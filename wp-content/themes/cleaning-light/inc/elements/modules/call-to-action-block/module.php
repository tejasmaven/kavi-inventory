<?php

namespace CleaningLightElements\Modules\CallToActionBlock;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {

        return 'CleaningLight-call-to-action-block';
    }

    public function get_widgets() {
        $widgets = [
            'CallToActionBlock',
        ];
        return $widgets;
    }

}
