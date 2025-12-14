<?php

namespace CleaningLightElements\Modules\TestimonialSlider;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-testimonial-slider';
    }

    public function get_widgets() {
        $widgets = [
            'TestimonialSlider',
        ];
        return $widgets;
    }

}
