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
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>']
    });
    
    $('#testimonial').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items:1,
        loop: true,
        margin:0,
        stagePadding:0,
        smartSpeed:450,
        nav: true,
        dots: false,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>']
    });
    
    $("#main-menu-mobile").mmenu();
    
    //$('.header-primary').sticky({topSpacing:101});
});

$(window).scroll(function(){
    if($(window).scrollTop() > 101){
        $('#masthead').css('height', $('.header-primary').outerHeight());
        $('body').addClass('header-fixed');
        
    }else{
        $('#masthead').css('height', $('.header-primary').outerHeight());
        $('body').removeClass('header-fixed');
    }
});

