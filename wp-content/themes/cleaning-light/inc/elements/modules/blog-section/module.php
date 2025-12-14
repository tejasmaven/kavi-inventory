<?php

namespace CleaningLightElements\Modules\BlogSection;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-blog-section';
    }

    public function get_widgets() {
        $widgets = [
            'BlogSection',
        ];
        return $widgets;
    }

}
