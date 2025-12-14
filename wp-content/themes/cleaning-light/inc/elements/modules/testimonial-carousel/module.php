<?php

namespace CleaningLightElements\Modules\TestimonialCarousel;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-testimonial-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TestimonialCarousel',
        ];
        return $widgets;
    }

}
