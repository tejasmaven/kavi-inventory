<?php

function cleaninglight_themes_dynamic_padding_value($padding) {
    $css = $tab_css = $mobile_css = '';

    $padding_desktop = cleaninglight_themes_cssbox_values_inline($padding, 'desktop');
    if (strpos($padding_desktop, 'px') !== false) {
        $css .= 'padding:' . rtrim($padding_desktop, ';') . ';';
    }

    $padding_tablet = cleaninglight_themes_cssbox_values_inline($padding, 'tablet');
    if (strpos($padding_tablet, 'px') !== false) {
        $tab_css .= 'padding:' . rtrim($padding_tablet, ';') . ';';
    }

    $padding_mobile = cleaninglight_themes_cssbox_values_inline($padding, 'mobile');
    if (strpos($padding_mobile, 'px') !== false) {
        $mobile_css .= 'padding:' . rtrim($padding_mobile, ';') . ';';
    }

    return ['desktop' => $css, 'tablet' => $tab_css, 'mobile' => $mobile_css];
}

function cleaninglight_themes_dynamic_margin_value($margin) {
    $css = $tab_css = $mobile_css = '';

    $margin_desktop = cleaninglight_themes_cssbox_values_inline($margin, 'desktop');
    if (strpos($margin_desktop, 'px') !== false) {
        $css .= 'margin:' . rtrim($margin_desktop, ';') . ';';
    }

    $margin_tablet = cleaninglight_themes_cssbox_values_inline($margin, 'tablet');
    if (strpos($margin_tablet, 'px') !== false) {
        $tab_css .= 'margin:' . rtrim($margin_tablet, ';') . ';';
    }

    $margin_mobile = cleaninglight_themes_cssbox_values_inline($margin, 'mobile');
    if (strpos($margin_mobile, 'px') !== false) {
        $mobile_css .= 'margin:' . rtrim($margin_mobile, ';') . ';';
    }

    return ['desktop' => $css, 'tablet' => $tab_css, 'mobile' => $mobile_css];
}

function cleaninglight_themes_dynamic_radius_value($radius) {
    $css = $tab_css = $mobile_css = '';

    $radius_desktop = cleaninglight_themes_cssbox_values_inline($radius, 'desktop');
    if (strpos($radius_desktop, 'px') !== false) {
        $css .= 'border-radius:' . rtrim($radius_desktop, ';') . ';';
    }

    $radius_tablet = cleaninglight_themes_cssbox_values_inline($radius, 'tablet');
    if (strpos($radius_tablet, 'px') !== false) {
        $tab_css .= 'border-radius:' . rtrim($radius_tablet, ';') . ';';
    }

    $radius_mobile = cleaninglight_themes_cssbox_values_inline($radius, 'mobile');
    if (strpos($radius_mobile, 'px') !== false) {
        $mobile_css .= 'border-radius:' . rtrim($radius_mobile, ';') . ';';
    }

    return ['desktop' => $css, 'tablet' => $tab_css, 'mobile' => $mobile_css];
}

function cleaninglight_themes_merge_arrays($array1, $array2) {
    return [
        'desktop' => $array1['desktop'] . $array2['desktop'],
        'tablet'  => $array1['tablet'] . $array2['tablet'],
        'mobile'  => $array1['mobile'] . $array2['mobile'],
    ];
}

function cleaninglight_themes_dynamic_css_return_val($wrapper, $desktop, $tablet, $mobile, $className) {
    $dynamicCss = $tabletCss = $mobileCss = '';

    if ($wrapper && is_array($wrapper)) {
        $dynamicCss = $wrapper['desktop'];
        $tabletCss  = $wrapper['tablet'];
        $mobileCss  = $wrapper['mobile'];
    }

    if ($desktop) {
        $dynamicCss .= "{$className} { {$desktop} }";
    }
    if ($tablet) {
        $tabletCss .= "{$className} { {$tablet} }";
    }
    if ($mobile) {
        $mobileCss .= "{$className} { {$mobile} }";
    }

    return [
        'desktop' => $dynamicCss,
        'tablet'  => $tabletCss,
        'mobile'  => $mobileCss,
    ];
}

function cleaninglight_themes_dynamic_header_social_links_css() {
    $css = $tab_css = $mobile_css = '';
    $social_color  = get_theme_mod('cleaninglight_social_icon_color');
    $social_icon_bg = get_theme_mod('cleaninglight_social_icon_bg_color');
    $hover_color = get_theme_mod('cleaninglight_social_icon_hover_color');
    $hover_bg = get_theme_mod('cleaninglight_social_icon_hover_bg_color');

    if ($social_color) {
        $css .= "color: {$social_color};";
    }

    if ($social_icon_bg) {
        $css .= "background-color: {$social_icon_bg};";
    }

    $css1 = cleaninglight_themes_dynamic_css_return_val('', $css, $tab_css, $mobile_css, '.top-bar-menu ul.cleaninglight-socialicon li a');

    if ($hover_color) {
        $css1['desktop'] .= ".top-bar-menu ul.cleaninglight-socialicon li a:hover { color: {$hover_color}; }";
    }
    if ($hover_bg) {
        $css1['desktop'] .= ".top-bar-menu ul.cleaninglight-socialicon li a:hover { background-color: {$hover_bg}; }";
    }

    return $css1;
}

