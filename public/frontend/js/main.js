const responsive = {
    0: {
        items: 1
    },
    320: {
        items: 1
    },
    560: {
        items: 2
    },
    960: {
        items: 3
    }
}
$(document).ready(function () {

    $nav = $(".my-nav");
    $toggleCollapse = $(".toggle-collapse");

    $toggleCollapse.click(function () {
        $nav.toggleClass("collapse");
    }) 
    
    // Owl Carousel function
    $(".owl-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        automlayTimeout: 5000,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-arrow-left fa-2x mr-5'></i>", "<div class='fas fa-arrow-right fa-2x'></div>"],
        responsive: responsive
    });

    // AOS Instance
    AOS.init();
});
