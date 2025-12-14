var CleaningLight = CleaningLight || {};

CleaningLight.primaryMenu = {

    init: function () {
        this.focusMenuWithChildren();
    },

    // The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
    // by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
    focusMenuWithChildren: function () {
        // Get all the link elements within the primary menu.
        var links, i, len,
            menu = document.querySelector('.box-header-nav');

        if (!menu) {
            return false;
        }

        links = menu.getElementsByTagName('a');

        // Each time a menu link is focused or blurred, toggle focus.
        for (i = 0, len = links.length; i < len; i++) {
            links[i].addEventListener('focus', toggleFocus, true);
            links[i].addEventListener('blur', toggleFocus, true);
        }

        //Sets or removes the .focus class on an element.
        function toggleFocus() {
            var self = this;
            // Move up through the ancestors of the current link until we hit .primary-menu.
            while (-1 === self.className.indexOf('main-menu')) {
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    if (-1 !== self.className.indexOf('focus')) {
                        self.className = self.className.replace(' focus', '');
                    } else {
                        self.className += ' focus';
                    }
                }
                self = self.parentElement;
            }
        }
    }
}; // CleaningLight.primaryMenu

(function($){
    // Search Modal Functions
    CleaningLight.searchModal = {
        lastFocusedElement: null,
        currentFocusTrapHandler: null,
        
        init: function() {
            this.bindEvents();
        },
        
        bindEvents: function() {
            var self = this;
            
            // Open search modal
            $('.menu-item-search a').on('click', function (e) {
                e.preventDefault();
                self.openSearchModal($(this));
            });
            
            // Close button click handler
            $('.full-search-wrapper').on('click', '.close-icon, .search-close', function (e) {
                e.preventDefault();
                e.stopPropagation();
                self.closeSearchModal();
            });
            
            // Close search on ESC key
            $(document).on('keydown', function (e) {
                if (e.key === "Escape" || e.keyCode === 27) {
                    self.closeSearchModal();
                }
            });
            
            // Close modal when clicking on backdrop
            $('.full-search-wrapper').on('click', function(e) {
                if ($(e.target).hasClass('full-search-wrapper')) {
                    self.closeSearchModal();
                }
            });
        },
        
        openSearchModal: function($clickedLink) {
            // Store what was focused before opening modal
            this.lastFocusedElement = $(document.activeElement);
            
            var $searchWrapper = $('.full-search-wrapper');
            var $searchField = $searchWrapper.find('.search-field').first();
            
            if ($clickedLink.hasClass('layout_two')) {
                $clickedLink.parents('.nav-menu').find('.main-menu, .nav-buttons').hide();
            }
            
            // Set ARIA attributes for accessibility
            $searchWrapper
                .addClass('search-triggered')
                .attr('aria-hidden', 'false')
                .attr('aria-modal', 'true')
                .attr('role', 'dialog');
            
            // Add aria-label to close button if not present
            $searchWrapper.find('.search-close, .close-icon')
                .attr('tabindex', '0')
                .attr('role', 'button')
                .attr('aria-label', 'Close search dialog');
            
            // Make body non-scrollable when modal is open
            $('body').addClass('modal-open');
            
            var self = this;
            setTimeout(function() {
                if ($searchWrapper.hasClass('search-triggered')) {
                    $searchField.focus();
                    self.currentFocusTrapHandler = self.trapFocus($searchWrapper[0]);
                }
            }, 50);
        },
        
        closeSearchModal: function() {
            var $searchWrapper = $('.full-search-wrapper');
            
            if ($searchWrapper.hasClass('search-triggered')) {
                // Remove focus trap handler if exists
                if (this.currentFocusTrapHandler) {
                    this.currentFocusTrapHandler();
                    this.currentFocusTrapHandler = null;
                }
                
                $searchWrapper
                    .removeClass('search-triggered')
                    .attr('aria-hidden', 'true')
                    .removeAttr('aria-modal')
                    .removeAttr('role');
                
                // Restore body scroll
                $('body').removeClass('modal-open');
                
                // Restore hidden elements if layout_two was used
                if ($('.menu-item-search a').hasClass('layout_two')) {
                    $('.nav-menu').find('.main-menu, .nav-buttons').show();
                }
                
                var self = this;
                setTimeout(function() {
                    if (self.lastFocusedElement && self.lastFocusedElement.length) {
                        self.lastFocusedElement.focus();
                    }
                    self.lastFocusedElement = null;
                }, 10);
            }
        },
        
        trapFocus: function(element) {
            if (!element) return null;
            
            // Get all focusable elements
            var focusableElements = element.querySelectorAll(
                'button, [href], [tabindex]:not([tabindex="-1"])'
            );
            
            // If no focusable elements, return
            if (focusableElements.length === 0) return null;
            
            var firstFocusable = focusableElements[0];
            var lastFocusable = focusableElements[focusableElements.length - 1];
            
            // Focus the first element
            firstFocusable.focus();
            
            // Handle Tab key
            function handleKeydown(e) {
                if (e.key !== 'Tab') return;
                
                // If shift+tab and currently on first focusable element
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusable) {
                        e.preventDefault();
                        lastFocusable.focus();
                    }
                } 
                // If tab and currently on last focusable element
                else {
                    if (document.activeElement === lastFocusable) {
                        e.preventDefault();
                        firstFocusable.focus();
                    }
                }
            }
            
            // Add event listener
            element.addEventListener('keydown', handleKeydown);
            
            // Return cleanup function
            return function removeFocusTrap() {
                element.removeEventListener('keydown', handleKeydown);
            };
        }
    };
})(jQuery);

