<?php

namespace CleaningLightElements\Modules\ServiceBlock;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-service-block';
    }

    public function get_widgets() {
        $widgets = [
            'ServiceBlock',
        ];
        return $widgets;
    }

}
