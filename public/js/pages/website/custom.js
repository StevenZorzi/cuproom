// Because of the way this file is set up, this works the same
// as a document.ready statement.
// Add your code, either within the misc: section, or create your own function
// if you create your own, make sure to add a line at the bottom to run that code
// ie: Engine.ui.misc();
$(document).foundation();

$.holdReady(true);

setTimeout(function(){ $.holdReady(false); }, 100);

$(function() {

    "use strict";
    var Engine = {
        ui: {
            dfoundation: function() {
                
            }, // end foundation 


            misc: function() {

                /*---------   Mobile Menu   ---------*/

                $('header .menu-icon, .side-menu .close-button').on('click', function() {
				  $(".app-container").toggleClass("expanded");
                });

                $('.menu-icon').on('click', function() {
                    $(".productbar-wrap").slideToggle();
                });
                $('.submenu-parent').each(function(index, element) {
                    $(this).append('<span></span>');
                });

                $('.submenu-parent span').on('click', function(e) {
                    var submenu = $(this).closest('.submenu-parent').find('>.sub-menu');
                    if (submenu.is(":visible") == true) {
                        submenu.slideUp();
                        $(this).closest('.submenu-parent').removeClass('active');
                    } else {
                        submenu.slideDown();
                        $(this).closest('.submenu-parent').addClass('active');
                    }
                    e.preventDefault();
                });

                $('.sub-menu .submenu-parent span').on('click', function(e) {
                    var grandsubmenu = $(this).closest('.submenu-parent').find('>.grand-submenu');
                    if (grandsubmenu.is(":visible") == true) {
                        grandsubmenu.slideUp();
                        $(this).closest('.submenu-parent').removeClass('active');
                    } else {
                        grandsubmenu.slideDown();
                        $(this).closest('.submenu-parent').addClass('active');
                        if ($(this).closest('.submenu-parent').hasClass('active')) {
                            console.log('hi');
                            $(this).closest('.sub-menu').slideDown();
                        } else {
                            // $(this).closest('.sub-menu').slideUp();
                        }
                    }
                    e.preventDefault();
                });
                /*---------   Quantity Counter   ---------*/

                $('.quntity-box .minus').on('click', function() {
                    var count = $(this).siblings(".quntity-box input");
                    var val = parseInt(count.val(),10);
                    if (val > 1) {
                        count.val(val - 1);
                    }
                });
                $('.quntity-box .plus').on('click', function() {
                    var count = $(this).siblings(".quntity-box input");
                    var val = parseInt(count.val(),10);
                    count.val(val + 1);
                });

                $('.slider-img').each(function() {
                    var height = '';
                    var el = $(this),
                        src = el.attr('src'),
                        parent = el.parent();
                    height = $(window).height() - $('header').innerHeight();

                    parent.css({
                        'background-image': 'url(' + src + ')',
                        'background-size': 'cover',
                        'background-position': 'center',
                        'height': height
                    });

                    el.hide();
                });

                $('.slider2-img, .bg-img').each(function() {
                    var height = '';
                    var el = $(this),
                        src = el.attr('src'),
                        parent = el.parent();
                    height = $(window).height();

                    parent.css({
                        'background-image': 'url(' + src + ')',
                        'background-size': 'cover',
                        'background-position': 'center',
                        'height': height
                    });

                    el.hide();
                });

            }, // end misc

        }, // end ui

        utils: {
            sliders: function() {
                $('.home-slider').slick({
                    speed: 1200,
                    autoplaySpeed: 5000,
                    pauseOnHover: false,
                    slidesToShow: 1,
                    arrows: true,
                    dots: true,
                    touchMove: false,
                    slide: 'li',
                    //fade:true,
                    autoplay: true,
                    //infinite:false,
                    dotsClass: 'custom-paging',
                    customPaging: function(slider, i) {
                        return '0' + (i + 1) + ' ' + '<span>' + '/' + ' ' + '0' + slider.slideCount + '</span>';
                    }
                });

                $('.grid-1').slick({
                    //infinite: true,
                    arrows: true,
                    dots: false,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true
                });

                $('.grid-2').slick({
                    //infinite: true,
                    arrows: true,
                    dots: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 568,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });

                $('.grid-3').slick({
                    //infinite: true,
                    arrows: true,
                    dots: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 568,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });

                $('.grid-4').slick({
                    //infinite: true,
                    arrows: true,
                    dots: false,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 568,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
                $('.grid-5').slick({
                    infinite: true,
                    arrows: false,
                    dots: false,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 4,
                            }
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 568,
                            settings: {
                                slidesToShow: 2,
                            }
                        }
                    ]
                });

                $('.home-blog4 ul').slick({
                    //infinite: true,
                    arrows: true,
                    dots: false,
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    slide: 'li',
                    autoplay: true,
                    responsive: [{
                            breakpoint: 1680,
                            settings: {
                                slidesToShow: 1,
                            }
                        },
                        {
                            breakpoint: 568,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });

                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-nav'
                });
                $('.slider-nav').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for',
                    arrows: false,
                    dots: false,
                    centerMode: false,
                    focusOnSelect: true
                });

            },

            magnific: function() {

                $('.lookbook, .galleryzoom').each(function() {
                    $(this).magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        tLoading: 'Loading image #%curr%...',
                        mainClass: 'mfp-img-mobile',
                        gallery: {
                            enabled: true,
                            navigateByImgClick: true,
                            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                        },
                        image: {}
                    });
                });
            },
            

        }, // end utils

    };

    $( document ).ready(function() {
        Engine.ui.dfoundation();
        Engine.ui.misc();
        Engine.utils.sliders();
        Engine.utils.magnific();
    });

});

$( document ).ready(function() {

    $("#status").fadeOut();
    $("#preloader").fadeOut("slow");

    wow = new WOW(
      {
      boxClass:     'wow',      // default
      animateClass: 'animated', // default
      offset:       130,          // default
      mobile:       true,       // default
      live:         true        // default
    }
    )
    wow.init();

});

$(window).load(function() {

    if ($('.izotope-container').length) {
        var $container = $('.izotope-container');
        $container.isotope({
            itemSelector: '.item',
            layoutMode: 'masonry',
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });
        $('#filters').on('click', '.but', function() {
            $('.izotope-container').each(function() {
                $(this).find('.item').removeClass('animated');
            });

            $('#filters .but').removeClass('activbut');
            $(this).addClass('activbut');
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue
            });
        });
    }
               
});

$(document).on('click', 'a.internal[href^="#"]', function (event) {
    event.preventDefault();
    
    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top - 123
    }, 800);
});

$(window).scroll(function() {

    if ($(this).scrollTop() >= 1) {
        $('.main-header').addClass('stickytop');
    } else {
        $('.main-header').removeClass('stickytop');
    }
});