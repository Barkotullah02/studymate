$(document).ready(function () {
    $('.slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        arrows: true,
        dots: false,
        speed: 300,
        centerPadding: '20px',
        infinite: true,
        autoplaySpeed: 2000,
        autoplay: true,
        responsive: [{
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false
            }
        }]
    });
});
