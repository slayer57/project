$(".slider-for").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".slider-nav",
    autoplaySpeed: 1000,
    speed: 1500,
});
$(".slider-nav").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    infinite: true,

    asNavFor: ".slider-for",
    centerMode: true,
    focusOnSelect: true,
});

$(".single-item").slick({
    dots: true,
    infinite: true,
    speed: 1500,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: true,
    prevArrow: '<i class="fa-solid fa-chevron-left slick-left"></i>',
    nextArrow: '<i class="fa-solid fa-chevron-right slick-right"></i>',
});

$(".minus, .plus").click(function (e) {
    e.preventDefault();
    var $input = $(this).siblings(".value");
    var val = parseInt($input.val(), 10);
    $input.val(val + ($(this).hasClass("minus") ? -1 : 1));
    if ($input.val() < 1) {
        $input.val(1);
    }
});
