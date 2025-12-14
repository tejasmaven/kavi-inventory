(function ($, elementor) {
    "use strict";
    var CleaningLightElements = {

        init: function () {

            var widgets = {
                'CleaningLight-slider.default': CleaningLightElements.CleaningLightSliderController,
                'CleaningLight-counter-block.default': CleaningLightElements.CleaningLightCounterController,
                'CleaningLight-progress-bar.default': CleaningLightElements.CleaningLightProgressBarController,
                'CleaningLight-team-carousel.default': CleaningLightElements.CleaningLightTeamCarouselController,
                'CleaningLight-testimonial-carousel.default': CleaningLightElements.CleaningLightTestimonialCarouselController,
                'CleaningLight-testimonial-slider.default': CleaningLightElements.CleaningLightTestimonialSliderController,
                'CleaningLight-logo-carousel.default': CleaningLightElements.CleaningLightLogoCarouselController,
                'CleaningLight-advance-gallery.default': CleaningLightElements.CleaningLightAdvanceGalleryController,
                'CleaningLight-image-flipster.default': CleaningLightElements.CleaningLightImageFlipsterController,
                'CleaningLight-video-popup.default': CleaningLightElements.CleaningLightvideoController,
                'CleaningLight-contact-block.default': CleaningLightElements.CleaningLightContactBlock,
                'CleaningLight-service-block.default': CleaningLightElements.CleaningLightServiceBlock,
            };
            
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },

        CleaningLightSliderController: function ($scope) {
            var $element = $scope.find('.cleaninglight-sliders');
            var params = JSON.parse($element.attr('data-params'));
            if ($element.length > 0) {
                var sliderObj = {
                    rtl: JSON.parse(cleaninglight_themes_ele_options.rtl),
                    items: 1,
                    margin: 0,
                    autoHeight :false,
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplayHoverPause: JSON.parse(params.mouseDrag),
                    autoplayTimeout: params.pause,
                    smartSpeed: params.speed,
                    navText: ['', ''],
                }
                if(params.nav == 'both' ){
                    sliderObj.dots = true;
                    sliderObj.nav = true;
                }
                else if(params.nav == 'arrows' ){
                    sliderObj.dots = false;
                    sliderObj.nav = true;
                }
                else if(params.nav == 'dots' ){
                    sliderObj.dots = true;
                    sliderObj.nav = false;
                }else{
                    sliderObj.dots = false;
                    sliderObj.nav = false;
                }

                if (params.easing == 'fade') {
                    sliderObj.animateOut = 'fadeOut';
                }

                $element.owlCarousel(sliderObj);
            }

            $(".owl-item.active .cleaninglight-slider-super-title").addClass('animated  '+params.animation+'');
            $(".owl-item.active .cleaninglight-slider-title").addClass('animated '+params.animation+'');
            $(".owl-item.active .cleaninglight-slider-description").addClass('animated '+params.animation+'');
            $(".owl-item.active .cleaninglight-button-wrapper").addClass('animated '+params.animation+'');

            $element.on('change.owl.carousel', function (event) {
                var item = event.item.index - 1;
                $('.cleaninglight-slider-super-title').removeClass('animated '+params.animation+'');
                $('.cleaninglight-slider-title').removeClass('animated '+params.animation+'');
                $('.cleaninglight-slider-description').removeClass('animated '+params.animation+'');
                $('.cleaninglight-button-wrapper').removeClass('animated '+params.animation+'');
                $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-slider-super-title').addClass('animated '+params.animation+'');
                $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-slider-title').addClass('animated '+params.animation+'');
                $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-slider-description').addClass('animated '+params.animation+'');
                $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-button-wrapper').addClass('animated '+params.animation+'');
            });

            /**
             *  Enable Number Count(1,2,3) in Owl Dots 
            */
            if (params.dots_type == 'number_type') {
                var dots = document.querySelectorAll(".cleaninglight-sliders .owl-dots .owl-dot");
                var i = 1;
                dots.forEach((elem) => {
                    elem.innerHTML = i;
                    i++;
                });
            }

            function IKthemeowlHomeThumb() {
                var bannerSlide = $element;
                bannerSlide.find('.owl-item').removeClass('prev next');
                var currentSlide = bannerSlide.find('.owl-item.active');
        
                currentSlide.next('.owl-item').addClass('next');
                currentSlide.prev('.owl-item').addClass('prev');
        
                var nextSlideImg = bannerSlide.find('.owl-item.next').find('.cleaninglight-slide-bg').data('img-url');
                var prevSlideImg = bannerSlide.find('.owl-item.active').find('.cleaninglight-slide-bg').data('img-url');
        
                bannerSlide.find('.owl-nav .owl-prev').css({
                    backgroundImage: 'url(' + prevSlideImg + ')'
                });
                bannerSlide.find('.owl-nav .owl-next').css({
                    backgroundImage: 'url(' + nextSlideImg + ')'
                });
            }
            IKthemeowlHomeThumb();
            
            $element.on('translated.owl.carousel', function () {
                IKthemeowlHomeThumb();
            });
        },

        CleaningLightCounterController: function ($scope) {
            var $count = $scope.find('.ikthemes-counter-number');
            if ($count.length > 0) {

                $count.each(function (index) {

                    var durations = $count.data('durations');
                    var fromvalue = $count.data('fromvalue');
                    var delimiters = $count.data('delimiters');

                    $(this).prop('Counter',fromvalue).animate({
                        Counter: $(this).text()
                    }, {
                        duration: durations,
                        easing: 'swing',
                        step: function(now) {
                            $(this).text(commaSeparateNumber(Math.ceil(now),delimiters));
                        }
                    });

                });

                function commaSeparateNumber(val, val1){

                    while (/(\d+)(\d{3})/.test(val)){
                        val = val.toString().replace(/(\d+)(\d{3})/, '$1'+''+val1+'$2');
                    }
                    return val;
                }
                commaSeparateNumber();
            }
        },

        CleaningLightLogoCarouselController: function ($scope) {
            var $element = $scope.find('.ikthemes-logo-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(cleaninglight_themes_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['', ''],
                    responsive: {
                        0: {
                            items: 1,
                            margin: 0,
                        },
                        480: {
                            items: 1,
                            margin: 0,
                        },
                        768: {
                            items: 3,
                            margin: params.margin,
                        },
                        1024: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        CleaningLightTeamCarouselController: function ($scope) {
            var $element = $scope.find('.cleaninglight-team-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(cleaninglight_themes_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['', ''],
                    responsive: {
                        0: {
                            items: 1,
                            margin: 0,
                        },
                        480: {
                            items: 1,
                            margin: 0,
                        },
                        768: {
                            items: 2,
                            margin: params.margin,
                        },
                        1024: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        CleaningLightTestimonialCarouselController: function ($scope) {
            var $element = $scope.find('.cleaninglight-testimonial-carousel');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(cleaninglight_themes_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['', ''],
                    responsive: {
                        0: {
                            items: 1,
                            margin: 0,
                        },
                        480: {
                            items: 1,
                            margin: 0,
                        },
                        768: {
                            items: 2,
                            margin: params.margin,
                        },
                        1024: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },

        CleaningLightTestimonialSliderController: function ($scope) {
            var $element = $scope.find('.cleaninglight-testimonial-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    rtl: JSON.parse(cleaninglight_themes_ele_options.rtl),
                    loop: JSON.parse(params.loop),
                    autoplay: JSON.parse(params.autoplay),
                    autoplaySpeed: params.speed,
                    autoplayTimeout: params.pause,
                    autoplayHoverPause: JSON.parse(params.pause_on_hover),
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['', ''],
                    items: 1,
                    margin:0,
                });
            }
        },

        CleaningLightImageFlipsterController: function ($scope) {
            var $element = $scope.find('.ikthemes-image-flipster-carousel');
            if ($element.length > 0) {
                $element.flipster({
                    itemContainer: '.ikthemes-flipster',
                    itemSelector: '.ikthemes-image-slide',
                    style: $element.attr('data-style'),
                    enableMousewheel: false,
                    enableKeyboard: true,
                    enableNavButtons: true,
                    enableTouch: true,
                    prevText: '<i class="fa-solid fa-chevron-left"></i>',
                    nextText: '<i class="fa-solid fa-chevron-right"></i>',
                });
            }
        },

        CleaningLightProgressBarController: function ($scope) {
            var $el = $scope.find('.cleaninglight-progress-bar-wrapper');
            if (($el.length > 0)) {
                var $newel = $el.find('.cleaninglight-progress-bar');
                $newel.each(function (index) {
                    var $el = $(this);
                    var delay_time = parseInt(index * 100 + 300);
                    setTimeout(function () {
                        $el.find('.cleaninglight-progress-bar-length').animate({
                            width: $el.attr("data-width") + '%'
                        }, 1000, function () {
                            $el.find('span').animate({
                                opacity: 1
                            }, 500).attr('data-index', index);
                        });
                    }, delay_time);
                });
            }
        },

        CleaningLightAdvanceGalleryController: function ($scope) {
            
            var $el = $scope.find('.cleaninglight-gallery-block-wrap');
            if (($el.length > 0)) {

                var active_tab = $el.find('.cleaninglight-gallery-name-wrap').data('active');
                if ($el.find('.cleaninglight-gallery-item-name[data-filter="' + active_tab + '"]').length == 0) {
                    var active_tab = $el.find('.cleaninglight-gallery-item-name:first').data('filter');
                }
        
                $el.find('.cleaninglight-gallery-item-name[data-filter="' + active_tab + '"]').addClass('active');

                var $container = $('.cleaninglight-gallery-content').imagesLoaded(function () {

                    $container.isotope({
                        itemSelector: '.cleaninglight-gallery-content-item',
                        filter: active_tab
                    });
        
                    SetMasonaryClass($el, $container);
        
                    $(window).on('resize', function () {
                        GetMasonary($el, $container);
                    }).resize();
        
                    $container.isotope({
                        itemSelector: '.cleaninglight-gallery-content-item',
                        filter: active_tab,
                    });
                });
        
                $el.find('.cleaninglight-gallery-item-wrap').on('click', '.cleaninglight-gallery-item-name', function () {
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({
                        filter: filterValue
                    });
        
                    SetMasonaryClass($el, $container);
        
                    GetMasonary($el, $container);

                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({
                        itemSelector: '.cleaninglight-gallery-content-item',
                        filter: filterValue
                    });

                    $(this).siblings('.cleaninglight-gallery-item-name').removeClass('active');
                    $(this).addClass('active');
                });
            }
        },

        CleaningLightserviceController: function ($scope) {
            var $el = $scope.find('.cleaninglight-toggle-service-wrap.style2');
            if (($el.length > 0)) {
                $el.on('click', '.cleaninglight-toggle-service-block-wrap .cleaninglight-item-title', function () {
                    $(this).parents('.cleaninglight-toggle-service-item').siblings().find('.cleaninglight-toggle-inner-service-wrap').slideUp();
                    $(this).parents('.cleaninglight-toggle-service-item').siblings().removeClass('toggle-active');
                    $(this).next('.cleaninglight-toggle-inner-service-wrap').slideToggle();
                    $(this).parents('.cleaninglight-toggle-service-item').toggleClass('toggle-active');
                });

                $el.on('click', '.cleaninglight-toggle-icon-wrapper', function () {
                    $(this).parents('.cleaninglight-toggle-service-item').siblings().find('.cleaninglight-toggle-inner-service-wrap').slideUp();
                    $(this).parents('.cleaninglight-toggle-service-item').siblings().removeClass('toggle-active');
                    $(this).next('.cleaninglight-toggle-service-block-wrap').find('.cleaninglight-toggle-inner-service-wrap').slideToggle();
                    $(this).parent('.cleaninglight-toggle-service-item').toggleClass('toggle-active');
                });
            }
        },
        
        CleaningLightServiceBlock: function ($scope) {
            var $count = $scope.find('.cleaninglight-service-area');
            if ($count.length > 0) {
                $(".cleaninglight-service-area.style4 .cleaninglight-service-block").hover(function () {
                    $('.cleaninglight-service-area.style4 .cleaninglight-service-block').removeClass('active');
                    $(this).addClass('active');
                }); 
            }
        },

        CleaningLightvideoController: function ($scope) {
            var $element = $scope.find('.ikthemes-video-popup');
            if ($element.length > 0) {
                $("a[rel^='ikthemesVideo[iframe]']").prettyPhoto({ 
                    default_width: 950, 
                    default_height: 550, 
                    social_tools: false, 
                    autoplay: true, 
                    deeplinking: false, 
                    show_title: false
                });

            }
        },

        CleaningLightContactBlock: function ($scope) {
            var $element = $scope.find('.ikthemes-contact-area');
            if ($element.length > 0) {
                $element.find('.ikthemes-contact-detail-toggle').on('click', function () {
                    if ($(this).hasClass('ikthemes-open')) {
                        $(this).next('.ikthemes-contact-content').addClass('ikthemes-box-hidden');
                        $(this).addClass('ikthemes-closed').removeClass('ikthemes-open');
                    } else {
                        $(this).next('.ikthemes-contact-content').removeClass('ikthemes-box-hidden');
                        $(this).removeClass('ikthemes-closed').addClass('ikthemes-open');
                    }
                });
            }
        },

    };
    
    $(window).on('elementor/frontend/init', CleaningLightElements.init);

}(jQuery, window.elementorFrontend));


function GetMasonary($element, $container) {
    var winWidth = window.innerWidth;
    var containerWidth = $element.find('.cleaninglight-gallery-content').width();

    var two_col_image = containerWidth / 2;
    var three_col_image = containerWidth / 3;
    var four_col_image = containerWidth / 4;

    var three_col_image_double = (three_col_image * 2);
    var two_col_image_double = (two_col_image * 2);

    if (winWidth > 768) {

        if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style1')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    height: three_col_image + 'px',
                    width: three_col_image + 'px'
                });
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style2')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        height: three_col_image_double + 'px',
                        width: three_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        height: three_col_image + 'px',
                        width: three_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: three_col_image_double + 'px',
                        height: three_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: three_col_image + 'px',
                        height: three_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style4')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    height: four_col_image + 'px',
                    width: four_col_image + 'px'
                });
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style5')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: four_col_image * 2 + 'px',
                        height: four_col_image * 2 + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: four_col_image + 'px',
                        height: four_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: four_col_image * 2 + 'px',
                        height: four_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: four_col_image + 'px',
                        height: four_col_image + 'px'
                    });
                }
            })
        }

    } else if (winWidth > 480) {
        if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style1')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    height: two_col_image + 'px',
                    width: two_col_image + 'px'
                });
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style2')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        height: two_col_image_double + 'px',
                        width: two_col_image + 'px'
                    });
                } else {
                    jQuery(this).css({
                        height: two_col_image + 'px',
                        width: two_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    width: two_col_image + 'px',
                    height: two_col_image + 'px'
                });
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style4')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    height: two_col_image + 'px',
                    width: two_col_image + 'px'
                });
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style5')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                if (jQuery(this).hasClass('wide')) {
                    jQuery(this).css({
                        width: two_col_image * 2 + 'px',
                        height: two_col_image * 2 + 'px'
                    });
                } else {
                    jQuery(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                jQuery(this).css({
                    width: two_col_image + 'px',
                    height: two_col_image + 'px'
                });
            })
        }
    } else {
        $container.find('.cleaninglight-gallery-content-item').each(function () {
            jQuery(this).css({
                width: containerWidth + 'px',
                height: containerWidth + 'px'
            });
        })
    }
}

function SetMasonaryClass($element, $container) {
    var elems = $container.isotope('getFilteredItemElements');
    var i = 0;
    if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style2')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 1 || i == 5) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 7) {
                i = 0;
            }
        })
    } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 2 || i == 6) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 10) {
                i = 0;
            }
        })
    } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style5')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 3 || i == 6) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 10) {
                i = 0;
            }
        })
    } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
        elems.forEach(function (item, index) {
            i++;
            if (i == 3 || i == 5 || i == 7) {
                jQuery(item).addClass('wide');
            } else {
                jQuery(item).removeClass('wide');
            }

            if (i == 9) {
                i = 0;
            }
        })
    }
}