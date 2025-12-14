<?php

namespace CleaningLightElements\Modules\ContactSection;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-contact-block';
    }

    public function get_widgets() {
        $widgets = [
            'ContactSection',
        ];
        return $widgets;
    }

}
