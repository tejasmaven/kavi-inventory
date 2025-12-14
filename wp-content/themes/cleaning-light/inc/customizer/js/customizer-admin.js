(function (api) {

    // Extends our custom section.
    api.sectionConstructor['cleaning-light'] = api.Section.extend({

        // No events for this type of section.
        attachEvents: function () { },

        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

})(wp.customize);

jQuery(document).ready(function ($) {

    /*******
     * Header Menu Button
    */
    wp.customize('cleaninglight_button_style', function (setting) {
        var ProgressBar = function (control) {
            var visibility = function () {
                if ('enable' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_hb_text', ProgressBar);
    });

    /*******
     * Customizer Option Auto focus
     */
    jQuery('h3.accordion-section-title').on('click', function () {
        var id = $(this).parent().attr('id');
        if (id == '' || id == undefined) {
            return;
        }
        var is_panel = id.includes("panel");
        var is_section = id.includes("section");

        if (is_panel) {
            focus_item = id.replace('accordion-panel-', '');
            history.pushState({}, null, '?autofocus[panel]=' + focus_item);
        }
        if (is_section) {
            focus_item = id.replace('accordion-section-', '');
            history.pushState({}, null, '?autofocus[section]=' + focus_item);
        }
    });

    /*******
     * slider type
    */
    wp.customize('cleaninglight_slider_type', function (setting) {

        /** Default Slider Banner */
        var defaultSlider = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        /** Advance Slider Banner */
        var advanceSlider = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        /** Slider Controls */
        var setupControlSliderSettings = function (control) {
            var visibility = function () {
                if ('default' === setting.get() || 'advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_banner_sliders', defaultSlider);

        /** Advance Slider Banner */
        wp.customize.control('cleaninglight_slider_advance_settings', advanceSlider);

        /** Slider Controls */
        wp.customize.control('main_slider_controls', setupControlSliderSettings);
        wp.customize.control('cleaninglight_banner_overlay_color', setupControlSliderSettings);
        wp.customize.control('cleaninglight_caption_title_font_size_group', setupControlSliderSettings);
        wp.customize.control('cleaninglight_slider_caption_msg', setupControlSliderSettings);
        wp.customize.control('cleaninglight_caption_width_group', setupControlSliderSettings);
        wp.customize.control('cleaninglight_caption_title_align', setupControlSliderSettings);
        wp.customize.control('cleaninglight_banner_caption_overlay_color', setupControlSliderSettings);
        wp.customize.control('cleaninglight_slider_caption_alignment', setupControlSliderSettings);
    });

    /*******
     * About Us Progress Bar 
    */

    wp.customize('cleaninglight_progress', function (setting) {
        var ProgressBar = function (control) {
            var visibility = function () {
                if ('enable' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_progressbar_item', ProgressBar);
    });

    /*******
     * Call To Action
    */
    wp.customize('cleaninglight_cta_style', function (setting) {
        var layout = function (control) {
            var visibility = function () {
                if ('classic' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_cta_layout', layout);
    });

    wp.customize('cleaninglight_cta_style', function (setting) {
        var layout = function (control) {
            var visibility = function () {
                if ('cover' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_cta_width', layout);
    });

    /*******
     * Features Server 
    */
    wp.customize('cleaninglight_promoservice_type', function (setting) {
        var setupControlDefault = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlAdvance = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_promoservice', setupControlDefault);
        wp.customize.control('cleaninglight_promoservice_advance_settings', setupControlAdvance);

    });

    wp.customize('cleaninglight_promoservice_style', function (setting) {
        var servicestyle = function (control) {
            var visibility = function () {
                if ('style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_promo_service_icon', servicestyle);
        wp.customize.control('cleaninglight_promoservice_show_image', servicestyle);
    });

    wp.customize('cleaninglight_promoservice_show_icon', function (setting) {
        var icon = function (control) {
            var visibility = function () {
                if ('enable' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_promoservice_icon_style', icon);
    });

    /*******
     * Service
    */
    wp.customize('cleaninglight_service_type', function (setting) {
        var setupControlDefault = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlAdvance = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_service_button', setupControlDefault);
        wp.customize.control('cleaninglight_service', setupControlDefault);
        wp.customize.control('cleaninglight_service_advance_settings', setupControlAdvance);

    });

    wp.customize('cleaninglight_service_layout', function (setting) {
        var featuresImage = function (control) {
            var visibility = function () {
                if ('style1' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_service_bg_url', featuresImage);
    });
    
    /*******
     * Testimonials 
    */
    wp.customize('cleaninglight_testimonial_type', function (setting) {
        var setupControlDefault = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlAdvance = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_testimonial_page', setupControlDefault);
        wp.customize.control('cleaninglight_testimonial_advance_settings', setupControlAdvance);

    });

    /*******
     * Team Member 
    */
    wp.customize('cleaninglight_team_type', function (setting) {
        var setupControlDefault = function (control) {
            var visibility = function () {
                if ('default' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        var setupControlAdvance = function (control) {
            var visibility = function () {
                if ('advance' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_team', setupControlDefault);
        wp.customize.control('cleaninglight_team_advance', setupControlAdvance);

    });


    wp.customize('cleaninglight_team_style', function (setting) {
        var teamstyle = function (control) {
            var visibility = function () {
                if ('style2' !== setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };

        wp.customize.control('cleaninglight_team_block_height', teamstyle);
    });


    /*******
     * Contact section 
    */
    wp.customize('cleaninglight_show_contact_detail', function (setting) {
        var showSocial = function (control) {
            var visibility = function () {
                if ('enable' === setting.get()) {
                    control.container.removeClass('customizer-hidden');
                } else {
                    control.container.addClass('customizer-hidden');
                }
            };
            visibility();
            setting.bind(visibility);
        };
        wp.customize.control('cleaninglight_google_map_heading', showSocial);
        wp.customize.control('cleaninglight_latitude', showSocial);
        wp.customize.control('cleaninglight_longitude', showSocial);
        wp.customize.control('cleaninglight_google_map_api_generate', showSocial);
        wp.customize.control('cleaninglight_google_map_api', showSocial);
        wp.customize.control('cleaninglight_contact_details_heading', showSocial);
        wp.customize.control('cleaninglight_contact_title', showSocial);
        wp.customize.control('cleaninglight_contact_shortcode', showSocial);
    });

   /*******
     * Social Icon Click Event 
    */
    $('body').on('click', '#customize-control-cleaninglight_topheader_social_link a, #customize-control-cleaninglight_topheader_social_color_link a, #customize-control-cleaninglight_social_link_left a', function (e) {
        e.preventDefault();
        wp.customize.section('cleaninglight_social_section').expand();
        return false;
    });

    /*******
     * Select Multiple Category
    */
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function () {

        var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(
            function () {
                return $(this).val();
            }
        ).get().join(',');

        $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');

    });

    // Homepage section - control visiblity toggle
    var settingIds = ['slider', 'aboutus', 'promoservice', 'calltoaction', 'service', 'counter', 'video_calltoaction', 'recentwork', 'testimonial', 'team', 'client', 'contact', 'blog', 'customa', 'header', 'titlebar', 'footer'];

    $.each(settingIds, function (i, settingId) {

        wp.customize('cleaninglight_' + settingId + '_bg_type', function (setting) {
            var setupControlColorBg = function (control) {
                var visibility = function () {
                    if ('color-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlImageBg = function (control) {
                var visibility = function () {
                    if ('image-bg' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupControlOverlay = function (control) {
                var visibility = function () {
                    if ('none' === setting.get() || 'color-bg' === setting.get()) {
                        control.container.addClass('customizer-hidden');
                    } else {
                        control.container.removeClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('cleaninglight_' + settingId + '_bg_color', setupControlColorBg);
            wp.customize.control('cleaninglight_' + settingId + '_bg_image', setupControlImageBg);
            wp.customize.control('cleaninglight_' + settingId + '_bg_image_url', setupControlImageBg);
            wp.customize.control('cleaninglight_' + settingId + '_overlay_color', setupControlOverlay);
        });

    });


    /*******
     * Disable Some Value in Customizer
    */
    $.each(settingIds, function (i, settingId) {
        wp.customize('cleaninglight_' + settingId + '_section_seperator', function (setting) {

            var setupTopSeperator = function (control) {
                var visibility = function () {
                    if ('top' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            var setupBottomSeperator = function (control) {
                var visibility = function () {
                    if ('bottom' === setting.get() || 'top-bottom' === setting.get()) {
                        control.container.removeClass('customizer-hidden');
                    } else {
                        control.container.addClass('customizer-hidden');
                    }
                };
                visibility();
                setting.bind(visibility);
            };

            wp.customize.control('cleaninglight_' + settingId + '_seperator1', setupTopSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_top_seperator', setupTopSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_ts_color', setupTopSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_ts_height', setupTopSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_seperator2', setupBottomSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_bottom_seperator', setupBottomSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_bs_color', setupBottomSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_bs_height', setupBottomSeperator);
            wp.customize.control('cleaninglight_' + settingId + '_bs_height_desktop', setupBottomSeperator);
        });
    });


    //Homepage Section Sortable
    function cleaninglight_sections_order(container) {
        var sections = $(container).sortable('toArray');
        var sec_ordered = [];
        $.each(sections, function (index, sec_id) {
            sec_id = sec_id.replace("accordion-section-", "");
            sec_ordered.push(sec_id);
        });

        $.ajax({
            url: ajaxurl,
            type: 'post',
            dataType: 'html',
            data: {
                'action': 'cleaninglight_sections_reorder',
                'sections': sec_ordered,
            }
        }).done(function (data) {
            $.each(sec_ordered, function (key, value) {
                wp.customize.section(value).priority(key);
            });
            $(container).find('.cleaninglight_light-drag-spinner').hide();
            wp.customize.previewer.refresh();
        });
    }

    $('#sub-accordion-panel-cleaninglight_frontpage_settings').sortable({
        axis: 'y',
        helper: 'clone',
        cursor: 'move',
        items: '> li.control-section:not(#accordion-section-cleaninglight_slider_section)',
        delay: 150,
        update: function (event, ui) {
            $('#sub-accordion-panel-cleaninglight_frontpage_settings').find('.cleaninglight_light-drag-spinner').show();
            cleaninglight_sections_order('#sub-accordion-panel-cleaninglight_frontpage_settings');
            $('.wp-full-overlay-sidebar-content').scrollTop(0);
        }
    });

    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-cleaninglight_frontpage_settings .control-subsection .accordion-section-title', function (event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        cleaninglight_ScrollToSection(section_id);
    });

});

function cleaninglight_ScrollToSection(section_id) {

    var preview_section_id = "banner-slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch (section_id) {

        case 'sub-accordion-section-cleaninglight_slider_section':
            preview_section_id = "banner-slider";
            break;
        
        case 'accordion-section-cleaninglight_aboutus_section':
            preview_section_id = "aboutus-section";
            break;

        case 'accordion-section-cleaninglight_promoservice_section':
            preview_section_id = "promoservice-section";
            break;

        case 'accordion-section-cleaninglight_calltoaction_section':
            preview_section_id = "calltoaction-section";
            break;

        case 'accordion-section-cleaninglight_service_section':
            preview_section_id = "service-section";
            break;

        case 'accordion-section-cleaninglight_counter_section':
            preview_section_id = "counter-section";
            break;

        case 'accordion-section-cleaninglight_video_calltoaction_section':
            preview_section_id = "video_calltoaction-section";
            break;

        case 'accordion-section-cleaninglight_recentwork_section':
            preview_section_id = "recentwork-section";
            break;

        case 'accordion-section-cleaninglight_testimonial_section':
            preview_section_id = "testimonial-section";
            break;

        case 'accordion-section-cleaninglight_team_section':
            preview_section_id = "team-section";
            break;

        case 'accordion-section-cleaninglight_client_section':
            preview_section_id = "client-section";
            break;

        case 'accordion-section-cleaninglight_blog_section':
            preview_section_id = "blog-section";
            break;

        case 'accordion-section-cleaninglight_customa_section':
            preview_section_id = "customa-section";
            break;

        case 'accordion-section-cleaninglight_contact_section':
            preview_section_id = "contact-section";
            break;
    }

    if ($contents.find('#' + preview_section_id).length > 0) {
        $contents.find("html, body").animate({
            scrollTop: $contents.find("#" + preview_section_id).offset().top
        }, 1000);
    }
}