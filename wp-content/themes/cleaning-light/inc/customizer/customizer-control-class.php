<?php 
if (class_exists('WP_Customize_Control')) {
    /**
     * Alpha Color Control
    */
    class Cleaninglight_Alpha_Color_Control extends WP_Customize_Control {
        /**
         * Official control name.
         */
        public $type = 'alpha-color';
        /**
         * Add support for palettes to be passed in.
         *
         * Supported palette values are true, false, or an array of RGBa and Hex colors.
         */
        public $palette;
        /**
         * Add support for showing the opacity value on the slider handle.
         */
        public $show_opacity;

        /**
         * Render the control.
         */
        public function render_content() {

            // Process the palette
            if (is_array($this->palette)) {

                $palette = implode('|', $this->palette);

            } else {

                // Default to true.
                $palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
            }
            // Support passing show_opacity as string or boolean. Default to true.
            $show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
            // Begin the output.

            ?>
            <div class="customize-control-title-wrap">
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </div>

            <input class="alpha-color-control" data-alpha-enabled="true" data-alpha="<?php echo esc_attr($show_opacity); ?>" type="text" data-palette="<?php echo esc_attr($palette); ?>" data-default-color="<?php echo esc_attr($this->settings['default']->default); ?>" <?php esc_attr($this->link()); ?>  />
            <?php
        }
    }

    /**
     * Buttonset control
    */
    class Cleaninglight_Custom_Control_Buttonset extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'cleaninglight-buttonset';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {

            parent::to_json();

            if ( isset( $this->default ) ) {
                $this->json['default'] = $this->default;
            } else {
                $this->json['default'] = $this->setting->default;
            }
            $this->json['value']   = $this->value();
            $this->json['choices'] = $this->choices;
            $this->json['link']    = $this->get_link();
            $this->json['id']      = $this->id;
            $this->json['inputAttrs'] = '';

            foreach ( $this->input_attrs as $attr => $value ) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
            }
        }

        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() { ?>

            <# if ( data.label ) { #>
                <span class="customize-control-title">{{{ data.label }}}</span>
            <# } #>
            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <div id="input_{{ data.id }}" class="buttonset">
                <# for ( key in data.choices ) { #>
                    <input {{{ data.inputAttrs }}} class="switch-input" type="radio" value="{{ key }}" name="_customize-radio-{{{ data.id }}}" id="{{ data.id }}{{ key }}" {{{ data.link }}}<# if ( key === data.value ) { #> checked="checked" <# } #>>
                        <label class="switch-label switch-label-<# if ( key === data.value ) { #>on <# } else { #>off<# } #>" for="{{ data.id }}{{ key }}">
                            {{ data.choices[ key ] }}
                        </label>
                    </input>
                <# } #>
            </div>
            <?php
        }
    }

    /**
	 * Responsive Buttonset control
	*/
	class Cleaninglight_Custom_Control_Responsive_Buttonset extends WP_Customize_Control {
		/**
		* The control type.
		*
		* @access public
		* @var string
		*/
		public $type = 'cleaninglight-responsive-buttonset';
		/**
		* Repeater drag and drop controler
		*
		* @since  1.0.6
		*/
		public function __construct( $manager, $id, $args = array(), $attr = array() ) {
			$this->attr  = $attr;
			$this->label = $args['label'];
			parent::__construct( $manager, $id, $args );
		}

		/**
		* Renders the control wrapper and calls $this->render_content() for the internals.
		*
		* @see WP_Customize_Control::render()
		*/
		protected function render() {
			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control has-switchers customize-control-' . $this->type; ?>

				<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
					<?php $this->render_content(); ?>
				</li>

			<?php
		}

		public function render_content() {
			if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {
				$values = json_encode( $this->value() );
			} else {
				$values = $this->value();
			}
			?>
			<ul class="cleaninglight-responsive-buttonset-field-control-wrap">
				<?php $this->cleaninglight_responsive_buttonset_fields(); ?>
			</ul>
			<input type="hidden" <?php $this->link(); ?> class="cleaninglight-responsive-buttonset-collection-value" value="<?php echo esc_attr( $values ); ?>"/>
			<?php
		}

		public function cleaninglight_responsive_buttonset_fields() {
			$devices = array(
				'desktop' => array(
					'icon' => 'dashicons-desktop',
				),
				'tablet'  => array(
					'icon' => 'dashicons-tablet',
				),
				'mobile'  => array(
					'icon' => 'dashicons-smartphone ',
				),
			);
			$attr = $this->attr;
			if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {
				$values = $this->value();
			} else {
				$values = json_decode( $this->value(), true );
			}
			?>
			<li class="cleaninglight-responsive-buttonset-field-control">
				<div class="cleaninglight-responsive-buttonset-fields">
					<div class="cleaninglight-responsive-buttonset-title-wrap">
						<h3 class="cleaninglight-responsive-buttonset-field-label">
							<?php echo "<span class='cleaninglight-responsive-buttonset-field-title'>" . esc_html( $this->label ) . '</span>'; ?>
						</h3>
						<?php if ( count( $devices ) > 1 ) { ?>
							<ul class="responsive-switchers">
								<?php
								$i = 1;
								foreach ( $devices as $device_id => $device_details ) {
									if ( $i == 1 ) {
										$active = ' active';
									} else {
										$active = '';
									}
								?>
									<li class="<?php echo esc_attr( $device_id ); ?>">
										<button type="button" class="preview-<?php echo esc_attr( $device_id ) . ' ' . $active; ?>" data-device="<?php echo esc_attr( $device_id ); ?>">
											<i class="dashicons <?php echo esc_attr( $device_details['icon'] ); ?>"></i>
										</button>
									</li>
								<?php $i ++; } ?>
							</ul>
						<?php } ?>
					</div>
				<?php if ( $this->description ) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post( $this->description ); ?>
					</span>
				<?php } ?>

				<div class="responsive-switchers-fields">
					<?php
						$i = 1;
						foreach ( $devices as $device_id => $device_details ) {
							if ( $i == 1 ) {
								$active = ' active';
							} else {
								$active = '';
							}
							echo '<ul class="cleaninglight-responsive-buttonset-device-wrap control-wrap ' . $device_id . ' ' . $active . '" data-device="' . esc_attr( $device_id ) . '" data-inputname="' . esc_attr( $this->id . $device_id ) . '">';
								
								$value = isset( $values[ $device_id ] ) ? $values[ $device_id ] : '';
							
								echo '<li>';
									foreach ( $this->choices as $val => $label ) {
										?>
										<input name="<?php echo esc_attr( $this->id . $device_id ); ?>" id="<?php echo esc_attr( $this->id . '-' . $device_id . '-' . $val ); ?>" class="switch-input" type="radio" <?php checked( $value, $val, true ); ?> value="<?php echo esc_attr( $val ); ?>">
											<label for="<?php echo esc_attr( $this->id . '-' . $device_id . '-' . $val ); ?>" class="switch-label switch-label-<?php $value == $val ? 'on' : 'off'; ?>">
												<?php echo esc_html( $label ); ?>
											</label>
										</input>
										<?php
									}
								echo '</li>';
								
							echo '</ul>';
							$i ++;
						}
					?>
				</div>
			</div>
			</li>
			<?php
		}
	}

    /**
     * Fontawesome Icon Select
    */
    class Cleaninglight_Fontawesome_Icon_Chooser extends WP_Customize_Control {

        public $type = 'icon';
        public $icon_array = array();

        public function __construct($manager, $id, $args = array()) {

            if (isset($args['icon_array'])) {
                $this->icon_array = $args['icon_array'];
            }
            parent::__construct($manager, $id, $args);
        }
        
        public function render_content() { ?>
            <label>
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>
                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
                <div class="cleaninglight-customizer-icon-box">
                    <div class="cleaninglight-selected-icon">
                        <i class="<?php echo esc_attr($this->value()); ?>"></i>
                        <span><i class="dashicons dashicons-arrow-down-alt2"></i></span>
                    </div>

                    <div class="cleaninglight-icon-box">
                        <div class="cleaninglight-icon-search">
                            <input type="text" class="cleaninglight-icon-search-input" placeholder="<?php echo esc_attr__('Type to filter', 'cleaning-light'); ?>" />
                        </div>

                        <ul class="cleaninglight-icon-list fontawesome-list clearfix active">
                            <?php
                                if (isset($this->icon_array) && !empty($this->icon_array)) {

                                    $cleaninglight_font_awesome_icon_array = $this->icon_array;

                                } else {

                                    $cleaninglight_font_awesome_icon_array = cleaninglight_font_awesome_icon_array();

                                }
                                foreach ($cleaninglight_font_awesome_icon_array as $cleaninglight_font_awesome_icon) {

                                    $icon_class = $this->value() == $cleaninglight_font_awesome_icon ? 'icon-active' : '';
                                    
                                    echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($cleaninglight_font_awesome_icon) . '"></i></li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <input type="hidden" value="<?php esc_attr($this->value()); ?>" <?php esc_attr( $this->link() ); ?> />
                
                </div>

            </label>
            <?php
        }
    }

    /**
     * Custom Heading Control
    */
    class Cleaninglight_Customize_Heading extends WP_Customize_Control {

        public $type = 'heading';

        public function render_content() {

            if (!empty($this->label)) : ?>

                <h3 class="cleaninglight-accordion-section-title">
                    <?php echo esc_html($this->label); ?>
                </h3>

            <?php endif; if ($this->description) { ?>

                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>

                <?php
            }
        }
    }

    /**
     * Info Text Control
    */
    class Cleaninglight_Info_Text extends WP_Customize_Control {

        public function render_content() { ?>

            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>

                <span class="customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>

                <?php
            }
        }
    }

    /**
     * Multiple Checkbox Control
     */
    class Cleaninglight_Multiple_Check_Control extends WP_Customize_Control {

        public $type = 'checkbox-multiple';

        public function render_content() {
            if (empty($this->choices)) {
                return;
            }
            ?>
            <div class="customize-control-checkbox-multiple">

                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if ($this->description) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>
                    <ul>
                        <?php foreach ($this->choices as $value => $label) : ?>
                            <li>
                                <label>
                                    <input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> />
                                    <?php echo esc_html($label); ?>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
            </div>
            <?php
        }
    }

    /**
     * Checkbox Control
    */
    class Cleaninglight_Checkbox_Control extends WP_Customize_Control {
        /**
         * Control type
         *
         * @var string
         */
        public $type = 'checkbox-toggle';
        /**
         * Control method
         *
         * @since 1.0.6
         */
        public function render_content() {
            ?>
            <div class="checkbox-toggle">
                <div class="onoff-switch">
                    <input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="onoff-switch-checkbox" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> <?php checked($this->value()); ?>>
                    <label class="onoff-switch-label" for="<?php echo esc_attr($this->id); ?>"></label>
                </div>
                <span class="customize-control-title onoff-switch-title"><?php echo esc_html($this->label); ?></span>
                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>
            </div>
            <?php
        }
    }

    /**
     * Select Box Control
    */
    class Cleaninglight_Selector extends WP_Customize_Control {

        public $type = 'selector';

        public $options = array();

        public $class = '';

        public function __construct($manager, $id, $args = array()) {
            $this->options = $args['options'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {

            $options = $this->options; ?>

            <div class="control-wrapper">
                <span class="customize-control-title">
                    <?php echo esc_html($this->label); ?>
                </span>

                <?php if (!empty($this->description)) { ?>
                    <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                    </span>
                <?php } ?>

                <div class="selector-labels <?php echo esc_attr($this->class) ?>">
                    <?php
                        foreach ($options as $key => $image) {
                            $class = ( $this->value() == $key ) ? 'selector-selected' : '';
                            echo '<div class="label ' . esc_attr($class) . '" data-val="' . esc_attr($key) . '">';
                            echo '<img src="' . esc_url($image) . '"/>';
                            echo '</div>';
                        }
                    ?>
                </div>
                <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            </div>
            <?php
        }
    }

    /**
     * Separator Control
    */
    class Cleaninglight_Separator_Control extends WP_Customize_Control {
        /**
         * Control type
         *
         * @var string
        */

        public $type = 'separator';

        /**
         * Control method
         *
         * @since 1.0.6
        */
        public function render_content() { ?>

            <p><span></span></p>

            <?php
        }
    }

    /**
     * Sortable Control
    */
    class Cleaninglight_Sortable_Control extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
        */
        public $type = 'sortable';

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
        */
        public function to_json() {
            parent::to_json();

            $this->json['default'] = $this->setting->default;

            if (isset($this->default)) {
                $this->json['default'] = $this->default;
            }
            $this->json['value'] = maybe_unserialize($this->value());
            $this->json['choices'] = $this->choices;
            $this->json['link'] = $this->get_link();
            $this->json['id'] = $this->id;
            $this->json['inputAttrs'] = '';

            foreach ($this->input_attrs as $attr => $value) {

                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }
            
            $this->json['inputAttrs'] = maybe_serialize($this->input_attrs());
        }
        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <div class='cleaninglight-sortable'>
                <span class="customize-control-title">
                    {{{ data.label }}}
                </span>

                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>
                <ul class="sortable">
                    <# _.each( data.value, function( choiceID ) { #>
                        <li {{{ data.inputAttrs }}} class='cleaninglight-sortable-item' data-value='{{ choiceID }}'>
                            <i class='dashicons dashicons-menu'></i>
                            <i class="dashicons dashicons-visibility visibility"></i>
                            {{{ data.choices[ choiceID ] }}}
                        </li>
                    <# }); #>
                    <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
                        <# if ( -1 === data.value.indexOf( choiceID ) ) { #>
                            <li {{{ data.inputAttrs }}} class='cleaninglight-sortable-item invisible' data-value='{{ choiceID }}'>
                                <i class='dashicons dashicons-menu'></i>
                                <i class="dashicons dashicons-visibility visibility"></i>
                                {{{ data.choices[ choiceID ] }}}
                            </li>
                        <# } #>
                    <# }); #>
                </ul>
            </div>
            <?php
        }
    }

    /**
     * Switch Control
    */
    class Cleaninglight_Switch_Control extends WP_Customize_Control {

        public $type = 'switch';

        public $on_off_label = array();

        public $class;

        public function __construct($manager, $id, $args = array()) {
            $this->on_off_label = $args['switch_label'];
            $this->class = isset($args['class']) ? $args['class'] : '';
            parent::__construct($manager, $id, $args);
        }

        public function render_content() {

            $switch_class = ($this->value() == 'enable') ? 'switch-on ' : '';

            $switch_class .= $this->class;

            $on_off_label = $this->on_off_label;
            ?>
            <div class="onoffswitch <?php echo esc_attr($switch_class); ?>">
                <div class="onoffswitch-inner">
                    <div class="onoffswitch-active">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['enable']) ?></div>
                    </div>
                    <div class="onoffswitch-inactive">
                        <div class="onoffswitch-switch"><?php echo esc_html($on_off_label['disable']) ?></div>
                    </div>
                </div>
            </div>
            <input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr($this->value()); ?>"/>
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
            </span>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo ($this->description ); ?>
                </span>
            <?php } ?>
            <?php
        }
    }

    /**
     * Tab Control
    */
    class Cleaninglight_Custom_Control_Tab extends WP_Customize_Control {

        public $type = 'tab';
        public $buttons = '';

        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
        }

        public function to_json() {

            parent::to_json();
            $first = true;

            $formatted_buttons = array();
            $all_fields = array();

            foreach ($this->buttons as $button) {

                $active = isset($button['active']) ? $button['active'] : false;
                if ($active && $first) {
                    $first = false;
                } elseif ($active && !$first) {
                    $active = false;
                }
                
                $class = "";
                if(isset($button['class'])){
                    $class = $button['class'];
                }

                $formatted_buttons[] = array(
                    'name' => $button['name'],
                    'fields' => $button['fields'],
                    'class' => $class,
                    'active' => $active,
                );
                $all_fields = array_merge($all_fields, $button['fields']);
            }
            $this->json['buttons'] = $formatted_buttons;
            $this->json['fields'] = $all_fields;
        }

        public function content_template() { ?>

            <div class="customizer-tab-wrap">
                <# if ( data.buttons ) { #>
                    <div class="customizer-tabs">
                        <# for (tab in data.buttons) { #>
                            <a href="#" class="customizer-tab {{ data.buttons[tab].class }} <# if ( data.buttons[tab].active ) { #> active <# } #>" data-tab="{{ tab }}">{{ data.buttons[tab].name }}</a>
                        <# } #>
                    </div>
                <# } #>
            </div>
            <?php
        }
    }

    /**
     * Toggle Eye
    */
    class Cleaninglight_Toggle_Section extends WP_Customize_Section {
        /**
         * The type of customize section being rendered.
         *
         * @access public
         * @var    string
         */
        public $type = 'toggle-section';

        /**
         * Flag to display icon when entering in customizer
         *
         * @access public
         * @var bool
         */
        public $hide;

        /**
         * Name of customizer hiding control.
         *
         * @access public
         * @var bool
         */
        public $hiding_control;

        /**
         * Cleaninglight_Toggle_Section constructor.
         *
         * @param WP_Customize_Manager $manager Customizer Manager.
         * @param string               $id Control id.
         * @param array                $args Arguments.
         */
        public function __construct(WP_Customize_Manager $manager, $id, array $args = array()) {
            parent::__construct($manager, $id, $args);
            if (isset($args['hiding_control'])) {
                $this->hide = get_theme_mod($args['hiding_control'], 'enable');
            }
            add_action('customize_controls_init', array($this, 'enqueue'));
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @access public
         */
        public function json() {
            $json = parent::json();
            $json['hide'] = $this->hide;
            $json['hiding_control'] = $this->hiding_control;
            return $json;
        }

        /**
         * Enqueue function.
         *
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script('toggle-section', get_template_directory_uri() . '/inc/customizer/js/toggle-section.js', array('jquery'), CLEANINGLIGHT_VERSION, true);
        }
        
        /**
         * Outputs the Underscore.js template.
         *
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
                <h3 class="accordion-section-title">
                    <# if(data.hiding_control){ #>
                    <span class="cleaninglight--sortable-handle dashicons dashicons-image-flip-vertical"></span>
                    <# } #>    
                    <button type="button" class="accordion-trigger" aria-expanded="false" aria-controls="{{ data.id }}-content">
                    {{ data.title }}
                    <# if ( data.hide == 'enable' ) { #>
                    <a data-control="{{ data.hiding_control }}" class="cleaninglight-toggle-section" href="#"><span class="dashicons dashicons-visibility"></span></a>
                    <# } else { #>
                    <a data-control="{{ data.hiding_control }}" class="cleaninglight-toggle-section" href="#"><span class="dashicons dashicons-hidden"></span></a>
                    <# } #>
                    </button>
                </h3>
                <ul class="accordion-section-content" id="{{ data.id }}-content">
                    <li class="customize-section-description-container section-meta <# if ( data.description_hidden ) { #>customize-info<# } #>">
                        <div class="customize-section-title">
                            <button class="customize-section-back" tabindex="-1">
                            </button>
                            <h3>
                                <span class="customize-action">
                                    {{{ data.customizeAction }}}
                                </span>
                                {{ data.title }}
                            </h3>
                            <# if ( data.description && data.description_hidden ) { #>
                            <button type="button" class="customize-help-toggle dashicons dashicons-editor-help" aria-expanded="false"></button>
                            <div class="description customize-section-description">
                                {{{ data.description }}}
                            </div>
                            <# } #>
                        </div>
                        <# if ( data.description && ! data.description_hidden ) { #>
                        <div class="description customize-section-description">
                            {{{ data.description }}}
                        </div>
                        <# } #>
                    </li>
                </ul>
            </li>

            <?php
        }
    }

    /**
     * Range Slider Control
    */
    class Cleaninglight_Range_Slider_Control extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'range-slider';

        /**
         * Renders the control wrapper and calls $this->render_content() for the internals.
         *
         * @see WP_Customize_Control::render()
         */
        protected function render() {
            $id = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
            $class = 'customize-control has-switchers customize-control-' . $this->type;
            ?>
            <li id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($class); ?>">
                <?php $this->render_content(); ?>
            </li><?php
        }

        /**
         * Refresh the parameters passed to the JavaScript via JSON.
         *
         * @see WP_Customize_Control::to_json()
         */
        public function to_json() {

            parent::to_json();
            $this->json['id'] = $this->id;

            $this->json['inputAttrs'] = '';
            foreach ($this->input_attrs as $attr => $value) {
                $this->json['inputAttrs'] .= $attr . '="' . esc_attr($value) . '" ';
            }

            $this->json['desktop'] = array();
            $this->json['tablet'] = array();
            $this->json['mobile'] = array();

            foreach ($this->settings as $setting_key => $setting) {
                $this->json[$setting_key] = array(
                    'id' => $setting->id,
                    'default' => $setting->default,
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                );
            }
        }
        /**
         * An Underscore (JS) template for this control's content (but not its container).
         *
         * Class variables for this control class are available in the `data` JS object;
         * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
            ?>
            <# if ( data.label ) { #>
                <div class="customize-control-title">
                    <span>{{{ data.label }}}</span>
                    <ul class="responsive-switchers">
                        <li class="desktop">
                            <button type="button" class="preview-desktop active" data-device="desktop">
                                <i class="dashicons dashicons-desktop"></i>
                            </button>
                        </li>
                        <li class="tablet">
                            <button type="button" class="preview-tablet" data-device="tablet">
                                <i class="dashicons dashicons-tablet"></i>
                            </button>
                        </li>
                        <li class="mobile">
                            <button type="button" class="preview-mobile" data-device="mobile">
                                <i class="dashicons dashicons-smartphone"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            <# } #>
            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <# if ( data.desktop ) { #>
                <div class="desktop control-wrap active">
                    <div class="cleaninglight-slider desktop-slider"></div>
                    <div class="cleaninglight-slider-input">
                        <input {{{ data.inputAttrs }}} type="number" class="slider-input desktop-input" value="{{ data.desktop.value }}" {{{ data.desktop.link }}} />
                    </div>
                </div>
            <# } #>
            <# if ( data.tablet ) { #>
                <div class="tablet control-wrap">
                    <div class="cleaninglight-slider tablet-slider"></div>
                    <div class="cleaninglight-slider-input">
                        <input {{{ data.inputAttrs }}} type="number" class="slider-input tablet-input" value="{{ data.tablet.value }}" {{{ data.tablet.link }}} />
                    </div>
                </div>
            <# } #>
            <# if ( data.mobile ) { #>
                <div class="mobile control-wrap">
                    <div class="cleaninglight-slider mobile-slider"></div>
                    <div class="cleaninglight-slider-input">
                        <input {{{ data.inputAttrs }}} type="number" class="slider-input mobile-input" value="{{ data.mobile.value }}" {{{ data.mobile.link }}} />
                    </div>
                </div>
            <# } #>
            <?php
        }
    }

    /**
     * Slider Control
     */
    class Cleaninglight_Themes_Range_Control extends WP_Customize_Control {
        /**
         * The type of control being rendered
         */
        public $type = 'range';

        /**
         * Render the control in the customizer
         */
        public function render_content() { ?>
        
            <span class="customize-control-title">
                <?php echo esc_html($this->label); ?>
                <span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr($this->value()); ?>"></span>
            </span>

            <div class="control-wrap"> 
                <div class="cleaninglight-slider" slider-min-value="<?php echo esc_attr($this->input_attrs['min']); ?>" slider-max-value="<?php echo esc_attr($this->input_attrs['max']); ?>" slider-step-value="<?php echo esc_attr($this->input_attrs['step']); ?>"></div>
                <div class="cleaninglight-slider-input">
                    <input type="number" value="<?php echo esc_attr($this->value()); ?>" class="slider-input" <?php $this->link(); ?> />
                </div>
            </div>

            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
                <?php
            }
        }
    }

    /**
	 * Buttonset control
	*/
	class Cleaninglight_Themes_Custom_Control_Cssbox extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'cleaninglight-cssbox';

		/**
		 * Repeater drag and drop controler
		 *
		 * @since  1.2.8
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array(), $attr = array() ) {
			$this->fields = $fields;
			$this->attr   = $attr;
			$this->label  = $args['label'];
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @see WP_Customize_Control::render()
		 */
		protected function render() {

			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control has-switchers customize-control-' . $this->type; ?>

                <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
                    <?php $this->render_content(); ?>
                </li>

		    <?php 
        }

		public function render_content() {

                if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {
                    $values = json_encode( $this->value() );
                } else {
                    $values = $this->value();
                }
			?>
                <ul class="cssbox-field-control-wrap">
                    <?php $this->get_fields(); ?>
                </ul>
			    <input type="hidden" <?php $this->link(); ?> class="cssbox-collection-value" value="<?php echo esc_attr( $values ); ?>"/>
			
            <?php 
        }

		public function get_fields() {

			$devices = array(
				'desktop' => array(
					'icon' => 'dashicons-laptop',
				),
				'tablet'  => array(
					'icon' => 'dashicons-tablet',
				),
				'mobile'  => array(
					'icon' => 'dashicons-smartphone ',
				),
			);

			$default_fields  = array(
				'top'    => true,
				'right'  => true,
				'bottom' => true,
				'left'   => true,
			);

			$box_fields_attr = ! empty( $this->fields ) ? $this->fields : $default_fields;

			$attr = $this->attr;

			if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {

				$values = $this->value();

			} else {

				$values = json_decode( $this->value(), true );
			}
			$min       = isset( $attr['min'] ) ? $attr['min'] : 0;
			$max       = isset( $attr['max'] ) ? $attr['max'] : 1000;
			$step      = isset( $attr['step'] ) ? $attr['step'] : 1;
			$link      = isset( $attr['link'] ) ? $attr['link'] : 1;
			$devices   = isset( $attr['devices'] ) ? $attr['devices'] : $devices;
			$link_text = isset( $attr['link_text'] ) ? $attr['link_text'] : esc_html__( 'Link', 'cleaning-light' );
			?>
			<li class="cssbox-field-control">
				<h3 class="cssbox-field-label">
					<?php echo "<span class='cssbox-field-title'>" . esc_html( $this->label ) . '</span>'; ?>
				</h3>
				<?php if ( $this->description ) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post( $this->description ); ?>
					</span>
				<?php } ?>
				<div class="cssbox-fields">
                    <?php if ( count( $devices ) > 1 ) { ?>
                        <ul class="responsive-switchers">
                            <?php
                            $i = 1;
                            foreach ( $devices as $device_id => $device_details ) {
                                if ( $i == 1 ) {
                                    $active = ' active';
                                } else {
                                    $active = '';
                                }
                            ?>
                                <li class="<?php echo esc_attr( $device_id ); ?>">
                                    <button type="button" class="preview-<?php echo esc_attr( $device_id ) . ' ' . $active; ?>" data-device="<?php echo esc_attr( $device_id ); ?>">
                                        <i class="dashicons <?php echo esc_attr( $device_details['icon'] ); ?>"></i>
                                    </button>
                                </li>
                            <?php $i ++; } ?>
                        </ul>
                    <?php } ?>
					<div class="responsive-switchers-fields">
						<?php
                            $i = 1;
                            foreach ( $devices as $device_id => $device_details ) {

                                if ( $i == 1 ) {
                                    $active = ' active';
                                } else {
                                    $active = '';
                                }

                                echo '<ul class="cssbox-device-wrap control-wrap ' . $device_id . ' ' . $active . '">';
                                    foreach ( $box_fields_attr as $field_id => $box_single_field ) {
                                        $value   = isset( $values[ $device_id ][ $field_id ] ) ? $values[ $device_id ][ $field_id ] : '';
                                        $default = isset( $box_single_field[ $device_id ][ $field_id ] ) ? $box_single_field[ $device_id ][ $field_id ] : '';
                                        
                                        if ( ! $value ) {
                                            if ( isset( $box_single_field['default'] ) ) {
                                                $value = $box_single_field['default'];
                                            }
                                        }
                                        echo '<li>'; ?>
                                            <label>
                                                <span>
                                                    <?php echo ucfirst( esc_attr( $field_id ) ); ?>
                                                </span>
                                                <input data-device="<?php echo esc_attr( $device_id ); ?>" data-single-name="<?php echo esc_attr( $field_id ); ?>" data-default="<?php echo esc_attr( $default ); ?>" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>" step="<?php echo esc_attr( $step ); ?>" type="number" class="cssbox-field" value="<?php echo esc_attr( $value ); ?>">
                                            </label>
                                        <?php 
                                        echo '</li>';
                                    }
                                    if ( $link ) { $cssbox_link = isset( $values[ $device_id ]['cssbox_link'] ) ? $values[ $device_id ]['cssbox_link'] : ''; ?>
                                        <li>
                                            <label>
                                                <span title="<?php echo esc_attr( $link_text ); ?>"><?php echo esc_html( $link_text ); ?></span>
                                                <span class="field-link">
                                                    <input data-device="<?php echo esc_attr( $device_id ); ?>" data-single-name="cssbox_link" data-default="<?php echo esc_attr( $default ); ?>"  type="checkbox" class="cssbox-field cssbox_link" value="<?php echo esc_attr( $value ); ?>" <?php checked( true, $cssbox_link, true ); ?>>
                                                    <span class="tgl-btn"></span>
                                                </span>
                                            </label>
                                        </li>
                                        <?php
                                    }
                                echo '</ul>';
                                $i ++;
                            }
						?>
					</div>
				</div>
			</li>
			<?php
		}
	}

    /**
     * Background Control
    */
    class Cleaninglight_Background_Control extends WP_Customize_Upload_Control {
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $type = 'background-image';

        /**
         * Mime type for upload control.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $mime_type = 'image';

        /**
         * Labels for upload control buttons.
         *
         * @since  1.0.6
         * @access public
         * @var    array
         */
        public $button_labels = array();

        /**
         * Field labels
         *
         * @since  1.0.6
         * @access public
         * @var    array
         */
        public $field_labels = array();

        /**
         * Background choices for the select fields.
         *
         * @since  1.0.6
         * @access public
         * @var    array
         */
        public $background_choices = array();

        /**
         * Constructor.
         *
         * @since 1.0.6
         * @uses WP_Customize_Upload_Control::__construct()
         *
         * @param WP_Customize_Manager $manager Customizer bootstrap instance.
         * @param string               $id      Control ID.
         * @param array                $args    Optional. Arguments to override class property defaults.
         */
        public function __construct($manager, $id, $args = array()) {
            // Calls the parent __construct
            parent::__construct($manager, $id, $args);
            // Set button labels for image uploader
            $button_labels = $this->cleaninglight_themes_button_labels();
            $this->button_labels = apply_filters('customizer_background_button_labels', $button_labels, $id);
            // Set field labels
            $field_labels = $this->cleaninglight_themes_field_labels();
            $this->field_labels = apply_filters('customizer_background_field_labels', $field_labels, $id);
            // Set background choices
            $background_choices = $this->cleaninglight_themes_background_choices();
            $this->background_choices = apply_filters('customizer_background_choices', $background_choices, $id);
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.6
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $background_choices = $this->background_choices;
            $field_labels = $this->field_labels;
            // Loop through each of the settings and set up the data for it.
            foreach ($this->settings as $setting_key => $setting_id) {
                $this->json[$setting_key] = array(
                    'link' => $this->get_link($setting_key),
                    'value' => $this->value($setting_key),
                    'label' => isset($field_labels[$setting_key]) ? $field_labels[$setting_key] : ''
                );
                if ('image_url' === $setting_key) {
                    if ($this->value($setting_key)) {
                        // Get the attachment model for the existing file.
                        $attachment_id = attachment_url_to_postid($this->value($setting_key));
                        if ($attachment_id) {
                            $this->json['attachment'] = wp_prepare_attachment_for_js($attachment_id);
                        }
                    }
                } elseif ('repeat' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['repeat'];
                } elseif ('size' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['size'];
                } elseif ('position' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['position'];
                } elseif ('attach' === $setting_key) {
                    $this->json[$setting_key]['choices'] = $background_choices['attach'];
                }
            }
        }

        /**
         * Render a JS template for the content of the media control.
         *
         * @since 1.0.6
         */
        public function content_template() {
            parent::content_template();
            ?>
            <div class="background-image-fields">
                <# if ( data.attachment && data.repeat && data.repeat.choices ) { #>
                <li class="background-image-repeat">
                    <# if ( data.repeat.label ) { #>
                    <span class="customize-control-title">{{ data.repeat.label }}</span>
                    <# } #>
                    <select {{{ data.repeat.link }}}>
                        <# _.each( data.repeat.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.repeat.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.size && data.size.choices ) { #>
                <li class="background-image-size">
                    <# if ( data.size.label ) { #>
                    <span class="customize-control-title">{{ data.size.label }}</span>
                    <# } #>
                    <select {{{ data.size.link }}}>
                        <# _.each( data.size.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.size.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.position && data.position.choices ) { #>
                <li class="background-image-position">
                    <# if ( data.position.label ) { #>
                    <span class="customize-control-title">{{ data.position.label }}</span>
                    <# } #>
                    <select {{{ data.position.link }}}>
                        <# _.each( data.position.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.position.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
                <# if ( data.attachment && data.attach && data.attach.choices ) { #>
                <li class="background-image-attach">
                    <# if ( data.attach.label ) { #>
                    <span class="customize-control-title">{{ data.attach.label }}</span>
                    <# } #>
                    <select {{{ data.attach.link }}}>
                        <# _.each( data.attach.choices, function( label, choice ) { #>
                        <option value="{{ choice }}" <# if ( choice === data.attach.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
                <# } #>
            </div>
            <?php
        }

        /**
         * Returns button labels.
         *
         * @since 1.0.6
         */
        public static function cleaninglight_themes_button_labels() {
            $button_labels = array(
                'select' => esc_html__('Select Image', 'cleaning-light'),
                'change' => esc_html__('Change Image', 'cleaning-light'),
                'remove' => esc_html__('Remove', 'cleaning-light'),
                'default' => esc_html__('Default', 'cleaning-light'),
                'placeholder' => esc_html__('No image selected', 'cleaning-light'),
                'frame_title' => esc_html__('Select Image', 'cleaning-light'),
                'frame_button' => esc_html__('Choose Image', 'cleaning-light'),
            );
            return $button_labels;
        }
        /**
         * Returns field labels.
         *
         * @since 1.0.6
         */
        public static function cleaninglight_themes_field_labels() {
            $field_labels = array(
                'repeat' => esc_html__('Repeat', 'cleaning-light'),
                'size' => esc_html__('Size', 'cleaning-light'),
                'position' => esc_html__('Position', 'cleaning-light'),
                'attach' => esc_html__('Attachment', 'cleaning-light')
            );
            return $field_labels;
        }
        
        /**
         * Returns the background choices.
         *
         * @since 1.0.6
         * @return array
         */
        public static function cleaninglight_themes_background_choices() {
            $choices = array(
                'repeat' => array(
                    'no-repeat' => esc_html__('No Repeat', 'cleaning-light'),
                    'repeat' => esc_html__('Tile', 'cleaning-light'),
                    'repeat-x' => esc_html__('Tile Horizontally', 'cleaning-light'),
                    'repeat-y' => esc_html__('Tile Vertically', 'cleaning-light')
                ),
                'size' => array(
                    'auto' => esc_html__('Default', 'cleaning-light'),
                    'cover' => esc_html__('Cover', 'cleaning-light'),
                    'contain' => esc_html__('Contain', 'cleaning-light')
                ),
                'position' => array(
                    'left top' => esc_html__('Left Top', 'cleaning-light'),
                    'left center' => esc_html__('Left Center', 'cleaning-light'),
                    'left bottom' => esc_html__('Left Bottom', 'cleaning-light'),
                    'right top' => esc_html__('Right Top', 'cleaning-light'),
                    'right center' => esc_html__('Right Center', 'cleaning-light'),
                    'right bottom' => esc_html__('Right Bottom', 'cleaning-light'),
                    'center top' => esc_html__('Center Top', 'cleaning-light'),
                    'center center' => esc_html__('Center Center', 'cleaning-light'),
                    'center bottom' => esc_html__('Center Bottom', 'cleaning-light')
                ),
                'attach' => array(
                    'fixed' => esc_html__('Fixed', 'cleaning-light'),
                    'scroll' => esc_html__('Scroll', 'cleaning-light')
                )
            );
            return $choices;
        }
    }

    /**
	 * Group Control
	*/
	class Cleaninglight_Themes_Custom_Control_Group extends WP_Customize_Control {
		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'group';

		public $label = '';

		/**
		 * The fields that each container row will contain.
		 *
		 * @access public
		 * @var array
		 */
		public $fields = array();

		/**
		 * Repeater drag and drop controler
		 *
		 * @since  1.0.6
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array() ) {
			$this->fields = $fields;
			$this->label  = $args['label'];
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * enqueue css and scrpts
		 *
		 * @since  1.2.8
		 */
		public function enqueue() {
            wp_enqueue_script('cleaninglight-group-control', get_template_directory_uri().'/inc/customizer/js/group.js', array( 'jquery', 'customize-controls' ), CLEANINGLIGHT_VERSION, true);
		}

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @see WP_Customize_Control::render()
		 */
		protected function render() {

			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control has-switchers customize-control-' . $this->type; ?>

            <li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
			    <?php $this->render_content(); ?>
			</li>

			<?php
		}
		public function render_content() {

			if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {

				$values = json_encode( $this->value() );

			} else {

				$values = $this->value();
			}
			?>
                <ul class="group-field-control-wrap">
                    <?php $this->get_fields(); ?>
                </ul>

                <input type="hidden" <?php $this->link(); ?> class="cleaninglight-group-collection" value="<?php echo esc_attr( $values ); ?>"/>
		    
            <?php
		}
		private function get_fields() {

			$fields = $this->fields;

			if ( is_array( $this->value() ) && ! empty( $this->value() ) ) {
				$values = $this->value();

			} else {

				$values = json_decode( $this->value(), true );
			}

		?>
			<li class="group-field-control">
				<h3 class="accordion-section-title">
					<?php echo "<span class='group-field-title'>" . esc_html( $this->label ) . '</span>'; ?>
				</h3>

				<?php if ( $this->description ) { ?>
					<span class="description customize-control-description">
						<?php echo wp_kses_post( $this->description ); ?>
					</span>
				<?php } ?>

				<div class="group-fields hidden">
					<?php
					foreach ( $fields as $key => $field ) {
                        
						$class = isset( $field['class'] ) ? $field['class'] : '';
					?>
						<div class="single-field type-<?php echo esc_attr( $field['type'] ) . ' ' . $class; ?>">
							<?php
                                $label = isset( $field['label'] ) ? $field['label'] : '';
                                $description = isset( $field['description'] ) ? $field['description'] : '';
                                
                                if ( $field['type'] != 'checkbox' ) {
                                    ?>
                                    <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                    <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                                    <?php
                                }

                                $new_value = isset( $values[ $key ] ) ? $values[ $key ] : '';

                                $default   = isset( $field['default'] ) ? $field['default'] : '';

                                switch ( $field['type'] ) {
                                    case 'color':
                                        echo '<div class="customize-control-alpha-color" data-color-single-name="' . esc_attr( $key ) . '"><input class="cleaninglight-alpha-picker" data-alpha-enabled="true" data-default-color="' . esc_attr( $default ) . '" data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/></div>';
                                        break;
                                    case 'text':
                                        echo '<input data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
                                        break;
                                    case 'number':
                                        echo '<input data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="number" value="' . esc_attr( $new_value ) . '"/>';
                                        break;
                                    case 'url':
                                        echo '<input data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="url" value="' . esc_url( $new_value ) . '"/>';
                                        break;
                                    case 'checkbox':
                                        echo "<span class='customize-control-checkbox-wrap'>";
                                        ?>
                                            <label for="<?php echo  esc_attr( $this->id . $key ); ?>" class="customize-control-title checkbox"><?php echo esc_html( $label ); ?>
                                                <?php echo '<input id="' . esc_attr( $this->id . $key ) . '" ' . checked( true, $new_value, false ) . ' data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="checkbox" value="' . esc_attr( $new_value ) . '"/>'; ?>
                                            </label>
                                        </span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
                                        <?php
                                        break;
                                    case 'textarea':
                                        echo '<textarea data-default="' . esc_attr( $default ) . '"  data-single-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
                                        break;
                                    case 'select':
                                        $options = $field['options'];
                                        echo '<select  class="group-control-select" data-value="' . esc_attr( $new_value ) . '" data-default="' . esc_attr( $default ) . '"  data-single-name="' . esc_attr( $key ) . '">';
                                        if ( ! empty( $options ) ) {
                                            foreach ( $options as $option => $val ) {
                                                printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_html( $val ) );
                                            }
                                        }
                                        echo '</select>';
                                        break;
                                    case 'icons':
                                        ?>
                                        <span class="customize-icons">
                                            <?php
                                                cleaninglight_icon_holder( $new_value );
                                                echo '<input class="cleaninglight-icon-value"  data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="hidden" value="' . esc_attr( $new_value ) . '"/>';
                                            ?>
                                        </span>
                                        <?php
                                        break;
                                    case 'cssbox':
                                        $this->css_box( $new_value, $key, $field );
                                        break;
                                    case 'image':
                                        $cleaninglight_display_none = '';
                                        if ( empty( $new_value ) ) {
                                            $cleaninglight_display_none = ' style="display:none;" ';
                                        }
                                        echo '<input data-default="' . esc_attr( $default ) . '" data-single-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '" class="hidden image-value-url"/>';
                                        ?>
                                        <span class="img-preview-wrap" <?php echo  $cleaninglight_display_none; ?>>
                                            <img class="widefat" src="<?php echo esc_url( $new_value ); ?>" alt="<?php esc_attr_e( 'Image preview', 'cleaning-light' ); ?>"  />
                                        </span><!-- .img-preview-wrap -->
                                        <input type="button" value="<?php esc_attr_e( 'Upload Image', 'cleaning-light' ); ?>" class="button cleaninglight-image-upload" data-title="<?php esc_attr_e( 'Select Image', 'cleaning-light' ); ?>" data-button="<?php esc_attr_e( 'Select Image', 'cleaning-light' ); ?>"/>
                                        <input type="button" value="<?php esc_attr_e( 'Remove Image', 'cleaning-light' ); ?>" class="button cleaninglight-image-remove" />
                                        <?php
                                        break;
                                    default:
                                        break;
                                }
							?>
						</div>
					<?php } ?>

					<div class="clearfix group-footer">
						<a class="group-field-close" href="#close">
							<?php esc_html_e( 'Close', 'cleaning-light' ); ?>
						</a>
					</div>
				</div>
			</li>
		<?php }

		public function css_box( $values, $key, $cssbox_fields ) {

			$box_fields = isset( $cssbox_fields['box_fields'] ) ? $cssbox_fields['box_fields'] : array();
			
            $attr       = isset( $cssbox_fields['attr'] ) ? $cssbox_fields['attr'] : array();
			
            $devices    = array(
				'desktop' => array(
					'icon' => 'dashicons-laptop',
				),
				'tablet'  => array(
					'icon' => 'dashicons-tablet',
				),
				'mobile'  => array(
					'icon' => 'dashicons-smartphone ',
				),
			);

			$default_fields  = array(
				'top'    => true,
				'right'  => true,
				'bottom' => true,
				'left'   => true,
			);
			$box_fields_attr = ! empty( $box_fields ) ? $box_fields : $default_fields;
			$min         = isset( $attr['min'] ) ? $attr['min'] : 0;
			$max         = isset( $attr['max'] ) ? $attr['max'] : 1000;
			$step        = isset( $attr['step'] ) ? $attr['step'] : 1;
			$link        = isset( $attr['link'] ) ? $attr['link'] : 1;
			$link_toggle = isset( $attr['link_toggle'] ) ? $attr['link_toggle'] : true;
			$devices     = isset( $attr['devices'] ) ? $attr['devices'] : $devices;
			$link_text   = isset( $attr['link_text'] ) ? $attr['link_text'] : esc_html__( 'Link', 'cleaning-light' );
			
            if ( count( $devices ) > 1 ) { ?>
				<ul class="responsive-switchers">
					<?php
					$i = 1;
					foreach ( $devices as $device_id => $device_details ) {
						if ( $i == 1 ) {
							$active = ' active';
						} else {
							$active = '';
						}
					?>
						<li class="<?php echo esc_attr( $device_id ); ?>">
							<button type="button" class="preview-<?php echo esc_attr( $device_id ) . ' ' . $active; ?>" data-device="<?php echo esc_attr( $device_id ); ?>">
								<i class="dashicons <?php echo esc_attr( $device_details['icon'] ); ?>"></i>
							</button>
						</li>
					<?php $i ++; } ?>
				</ul>

			<?php } ?>
			    
            <div class="responsive-switchers-cssboxfields" data-responsive-name="<?php echo esc_attr( $key ); ?>">
                <?php
                    $i = 1;
                    foreach ( $devices as $device_id => $device_details ) {
                        if ( $i == 1 ) {
                            $active = ' active';
                        } else {
                            $active = '';
                        }
                        echo '<ul class="groupcssbox-device-wrap control-wrap ' . $device_id . ' ' . $active . '">';
                        foreach ( $box_fields_attr as $field_id => $box_single_field ) {
                            $value   = isset( $values[ $device_id ][ $field_id ] ) ? $values[ $device_id ][ $field_id ] : '';
                            $default = isset( $box_single_field[ $device_id ][ $field_id ] ) ? $box_single_field[ $device_id ][ $field_id ] : '';
                            if ( ! $value ) {
                                if ( isset( $box_single_field['default'] ) ) {
                                    $value = $box_single_field['default'];
                                }
                            }
                            echo '<li>';
                        ?>
                            <label>
                                <span>
                                    <?php echo ucfirst( esc_attr( $field_id ) ); ?>
                                </span>
                                <input data-device="<?php echo esc_attr( $device_id ); ?>" data-cssbox-name="<?php echo esc_attr( $field_id ); ?>" data-default="<?php echo esc_attr( $default ); ?>" min="<?php echo esc_attr( $min ); ?>" max="<?php echo esc_attr( $max ); ?>" step="<?php echo esc_attr( $step ); ?>" type="number" class="groupcssbox-field" value="<?php echo esc_attr( $value ); ?>">
                            </label>
                            <?php
                        echo '</li>'; 
                    
                        }
                        if ( $link ) {
                            $cssbox_link       = isset( $values[ $device_id ]['cssbox_link'] ) ? $values[ $device_id ]['cssbox_link'] : '';
                            $link_toggle_class = $link_toggle ? 'groupcssbox_link' : '';
                        ?>
                            <li>
                                <label>
                                    <span title="<?php echo esc_attr( $link_text ); ?>"><?php echo esc_html( $link_text ); ?></span>
                                    <span class="field-link">
                                        <input data-device="<?php echo esc_attr( $device_id ); ?>" data-cssbox-name="cssbox_link" data-default="<?php echo esc_attr( $default ); ?>"  type="checkbox" class="groupcssbox-field <?php echo $link_toggle_class; ?>" value="<?php echo esc_attr( $value ); ?>" <?php checked( true, $cssbox_link, true ); ?>>
                                        <span class="tgl-btn"></span>
                                    </span>
                                </label>
                            </li>
                        <?php
                        }
                        echo '</ul>';
                        $i ++;
                    }
                ?>
			</div>
			<?php
		}
	}

    /**
     * Repeater Custom Control Function
    */
    class Cleaninglight_Themes_Repeater_Control  extends WP_Customize_Control {
        /**
         * The control type.
         *
         * @access public
         * @var string
         */
        public $type = 'repeater';
        public $box_label = '';
        public $add_label = '';
        public $limit = '';
        private $cats = '';

        /**
         * The fields that each container row will contain.
         *
         * @access public
         * @var array
         */
        public $fields = array();

        /**
		 * enqueue css and scrpts
		 *
		 * @since  1.2.8
		 */
		public function enqueue() {
            
            wp_enqueue_script('cleaninglight-repeater-control', get_template_directory_uri().'/inc/customizer/js/repeater.js', array( 'jquery', 'customize-controls' ), CLEANINGLIGHT_VERSION, true);
            
            // Localize the script with new data
            $translation_array = array(
                'url_to_icon' => esc_url(get_template_directory_uri()) . '/assets/images/icons/',
            );
            wp_localize_script('cleaninglight-repeater-control', 'cleaninglight_script', $translation_array);
		}
        
        /**
         * Repeater drag and drop controller
         *
         * @since  1.0.6
         */
        public function __construct($manager, $id, $args = array(), $fields = array()) {

            $this->fields = $fields;

            $this->box_label = $args['box_label'];

            $this->add_label = $args['add_label'];

            if( isset($args['limit'])){
                $this->limit = $args['limit'];
            }

            if( isset($args['sortable'])){
                $this->sortable = $args['sortable'];
            }

            $this->cats = get_categories(array('hide_empty' => false));

            parent::__construct($manager, $id, $args);
        }

        public function render_content() {

            $values = json_decode($this->value());

            $array_lenght = 0;

            if(is_array( $values ) ){
                $array_lenght = count($values);
            }
            ?>
            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>

            <ul class="cleaninglight-repeater-field-control-wrap <?php if( !empty( $this->sortable ) && $this->sortable == 'enable' ){ echo esc_attr( 'cleaninglight-fields-sortable-disable' ); }else{ echo esc_attr( 'cleaninglight-fields-sortable' ); } ?>">
                <?php $this->get_fields(); ?>
            </ul>

            <input type="hidden" <?php esc_attr($this->link()); ?> class="cleaninglight-repeater-collector" value="<?php echo esc_attr($this->value()); ?>" />
            <button type="button" class="button cleaninglight-add-control-field <?php if( $this->limit == $array_lenght) echo esc_attr('hidden'); ?>"><?php echo esc_html($this->add_label); ?></button>
            
            <?php if( $this->limit ): ?>
                <div class="moreitems"><?php echo esc_html('Need More Than','cleaning-light'); ?> <span class="upper-limit"><?php echo intval($this->limit); ?> <?php echo esc_html('Items','cleaning-light'); ?></span> <a href="<?php echo apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') );?>" target="_blank"> <strong><?php echo esc_html__('UPGRADE TO PRO', 'cleaning-light'); ?></strong></a></div>
                <input type="hidden" class="cleaninglight-repeater-count-limit" value="<?php echo esc_attr($this->limit); ?>" />
            <?php endif; ?>

            <?php
        }

        private function get_fields() {

            $fields = $this->fields;
            
            $values = json_decode($this->value());

            if (is_array($values)) {

                foreach ($values as $value) { ?>
                    <li class="cleaninglight-repeater-field-control">
                        <h3 class="cleaninglight-repeater-field-title"><?php echo esc_html($this->box_label); ?></h3>
                        <div class="cleaninglight-repeater-fields">
                            <?php
                            foreach ($fields as $key => $field) {
                                $class = isset($field['class']) ? $field['class'] : '';
                            ?>
                                <div class="cleaninglight-fields cleaninglight-type-<?php echo esc_attr($field['type']) . ' ' . esc_attr($class); ?>">
                                    <?php
                                        $label = isset($field['label']) ? $field['label'] : '';
                                        $description = isset($field['description']) ? $field['description'] : '';
                                        if ( !in_array( $field['type'], array('checkbox', 'wrapper-start', 'wrapper-end')) ) {
                                    ?>
                                        <?php if( !empty( $label ) ){ ?>
                                            <span class="customize-control-repeater-title">
                                                <?php echo esc_html($label); ?>
                                            </span>
                                        <?php } ?>

                                        <?php if( !empty( $description ) ){ ?>
                                            <span class="description customize-control-description">
                                                <?php echo esc_html($description); ?>
                                            </span>
                                        <?php } ?>
                                    <?php }

                                    $new_value = isset($value->$key) ? $value->$key : '';

                                    $default = isset($field['default']) ? $field['default'] : '';

                                    switch ($field['type']) {
                                        case 'wrapper-start':
                                            echo '<div class="wrapper-start">';
                                                echo '<span class="customize-control-repeater-title">'. esc_html($label). '</span>';
                                            break;
                                        case 'wrapper-end':
                                            echo '
                                            </div>';
                                            break;
                                        case 'url':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="url" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'text':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'number':
                                            echo '<input data-default="' . esc_attr($default) . '" data-name="' . esc_attr($key) . '" type="number" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'textarea':
                                            echo '<textarea data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">' . esc_textarea($new_value) . '</textarea>';
                                            break;
                                        case 'upload':
                                            $image = $image_class = "";
                                            if ($new_value) {
                                                $image = '<img src="' . esc_url($new_value) . '" style="max-width:100%;"/>';
                                                $image_class = ' hidden';
                                            }
                                            echo '<div class="cleaninglight-fields-wrap">';
                                            echo '<div class="attachment-media-view">';
                                            echo '<div class="placeholder' . esc_attr($image_class) . '">';
                                                esc_html_e('No image selected', 'cleaning-light');
                                            echo '</div>';
                                            echo '<div class="thumbnail thumbnail-image">';
                                            echo $image;
                                            echo '</div>';
                                            echo '<div class="actions clearfix">';
                                            echo '<button type="button" class="button cleaninglight-delete-button align-left">' . esc_html__('Remove', 'cleaning-light') . '</button>';
                                            echo '<button type="button" class="button cleaninglight-upload-button alignright">' . esc_html__('Select Image', 'cleaning-light') . '</button>';
                                            echo '<input data-default="' . esc_attr($default) . '" class="upload-id" data-name="' . esc_attr($key) . '" type="hidden" value="' . esc_attr($new_value) . '"/>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            break;
                                        case 'category':
                                            echo '<select data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            echo '<option value="0">' . esc_html__('Select Category', 'cleaning-light') . '</option>';
                                            echo '<option value="-1">' . esc_html__('Latest Posts', 'cleaning-light') . '</option>';
                                            foreach ($this->cats as $cat) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($new_value, $cat->term_id, false), esc_html($cat->name));
                                            }
                                            echo '</select>';
                                            break;
                                        case 'select':
                                            $options = $field['options'];
                                            echo '<select  data-default="' . esc_attr($default) . '"  data-name="' . esc_attr($key) . '">';
                                            foreach ($options as $option => $val) {
                                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($option), selected($new_value, $option, false), esc_html($val));
                                            }
                                            echo '</select>';
                                            break;
                                        case 'checkbox':
                                            echo '<label>';
                                            echo '<input data-default="' . esc_attr($default) . '" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '" type="checkbox" ' . checked($new_value, 'yes', false) . '/>';
                                            echo esc_html($label);
                                            echo '<span class="description customize-control-description">' . esc_html($description) . '</span>';
                                            echo '</label>';
                                            break;
                                        case 'colorpicker':
                                            echo '<input data-default="' . esc_attr($default) . '" class="cleaninglight-color-picker color-picker" data-alpha-enabled="true" data-name="' . esc_attr($key) . '" type="text" value="' . esc_attr($new_value) . '"/>';
                                            break;
                                        case 'selector':
                                            $options = $field['options'];
                                            echo '<div class="selector-labels">';
                                            foreach ($options as $option => $val) {
                                                $class = ( $new_value == $option ) ? 'selector-selected' : '';
                                                echo '<label class="' . $class . '" data-val="' . esc_attr($option) . '">';
                                                echo '<img src="' . esc_url($val) . '"/>';
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'radio':
                                            $options = $field['options'];
                                            echo '<div class="radio-labels">';
                                            foreach ($options as $option => $val) {
                                                echo '<label>';
                                                echo '<input value="' . esc_attr($option) . '" type="radio" ' . checked($new_value, $option, false) . '/>';
                                                echo esc_html($val);
                                                echo '</label>';
                                            }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'switch':
                                            $switch = $field['switch'];
                                            $switch_class = ($new_value == 'enable' || $new_value == 'on') ? 'switch-on' : '';
                                            echo '<div class="onoffswitch ' . esc_attr($switch_class) . '">';
                                            echo '<div class="onoffswitch-inner">';
                                            echo '<div class="onoffswitch-active">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["enable"]) . '</div>';
                                            echo '</div>';
                                            echo '<div class="onoffswitch-inactive">';
                                            echo '<div class="onoffswitch-switch">' . esc_html($switch["disable"]) . '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'range':
                                            $options = $field['options'];
                                            $new_value = $new_value ? $new_value : $options['val'];
                                            echo '<div class="cleaninglight-range-slider" >';
                                            echo '<div class="range-input" data-defaulvalue="' . esc_attr($options['val']) . '" data-value="' . esc_attr($new_value) . '" data-min="' . esc_attr($options['min']) . '" data-max="' . esc_attr($options['max']) . '" data-step="' . esc_attr($options['step']) . '"></div>';
                                            echo '<input  class="range-input-selector" type="text" disabled="disabled" value="' . esc_attr($new_value) . '"  data-name="' . esc_attr($key) . '"/>';
                                            echo '<span class="unit">' . esc_html($options['unit']) . '</span>';
                                            echo '</div>';
                                            break;
                                        case 'icon':
                                            echo '<div class="cleaninglight-customizer-icon-box">';
                                            echo '<div class="cleaninglight-selected-icon">';
                                            echo '<i class="' . esc_attr($new_value) . '"></i>';
                                            echo '<span><i class="dashicons dashicons-arrow-down-alt2"></i></span>';
                                            echo '</div>';
                                            echo '<div class="cleaninglight-icon-box">';
                                                echo '<div class="cleaninglight-icon-search">';
                                                    echo '<select>';
                                                    if (apply_filters('cleaninglight_show_font_awesome', true)) {
                                                        echo '<option value="fontawesome-list">' . esc_html__('Font Awesome', 'cleaning-light') . '</option>';
                                                    }
                                                    if (apply_filters('cleaninglight_show_ico_font', true)) {
                                                        echo '<option value="icofont-list">' . esc_html__('IcoFont', 'cleaning-light') . '</option>';
                                                    }
                                                    echo '</select>';
                                                    echo '<input type="text" class="cleaninglight-icon-search-input" placeholder="' . esc_attr__('Type to filter', 'cleaning-light') . '" />';
                                                echo '</div>';

                                                if (apply_filters('cleaninglight_show_font_awesome', true)) {
                                                    echo '<ul class="cleaninglight-icon-list fontawesome-list active clearfix">';
                                                    $cleaninglight_font_awesome_icon_array = cleaninglight_font_awesome_icon_array();
                                                    foreach ($cleaninglight_font_awesome_icon_array as $cleaninglight_font_awesome_icon) {
                                                        $icon_class = $new_value == $cleaninglight_font_awesome_icon ? 'icon-active' : '';
                                                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($cleaninglight_font_awesome_icon) . '"></i></li>';
                                                    }
                                                    echo '</ul>';
                                                }

                                                if (apply_filters('cleaninglight_show_ico_font', true)) {
                                                    echo '<ul class="cleaninglight-icon-list icofont-list clearfix">';
                                                    $cleaninglight_icofont_icon_array = cleaninglight_icofont_icon_array();
                                                    foreach ($cleaninglight_icofont_icon_array as $cleaninglight_icofont_icon) {
                                                        $icon_class = $new_value == $cleaninglight_icofont_icon ? 'icon-active' : '';
                                                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($cleaninglight_icofont_icon) . '"></i></li>';
                                                    }
                                                    echo '</ul>';
                                                }
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            echo '</div>';
                                            break;
                                        case 'social-icon':
                                            echo '<div class="cleaninglight-customizer-icon-box">';
                                            echo '<div class="cleaninglight-selected-icon">';
                                            echo '<i class="'.esc_attr($new_value).'"></i>';
                                            echo '<span><i class="dashicons dashicons-arrow-down-alt2"></i></span>';
                                            echo '</div>';
                                            echo '<div class="cleaninglight-icon-box">';
                                            
                                                echo '<ul class="cleaninglight-icon-list fontawesome-list active clearfix">';
                                                $font_awesome_icon_array = cleaninglight_font_awesome_social_icon_array();
                                                foreach ($font_awesome_icon_array as $font_awesome_icon) {
                                                    $icon_class = $new_value == $font_awesome_icon ? 'icon-active' : '';
                                                    echo '<li class='.esc_attr( $icon_class ).'><i class="'.esc_attr( $font_awesome_icon ).'"></i></li>';
                                                }
                                                echo '</ul>';
                                            echo '</div>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr($new_value) . '" data-name="' . esc_attr($key) . '"/>';
                                            echo '</div>';
                                            break;
                                        case 'multicategory':
                                            $new_value_array = !is_array($new_value) ? explode(',', $new_value) : $new_value;
                                            echo '<ul class="cleaninglight-multi-category-list">';
                                            echo '<li><label><input type="checkbox" value="-1" ' . checked('-1', $new_value, false) . '/>' . esc_html__('Latest Posts', 'cleaning-light') . '</label></li>';
                                            foreach ($this->cats as $cat) {
                                                $checked = in_array($cat->term_id, $new_value_array) ? 'checked="checked"' : '';
                                                echo '<li>';
                                                echo '<label>';
                                                echo '<input type="checkbox" value="' . esc_attr($cat->term_id) . '" ' . $checked . '/>';
                                                echo esc_html($cat->name);
                                                echo '</label>';
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                            echo '<input data-default="' . esc_attr($default) . '" type="hidden" value="' . esc_attr(implode(',', $new_value_array)) . '" data-name="' . esc_attr($key) . '"/>';
                                            break;
                                        case 'gallery':?>
                                            <div class="cleaninglight-gallery-screenshot">
                                                <?php
                                                    {
                                                    $ids = explode( ',', $new_value );
                                                        foreach ( $ids as $attachment_id ) {
                                                            $img = wp_get_attachment_image_src( $attachment_id, 'thumbnail' );
                                                            if(!$img) continue;
                                                            echo '<div class="screen-thumb"><img src="' . esc_url( $img[0] ) . '" /></div>';
                                                        }
                                                    }
                                                ?>
                                            </div>
                                            <input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Add/Edit Gallery','cleaning-light') ?>" />
                                            <input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Clear','cleaning-light') ?>" />
                                            <?php echo '<input data-default="'.esc_attr($default).'" type="hidden" value="'.esc_attr($new_value).'" data-name="'.esc_attr($key).'"/>';
                                            break;
                                        default:
                                            break;
                                    }
                                    ?>
                                </div>
                            <?php } ?>

                            <div class="clearfix cleaninglight-repeater-footer">
                                <div class="alignright">
                                    <a class="cleaninglight-repeater-field-remove" href="#remove"><?php esc_html_e('Delete', 'cleaning-light') ?></a> |
                                    <a class="cleaninglight-repeater-field-close" href="#close"><?php esc_html_e('Close', 'cleaning-light') ?></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
        }
    }

    class Cleaninglight_Themes_Upgrade_Text extends WP_Customize_Control {

        public $type = 'cleaninglight-upgrade-text';

        public function render_content() { ?>
            <label>
                <span class="dashicons dashicons-info"></span>
                <?php if ($this->label) { ?>
                    <span>
                        <?php echo wp_kses_post($this->label); ?>
                    </span>
                <?php } ?>
                <a href="<?php echo apply_filters('cleaninglight-link', esc_url('https://ikreatethemes.com/wordpress-theme/cleaning-wordpress-theme/') ); ?>" target="_blank"> <strong><?php echo esc_html__('UPGRADE TO PRO', 'cleaning-light'); ?></strong></a>
            </label>
            <?php if ($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
            $choices = $this->choices;
            if ($choices) {
                echo '<ul>';
                    foreach ($choices as $choice) {
                        echo '<li>' . esc_html($choice) . '</li>';
                    }
                echo '</ul>';
            }
        }
    }

    class Cleaninglight_Themes_Upgrade_Section extends WP_Customize_Section {

        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $type = 'cleaninglight-upgrade-section';
        public $class = '';

        /**
         * Custom button text to output.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $upgrade_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $upgrade_url = '';
        public $options = array();

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.6
         * @access public
         * @return void
         */
        public function json() {

            $json = parent::json();
            $json['upgrade_text'] = $this->upgrade_text;
            $json['upgrade_url'] = $this->upgrade_url;
            $json['options'] = $this->options;
            $json['class'] = $this->class;

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.6
         * @access public
         * @return void
         */
        protected function render_template() {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand {{data.class}}">
                <# if ( _.isEmpty(data.options) ) { #>
                    <h3 class="accordion-section-title">
                        <# if ( data.title ) { #>
                            {{{ data.title }}}
                        <# } #>
                        <# if ( data.upgrade_text && data.upgrade_url ) { #>
                            <a href="{{ data.upgrade_url }}" class="button button-primary" target="_blank">{{ data.upgrade_text }}</a>
                        <# } #>
                    </h3>
                <# }else{ #>
                    <label>
                        <# if ( data.title ) { #>
                            {{ data.title }}
                        <# } #>
                    </label>

                    <# _.each( data.options, function(key, value) { #>
                        {{{ key }}}<br/>
                    <# }) #>

                    <# if ( data.upgrade_text && data.upgrade_url ) { #>
                        <a href="{{ data.upgrade_url }}" class="button button-primary" target="_blank">{{ data.upgrade_text }}</a>
                    <# } #>
                <# } #>
            </li>
            <?php
        }
    }

    class Cleaninglight_Themes_Customize_Section extends WP_Customize_Section {
        /**
         * The type of customize section being rendered.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $type = 'cleaninglight';

        /**
         * Custom button text to output.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $pro_text = '';

        /**
         * Custom pro button URL.
         *
         * @since  1.0.6
         * @access public
         * @var    string
         */
        public $pro_url = '';

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.6
         * @access public
         * @return void
         */
        public function json() {

            $json = parent::json();

            $json['pro_text'] = $this->pro_text;
            $json['pro_url']  = esc_url( $this->pro_url );

            return $json;
        }

        /**
         * Outputs the Underscore.js template.
         *
         * @since  1.0.6
         * @access public
         * @return void
         */
        protected function render_template() { ?>

            <li id="accordion-section-{{ data.id }}" class="accordion-section ikthemes-upgrade-premium control-section control-section-{{ data.type }} cannot-expand">
                <h3 class="accordion-section-title">
                    {{ data.title }}
                    <# if ( data.pro_text && data.pro_url ) { #>
                        <a href="{{ data.pro_url }}" class="button" target="_blank">{{ data.pro_text }}</a>
                    <# } #>
                </h3>
            </li>
        <?php }
    }
}