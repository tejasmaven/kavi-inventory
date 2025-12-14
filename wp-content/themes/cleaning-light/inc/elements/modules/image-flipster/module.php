<?php

namespace CleaningLightElements\Modules\ImageFlipster;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-image-flipster';
    }

    public function get_widgets() {
        $widgets = [
            'ImageFlipster',
        ];
        return $widgets;
    }

}
