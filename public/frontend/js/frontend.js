$(document).ready(function () {
    $(".products")({
        items: 4,
        loop: false,
        margin: 20,
        nav: false,
        dots: true,
        responsive: {
            0: { items: 2 },
            600: { items: 3 },
            1080: { items: 4 },
        },
    });
});
