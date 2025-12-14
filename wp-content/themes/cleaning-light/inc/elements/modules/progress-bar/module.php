<?php

namespace CleaningLightElements\Modules\ProgressBar;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-progress-bar';
    }

    public function get_widgets() {
        $widgets = [
            'ProgressBar',
        ];
        return $widgets;
    }

}
