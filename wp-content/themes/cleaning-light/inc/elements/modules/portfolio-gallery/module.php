<?php

namespace CleaningLightElements\Modules\PortfolioGallery;

use CleaningLightElements\Base\Module_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'CleaningLight-portfolio-gallery';
    }

    public function get_widgets() {
        $widgets = [
            'PortfolioGallery',
        ];
        return $widgets;
    }

}
