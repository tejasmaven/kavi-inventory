jQuery(document).ready(function ($) {

    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    jQuery('html').addClass('colorpicker-ready');

    
    // Date Picker Js
    $(".datepicker-control").datepicker({
        dateFormat: "yy/mm/dd"
    });

    // FontAwesome Icon Control JS
    $('body').on('click', '.cleaninglight-customizer-icon-box .cleaninglight-icon-list li', function () {
        var icon_class = $(this).find('i').attr('class');
        $(this).closest('.cleaninglight-icon-box').find('.cleaninglight-icon-list li').removeClass('icon-active');
        $(this).addClass('icon-active');
        $(this).closest('.cleaninglight-icon-box').prev('.cleaninglight-selected-icon').children('i').attr('class', '').addClass(icon_class);
        $(this).closest('.cleaninglight-icon-box').next('input').val(icon_class).trigger('change');
        $(this).closest('.cleaninglight-icon-box').slideUp();
    });

    $('body').on('click', '.cleaninglight-customizer-icon-box .cleaninglight-selected-icon', function () {
        $(this).next().slideToggle();
    });

    $('body').on('change', '.cleaninglight-customizer-icon-box .cleaninglight-icon-search select', function () {
        var selected = $(this).val();
        $(this).closest('.cleaninglight-icon-box').find('.cleaninglight-icon-search-input').val('');
        $(this).closest('.cleaninglight-icon-box').find('.cleaninglight-icon-list li').show();
        $(this).closest('.cleaninglight-icon-box').find('.cleaninglight-icon-list').hide().removeClass('active');
        $(this).closest('.cleaninglight-icon-box').find('.' + selected).fadeIn().addClass('active');
    });

    $('body').on('keyup', '.cleaninglight-customizer-icon-box .cleaninglight-icon-search input', function (e) {
        var $input = $(this);
        var keyword = $input.val().toLowerCase();
        search_criteria = $input.closest('.cleaninglight-icon-box').find('.cleaninglight-icon-list.active i');

        delay(function () {
            $(search_criteria).each(function () {
                if ($(this).attr('class').indexOf(keyword) > -1) {
                    $(this).parent().show();
                } else {
                    $(this).parent().hide();
                }
            });
        }, 500);
    });

    // Select Multiple Category
    $('.customize-control-checkbox-multiple input[type="checkbox"]').on('change', function () {
        var checkbox_values = $(this).parents('.customize-control').find('input[type="checkbox"]:checked').map(
            function () {
                return $(this).val();
            }
        ).get().join(',');
        $(this).parents('.customize-control').find('input[type="hidden"]').val(checkbox_values).trigger('change');
    });

    // Image Selector JS
    $('body').on('click', '.selector-labels .label', function () {
        var $this = $(this);
        var value = $this.attr('data-val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value).trigger('change');
    });

    // Switch Control
    $('body').on('click', '.onoffswitch', function () {
        var $this = $(this);
        if ($this.hasClass('switch-on')) {
            $(this).removeClass('switch-on');
            $this.next('input').val('disable').trigger('change')
        } else {
            $(this).addClass('switch-on');
            $this.next('input').val('enable').trigger('change')
        }
    });


    // Range JS
    $('.customize-control-range').each(function () {
        var sliderValue = $(this).find('.slider-input').val();
        var newSlider = $(this).find('.cleaninglight-slider');
        var sliderMinValue = parseFloat(newSlider.attr('slider-min-value'));
        var sliderMaxValue = parseFloat(newSlider.attr('slider-max-value'));
        var sliderStepValue = parseFloat(newSlider.attr('slider-step-value'));

        newSlider.slider({
            value: sliderValue,
            min: sliderMinValue,
            max: sliderMaxValue,
            step: sliderStepValue,
            range: 'min',
            slide: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            },
            change: function (e, ui) {
                $(this).parent().find('.slider-input').trigger('change');
            }
        });
    });

    // Change the value of the input field as the slider is moved
    $('.customize-control-range .cleaninglight-slider').on('slide', function (event, ui) {
        $(this).parent().find('.slider-input').val(ui.value);
    });

    // Reset slider and input field back to the default value
    $('.customize-control-range .slider-reset').on('click', function () {
        var resetValue = $(this).attr('slider-reset-value');
        $(this).parents('.customize-control-range').find('.slider-input').val(resetValue);
        $(this).parents('.customize-control-range').find('.cleaninglight-slider').slider('value', resetValue);
    });

    // Update slider if the input field loses focus as it's most likely changed
    $('.customize-control-range .slider-input').blur(function () {
        var resetValue = $(this).val();
        var slider = $(this).parents('.customize-control-range').find('.cleaninglight-slider');
        var sliderMinValue = parseInt(slider.attr('slider-min-value'));
        var sliderMaxValue = parseInt(slider.attr('slider-max-value'));

        // Make sure our manual input value doesn't exceed the minimum & maxmium values
        if (resetValue < sliderMinValue) {
            resetValue = sliderMinValue;
            $(this).val(resetValue);
        }
        if (resetValue > sliderMaxValue) {
            resetValue = sliderMaxValue;
            $(this).val(resetValue);
        }
        $(this).parents('.customize-control-range').find('.cleaninglight-slider').slider('value', resetValue);
    });


    // Responsive switchers
    $('.customize-control .responsive-switchers button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
            $devices = $('.responsive-switchers'),
            $device = $(event.currentTarget).data('device'),
            $control = $('.customize-control.has-switchers'),
            $body = $('.wp-full-overlay'),
            $footer_devices = $('.wp-full-overlay-footer .devices');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Wrapper class
        $body.removeClass('preview-desktop preview-tablet preview-mobile').addClass('preview-' + $device);

        // Panel footer buttons
        $footer_devices.find('button').removeClass('active').attr('aria-pressed', false);
        $footer_devices.find('button.preview-' + $device).addClass('active').attr('aria-pressed', true);

        // Open switchers
        if ($this.hasClass('preview-desktop')) {
            $control.toggleClass('responsive-switchers-open');
        }

    });

    // If panel footer buttons clicked
    $('.wp-full-overlay-footer .devices button').on('click', function (event) {

        // Set up variables
        var $this = $(this),
            $devices = $('.customize-control.has-switchers .responsive-switchers'),
            $device = $(event.currentTarget).data('device'),
            $control = $('.customize-control.has-switchers');

        // Button class
        $devices.find('button').removeClass('active');
        $devices.find('button.preview-' + $device).addClass('active');

        // Control class
        $control.find('.control-wrap').removeClass('active');
        $control.find('.control-wrap.' + $device).addClass('active');
        $control.removeClass('control-device-desktop control-device-tablet control-device-mobile').addClass('control-device-' + $device);

        // Open switchers
        if (!$this.hasClass('preview-desktop')) {
            $control.addClass('responsive-switchers-open');
        } else {
            $control.removeClass('responsive-switchers-open');
        }

    });

    // Linked button
    $('.cleaninglight-linked').on('click', function () {

        // Set up variables
        var $this = $(this);

        // Remove linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').removeClass('linked').attr('data-element', '');

        // Remove class
        $this.parent('.link-dimensions').removeClass('unlinked');

    });

    // Unlinked button
    $('.cleaninglight-unlinked').on('click', function () {

        // Set up variables
        var $this = $(this),
            $element = $this.data('element');

        // Add linked class
        $this.parent().parent('.dimension-wrap').prevAll().slice(0, 4).find('input').addClass('linked').attr('data-element', $element);

        // Add class
        $this.parent('.link-dimensions').addClass('unlinked');

    });

    // Values linked inputs
    $('.dimension-wrap').on('input', '.linked', function () {

        var $data = $(this).attr('data-element'),
            $val = $(this).val();

        $('.linked[ data-element="' + $data + '" ]').each(function (key, value) {
            $(this).val($val).change();
        });

    });


});

