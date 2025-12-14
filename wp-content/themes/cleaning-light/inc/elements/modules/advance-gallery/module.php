<?php

namespace CleaningLightElements\Modules\AdvanceGallery;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-advance-gallery';
    }

    public function get_widgets() {
        $widgets = [
            'AdvanceGallery',
        ];
        return $widgets;
    }

}
