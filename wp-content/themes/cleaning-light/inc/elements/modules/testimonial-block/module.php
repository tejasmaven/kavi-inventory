<?php

namespace CleaningLightElements\Modules\TestimonialBlock;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-testimonial-block';
    }

    public function get_widgets() {
        $widgets = [
            'TestimonialBlock',
        ];
        return $widgets;
    }

}