(function (api) {

    // Extends our custom "cleaninglight" section.
    api.sectionConstructor['cleaninglight'] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function () { },
        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

    api.sectionConstructor['cleaninglight-upgrade-section'] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function () { },
        // Always make the section active.
        isContextuallyActive: function () {
            return true;
        }
    });

    // Alpha Color Picker Control
    api.controlConstructor['alpha-color'] = api.Control.extend({
        ready: function () {
            var control = this;

            var paletteInput = control.container.find('.alpha-color-control').data('palette');
            var palette;

            if (paletteInput === true || paletteInput === 'true') {
                palette = true;
            } else if (typeof paletteInput !== 'undefined' && paletteInput.indexOf('|') !== -1) {
                palette = paletteInput.split('|');
            } else {
                palette = false;
            }

            control.container.find('.alpha-color-control').wpColorPicker({
                change: function (event, ui) {
                    if (typeof ui.color !== 'undefined') {
                        control.setting.set(ui.color.to_s());
                    }
                },
                clear: function () {
                    const $input = control.container.find('.alpha-color-control');
                    $input.wpColorPicker('color', null);
                    control.setting.set('');
                },
                palettes: palette
            });
        }
    });

    // Class extends the UploadControl
    api.controlConstructor['background-image'] = api.UploadControl.extend({

        ready: function () {

            // Re-use ready function from parent class to set up the image uploader
            var image_url = this;
            image_url.setting = this.settings.image_url;
            api.UploadControl.prototype.ready.apply(image_url, arguments);

            // Set up the new controls
            var control = this;

            control.container.addClass('customize-control-image');

            control.container.on('click keydown', '.remove-button',
                    function () {
                        control.container.find('.background-image-fields').hide();
                    }
            );

            control.container.on('change', '.background-image-repeat select',
                    function () {
                        control.settings['repeat'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-size select',
                    function () {
                        control.settings['size'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-attach select',
                    function () {
                        control.settings['attach'].set(jQuery(this).val());
                    }
            );

            control.container.on('change', '.background-image-position select',
                    function () {
                        control.settings['position'].set(jQuery(this).val());
                    }
            );

        },

        /**
         * Callback handler for when an attachment is selected in the media modal.
         * Gets the selected image information, and sets it within the control.
         */
        select: function () {
            var attachment = this.frame.state().get('selection').first().toJSON();
            this.params.attachment = attachment;
            this.settings['image_url'].set(attachment.url);
           // this.settings['image_id'].set(attachment.id);
        },

    });

    // Sortable Control
    api.controlConstructor['sortable'] = wp.customize.Control.extend({

        ready: function () {

            var control = this;

            // Set the sortable container.
            control.sortableContainer = control.container.find('ul.sortable').first();

            // Init sortable.
            control.sortableContainer.sortable({

                // Update value when we stop sorting.
                stop: function () {
                    control.updateValue();
                }
            }).disableSelection().find('li').each(function () {

                // Enable/disable options when we click on the eye of Thundera.
                jQuery(this).find('i.visibility').click(function () {
                    jQuery(this).toggleClass('dashicons-visibility-faint').parents('li:eq(0)').toggleClass('invisible');
                });
            }).click(function () {

                // Update value on click.
                control.updateValue();
            });
        },

        /**
         * Updates the sorting list
         */
        updateValue: function () {

            var control = this,
                    newValue = [];

            this.sortableContainer.find('li').each(function () {
                if (!jQuery(this).is('.invisible')) {
                    newValue.push(jQuery(this).data('value'));
                }
            });

            control.setting.set(newValue);
        }
    });

    // Range Slider Control
    api.controlConstructor['range-slider'] = wp.customize.Control.extend({
        ready: function () {
            var control = this;

            function initializeSlider(sliderSelector, inputSelector, setting) {
                var slider = control.container.find(sliderSelector);
                var input = control.container.find(inputSelector);
                var isSyncing = false;

                // Prevent setup if slider or input doesn't exist
                if (!slider.length || !input.length) {
                    return;
                }

                // Initialize the slider
                slider.slider({
                    range: 'min',
                    value: parseFloat(input.val()) || 0,
                    min: parseFloat(input.attr('min')) || 0,
                    max: parseFloat(input.attr('max')) || 100,
                    step: parseFloat(input.attr('step')) || 1,
                    slide: function (event, ui) {
                        if (!isSyncing) {
                            isSyncing = true;
                            input.val(ui.value);
                            setting.set(ui.value);
                            isSyncing = false;
                        }
                    },
                    change: function (event, ui) {
                        if (!isSyncing) {
                            isSyncing = true;
                            input.val(ui.value);
                            setting.set(ui.value);
                            isSyncing = false;
                        }
                    }
                });

                // Input field change
                input.on('input change', function () {
                    if (!isSyncing) {
                        var val = parseFloat(jQuery(this).val());
                        if (!isNaN(val)) {
                            isSyncing = true;
                            slider.slider('value', val);
                            setting.set(val);
                            isSyncing = false;
                        }
                    }
                });
            }

            initializeSlider('.cleaninglight-slider.desktop-slider', '.desktop-input', control.settings['desktop']);
            initializeSlider('.cleaninglight-slider.tablet-slider', '.tablet-input', control.settings['tablet']);
            initializeSlider('.cleaninglight-slider.mobile-slider', '.mobile-input', control.settings['mobile']);
        }

    });

    // Cssbox (Margin & Padding)
    api.controlConstructor['cleaninglight-cssbox'] = wp.customize.Control.extend({
        ready: function () {
            'use strict';
            var control = this;
            this.container.on(
                'change keyup input',
                '.cssbox-field',
                function (e) {
                    e.preventDefault();
                    var $ = jQuery;
                    var cssbox_field = $(this);

                    if (!cssbox_field.hasClass('cssbox_link')) {
                        var dataValue = cssbox_field.val(),
                            device_wrap = cssbox_field.closest('.cssbox-device-wrap');

                        if (device_wrap.find('.cssbox_link').is(':checked')) {
                            device_wrap.find('.cssbox-field').each(
                                function () {
                                    $(this).val(dataValue);
                                }
                            );
                        }
                    }
                    control.updateValue();
                }
            );
        },
        /** Update */
        updateValue: function () {
            'use strict';
            var control = this;

            var valueToPush = {};
            control.container.find('.cssbox-field').each(
                function () {

                    var $ = jQuery;
                    var device = $(this).attr('data-device'),
                        dataName = $(this).attr('data-single-name');

                    if (typeof valueToPush[device] === 'undefined') {
                        valueToPush[device] = {};
                    }
                    if ($(this).attr('type') === 'checkbox') {
                        if ($(this).is(':checked')) {
                            var dataValue = 1;
                        } else {
                            var dataValue = '';
                        }
                    } else {
                        var dataValue = $(this).val();
                    }
                    valueToPush[device][dataName] = dataValue;
                }
            );
            var collector = jQuery(control).find('.cssbox-collection-value');
            collector.val(JSON.stringify(valueToPush));
            control.setting.set(JSON.stringify(valueToPush));
        },
    });

    // Tab Control
    api.CleaningLightTabs = [];
    api.CleaningLightTab = api.Control.extend({

        ready: function () {
            var control = this;
            control.container.find('a.customizer-tab').click(function (evt) {
                var tab = jQuery(this).data('tab');
                evt.preventDefault();
                control.container.find('a.customizer-tab').removeClass('active');
                jQuery(this).addClass('active');
                control.toggleActiveControls(tab);
            });

            api.CleaningLightTabs.push(control.id);
        },

        toggleActiveControls: function (tab) {
            var control = this,
                currentFields = control.params.buttons[tab].fields;
            _.each(control.params.fields, function (id) {
                var tabControl = api.control(id);
                if (undefined !== tabControl) {
                    if (tabControl.active() && jQuery.inArray(id, currentFields) >= 0) {
                        tabControl.toggle(true);
                    } else {
                        tabControl.toggle(false);
                    }
                }
            });
        }

    });

    jQuery.extend(api.controlConstructor, {
        'tab': api.CleaningLightTab,
    });

    api.bind('ready', function () {
        _.each(api.CleaningLightTabs, function (id) {
            var control = api.control(id);
            control.toggleActiveControls(0);
        });
    });

    api.controlConstructor['cleaninglight-buttonset'] = wp.customize.Control.extend({
        ready: function () {

            'use strict';

            var control = this;

            // Change the value
            this.container.on(
                'click',
                'input',
                function () {
                    control.setting.set(jQuery(this).val());
                }
            );
        }
    });

    /**
     * Responsive ButtonSet JS
    */
    wp.customize.controlConstructor['cleaninglight-responsive-buttonset'] = wp.customize.Control.extend(
        {
            ready: function () {

                'use strict';

                var control = this;

                this.container.on(
                    'click',
                    'input',
                    function (e) {
                        control.updateValue();
                    }
                );
            },

            /**
             * Update
            */
            updateValue: function () {
                'use strict';
                var control = this;

                var valueToPush = {};
                control.container.find('.cleaninglight-responsive-buttonset-device-wrap').each(
                    function () {
                        var $ = jQuery;
                        var device = $(this).attr('data-device');
                        var inputname = $(this).attr('data-inputname');
                        var dataValue = $(this).find('input[name=' + inputname + ']:checked').val();

                        valueToPush[device] = dataValue;
                    }
                );
                var collector = jQuery(control).find('.cleaninglight-responsive-buttonset-collection-value');
                collector.val(JSON.stringify(valueToPush));
                control.setting.set(JSON.stringify(valueToPush));
            },
        }
    );

})(wp.customize);