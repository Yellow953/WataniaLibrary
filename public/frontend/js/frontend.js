$(document).ready(function () {
    $(".product-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: { items: 2 },
            768: { items: 3 },
            992: { items: 4 },
            1200: { items: 5 },
        },
    });
});
