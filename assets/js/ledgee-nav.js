document.addEventListener('DOMContentLoaded', function () {
  var ledgee = document.querySelector('.js-ledgee');
  var bubbles = document.querySelectorAll('.js-ledgee-bubble');
  var topButtons = document.querySelectorAll('.js-ledgee-top');
  var kvWrapper = document.querySelector('.kv_wrapper');

  if (!ledgee && !bubbles.length && !topButtons.length) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var bubbleTimer = null;
  var bubbleDuration = reduceMotion ? 1800 : 2600;

  /**
   * 1. セクション別ひとことナビゲーション
   * 対象セクションに初めて入ったタイミングで吹き出しを表示し、2〜3秒後にフェードアウトする。
   * 同一セクションでの再表示はしない。
   */
  function showBubble(text) {
    bubbles.forEach(function (bubble) {
      bubble.textContent = text;
      bubble.classList.add('is-visible');
    });
    if (bubbleTimer) clearTimeout(bubbleTimer);
    bubbleTimer = setTimeout(function () {
      bubbles.forEach(function (bubble) {
        bubble.classList.remove('is-visible');
      });
    }, bubbleDuration);
  }

  var sectionMessages = [
    { id: 'item', text: 'どれから見る？' },
    { id: 'styling', text: '着こなしから探してみる？' },
    { id: 'about', text: 'KNOWLEDGEのこと、少しだけ。' }
  ];

  if (bubbles.length && 'IntersectionObserver' in window) {
    sectionMessages.forEach(function (section) {
      var target = document.getElementById(section.id);
      if (!target) return;

      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            showBubble(section.text);
            observer.unobserve(target);
          }
        });
      }, { threshold: 0.3 });

      observer.observe(target);
    });
  }

  /**
   * 2. 深くスクロールしたらTOPへ戻る
   */
  if (topButtons.length) {
    var topThreshold = window.innerHeight;
    var topVisible = false;

    var updateTopVisibility = function () {
      var shouldShow = window.scrollY > topThreshold;
      if (shouldShow === topVisible) return;
      topVisible = shouldShow;

      topButtons.forEach(function (btn) {
        btn.classList.toggle('is-visible', shouldShow);
        btn.setAttribute('aria-hidden', shouldShow ? 'false' : 'true');
      });
    };

    window.addEventListener('scroll', updateTopVisibility, { passive: true });
    updateTopVisibility();

    topButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
      });
    });
  }

  /**
   * 3. SP専用：FV（KV領域）を抜けたら、レッジー本人を画面端にfixed表示する
   */
  if (ledgee && kvWrapper && 'IntersectionObserver' in window) {
    var isFixedNav = false;
    var showHideTimer = null;

    var activateFixedNav = function () {
      if (isFixedNav) return;
      isFixedNav = true;
      if (showHideTimer) { clearTimeout(showHideTimer); showHideTimer = null; }
      ledgee.classList.add('is-fixed-nav');
      requestAnimationFrame(function () {
        requestAnimationFrame(function () {
          ledgee.classList.add('is-shown');
        });
      });
    };

    var deactivateFixedNav = function () {
      if (!isFixedNav) return;
      isFixedNav = false;
      ledgee.classList.remove('is-shown');
      showHideTimer = setTimeout(function () {
        ledgee.classList.remove('is-fixed-nav');
      }, reduceMotion ? 0 : 400);
    };

    var kvObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          deactivateFixedNav();
        } else {
          activateFixedNav();
        }
      });
    }, { threshold: 0 });

    kvObserver.observe(kvWrapper);

    /**
     * 4. SP専用：Item／Stylingでは、案内（吹き出し）を終えたら
     * レッジーを画面右方向へ一時的に退避させ、商品写真を隠さないようにする。
     * セクションを抜けたら（前後どちら向きにスクロールしても）再表示する。
     * About以降ではこの退避処理は行わず、常時表示のままにする。
     */
    var retreatZones = ['item', 'styling'];
    var retreatTimer = null;

    var showLedgeeBody = function () {
      if (retreatTimer) { clearTimeout(retreatTimer); retreatTimer = null; }
      ledgee.classList.remove('is-retreated');
    };

    var scheduleRetreat = function (delay) {
      if (retreatTimer) clearTimeout(retreatTimer);
      retreatTimer = setTimeout(function () {
        ledgee.classList.add('is-retreated');
      }, delay);
    };

    retreatZones.forEach(function (id) {
      var target = document.getElementById(id);
      if (!target) return;
      var bubbleAlreadyShownHere = false;

      var zoneObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            showLedgeeBody();
            if (!bubbleAlreadyShownHere) {
              bubbleAlreadyShownHere = true;
              // 案内(吹き出し)表示が終わるタイミングに合わせて退避する
              scheduleRetreat(bubbleDuration + 300);
            } else {
              // 再訪時は吹き出しを出さないため、短い猶予のあと退避する
              scheduleRetreat(reduceMotion ? 0 : 1200);
            }
          } else {
            // セクションを抜けたら（どちら向きでも）再表示する
            showLedgeeBody();
          }
        });
      }, { threshold: 0.3 });

      zoneObserver.observe(target);
    });
  }
});
