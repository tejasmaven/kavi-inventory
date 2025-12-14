<?php

if(!function_exists('cleaninglight_themes_sanitize_checkbox')){

	function cleaninglight_themes_sanitize_checkbox( $input ) {

		return ( ( isset( $input ) && true === $input ) ? true : false );
	}
}

if(!function_exists('cleaninglight_themes_sanitize_text')){

	function cleaninglight_themes_sanitize_text($input) {

		return wp_kses_post(force_balance_tags($input));
	}
}

if(!function_exists('cleaninglight_themes_sanitize_select')){

	function cleaninglight_themes_sanitize_select( $input, $setting ){
		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		//get the list of possible select options 
		$choices = $setting->manager->get_control( $setting->id )->choices;

		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );  
	}
}


if(!function_exists('cleaninglight_themes_sanitize_options')){

	function cleaninglight_themes_sanitize_options( $input, $setting ){

		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		//get the list of possible select options 
		$options = $setting->manager->get_control( $setting->id )->options;

		//return input if valid or return default option
		return ( array_key_exists( $input, $options ) ? $input : $setting->default );  
	}
}


if(!function_exists('cleaninglight_themes_sanitize_switch')){

	function cleaninglight_themes_sanitize_switch($input) {

		$valid_keys = array(
			'enable'  => esc_html__( 'Enable', 'cleaning-light' ),
			'disable' => esc_html__( 'Disable', 'cleaning-light' )
		);

		if ( array_key_exists( $input, $valid_keys ) ) {

			return $input;

		} else {

			return '';
		}
	}
}


if(!function_exists('cleaninglight_themes_sanitize_number_blank')){

	function cleaninglight_themes_sanitize_number_blank($val) {

		return is_numeric($val) ? $val : '';
		
	}
}


if( !function_exists('cleaninglight_themes_sanitize_color_alpha')):
    
    function cleaninglight_themes_sanitize_color_alpha($color) {

        $color = str_replace('#', '', $color);

        if ('' === $color) {
            return '';
        }

        // 3 or 6 hex digits, or the empty string.
        if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', '#' . $color)) {
            // convert to rgb
            $colour = $color;
            if (strlen($colour) == 6) {

                list( $r, $g, $b ) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
            
			} elseif (strlen($colour) == 3) {

                list( $r, $g, $b ) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);

            } else {

                return false;
            }
            $r = hexdec($r);
            $g = hexdec($g);
            $b = hexdec($b);

            return 'rgba(' . join(',', array('r' => $r, 'g' => $g, 'b' => $b, 'a' => 1)) . ')';
        }

        return strpos(trim($color), 'rgb') !== false ? $color : false;
    }

endif;


if(!function_exists('cleaninglight_themes_sanitize_options')){
    
    function cleaninglight_themes_sanitize_options( $input, $setting ){
        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible select options 
        $options = $setting->manager->get_control( $setting->id )->options;
		
        //return input if valid or return default option
        return ( array_key_exists( $input, $options ) ? $input : $setting->default );  
    }
}


if( !function_exists('cleaninglight_themes_sanitize_multi_choices')){

    function cleaninglight_themes_sanitize_multi_choices($input, $setting) {
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control($setting->id)->choices;
        $input_keys = $input;
        foreach ($input_keys as $key => $value) {

            if (!array_key_exists($value, $choices)) {
                
                unset($input[$key]);
            }
        }
        // If the input is a valid key, return it;
        // otherwise, return the default.
        return ( is_array($input) ? $input : $setting->default );
    }
}


if( !function_exists('cleaninglight_themes_sanitize_repeater')){

    /** Repeat Fields Sanitization */
    function cleaninglight_themes_sanitize_repeater($input) {

        $input_decoded = json_decode($input, true);

        if (!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box) {

                foreach ($box as $key => $value) {

                    $input_decoded[$boxes][$key] = wp_kses_post($value);
                }
            }
            return json_encode($input_decoded);
        }
        return $input;
    }
}


