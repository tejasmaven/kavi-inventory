<?php

namespace CleaningLightElements\Modules\Heading;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        
        return 'CleaningLight-heading';
    }

    public function get_widgets() {
        $widgets = [
            'Heading',
        ];
        return $widgets;
    }

}
