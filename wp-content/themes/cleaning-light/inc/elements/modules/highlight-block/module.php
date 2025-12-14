<?php

namespace CleaningLightElements\Modules\HighlightBlock;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-highlight-block';
    }

    public function get_widgets() {
        $widgets = [
            'HighlightBlock',
        ];
        return $widgets;
    }

}
