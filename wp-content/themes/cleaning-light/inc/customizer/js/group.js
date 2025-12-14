/**
 * Group JS
*/
(function ($) {
	/*Drag and drop to change order*/
	$(document).ready(
		function () {
			var customize_theme_controls = $(document);

			function refresh_group_cssbox_values(control_cssbox_wrap) {
				var valueToPush = {};
				control_cssbox_wrap.find('.groupcssbox-field').each(
					function () {

						var device = $(this).attr('data-device'),
							dataName = $(this).attr('data-cssbox-name');

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

				return valueToPush;
			}

			function refresh_group_values(control_wrap) {

				var valueToPush = {};

				control_wrap.find('[data-single-name]').each(
					function () {
						if ($(this).attr('type') === 'checkbox') {
							if ($(this).is(':checked')) {
								var dataValue = 1;
							} else {
								var dataValue = '';
							}
						} else {
							var dataValue = $(this).val();
						}
						var dataName = $(this).attr('data-single-name');
						valueToPush[dataName] = dataValue;
					}
				);

				control_wrap.find('.responsive-switchers-fields').each(
					function () {
						var responsiveValue = {},
							responsive_wrap = $(this),
							desktop_value = responsive_wrap.find('.group-desktop').val(),
							tablet_value = responsive_wrap.find('.group-tablet').val(),
							mobile_value = responsive_wrap.find('.group-mobile').val();

						responsiveValue['desktop'] = desktop_value;
						responsiveValue['tablet'] = tablet_value;
						responsiveValue['mobile'] = mobile_value;

						var dataName = responsive_wrap.attr('data-responsive-name');
						valueToPush[dataName] = responsiveValue;

					}
				);

				control_wrap.find('.responsive-switchers-cssboxfields').each(
					function () {
						var responsive_wrap = $(this);
						var dataName = responsive_wrap.attr('data-responsive-name');
						valueToPush[dataName] = refresh_group_cssbox_values(responsive_wrap);
					}
				);

				control_wrap.next('.cleaninglight-group-collection').val(JSON.stringify(valueToPush)).trigger('change');
			}

			customize_theme_controls.on(
				'click',
				'.accordion-section-title',
				function () {
					var this_field_title = $(this),
						group_field_control = this_field_title.closest('.group-field-control');

					group_field_control.toggleClass('expanded');
					group_field_control.find('.group-fields').slideToggle();
					group_field_control.find('.group-fields').trigger('cleaninglight__group_slide_toggle');
				}
			);

			customize_theme_controls.on(
				'click',
				'.group-field-close',
				function () {
					$(this).closest('.group-fields').slideUp();
					$(this).closest('.group-field-control').toggleClass('expanded');
				}
			);

			customize_theme_controls.on(
				'keyup change',
				'.group-field-control-wrap [data-single-name], .group-field-control-wrap [data-cssbox-name], .responsive-range',
				function () {

					var group_field = $(this),
						control_wrap = $(this).closest(".group-field-control-wrap");

					if (group_field.hasClass('groupcssbox-field')) {
						if (!group_field.hasClass('groupcssbox_link')) {
							var dataValue = group_field.val(),
								device_wrap = group_field.closest('.groupcssbox-device-wrap');

							if (device_wrap.find('.groupcssbox_link').is(':checked')) {
								device_wrap.find('.groupcssbox-field').each(
									function () {
										$(this).val(dataValue);
									}
								);
							}
						}
					}
					refresh_group_values(control_wrap);

					return false;
				}
			);

			function cleaninglight__group_field_border_style_control(group_field) {

				var selectParent = group_field.parent(),
					select_data_attr = group_field.attr('data-single-name');
				if (select_data_attr === 'border-style') {
					var selected_val = group_field.find(":selected").val();
					if (selected_val === 'none') {
						selectParent.siblings().find('.responsive-switchers-cssboxfields').each(
							function () {
								var width = $(this).data('responsive-name');
								if (width === 'border-width') {
									$(this).parent().hide();
								}
							}
						);
						selectParent.siblings().find('.customize-control-alpha-color').each(
							function () {
								var color = $(this).data('color-single-name');
								if (color === 'border-color') {
									$(this).parent().hide();
								}
							}
						);
					} else {
						selectParent.siblings().show();
					}
				}
			}

			function cleaninglight__group_field_check_overlay_color_control(group_field) {

				var selectParent = group_field.parent().closest(".single-field"),
					select_data_attr = group_field.attr('data-single-name'),
					control_wrap = $(this).closest(".group-field-control-wrap"),
					image_preview_wrap = selectParent.siblings().find('.img-preview-wrap');

				if (select_data_attr === 'enable-overlay') {
					var img = image_preview_wrap.find("img"),
						img_len = img.length,
						image_src = '';
					if (img_len > 0) {
						image_src = img.attr("src");
					} else {
						image_src = false;
					}
					var selected_val = group_field.is(":checked");
					if (selected_val && image_src) {
						selectParent.siblings().find('.customize-control-alpha-color').each(
							function () {
								var color = $(this).data('color-single-name');
								if (color === 'background-overlay-color') {
									$(this).parent().show();
								}
							}
						);
					} else {
						selectParent.siblings().find('.customize-control-alpha-color').each(
							function () {
								var color = $(this).data('color-single-name');
								if (color === 'background-overlay-color') {
									$(this).parent().hide();
								}
							}
						);
					}
				}
			}

			customize_theme_controls.on(
				'change',
				'.group-field-control-wrap select[data-single-name]',
				function () {
					cleaninglight__group_field_border_style_control($(this))
				}
			);

			customize_theme_controls.find('.group-field-control-wrap select[data-single-name]').each(
				function () {
					cleaninglight__group_field_border_style_control($(this))
				}
			);

			customize_theme_controls.on(
				'change',
				'.group-field-control-wrap input[type="checkbox"]',
				function () {
					cleaninglight__group_field_check_overlay_color_control($(this))
				}
			);

			customize_theme_controls.find('.group-field-control-wrap input[type="checkbox"]').each(
				function () {
					cleaninglight__group_field_check_overlay_color_control($(this))
				}
			);

			/*Image*/
			customize_theme_controls.on(
				'click',
				'.cleaninglight-image-upload',
				function (e) {

					// Prevents the default action from occuring.
					e.preventDefault();
					var media_image_upload = $(this);
					var media_title = $(this).data('title');
					var media_button = $(this).data('button');
					var media_input_val = $(this).siblings('.image-value-url');
					var media_image_url = $(this).siblings('.img-preview-wrap');
					var media_image_url_value = media_image_url.children('img');

					var meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
						title: media_title,
						button: { text: media_button },
						library: { type: 'image' }
					});

					// Opens the media library frame.
					meta_image_frame.open();
					// Runs when an image is selected.
					meta_image_frame.on(
						'select',
						function () {

							// Grabs the attachment selection and creates a JSON representation of the model.
							var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

							// Sends the attachment URL to our custom image input field.
							media_input_val.val(media_attachment.url).trigger('change');
							if (media_image_url_value !== null) {
								media_image_url_value.attr('src', media_attachment.url);
								media_image_url.show();
							}
						}
					);
				}
			);

			// Runs when the image button is clicked.
			customize_theme_controls.on(
				'click',
				'.cleaninglight-image-remove',
				function (e) {
					$(this).siblings('.img-preview-wrap').hide();
					$(this).siblings('.image-value-url').val('');
					$(this).siblings('.image-value-url').attr('value', '');
					$(this).parent().siblings().find('.customize-control-alpha-color').each(
						function () {
							var color = $(this).data('color-single-name');
							if (color === 'background-overlay-color') {
								$(this).parent().hide();
							}
						}
					);
				}
			);
		}
	)
})(jQuery);


function cleaninglight_Alpha_Color_Control(wrap, $) {

	wrap.find('.cleaninglight-alpha-picker').each(

		function () {

			// Scope the vars.
			var $control, colorPickerOptions, $container;

			// Store the control instance.
			$control = $(this);

			// Set up the options that we'll pass to wpColorPicker().
			colorPickerOptions = {
				change: _.throttle(
					function (event, ui) {
						var key, value;

						key = $control.attr('data-customize-setting-link');
						value = $control.wpColorPicker('color');

						// Send ajax request to wp.customize to trigger the Save action.
						wp.customize(
							key,
							function (obj) {
								obj.set(value);
							}
						);
						$control.trigger('change');
					},
					200
				)
			};

			// Create the colorpicker.
			$control.wpColorPicker(colorPickerOptions);

		}
	);
}

/**
 * Initialization trigger.
 */
jQuery(document).ready(
	function ($) {
		cleaninglight_Alpha_Color_Control($('body'), $);
	}
);