if ( ! function_exists( 'cleaninglight_themes_sanitize_field_background' ) ) :

	/**
	 * Sanitize Field Background
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function cleaninglight_themes_sanitize_field_background( $input, $cleaninglight_themes_setting ) {

		$input_decoded = json_decode( $input, true );

		$output        = array();

		if ( ! empty( $input_decoded ) ) {

			foreach ( $input_decoded as $key => $value ) {

				switch ( $key ) :
					case 'background-size':
					case 'background-position':
					case 'background-repeat':
					case 'background-attachment':
						$output[ $key ] = sanitize_key( $value );
						break;

					case 'background-image':
						$output[ $key ] = esc_url_raw( $value );
						break;
					case 'background-color':
					case 'background-hover-color':
					case 'background-color-title':
					case 'title-font-color':
					case 'background-color-post':
					case 'site-title-color':
					case 'site-tagline-color':
					case 'post-font-color':
					case 'text-color':
					case 'text-hover-color':
					case 'title-color':
					case 'link-color':
					case 'link-hover-color':
					case 'on-sale-bg':
					case 'on-sale-color':
					case 'out-of-stock-bg':
					case 'out-of-stock-color':
					case 'rating-color':
					case 'grid-list-color':
					case 'grid-list-hover-color':
					case 'categories-color':
					case 'categories-hover-color':
					case 'deleted-price-color':
					case 'deleted-price-hover-color':
					case 'price-color':
					case 'price-hover-color':
					case 'content-color':
					case 'content-hover-color':
					case 'tab-list-color':
					case 'tab-content-color':
					case 'tab-list-border-color':
					case 'tab-content-border-color':
					case 'background-stripped-color':
					case 'button-color':
					case 'button-hover-color':
					case 'icon-color':
					case 'icon-hover-color':
					case 'meta-color':
					case 'next-prev-color':
					case 'next-prev-hover-color':
					case 'button-bg-color':
					case 'button-bg-hover-color':
						$output[ $key ] = cleaninglight_themes_sanitize_color( $value );
						break;
					case 'margin': 
					case 'padding': 
					case 'radius': 
						$output[ $key ] =  cleaninglight_themes_sanitize_field_css_box( $value );
						break;
					default:
						$output[ $key ] = sanitize_text_field( $value );
						break;
				endswitch;
			}
			return json_encode( $output );
		}

		return $input;

	}

endif;


if ( ! function_exists( 'cleaninglight_themes_sanitize_color' ) ) :
	/**
	 * Color sanitization callback
	 * https://wordpress.stackexchange.com/questions/257581/escape-hexadecimals-rgba-values
	 * @since 1.0.6
	 */
	function cleaninglight_themes_sanitize_color( $color ) {

		if ( empty( $color ) || is_array( $color ) ) {
			return '';
		}
		// If string does not start with 'rgba', then treat as hex.
		// sanitize the hex color and finally convert hex to rgba
		if ( false === strpos( $color, 'rgba' ) ) {
			return sanitize_hex_color( $color );
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
	}
endif;


if ( ! function_exists( 'cleaninglight_themes_sanitize_field_css_box' ) ) :
	/**
	 * Sanitize Default Css Box
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function cleaninglight_themes_sanitize_field_css_box( $input_decoded ) {

		$output        = array();

		if ( ! empty( $input_decoded ) ) {

			foreach ( $input_decoded as $device_id => $device_details ) {

				foreach ( $device_details as $key => $value ) {

					if ( $key == 'cssbox_link' ) {
						$output[ $device_id ][ $key ] = $value; //( ( isset( $value ) && true === $value ) ? 1 : 0 );
					} else {
						$output[ $device_id ][ $key ] = $value !='' ? intval( $value ) : '';
					}
				}
			}
			return ( $output );
		}
		return $input_decoded;
	}
endif;


if ( ! function_exists( 'cleaninglight_themes_sanitize_field_default_css_box' ) ) :
	/**
	 * Sanitize Default Css Box
	 *
	 * @param $input
	 * @return array
	 *
	 */
	function cleaninglight_themes_sanitize_field_default_css_box( $input ) {

		$input_decoded = json_decode( $input, true );

		$output        = array();

		if ( ! empty( $input_decoded ) ) {

			foreach ( $input_decoded as $device_id => $device_details ) {

				foreach ( $device_details as $key => $value ) {

					if ( $key == 'cssbox_link' ) {

						$output[ $device_id ][ $key ] = ( ( isset( $value ) && true === $value ) ? true : false );
					
					} else {

						$output[ $device_id ][ $key ] = $value !='' ? intval( $value ) : '';
					}
				}
			}
			return json_encode( $output );
		}
		return $input;
	}
endif;

if ( ! function_exists( 'cleaninglight_themes_not_empty' ) ) {
	/**
	 * cleaninglight_themes_not_empty
	 * @param $var
	 * @return bool
	 */
	function cleaninglight_themes_not_empty( $var ) {
		if ( trim( $var ) === '' ) {
			return false;
		}
		return true;
	}
}


if ( ! function_exists( 'cleaninglight_themes_cssbox_values_inline' ) ) {
	/**
	 * cleaninglight_themes_cssbox_values_inline description
	 * @param  array  $position_collection
	 * @param  string $device
	 * @return string
	 */
	function cleaninglight_themes_cssbox_values_inline( $position_collection, $device ) {
		$inline_css = '';
		if ( ! is_array( $position_collection ) ) {
			return false;
		}
		foreach ( $position_collection as $device_data => $value ) {
			switch ( $device_data ) {
				case 'desktop':
					if ( 'desktop' == $device ) {
						$top    = ( isset( $value['top'] ) && cleaninglight_themes_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && cleaninglight_themes_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && cleaninglight_themes_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && cleaninglight_themes_not_empty( $value['left'] ) ) ? $value['left'] : '';
						if ( cleaninglight_themes_not_empty( $top ) || cleaninglight_themes_not_empty( $right ) || cleaninglight_themes_not_empty( $bottom ) || cleaninglight_themes_not_empty( $left ) ) {
							$top        = ( cleaninglight_themes_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( cleaninglight_themes_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( cleaninglight_themes_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( cleaninglight_themes_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;
				case 'tablet':
					if ( 'tablet' == $device ) {
						$top    = ( isset( $value['top'] ) && cleaninglight_themes_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && cleaninglight_themes_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && cleaninglight_themes_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && cleaninglight_themes_not_empty( $value['left'] ) ) ? $value['left'] : '';
						if ( cleaninglight_themes_not_empty( $top ) || cleaninglight_themes_not_empty( $right ) || cleaninglight_themes_not_empty( $bottom ) || cleaninglight_themes_not_empty( $left ) ) {
							$top        = ( cleaninglight_themes_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( cleaninglight_themes_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( cleaninglight_themes_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( cleaninglight_themes_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;
				case 'mobile':
					if ( 'mobile' == $device ) {
						$top    = ( isset( $value['top'] ) && cleaninglight_themes_not_empty( $value['top'] ) ) ? $value['top'] : '';
						$right  = ( isset( $value['right'] ) && cleaninglight_themes_not_empty( $value['right'] ) ) ? $value['right'] : '';
						$bottom = ( isset( $value['bottom'] ) && cleaninglight_themes_not_empty( $value['bottom'] ) ) ? $value['bottom'] : '';
						$left   = ( isset( $value['left'] ) && cleaninglight_themes_not_empty( $value['left'] ) ) ? $value['left'] : '';
						if ( cleaninglight_themes_not_empty( $top ) || cleaninglight_themes_not_empty( $right ) || cleaninglight_themes_not_empty( $bottom ) || cleaninglight_themes_not_empty( $left ) ) {
							$top        = ( cleaninglight_themes_not_empty( $top ) ) ? $top . 'px' : 0;
							$right      = ( cleaninglight_themes_not_empty( $right ) ) ? $right . 'px' : 0;
							$bottom     = ( cleaninglight_themes_not_empty( $bottom ) ) ? $bottom . 'px' : 0;
							$left       = ( cleaninglight_themes_not_empty( $left ) ) ? $left . 'px' : 0;
							$inline_css = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
						} else {
							$inline_css = '0';
						}
					}
					break;
				default:
					break;
			}
    	}
		return $inline_css;
	}
}


if ( ! function_exists( 'cleaninglight_themes_sanitize_field_responsive_buttonset' ) ) :
	/**
	 * Check if Json
	 *
	 * @since 1.0.6
	 * @param  $input, $setting
	 * @return boolean
	 */
	function cleaninglight_themes_sanitize_field_responsive_buttonset( $input ) {
		$range_value            = json_decode( $input, true );
		$range_value['desktop'] = ! empty( $range_value['desktop'] ) ? sanitize_text_field( $range_value['desktop'] ) : '';
		$range_value['tablet']  = ! empty( $range_value['tablet'] ) ? sanitize_text_field( $range_value['tablet'] ) : '';
		$range_value['mobile']  = ! empty( $range_value['mobile'] ) ? sanitize_text_field( $range_value['mobile'] ) : '';
		return json_encode( $range_value );
	}
endif;