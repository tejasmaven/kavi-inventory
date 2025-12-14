<?php

namespace CleaningLightElements\Modules\TeamCarousel;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-team-carousel';
    }

    public function get_widgets() {
        $widgets = [
            'TeamCarousel',
        ];
        return $widgets;
    }

}