function cleaninglight_themes_dynamic_slider_css() {
    $css = $tab_css = $mobile_css = '';

    $slider_height = get_theme_mod('cleaninglight_slider_height');
    if (!empty($slider_height)) {
        $css .= ".cleaninglight-slider-item-wrap { height: {$slider_height}px; }";
    }

    $bg_overlay = get_theme_mod('cleaninglight_banner_overlay_color');
    if (!empty($bg_overlay)) {
        $css .= ".cleaninglight-banner-bg-overlay { background-color: {$bg_overlay}; }";
    }

    $title_font_size = get_theme_mod('cleaninglight_caption_title_font_size');
    if (!empty($title_font_size)) {
        $css .= ".cleaninglight-banner-title { font-size: {$title_font_size}px; }";
    }

    $slider_caption_width = get_theme_mod('cleaninglight_caption_width');
    if (!empty($slider_caption_width)) {
        $css .= ".cleaninglight-banner-caption { max-width: {$slider_caption_width}%; }";
    }

    $slider_bottom_separator = get_theme_mod("cleaninglight_slider_section_seperator", 'no');
    $separator_color = get_theme_mod("cleaninglight_slider_bs_color");
    $separator_bs_height = get_theme_mod("cleaninglight_slider_bs_height", 120);
    $separator_bs_height_tablet = get_theme_mod("cleaninglight_slider_bs_height_tablet", 40);
    $separator_bs_height_mobile = get_theme_mod("cleaninglight_slider_bs_height_mobile", 20);

    if ($slider_bottom_separator === 'bottom') {
        if (!empty($separator_color)) {
            $css .= ".cleaninglight-banner-wrapper .section-seperator svg { fill: {$separator_color}; }";
        }
        if (!empty($separator_bs_height)) {
            $css .= ".cleaninglight-banner-wrapper .section-seperator { height: {$separator_bs_height}px; }";
        }
        if (!empty($separator_bs_height_tablet)) {
            $tab_css .= ".cleaninglight-banner-wrapper .section-seperator { height: {$separator_bs_height_tablet}px; }";
        }
        if (!empty($separator_bs_height_mobile)) {
            $mobile_css .= ".cleaninglight-banner-wrapper .section-seperator { height: {$separator_bs_height_mobile}px; }";
        }
    }

    return [
        'desktop' => $css,
        'tablet'  => $tab_css,
        'mobile'  => $mobile_css,
    ];
}

function cleaninglight_themes_promoservice_dynamic_css() {
    $css = $tab_css = $mobile_css = '';

    $padding = get_theme_mod('cleaninglight_promoservice_icon_style');
    $val = json_decode($padding, true);

    if (is_array($val) && isset($val['padding'])) {
        $padding_values = cleaninglight_themes_dynamic_padding_value($val['padding']);
        $css .= $padding_values['desktop'];
        $tab_css .= $padding_values['tablet'];
        $mobile_css .= $padding_values['mobile'];
    }

    if (is_array($val) && isset($val['radius'])) {
        $radius = cleaninglight_themes_dynamic_radius_value($val['radius']);
        $css .= $radius['desktop'];
        $tab_css .= $radius['tablet'];
        $mobile_css .= $radius['mobile'];
    }

    if (!empty($val['borderwidth'])) {
        $css .= "border: solid {$val['borderwidth']}px {$val['bordercolor']};";
    }

    $css1 = cleaninglight_themes_dynamic_css_return_val('', $css, $tab_css, $mobile_css, '.feature-service-content .feature-service-icon');

    $css = $tab_css = $mobile_css = '';
    if (!empty($val['iconsize'])) {
        $css .= "font-size: {$val['iconsize']}px;";
    }

    $css2 = cleaninglight_themes_dynamic_css_return_val('', $css, $tab_css, $mobile_css, '.feature-service-content .feature-service-icon i');

    return cleaninglight_themes_merge_arrays($css1, $css2);
}

if (!function_exists('cleaninglight_themes_patterns_block_color')) {
    function cleaninglight_themes_patterns_block_color() {
        $css = '';

        $theme_color = get_theme_mod('cleaninglight_primary_color');
        if ($theme_color) {
            $css .= ".is-style-primary-button.wp-block-read-more, 
                     .wp-block-button .wp-block-button__link, 
                     .wp-block-button.is-style-video .wp-block-button__link, 
                     .editor-styles-wrapper .is-style-video.wp-block-button .wp-block-button__link, 
                     .wp-block-button.is-style-secondary-button .wp-block-button__link:before, 
                     .editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link:before, 
                     .has-margin-top-plus, 
                     .has-primary-background-color, 
                     .is-style-secondary-button.wp-block-read-more:before { background-color: {$theme_color}; }
                     .wp-block-button.is-style-secondary-button .wp-block-button__link, 
                     .editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link, 
                     .is-style-secondary-button.wp-block-read-more { border-color: {$theme_color}; }
                     .wp-block-button.is-style-secondary-button .wp-block-button__link, 
                     .editor-styles-wrapper .is-style-secondary-button.wp-block-button .wp-block-button__link, 
                     .wp-block-button.is-style-no-border .wp-block-button__link:hover, 
                     .editor-styles-wrapper .is-style-no-border.wp-block-button .wp-block-button__link:hover, 
                     .is-style-no-border.wp-block-read-more:hover, 
                     .is-style-secondary-button.wp-block-read-more { color: {$theme_color}; }";
            }
            
        return [
            'desktop' => $css,
            'tablet'  => '',
            'mobile'  => '',
        ];
    }
}