jQuery(function($) {

  /**
   * ハンバーガーメニューの開閉
   */
  $('.js-menu-icon').on('click', function() {
    // 1. ボタンを「×」
    $(this).toggleClass('is-active');
    // 2. メニューを右から出す
    $('.l_header_nav').toggleClass('is-active');
    // 3. 背景を暗くする
    $('.m_nav-overlay').toggleClass('is-active');
  });

  /**
   * 背景（オーバーレイ）をクリックしても閉じるようにする
   */
  $('.m_nav-overlay').on('click', function() {
    $('.js-menu-icon').removeClass('is-active');
    $('.l_header_nav').removeClass('is-active');
    $(this).removeClass('is-active');
  });

  /**
   * スクロールでヘッダーに色をつける
   */
  $(window).on('scroll', function() {
    // 100px以上スクロールしたら
    if ($(this).scrollTop() > 100) {
      $('.l_header').addClass('is-scrolled');
    } else {
      $('.l_header').removeClass('is-scrolled');
    }
  });

});