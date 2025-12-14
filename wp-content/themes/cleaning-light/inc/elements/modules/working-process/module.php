<?php

namespace CleaningLightElements\Modules\WorkingProcess;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-working-process';
    }

    public function get_widgets() {
        $widgets = [
            'WorkingProcess',
        ];
        return $widgets;
    }

}
