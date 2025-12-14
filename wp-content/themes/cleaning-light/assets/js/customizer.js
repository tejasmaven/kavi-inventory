jQuery(document).ready(function ($) {

    function CleaningLightConvertHex(hexcolor, opacity) {
        var hex = String(hexcolor).replace(/[^0-9a-f]/gi, '');
        if (hex.length < 6) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        r = parseInt(hex.substring(0, 2), 16);
        g = parseInt(hex.substring(2, 4), 16);
        b = parseInt(hex.substring(4, 6), 16);

        result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
        return result;
    }

    function cleaninglight_set_dynamic_css(control, style) {
        jQuery('style.' + control).remove();
        jQuery('body').append('<style class="' + control + '">' + style + '</style>');
    }

    $('.repeater-field-title.accordion-section-title').click(function () {
        $(this).toggleClass('expanded');
    });

    $('.repeater-selected-icon').click(function () {
        $(this).find(".fa-angle-down").toggleClass('fa-angle-up');
    });


    // Site title and description.
    wp.customize('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title a').text(to);
        });
    });
    wp.customize('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });

    // Header text color.
    wp.customize('header_textcolor', function (value) {
        value.bind(function (to) {
            if ('blank' === to) {
                $('.site-title, .site-description').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.site-title, .site-description').css({
                    'clip': 'auto',
                    'position': 'relative'
                });
                $('.site-title a, .site-description').css({
                    'color': to
                });
            }
        });
    });

    /************
     * Top Header Settings 
    */
    wp.customize('cleaninglight_top_header_hide_show', function (value) {
        value.bind(function (to) {
            var visibility = JSON.parse(to);
            var desk_visibility = 'desktop-' + visibility.desktop;
            var tab_visibility = 'tablet-' + visibility.tablet;
            var mob_visibility = 'mobile-' + visibility.mobile;
            var cleaninglight_top_bar = 'top-menu-bar ' + desk_visibility + ' ' + tab_visibility + ' ' + mob_visibility;
            $('.top-menu-bar').attr('class', cleaninglight_top_bar);
        });
    });

    wp.customize('cleaninglight_th_bg_color', function (value) {
        value.bind(function (color) {
            $('.top-menu-bar').css('background-color', color);
        })
    });

    /** Content COLOR OPTIONS */
    wp.customize('content_text_color', function (value) {
        value.bind(function (to) {
            var borderColor = CleaningLightConvertHex(to, 10);
            var lighterBorderColor = CleaningLightConvertHex(to, 5);
            var css = ".content-area{color:" + to + "}";
            css += ".widget-area .widget{border-color:" + borderColor + "}";
            css += ".widget-area li{border-color:" + lighterBorderColor + "}";
            cleaninglight_set_dynamic_css('content_text_color', css);
        });
    });

    /*****
     * Menu Style style 
    */
    wp.customize('cleaninglight_header_full_nav_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.nav-classic .nav-menu, .headertwo .nav-classic .nav-menu, .headerthree .nav-classic .nav-menu{background-color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_header_full_nav_bg_color', css);
        });
    });

    /** Menu Item Color */
    wp.customize('cleaninglight_menu_item_color', function (value) {
        value.bind(function (to) {
            var css = '.box-header-nav .main-menu .page_item a, .box-header-nav .main-menu>.menu-item>a, .menu-item-search a, .headertwo .box-header-nav .main-menu .page_item a, .headertwo .box-header-nav .main-menu>.menu-item>a{color:' + to + '}';
            css += '.menu-item-search{border-color:' + to + '}';
            css += '.menu-item-sidebar svg{stroke:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_menu_item_color', css);
        });
    });

    wp.customize('cleaninglight_menu_item_link_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .box-header-nav .main-menu .page_item.current_page_item>a, .hover-style1 .box-header-nav .main-menu .page_item:hover>a, .hover-style1 .box-header-nav .main-menu .page_item.focus>a, .hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .hover-style1 .box-header-nav .main-menu>.menu-item.focus>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item.current_page_item>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item:hover>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item.focus>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item.focus>a, .headerthree.hover-style1 .box-header-nav .main-menu .page_item.current_page_item>a, .headerthree.hover-style1 .box-header-nav .main-menu .page_item:hover>a, .headerthree.hover-style1 .box-header-nav .main-menu .page_item.focus>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item.focus>a{color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_menu_item_link_color', css);
        });
    });

    wp.customize('cleaninglight_menu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.hover-style1 .box-header-nav .main-menu .page_item.current_page_item>a, .hover-style1 .box-header-nav .main-menu .page_item:hover>a, .hover-style1 .box-header-nav .main-menu .page_item.focus>a, .hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .hover-style1 .box-header-nav .main-menu>.menu-item.focus>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item.current_page_item>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item:hover>a, .headertwo.hover-style1 .box-header-nav .main-menu .page_item.focus>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .headertwo.hover-style1 .box-header-nav .main-menu>.menu-item.focus>a, .headerthree.hover-style1 .box-header-nav .main-menu .page_item:hover>a, .headerthree.hover-style1 .box-header-nav .main-menu .page_item.focus>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item.current-menu-item>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item:hover>a, .headerthree.hover-style1 .box-header-nav .main-menu>.menu-item.focus>a{background-color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_menu_bg_color', css);
        });
    });

    /** Sub Menu */
    wp.customize('cleaninglight_submenu_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.box-header-nav .main-menu .children, .box-header-nav .main-menu .sub-menu{background-color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_submenu_bg_color', css);
        });
    });

    wp.customize('cleaninglight_submenu_item_color', function (value) {
        value.bind(function (to) {
            var css = '.box-header-nav .main-menu .children>.page_item>a, .box-header-nav .main-menu .sub-menu>.menu-item>a{color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_submenu_item_color', css);
        });
    });

    wp.customize('cleaninglight_submenu_item_link_color', function (value) {
        value.bind(function (to) {
            var css = '.nav-menu .main-menu .children li:hover>a, .nav-menu .main-menu .sub-menu li:hover>a{color:' + to + '}';
            css += '.nav-menu .main-menu .children li:hover>a:before, .nav-menu .main-menu .sub-menu li:hover>a:before{background-color:' + to + '}'
            cleaninglight_set_dynamic_css('cleaninglight_submenu_item_link_color', css);
        });
    });

    wp.customize('cleaninglight_submenu_item_bg_color', function (value) {
        value.bind(function (to) {
            var css = '.nav-menu .main-menu .children li:hover>a, .nav-menu .main-menu .sub-menu li:hover>a{background-color:' + to + '}';
            cleaninglight_set_dynamic_css('cleaninglight_submenu_item_bg_color', css);
        });
    });

    /** Social Icon */
    wp.customize('cleaninglight_social_icon_color', function (value) {
        value.bind(function (to) {
            var css = ".top-bar-menu ul.cleaninglight-socialicon li a{ color:" + to + "}";
            cleaninglight_set_dynamic_css('cleaninglight_social_icon_color', css);
        })
    });

    wp.customize('cleaninglight_social_icon_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".top-bar-menu ul.cleaninglight-socialicon li a{ background-color:" + to + "}";
            cleaninglight_set_dynamic_css('cleaninglight_social_icon_bg_color', css);
        })
    });

    wp.customize('cleaninglight_social_icon_hover_color', function (value) {
        value.bind(function (to) {
            var css = ".top-bar-menu ul.cleaninglight-socialicon li a:hover{ color:" + to + "; border-color:" + to + ";}";
            cleaninglight_set_dynamic_css('cleaninglight_social_icon_hover_color', css);
        })
    });

    wp.customize('cleaninglight_social_icon_hover_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".top-bar-menu ul.cleaninglight-socialicon li a:hover{ background-color:" + to + "}";
            cleaninglight_set_dynamic_css('cleaninglight_social_icon_hover_bg_color', css);
        })
    });

    /*****
     * Header Button 
    */
    wp.customize('cleaninglight_hb_title', function (value) {
        value.bind(function (to) {
            $('.ikbutton-title').text(to);
        })
    });

    wp.customize('cleaninglight_hb_text', function (value) {
        value.bind(function (to) {
            $('.ikbutton-text').text(to);
        })
    });

    wp.customize('cleaninglight_hb_link', function (value) {
        value.bind(function (to) {
            $('a.ikbutton-link').attr('href', to);
        })
    });


    wp.customize('cleaninglight_header_button_bg_color', function (value) {
        value.bind(function (color) {
            $('.ikbutton-single-wrap').css('background-color', color);
        })
    });

    wp.customize('cleaninglight_header_button_color', function (value) {
        value.bind(function (color) {
            $('.ikbutton-single-wrap').css('color', color);
            $('.ikbutton-icon i').css('border-color', color);
            $('.ikbutton-single-wrap.style1::after').css('background-color', color);
        })
    });

    wp.customize('cleaninglight_header_button_color', function (value) {
        value.bind(function (color) {
            $('.ikbutton-single-wrap.style1::after').css('background-color', color);
        })
    });

    wp.customize('cleaninglight_enable_search', function (value) {
        value.bind(function (to) {
            if (to === 'enable') {
                $('.menu-item-search').css('display', 'flex');
            } else {
                $('.menu-item-search').css('display', 'none');
            }
        })
    });


    /*****
     * Breacrumbs Settings
    */
    wp.customize('cleaninglight_show_title', function (value) {
        value.bind(function (to) {
            if( to ) {
                $( '#titlebar-section .section-title' ).css( { 'display' : 'block' } );
            } else {
                $( '#titlebar-section .section-title' ).css( { 'display' : 'none' } );
            }
        });
    });

    wp.customize('cleaninglight_breadcrumb', function (value) {
        value.bind(function (to) {
            if( to ) {
                $( '#titlebar-section #breadcrumb' ).css( { 'display' : 'block' } );
            } else {
                $( '#titlebar-section #breadcrumb' ).css( { 'display' : 'none' } );
            }
        });
    });
    
    wp.customize('cleaninglight_titlebar_title_align', function (value) {
        value.bind(function (to) {
            $('.titlebar-section').removeClass('text-left text-center text-right').addClass(to);
        })
    });

    // Sections dynamic
    var settingIds = ['titlebar', 'aboutus', 'promoservice', 'service', 'calltoaction', 'video_calltoaction', 'recentwork', 'counter', 'blog', 'testimonial', 'team', 'client', 'contact', 'customa', 'footer'];

    $.each(settingIds, function (i, settingId) {

        wp.customize('cleaninglight_' + settingId + '_super_title', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section .super-title';
                if ($(sectionClass).length == 0) {
                    wp.customize.preview.send('refresh');
                } else {
                    $(sectionClass).text(to);
                }
            })
        });

        wp.customize('cleaninglight_' + settingId + '_title', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section .section-title';
                if ($(sectionClass).length == 0) {
                    wp.customize.preview.send('refresh');
                } else {
                    $(sectionClass).text(to);
                }

            })
        });

        wp.customize('cleaninglight_' + settingId + '_title_align', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section';
                var remove_class = 'text-center text-left text-right';
                $(sectionClass + ' .section-title-wrapper').removeClass(remove_class);
                $(sectionClass + ' .section-title-wrapper').addClass(to);
            })
        });

        wp.customize('cleaninglight_' + settingId + '_title_style', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section';
                var remove_class = 'style1 style2 style3 style4 style5';
                $(sectionClass + ' .section-title-wrapper').removeClass(remove_class);
                $(sectionClass + ' .section-title-wrapper').addClass(to);
            })
        });


        wp.customize('cleaninglight_' + settingId + '_bg_type', function (value) {
            value.bind(function (to) {

                var sectionClass = '#' + settingId + '-section';

                if (to === 'none' || to === 'color-bg' || to === 'image-bg') {
                    if( settingId === 'footer' ) {
                        var css = sectionClass + "{ background-color: #112437; background-image: none; }";
                    } else {
                        var css = sectionClass + '{ background-color: transparent; background-image: none; }';
                    }
                    css += sectionClass + '::before{ background-color: transparent; }';
                    $(sectionClass + ' iframe').css('display', 'none');
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + 'none_setting', css);
                }
                if ('color-bg' === to) {
                    var color = wp.customize('cleaninglight_' + settingId + '_bg_color').get();
                    
                    var css = sectionClass + '{background-color:' + color + '}';
                    css += sectionClass + '::before{ background-color: transparent }';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bg_color', css);

                    var css = sectionClass + '{background-image:none}';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bg_image_url', css);

                }
                if ('image-bg' === to) {
                    var image = wp.customize('cleaninglight_' + settingId + '_bg_image_url').get();
                    var css = sectionClass + '{background-image:url(' + image + ')}';
                    css += sectionClass + '{ background-color: transparent }';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bg_image_url', css);
                    var color_overlay = wp.customize('cleaninglight_' + settingId + '_overlay_color').get();
                    var css = sectionClass + '::before{background-color:' + color_overlay + '}';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_overlay_color', css);
                }
            });
        });

        wp.customize('cleaninglight_' + settingId + '_bg_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section, .layout_three #titlebar-section';
                var css = sectionClass + '{background-color:' + to + '}';
                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bg_color', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_bg_image_url', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section';
                var css = sectionClass + '{background-image:url(' + to + ')}';
                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bg_image_url', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_overlay_color', function (value) {
            value.bind(function (to) {
                var sectionClass = '#' + settingId + '-section';
                var css = sectionClass + '::before{background-color:' + to + '}';
                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_overlay_color', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_padding', function (value) {
            value.bind(function (to) {
                var selector = '#' + settingId + '-section, .layout_three #titlebar-section';
                var section_padding = JSON.parse(to);
                var css = selector + '{padding-top:' + section_padding.desktop.top + 'px; padding-right:' + section_padding.desktop.right + 'px; padding-bottom:' + section_padding.desktop.bottom + 'px; padding-left:' + section_padding.desktop.left + 'px}';
                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + 'padding_desktop', css);

                if (($(window).width() >= 700) && ($(window).width() < 992)) {
                    var css = '@media screen and (max-width:992px){';
                    css += selector + '{ padding-top:' + section_padding.tablet.top + 'px; padding-right:' + section_padding.tablet.right + 'px; padding-bottom:' + section_padding.tablet.bottom + 'px; padding-left:' + section_padding.tablet.left + 'px}';
                    css += '}';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + 'padding_tablet', css);
                }
                if ($(window).width() < 500) {
                    var css = '@media screen and (max-width:500px){';
                    css += selector + '{ padding-top:' + section_padding.mobile.top + 'px; padding-right:' + section_padding.mobile.right + 'px; padding-bottom:' + section_padding.mobile.bottom + 'px; padding-left:' + section_padding.mobile.left + 'px}';
                    css += '}';
                    cleaninglight_set_dynamic_css('cleaninglight_' + settingId + 'padding_mobile', css);
                }

            });
        });

        //Footer
        wp.customize('cleaninglight_' + settingId + '_ts_height_desktop', function (value) {
            value.bind(function (to) {
            
                if( settingId === 'footer' ) {
                    var sectionClass = '.footer-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.top-section-seperator';
                }
                var desktop = to;
                var tablet = wp.customize('cleaninglight_' + settingId + '_ts_height_tablet').get();
                var mobile = wp.customize('cleaninglight_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_ts_height_tablet', function (value) {
            value.bind(function (to) {
                if( settingId === 'footer' ) {
                    var sectionClass = '.footer-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.top-section-seperator';
                }
                var desktop = wp.customize('cleaninglight_' + settingId + '_ts_height_desktop').get();
                var tablet = to;
                var mobile = wp.customize('cleaninglight_' + settingId + '_ts_height_mobile').get();

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_ts_height', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_ts_height_mobile', function (value) {
            value.bind(function (to) {
                if( settingId === 'footer' ) {
                    var sectionClass = '.footer-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.top-section-seperator';
                }
                var desktop = wp.customize('cleaninglight_' + settingId + '_ts_height_desktop').get();
                var tablet = wp.customize('cleaninglight_' + settingId + '_ts_height_tablet').get();
                var mobile = to;

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_ts_height', css);
            });
        });

        //Breadcrumb
        wp.customize('cleaninglight_' + settingId + '_bs_color', function (value) {
            value.bind(function (to) {
                $( '.breadcrumb-seprator .bottom-section-seperator svg' ).css( 'fill', to );
            });
        });
        
        wp.customize('cleaninglight_' + settingId + '_bs_height_desktop', function (value) {
            value.bind(function (to) {
            
                if( settingId === 'titlebar' ) {
                    var sectionClass = '.breadcrumb-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.bottom-section-seperator';
                }
                var desktop = to;
                var tablet = wp.customize('cleaninglight_' + settingId + '_bs_height_tablet').get();
                var mobile = wp.customize('cleaninglight_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_bs_height_tablet', function (value) {
            value.bind(function (to) {
                if( settingId === 'titlebar' ) {
                    var sectionClass = '.breadcrumb-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.bottom-section-seperator';
                }
                var desktop = wp.customize('cleaninglight_' + settingId + '_bs_height_desktop').get();
                var tablet = to;
                var mobile = wp.customize('cleaninglight_' + settingId + '_bs_height_mobile').get();

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bs_height', css);
            });
        });

        wp.customize('cleaninglight_' + settingId + '_bs_height_mobile', function (value) {
            value.bind(function (to) {
                if( settingId === 'titlebar' ) {
                    var sectionClass = '.breadcrumb-seprator .section-seperator.bottom-section-seperator';
                } else {
                    var sectionClass = '#' + settingId + '-section .section-seperator.bottom-section-seperator';
                }
                var desktop = wp.customize('cleaninglight_' + settingId + '_bs_height_desktop').get();
                var tablet = wp.customize('cleaninglight_' + settingId + '_bs_height_tablet').get();
                var mobile = to;

                var css = sectionClass + '{height:' + desktop + 'px}';

                if (tablet) {
                    css += '@media screen and (max-width:768px){';
                    css += sectionClass + '{height:' + tablet + 'px}';
                    css += '}';
                }

                if (mobile) {
                    css += '@media screen and (max-width:480px){';
                    css += sectionClass + '{height:' + mobile + 'px}';
                    css += '}';
                }

                cleaninglight_set_dynamic_css('cleaninglight_' + settingId + '_bs_height', css);
            });
        });

    });

    /******
     * Slider 
    */
    wp.customize('cleaninglight_slider_height', function (value) {
        value.bind(function (to) {
            var css = '.cleaninglight-slider-item-wrap{ height:' + to + 'px;}'; 
            cleaninglight_set_dynamic_css('cleaninglight_slider_height', css);
        });
    });
    wp.customize('cleaninglight_banner_overlay_color', function (value) {
        value.bind(function (to) {
            $('.cleaninglight-banner-bg-overlay').css('background-color', to);
        });
    });

    /** Slider Title */
    wp.customize('cleaninglight_caption_title_font_size', function (value) {
        value.bind(function (to) {
            var css = '.cleaninglight-banner-caption .cleaninglight-banner-title{ font-size:' + to + 'px;}';
            cleaninglight_set_dynamic_css('cleaninglight_caption_title_font_size', css);
        });
    });

    /** Slider Caption */
    wp.customize('cleaninglight_caption_width', function (value) {
        value.bind(function (to) {
            var css = '.cleaninglight-banner-caption{ max-width:' + to + '%;}';
            cleaninglight_set_dynamic_css('cleaninglight_caption_width', css);
        });
    });

    /***
     * Slider Seperator
    */
    wp.customize('cleaninglight_slider_bottom_seperator', function (value) {
        value.bind(function (to) {
            var seperatorColor = wp.customize('cleaninglight_slider_bs_color').get();
            var css = '.cleaninglight-banner-wrapper .bottom-section-seperator svg{ fill:' + seperatorColor + '}';
            cleaninglight_set_dynamic_css('cleaninglight_slider_bottom_seperator', css);
        });
    });

    wp.customize('cleaninglight_slider_bs_color', function (value) {
        value.bind(function (to) {
            $('.bottom-section-seperator svg').css('fill', to);
        });
    });

    wp.customize('cleaninglight_slider_bs_height', function (value) {
        value.bind(function (to) {
            var css = '.section-seperator.bottom-section-seperator{height:' + to + 'px}';
            var tabletHeight = wp.customize('cleaninglight_slider_bs_height_tablet').get();
            var mobileHeight = wp.customize('cleaninglight_slider_bs_height_mobile').get();

            css += '@media screen and (max-width:768px){';
                css += '.section-seperator.bottom-section-seperator{height:' + tabletHeight + 'px}';
            css += '}';

            css += '@media screen and (max-width:480px){';
                css += '.section-seperator.bottom-section-seperator{height:' + mobileHeight + 'px}';
            css += '}';

            cleaninglight_set_dynamic_css('cleaninglight_slider_bs_height', css);
        });
    });

    wp.customize('cleaninglight_slider_bs_height_tablet', function (value) {
        value.bind(function (to) {
            var desktopHeight = wp.customize('cleaninglight_slider_bs_height').get();
            var mobileHeight = wp.customize('cleaninglight_slider_bs_height_mobile').get();

            var css = '.section-seperator.bottom-section-seperator{height:' + desktopHeight + 'px}';
            
            css += '@media screen and (max-width:768px){';
                css += '.section-seperator.bottom-section-seperator{height:' + to + 'px}';
            css += '}';

            css += '@media screen and (max-width:480px){';
                css += '.section-seperator.bottom-section-seperator{height:' + mobileHeight + 'px}';
            css += '}';

            cleaninglight_set_dynamic_css('cleaninglight_slider_bs_height_tablet', css);
        });
    });

    wp.customize('cleaninglight_slider_bs_height_mobile', function (value) {
        value.bind(function (to) {
            var desktopHeight = wp.customize('cleaninglight_slider_bs_height').get();
            var tabletHeight = wp.customize('cleaninglight_slider_bs_height_tablet').get();

            var css = '.section-seperator.bottom-section-seperator{height:' + desktopHeight + 'px}';
            
            css += '@media screen and (max-width:768px){';
                css += '.section-seperator.bottom-section-seperator{height:' + tabletHeight + 'px}';
            css += '}';

            css += '@media screen and (max-width:480px){';
                css += '.section-seperator.bottom-section-seperator{height:' + to + 'px}';
            css += '}';

            cleaninglight_set_dynamic_css('cleaninglight_slider_bs_height_mobile', css);
        });
    });

    /******* Partial Refresh in Customizer */
    jQuery(document).ready(function ($) {
        wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
            var brtl = $("body").hasClass('rtl') ? true : false;
            //AOS.init();
            var p_p_id = placement.partial.id;

            if (p_p_id == 'cleaninglight_slider_refresh') {
                var brtl = false;
                if (jQuery("body").hasClass('rtl')) brtl = true;
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

                /**
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
            }

            if (p_p_id == 'cleaninglight_aboutus_settings') {
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
            }

            if (p_p_id == 'cleaninglight_testimonial_refresh') {
                var owlTestimonial = $(".testimonial-block-slider");
                owlTestimonial.each(function () {
                    var $this = $(this);
                    $this.owlCarousel({
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
                });
            }

            if (p_p_id == 'cleaninglight_team_options_refresh') {
                var owlTeam = $(".team-block-slider");
                owlTeam.each(function () {
                    var $this = $(this);
                    $this.owlCarousel({
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
                });
            }

            if (p_p_id == 'cleaninglight_client_refresh') {
                var owlClient = $(".client-logo-slider");
                owlClient.owlCarousel({
                    rtl: JSON.parse(cleaninglight_options.rtl),
                    loop: true,
                    autoplay: true,
                    autoHeight :false,
                    autoplayHoverPause: true,
                    mouseDrag: true,
                    nav: false,
                    dots: true,
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
                            items: owlClient.data('item'),
                            margin: 15,
                        }
                    }
                });
            }

            if (p_p_id == 'cleaninglight_counter_section_refresh') {
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
            }

            if (p_p_id == 'cleaninglight_home_blog_section_refresh') {
                var owlBlog = $(".blog-block-slider");
                owlBlog.owlCarousel({
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
            }

            if (p_p_id == 'cleaninglight_portfolio_section_refresh') {
                
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
            }

        });
    });    

    wp.customize.selectiveRefresh.bind('partial-content-rendered', function(placement) {
        if (jQuery(placement.container).find('#google-map').length) {
            setTimeout(function() {
                initLeafletMap();
            }, 100);
        }
    });

    /*****
     * About Section
    */
    wp.customize('cleaninglight_aboutus_layout_design', function (value) {
        value.bind(function (to) {
            $('.about_us_front').removeClass('layoutone layouttwo layoutthree').addClass(to);
        })
    });

    wp.customize('cleaninglight_about_image', function (value) {
        value.bind(function (to) {
            $('.about-wrapper .about-img img').attr('src', to);
        })
    });

    wp.customize('cleaninglight_aboutus_super_title', function (value) {
        value.bind(function (to) {
            $('.about-right .super-title').html(to);
        })
    });

    wp.customize('cleaninglight_aboutus_button_text', function (value) {
        value.bind(function (to) {
            $('#aboutus-section .section-tagline-text a.btn-primary').html(to);
        })
    });

    /**********
     * Features Service 
     */
    wp.customize('cleaninglight_promo_service_icon', function (value) {
        value.bind(function (to) {
            $('.feature-service-icon').css('margin-top', to +'px');
        })
    });

    wp.customize('cleaninglight_promoservice_show_icon', function (value) {
        value.bind(function (to) {
            if (to === 'enable') {
                $('.feature-service-icon').css('display', 'block');
            } else {
                $('.feature-service-icon').css('display', 'none');
            }
        })
    });   
    /** Promo Service Icon Settings */
    wp.customize('cleaninglight_promoservice_icon_style', function (value) {
        value.bind(function (to) {
            var value = JSON.parse(to);

            var top_left_radius = ( value.radius.desktop.top === '' ) ? 0 : value.radius.desktop.top;
            var top_right_radius = ( value.radius.desktop.right === '' ) ? 0 : value.radius.desktop.right;
            var bottom_right_radius = ( value.radius.desktop.bottom === '' ) ? 0 : value.radius.desktop.bottom;
            var bottom_left_radius = ( value.radius.desktop.left === '' ) ? 0 : value.radius.desktop.left;

            var tablet_top_left_radius = ( value.radius.tablet.top === '' ) ? 0 : value.radius.tablet.top;
            var tablet_top_right_radius = ( value.radius.tablet.right === '' ) ? 0 : value.radius.tablet.right;
            var tablet_bottom_right_radius = ( value.radius.tablet.bottom === '' ) ? 0 : value.radius.tablet.bottom;
            var tablet_bottom_left_radius = ( value.radius.tablet.left === '' ) ? 0 : value.radius.tablet.left;

            var mobile_top_left_radius = ( value.radius.mobile.top === '' ) ? 0 : value.radius.mobile.top;
            var mobile_top_right_radius = ( value.radius.mobile.right === '' ) ? 0 : value.radius.mobile.right;
            var mobile_bottom_right_radius = ( value.radius.mobile.bottom === '' ) ? 0 : value.radius.mobile.bottom;
            var mobile_bottom_left_radius = ( value.radius.mobile.left === '' ) ? 0 : value.radius.mobile.left;

            var css = ".feature-service-content .feature-service-icon{ \
                border:solid " + value.borderwidth + "px " + value.bordercolor + "; \
            }";

            css += ".feature-service-content .feature-service-icon i{ font-size:" + value.iconsize + "px;}";

            if( top_left_radius || top_right_radius || bottom_right_radius || bottom_left_radius ) {
                css += ".feature-service-content .feature-service-icon{ border-radius: " + top_left_radius + "px " + top_right_radius + "px " + bottom_right_radius + "px " + bottom_left_radius + "px;}";
            }
            if( tablet_top_left_radius || tablet_top_right_radius || tablet_bottom_right_radius || tablet_bottom_left_radius ) {
                css += '@media screen and (max-width:768px){';
                css += ".feature-service-content .feature-service-icon{ border-radius: " + tablet_top_left_radius + "px " + tablet_top_right_radius + "px " + tablet_bottom_right_radius + "px " + tablet_bottom_left_radius + "px;}";
                css += '}';
            }
            if( mobile_top_left_radius || mobile_top_right_radius || mobile_bottom_right_radius || mobile_bottom_left_radius ) {
                css += '@media screen and (max-width:480px){';
                css += ".feature-service-content .feature-service-icon{ border-radius: " + mobile_top_left_radius + "px " + mobile_top_right_radius + "px " + mobile_bottom_right_radius + "px " + mobile_bottom_left_radius + "px;}";
                css += '}';
            }

            css += ".feature-service-content .feature-service-icon{padding-top:" + value.padding.desktop.top + "px; padding-right:" + value.padding.desktop.right + "px; padding-bottom:" + value.padding.desktop.bottom + "px; padding-left:" + value.padding.desktop.left + "px; }";
            css += '@media screen and (max-width:768px){';
            css += ".feature-service-content .feature-service-icon{padding-top:" + value.padding.tablet.top + "px; padding-right:" + value.padding.tablet.right + "px; padding-bottom:" + value.padding.tablet.bottom + "px; padding-left:" + value.padding.tablet.left + "px; }";
            css += '}';
            css += '@media screen and (max-width:480px){';
            css += ".feature-service-content .feature-service-icon{padding-top:" + value.padding.mobile.top + "px; padding-right:" + value.padding.mobile.right + "px; padding-bottom:" + value.padding.mobile.bottom + "px; padding-left:" + value.padding.mobile.left + "px; }";
            css += '}';

            cleaninglight_set_dynamic_css('cleaninglight_promoservice_icon_style', css);
        });
    });

    /*********
     * Service Section
    */
    wp.customize('cleaninglight_service_button', function (value) {
        value.bind(function (to) {
            $('.service-section .feature_detail a.btn').html(to);
        })
    });

    wp.customize('cleaninglight_service_bg_url', function (value) {
        value.bind(function (to) {
            $('.feature_detail .feature_img img').attr('src', to);
        })
    });

    /*********
     * Call To Action
    */
    wp.customize('cleaninglight_cta_style', function (value) {
        value.bind(function (to) {
            $('.calltoaction-section').removeClass('classic cover').addClass(to);
        })
    });

    wp.customize('cleaninglight_cta_layout', function (value) {
        value.bind(function (to) {
            $('.inner-section-wrap').removeClass('cta-left cta-right cta-above cta-below').addClass(to);
        })
    });

    wp.customize('cleaninglight_cta_alignment', function (value) {
        value.bind(function (to) {
            $('.calltoaction-section').removeClass('start center end').addClass(to);
        })
    });

    wp.customize('cleaninglight_call_to_action_title', function (value) {
        value.bind(function (to) {
            $('.call-to-action-content-wrap h3').html(to);
        })
    });

    wp.customize('cleaninglight_call_to_action_subtitle', function (value) {
        value.bind(function (to) {
            $('.call-to-action-content-wrap p').html(to);
        })
    });

    wp.customize('cleaninglight_call_to_action_button', function (value) {
        value.bind(function (to) {
            $('.call-to-action-button-wrap a.btn-primary').html(to);
        })
    });

    wp.customize('cleaninglight_call_to_action_button_one', function (value) {
        value.bind(function (to) {
            $('.call-to-action-button-wrap a.style-white').html(to);
        })
    });

    wp.customize('cleaninglight_calltoaction_height', function (value) {
        value.bind(function (to) {
            var css = '.call-to-action-bg-img img{ height:' + to + 'px;}'; 
            cleaninglight_set_dynamic_css('cleaninglight_calltoaction_height', css);
        });
    });

    wp.customize('cleaninglight_cta_title_font_size', function (value) {
        value.bind(function (to) {
            $('.call-to-action-content-wrap h2').css('font-size', to + 'px');
        });
    });

    wp.customize('cleaninglight_cta_desc_font_size', function (value) {
        value.bind(function (to) {
            $('.call-to-action-content-wrap p').css('font-size', to + 'px');
        });
    });

    wp.customize('cleaninglight_calltoaction_box_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".call-to-action-content-wrap, .cover .call-to-action-content-wrap{ background-color:" + to + " }";
            cleaninglight_set_dynamic_css('cleaninglight_calltoaction_box_bg_color', css);
        });
    });

    wp.customize('cleaninglight_calltoaction_text_color', function (value) {
        value.bind(function (to) {
            var css = ".call-to-action-content-wrap p { color:" + to + " }";
            cleaninglight_set_dynamic_css('cleaninglight_calltoaction_text_color', css);
        });
    });

    /*********
     * Video Call To Action Block
    */
    wp.customize('cleaninglight_video_calltoaction_height', function (value) {
        value.bind(function (to) {
            var css = '.video-cat-image-wrap img{ height:' + to + 'px;}'; 
            cleaninglight_set_dynamic_css('cleaninglight_video_calltoaction_height', css);
        });
    });

    wp.customize('cleaninglight_video_calltoaction_box_bg_color', function (value) {
        value.bind(function (to) {
            var css = ".video-cat-image-wrap::after, .video-cta-section .contact-form{ background-color:" + to + " }";
            cleaninglight_set_dynamic_css('cleaninglight_video_calltoaction_box_bg_color', css);
        });
    });

    /*****
     * Our Team Member
    */
    wp.customize('cleaninglight_team_block_height', function (value) {
        value.bind(function (to) {
            var css = '.team-member-block-image img{ height:' + to + 'px;}'; 
            cleaninglight_set_dynamic_css('cleaninglight_team_block_height', css);
        });
    });

    /*****
     * Testimonail Settings
    */
    wp.customize('cleaninglight_testimonial_designation_color', function (value) {
        value.bind(function (to) {
            var css =".testimonial-block-content .designation, .style2 .testimonial-block-inner-content .designation{ color:" + to + "}";
            cleaninglight_set_dynamic_css('cleaninglight_testimonial_designation_color', css);
        });
    });
    

    /********
     * Counter Icon 
    */
    wp.customize('cleaninglight_counter_display_style', function (value) {
        value.bind(function (to) {
            $('.counter-block-wrapper').removeClass('left right above below').addClass(to);
        })
    });
    wp.customize('cleaninglight_counter_icon_disable', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.counter-block-wrap .counter-block-icon' ).css( 'display', 'inline-block' );
            } else {
                $( '.counter-block-wrap .counter-block-icon' ).css( 'display', 'none' );
            }
        });
    });

    /**********
     * Gallery Block
    */
    wp.customize('cleaninglight_gallery_default_text', function (value) {
        value.bind(function (to) {
            $('.default-item-name').html(to);
        })
    });
    wp.customize('cleaninglight_gallery_tab_align', function (value) {
        value.bind(function (to) {
            $('.cleaninglight-gallery-item-wrap').removeClass('start end center').addClass(to);
        })
    });
    wp.customize('cleaninglight_gallery_caption_disable', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.cleaninglight-gallery-caption' ).css( { 'display': 'flex' } );
            } else {
                $( '.cleaninglight-gallery-caption' ).css( { 'display': 'none' } );
            }
        });
    });
    wp.customize('cleaninglight_gallery_zoom_icon_disable', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.cleaninglight-gallery-image-large' ).css( { 'display': 'block' } );
            } else {
                $( '.cleaninglight-gallery-image-large' ).css( { 'display': 'none' } );
            }
        });
    });
    
    /**********
     * Home Blog Block
    */
    wp.customize('cleaninglight_blog_home_btn', function (value) {
        value.bind(function (to) {
            $('#blog-section .inner-section-wrap .ikthemes-article-item a.btn').html(to);
        })
    });
    wp.customize('cleaninglight_home_blog_alignment', function (value) {
        value.bind(function (to) {
            $('#blog-section .inner-section-wrap .ikthemes-article-item').removeClass('text-center text-left text-right').addClass(to);
        })
    });

    wp.customize('cleaninglight_home_post_date_options', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.posted-on, .ikthemes-article-date' ).css( { 'display': 'inline-block' } );
            } else {
                $( '.entry-meta.info span.posted-on, .ikthemes-article-date' ).css( { 'display': 'none' } );
            }
        });
    });
    wp.customize('cleaninglight_home_post_author_options', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.byline' ).css( { 'display': 'block' } );
            } else {
                $( '.entry-meta.info span.byline' ).css( { 'display': 'none' } );
            }
        });
    });
    wp.customize('cleaninglight_home_post_reading_time', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.reading-time' ).css( 'display', 'inline-block' );
            } else {
                $( '.entry-meta.info span.reading-time' ).css( 'display', 'none' );
            }
        });
    });

    /**********
     * Blog Template
    */
    wp.customize('cleaninglight_post_column', function (value) {
        value.bind(function (to) {
            var removeClasses = 'd-grid-column-1 d-grid-column-2 d-grid-column-3 d-grid-column-4 d-grid-column-5 d-grid-column-6';
            $( '.ikthemes-article-wrap' ).removeClass(removeClasses).addClass( 'd-grid-column-' + to );
        });
    });

    wp.customize('cleaninglight_blog_post_space', function (value) {
        value.bind(function (to) {
            $( '.ikthemes-article-wrap' ).css( { 'gap': to + 'rem' } );
        });
    });

    wp.customize('cleaninglight_blog_alignment', function (value) {
        value.bind(function (to) {
            var removeClasses = 'text-left text-right text-center';
            $( '.ikthemes-article-wrap .article' ).removeClass(removeClasses).addClass( to );
        });
    });

    wp.customize('cleaninglight_blogtemplate_btn', function (value) {
        value.bind(function (to) {
            console.log( $( '.ikthemes-article-wrap .article .ikthemes-article-btn-wrap span' ).text().trim().length );
            $( '.ikthemes-article-wrap .article .ikthemes-article-btn-wrap span' ).html( to );
            if( !$( '.ikthemes-article-wrap .article .ikthemes-article-btn-wrap span' ).text().trim().length ) {
                $( '.ikthemes-article-wrap .article .ikthemes-article-btn-wrap' ).css( { 'display': 'none' } );
            } else {
                $( '.ikthemes-article-wrap .article .ikthemes-article-btn-wrap' ).css( { 'display': 'inline-block' } );
            }
        });
    });

    wp.customize('cleaninglight_post_date_options', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.posted-on, .ikthemes-article-date' ).css( { 'display': 'inline-block' } );
            } else {
                $( '.entry-meta.info span.posted-on, .ikthemes-article-date' ).css( { 'display': 'none' } );
            }
        });
    });

    wp.customize('cleaninglight_post_comments_options', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info .comments-link-wrapper' ).css( { 'display': 'block' } );
            } else {
                $( '.entry-meta.info .comments-link-wrapper' ).css( { 'display': 'none' } );
            }
        });
    });

    wp.customize('cleaninglight_post_author_options', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.byline' ).css( { 'display': 'block' } );
            } else {
                $( '.entry-meta.info span.byline' ).css( { 'display': 'none' } );
            }
        });
    });

    wp.customize('cleaninglight_post_reading_time', function (value) {
        value.bind(function (to) {
            if( to === 'enable' ) {
                $( '.entry-meta.info span.reading-time' ).css( 'display', 'inline-block' );
            } else {
                $( '.entry-meta.info span.reading-time' ).css( 'display', 'none' );
            }
        });
    });
    
    /** Single Post */
    wp.customize('cleaninglight_blog_single_alignment', function (value) {
        value.bind(function (to) {
            var removeClasses = 'text-left text-center text-right';
            $( '.singlearticle .cleaninglight-article-wrap' ).removeClass( removeClasses ).addClass( to );
        });
    });


    /**********
     * Footer
    */
     wp.customize('cleaninglight_footer_column', function (value) {
        value.bind(function (to) {
            var removeClasses = 'd-grid-column-1 d-grid-column-2 d-grid-column-3 d-grid-column-4';
            $( '#footer-section .d-grid' ).removeClass( removeClasses ).addClass( to );
        });
    });

    wp.customize('cleaninglight_footer_bg_color', function (value) {
        value.bind(function (to) {
            $( '.footer-seprator .section-seperator svg' ).css( 'fill', to );
        });
    });
    
    wp.customize('cleaninglight_footer_top_seperator', function (value) {
        value.bind(function (to) {
            var seperatorColor = wp.customize('cleaninglight_footer_ts_color').get();
            var css = '.footer-seprator .section-seperator svg{ fill:' + seperatorColor + '}';
            cleaninglight_set_dynamic_css('cleaninglight_footer_top_seperator', css);
        });
    });

    wp.customize('cleaninglight_footer_ts_color', function (value) {
        value.bind(function (to) {
            $( '.footer-seprator .section-seperator svg' ).css( 'fill', to );
        });
    });

});