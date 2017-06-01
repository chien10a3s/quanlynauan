$(document).ready(function(){
    $('#mainslider').owlCarousel({
        animateOut: 'slideOutDown',
        animateIn: 'fadeIn',
        items:1,
        loop: true,
        margin:0,
        stagePadding:0,
        smartSpeed:450,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>']
    });
});

