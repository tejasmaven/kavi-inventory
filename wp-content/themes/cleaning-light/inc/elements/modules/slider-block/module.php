<?php

namespace CleaningLightElements\Modules\SliderBlock;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-slider';
    }

    public function get_widgets() {
        $widgets = [
            'SliderBlock',
        ];
        return $widgets;
    }

}
