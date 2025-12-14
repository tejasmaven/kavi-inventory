<?php

namespace CleaningLightElements\Modules\LogoCarousel;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-logo-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'LogoCarousel',
        ];
        return $widgets;
    }

}
