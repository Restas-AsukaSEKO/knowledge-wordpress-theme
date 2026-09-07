jQuery(function($) {
    $('.js-slider').slick({
        fade: true,
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 3000,         // 小文字に修正
        dots: false,
        arrows: false,
        accessibility: false,
        infinite: true,
        pauseOnFocus: false,  // フォーカスによる停止を無効化
        pauseOnHover: false,  // マウスホバーによる停止を無効化
    });
});