jQuery(document).ready(function ($) {

    /**********
     * RTL Detection & Configuration
    */
    var brtl = $("body").hasClass('rtl');
    
    // RTL-specific configuration object
    var rtlConfig = {
        isRTL: brtl,
        directionSign: brtl ? -1 : 1,
        marginStart: brtl ? 'marginRight' : 'marginLeft',
        marginEnd: brtl ? 'marginLeft' : 'marginRight',
        paddingStart: brtl ? 'paddingRight' : 'paddingLeft',
        paddingEnd: brtl ? 'paddingLeft' : 'paddingRight',
        left: brtl ? 'right' : 'left',
        right: brtl ? 'left' : 'right',
        insetStart: brtl ? 'insetEnd' : 'insetStart',
        insetEnd: brtl ? 'insetStart' : 'insetEnd'
    };
    
    // Store RTL config globally for easy access
    window.cleaninglightRTL = rtlConfig;

    /**********
     * Primary Menu & Search Focus Class
    */
    CleaningLight.primaryMenu.init();    // Primary Menu
    
    CleaningLight.searchModal.init();    // Search Modal

    /** nav item */
    if ($('.site-header').hasClass('headerfive')) {
        var i = 1;
        var midValue = parseInt($('.main-menu >li').length / 2);
        $('.main-menu >li').each(function () {
            if (i == midValue) {
                $(this).addClass('last-child-left');
                $(this).after('<li class="menu-item menu-item-type-post_type menu-item-object-page logo-wrap text-center"><div class="cleaninglight-logo-wrap">' + jQuery('.site-brandinglogo').html() + '</div></li>');
            }
            i++;
        });
    }

    /**********
     * Mobile Menu Tabs
    */
    $('.cleaninglight-tab-area button').click(function(e){
        $(this).parent().find('button').removeClass('active');
        $(this).parent().parent().find('.cleaninglight-tab-content div.tab-content').addClass('hidden');
        var currentClass= $(this).attr('class').split(' ')[0]
        $(this).addClass('active');
        
        window.location.hash = currentClass;

        $(this).parent().parent().find(".cleaninglight-tab-content").find('.' + currentClass + "-content").removeClass('hidden');

    });

    /**********
     * Header Search
    */
    // $('.menu-item-search a').click(function () {
    //     if ($(this).hasClass('layout_two')) {
    //         $(this).parents('.nav-menu').find('.main-menu, .nav-buttons').hide();
    //     }
    //     $('.full-search-wrapper').addClass('search-triggered');
    //     setTimeout(function () {
    //         $('.full-search-wrapper .search-field').focus();
    //     }, 1000);
    // });

    // $('.full-search-wrapper .close-icon').click(function () {
    //     $('.full-search-wrapper').removeClass('search-triggered');
    // });

    /**********
     * Sidebar mobile menu 
    */
    $('body').click(function (evt) {

        //For descendants of menu_content being clicked, remove this check if you do not want to put constraint on descendants.
        if ($(evt.target).closest('.cover-modal.active').length)
            return;

        //Do processing of click event here for every element except with id menu_content
        if ($('body').hasClass('showing-menu-modal')) {
            var body = document.body;

            $('.cover-modal.active').removeClass('active');
            body.classList.remove('showing-modal');
            body.classList.add('hiding-modal');
            body.classList.remove('showing-menu-modal');
            body.classList.remove('show-modal');

            // Remove the hiding class after a delay, when animations have been run.
            setTimeout(function () {
                body.classList.remove('hiding-modal');
            }, 500);
        }
        return;
    });

    /**********
     * Banner Slider
    */
    var owlHome = $(".cleaninglight-banner-slide");
    var sliderObj = {
        rtl: JSON.parse(cleaninglight_options.rtl),
        items: 1,
        margin: 0,
        autoHeight :false,
        loop: parseInt(owlHome.data('loop')) == 1 ? true : false,
        autoplay: parseInt(owlHome.data('autoplay')) == 1 ? true : false,
        autoplayHoverPause: true,
        mouseDrag: parseInt(owlHome.data('drag')) == 1 ? true : false,
        autoplayTimeout: parseInt(owlHome.data('pause')) || 5000,
        smartSpeed: parseInt(owlHome.data('speed')) || 500,
        animateOut: ( owlHome.data('easing') === 'fadeOut' ) ? 'fadeOut' : false,
        animateIn: ( owlHome.data('easing') === 'fadeIn' ) ? 'fadeIn' : false,
        slideTransition: ( owlHome.data('easing') === 'slide' ) ? 'linear' : '',
        rtl: brtl,
        navText: ['', ''],
    }
    if(owlHome.data('navtype') == 'both' ){
        sliderObj.dots = true;
        sliderObj.nav = true;
    }
    else if(owlHome.data('navtype') == 'arrows' ){
        sliderObj.dots = false;
        sliderObj.nav = true;
    }
    else if(owlHome.data('navtype') == 'dots' ){
        sliderObj.dots = true;
        sliderObj.nav = false;
    }else{
        sliderObj.dots = false;
        sliderObj.nav = false;
    }
    
    owlHome.owlCarousel(sliderObj);

    $(".owl-item.active .cleaninglight-banner-supertitle").addClass('animated fadeInUp delay-1');
    $(".owl-item.active .cleaninglight-banner-title").addClass('animated fadeInUp delay-2');
    $(".owl-item.active .cleaninglight-banner-content").addClass('animated fadeInUp delay-3');
    $(".owl-item.active .cleaninglight-banner-btn-wrap").addClass('animated fadeInUp delay-4');

    owlHome.on('change.owl.carousel', function (event) {
        var item = event.item.index - 1;
        $('.cleaninglight-banner-supertitle').removeClass('animated fadeInUp delay-1');
        $('.cleaninglight-banner-title').removeClass('animated fadeInUp delay-2');
        $('.cleaninglight-banner-content').removeClass('animated fadeInUp delay-3');
        $('.cleaninglight-banner-btn-wrap').removeClass('animated fadeInUp delay-4');
        $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-banner-supertitle').addClass('animated fadeInUp delay-1');
        $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-banner-title').addClass('animated fadeInUp delay-2');
        $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-banner-content').addClass('animated fadeInUp delay-3');
        $('.owl-item').not('.cloned').eq(item).find('.cleaninglight-banner-btn-wrap').addClass('animated fadeInUp delay-4');
    });

    /**********
      *  Enable Number Count(1,2,3) in Owl Dots 
    */
    if (owlHome.data('dotstyle') == 'numberstyle') {
        var dots = document.querySelectorAll(".cleaninglight-banner-slide .owl-dots .owl-dot");
        var i = 1;
        dots.forEach((elem) => {
            elem.innerHTML = i;
            i++;
        });
    }

    function owlHomeThumb() {
        var bannerSlide = owlHome;
        bannerSlide.find('.owl-item').removeClass('prev next');
        var currentSlide = bannerSlide.find('.owl-item.active');

        currentSlide.next('.owl-item').addClass('next');
        currentSlide.prev('.owl-item').addClass('prev');

        var nextSlideImg = bannerSlide.find('.owl-item.next').find('.cleaninglight-banner-item-bg').data('img-url');
        var prevSlideImg = bannerSlide.find('.owl-item.active').find('.cleaninglight-banner-item-bg').data('img-url');

        bannerSlide.find('.owl-nav .owl-prev').css({
            backgroundImage: 'url(' + prevSlideImg + ')'
        });
        bannerSlide.find('.owl-nav .owl-next').css({
            backgroundImage: 'url(' + nextSlideImg + ')'
        });
    }
    owlHomeThumb();

    owlHome.on('translated.owl.carousel', function () {
        owlHomeThumb();
    });

    /**********
     * Progress Bar
    */
    $('.cleaninglight-progress-bar').each(function (index) {
        var $this = $(this);
        var delay_time = parseInt(index * 100 + 300);
        setTimeout(function () {
            $this.find('.cleaninglight-progress-bar-length').animate({
                width: $this.attr("data-width") + '%'
            }, 1000, function () {
                $this.find('span').animate({
                    opacity: 1
                }, 500).attr('data-index', index);
            });
        }, delay_time);
    });

    /**********
     * More About Us Toggle
    */
    $('.aboutus-service-block-wrap .cleaninglight-item-title').click(function(){
        $(this).parents('.aboutus-service-item').siblings().find('.aboutus-inner-service-wrap').slideUp();
        $(this).parents('.aboutus-service-item').siblings().removeClass('toggle-active');
        $(this).next('.aboutus-inner-service-wrap').slideToggle();
        $(this).parents('.aboutus-service-item').toggleClass('toggle-active');
    });
    
    /**********
     * Service Area
    */
    $(".service-area-block-wrap .service-area-block-item").hover(function () {
        $('.service-area-block-wrap .service-area-block-item').removeClass('active');
        $(this).addClass('active');
    });

    /**********
     * Tabs Block
    */
    $('.tabs-block-item').click(function () {
        $('.tabs-block-item').removeClass('tab-active');
        $('.tabs-block-content .tabs-block-item-content').addClass('d-none');
        //make active class
        var that = $(this);
        var id = that.data('id');
        that.addClass('tab-active');
        $('.tabs-block-content').find('#' + id).removeClass('d-none');
    });

    /**********
     * Video popup
    */
     $("a[rel^='prettyVideo[iframe]']").prettyPhoto({ default_width: 900, default_height: 500, social_tools: false, autoplay: true, deeplinking: false, });

    /**********
     * Gallery Block (Portfolio)
    */
    $('.cleaninglight-gallery-block-wrap').each(function () {
        var $this = $(this);
        var active_tab = $this.find('.cleaninglight-gallery-name-wrap').data('active');
        if ($this.find('.cleaninglight-gallery-item-name[data-filter="' + active_tab + '"]').length == 0) {
            var active_tab = $this.find('.cleaninglight-gallery-item-name:first').data('filter');
        }

        $this.find('.cleaninglight-gallery-item-name[data-filter="' + active_tab + '"]').addClass('active');
        var $container = $this.find('.cleaninglight-gallery-content').imagesLoaded(function () {

            $container.isotope({
                itemSelector: '.cleaninglight-gallery-content-item',
                filter: active_tab
            });

            SetMasonaryClass($this, $container);

            $(window).on('resize', function () {
                GetMasonary($this, $container);
            }).resize();

            $container.isotope({
                itemSelector: '.cleaninglight-gallery-content-item',
                filter: active_tab,
            });
        });

        $this.find('.cleaninglight-gallery-item-wrap').on('click', '.cleaninglight-gallery-item-name', function () {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue
            });

            SetMasonaryClass($this, $container);

            GetMasonary($this, $container);
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                itemSelector: '.cleaninglight-gallery-content-item',
                filter: filterValue
            });
            $(this).siblings('.cleaninglight-gallery-item-name').removeClass('active');
            $(this).addClass('active');
        });
    });

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
                    $(this).css({
                        height: three_col_image + 'px',
                        width: three_col_image + 'px'
                    });
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style2')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            height: three_col_image_double + 'px',
                            width: three_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            height: three_col_image + 'px',
                            width: three_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: three_col_image_double + 'px',
                            height: three_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            width: three_col_image + 'px',
                            height: three_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            width: four_col_image * 2 + 'px',
                            height: four_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            width: four_col_image + 'px',
                            height: four_col_image + 'px'
                        });
                    }
                })
            }

        } else if (winWidth > 480) {
            if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style1')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    $(this).css({
                        height: two_col_image + 'px',
                        width: two_col_image + 'px'
                    });
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style2')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    if ($(this).hasClass('wide')) {
                        $(this).css({
                            height: two_col_image_double + 'px',
                            width: two_col_image + 'px'
                        });
                    } else {
                        $(this).css({
                            height: two_col_image + 'px',
                            width: two_col_image + 'px'
                        });
                    }
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    $(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                })
            } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
                $container.find('.cleaninglight-gallery-content-item').each(function () {
                    $(this).css({
                        width: two_col_image + 'px',
                        height: two_col_image + 'px'
                    });
                })
            }
        } else {
            $container.find('.cleaninglight-gallery-content-item').each(function () {
                $(this).css({
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
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 7) {
                    i = 0;
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style3')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 2 || i == 6) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 10) {
                    i = 0;
                }
            })
        } else if ($element.find('.cleaninglight-gallery-content-wrap').hasClass('style6')) {
            elems.forEach(function (item, index) {
                i++;
                if (i == 3 || i == 5 || i == 7) {
                    $(item).addClass('wide');
                } else {
                    $(item).removeClass('wide');
                }

                if (i == 9) {
                    i = 0;
                }
            })
        }
    }

    /**********
     * Gallery Light Box
    */
    $("a[rel^='portfolio[work]']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: false,
        deeplinking: false,
        social_tools: false,
        default_width: 900,
        default_height: 500,
    });

    /**********
     * Counter Block
    */
    $count = $('.counternumber');
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

    /**********
     * Team Block
    */
    var owlTeam = $(".team-block-slider");
    owlTeam.owlCarousel({
        rtl: JSON.parse(cleaninglight_options.rtl),
        loop: true,
        autoplay: true,
        autoHeight :false,
        autoplayHoverPause: true,
        mouseDrag: true,
        nav: true,
        dots: true,
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
                margin: 15,
            },
            1024: {
                items: owlTeam.data('item'),
                margin: 15,
            }
        }
    });

    /**********
     * Testimonial Block
    */
    var owlTestimonial = $(".testimonial-block-slider");
    owlTestimonial.owlCarousel({
        rtl: JSON.parse(cleaninglight_options.rtl),
        loop: true,
        autoplay: true,
        autoHeight :false,
        autoplayHoverPause: true,
        mouseDrag: true,
        nav: true,
        dots: true,
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
                margin: 15,
            },
            1024: {
                items: owlTestimonial.data('item'),
                margin: 15,
            }
        }
    });

    /**********
     * Client logo owl slider
    */
    var owlClient = $(".client-logo-slider");
    owlClient.owlCarousel({
        rtl: JSON.parse(cleaninglight_options.rtl),
        loop: true,
        autoplay: true,
        autoHeight :false,
        autoplayHoverPause: true,
        mouseDrag: true,
        nav: true,
        dots: false,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1,
                margin: 0,
            },
            480: {
                items: 2,
                margin: 0,
            },
            768: {
                items: 3,
                margin: 15,
            },
            1024: {
                items: 4,
                margin: 15,
            }
        }
    });

    /**********
     * Blog Block
    */
    var owlBlog = $(".blog-block-slider");
    owlBlog.owlCarousel({
        rtl: JSON.parse(cleaninglight_options.rtl),
        loop: true,
        autoplay: true,
        autoHeight :false,
        autoplayHoverPause: true,
        mouseDrag: true,
        nav: true,
        dots: true,
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
                margin: 15,
            },
            1024: {
                items: owlBlog.data('item'),
                margin: 15,
            }
        }
    });

    /**********
     * Contact Section 
    */
    $('body').on('click', '.contact-detail-toggle.open', function () {
        $(this).next('.contact-content').addClass('box-hidden');
        $(this).addClass('closed').removeClass('open');
    });

    $('body').on('click', '.contact-detail-toggle.closed', function () {
        $(this).next('.contact-content').removeClass('box-hidden');
        $(this).removeClass('closed').addClass('open');
    });

    /**********
     * scrollTop To Top
    */
    $(window).scroll(function () {
        if ($(window).scrollTop() > 300) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    });

    $('#back-to-top').click(function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    try {
        var progressPath = document.querySelector('.progress path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 300ms linear';
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var percent = Math.round(scroll * 100 / height);
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
            $('.percent').text(percent + "%");
        };
        updateProgress();
        $(window).scroll(updateProgress);
    } catch (e) {

    }

    /**********
     * Leaflet Map
    */
    initLeafletMap();

});

let leafletMapInstance; // global

function initLeafletMap() {
    const $mapContainer = jQuery("#google-map");

    if ($mapContainer.length) {
        let latitude = parseFloat($mapContainer.data('latitude')) || 27.7172;
        let longitude = parseFloat($mapContainer.data('longitude')) || 85.3240;
        let mapAddress = $mapContainer.data('mapaddress') || '';

        if (leafletMapInstance) {
            leafletMapInstance.remove();
            leafletMapInstance = null;
        }

        $mapContainer.html("");

        leafletMapInstance = L.map('google-map').setView([latitude, longitude], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 25,
        }).addTo(leafletMapInstance);

        const marker = L.marker([latitude, longitude]).addTo(leafletMapInstance);

        if (mapAddress.trim() !== "") {
            marker.bindPopup(mapAddress).openPopup();
        }

        setTimeout(function() {
            leafletMapInstance.invalidateSize();
        }, 300);
    }
}