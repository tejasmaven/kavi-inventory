<?php
if ( ! function_exists( 'cleaninglight_themes_convert_hex_to_rgba' ) ) :
/**
 * Convert HEX color to RGB values
 *
 * @since Cleaning Light 1.0.6
 *
 * @param string $hex Hexadecimal color code (e.g., #ffffff or #fff)
 * @param bool $as_string Return as comma-separated string (default) or array
 * @return string|array RGB values as "r, g, b" string or array [r, g, b]
 */
function cleaninglight_themes_convert_hex_to_rgba( $hex, $as_string = true ) {
    // Remove any whitespace
    $hex = trim( $hex );
    
    // Validate input
    if ( ! is_string( $hex ) || empty( $hex ) ) {
        return $as_string ? '0, 0, 0' : array( 0, 0, 0 );
    }
    
    // Remove # if present
    $hex = ltrim( $hex, '#' );
    
    // Convert 3-character hex to 6-character
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    
    // Validate hex format (must be exactly 6 characters after processing)
    if ( strlen( $hex ) !== 6 || ! ctype_xdigit( $hex ) ) {
        return $as_string ? '0, 0, 0' : array( 0, 0, 0 );
    }
    
    // Convert hex to RGB
    $hex = strtolower( $hex );
    list( $r, $g, $b ) = sscanf( $hex, "%02x%02x%02x" );
    
    // Ensure valid RGB values
    $r = max( 0, min( 255, $r ) );
    $g = max( 0, min( 255, $g ) );
    $b = max( 0, min( 255, $b ) );
    
    // Return as requested format
    if ( $as_string ) {
        return sprintf( '%d, %d, %d', $r, $g, $b );
    } else {
        return array( $r, $g, $b );
    }
}
endif;



if (! function_exists('cleaninglight_themes_dynamic_css')){
    
	function cleaninglight_themes_dynamic_css(){

        // Initialize dynamic CSS variables
        $cleaninglight_dynamic = '';
        $cleaninglight_dynamic_tablet_style = '';
        $cleaninglight_dynamic_mobile_style = '';

        // Prepare CSS variables for :root
        $root = [];

        $primary_color = get_theme_mod('cleaninglight_primary_color');
        if ($primary_color) {
            $rgb = cleaninglight_themes_convert_hex_to_rgba($primary_color);
            $root[] = "--theme-color: {$primary_color}";
            $root[] = "--link-hover-color: {$primary_color}";
            $root[] = "--theme-rgb-color: {$rgb}";
        }

        $widget_bg_color = get_theme_mod('content_widget_background');
        if ($widget_bg_color) {
            $root[] = "--widget-bg-color: {$widget_bg_color}";
        }

        $container_width = get_theme_mod('cleaninglight_container_width');
        if ($container_width) {
            $root[] = "--container-width: {$container_width}px";
        }

        $sidebar_width = get_theme_mod('cleaninglight_sidebar_width');
        if ($sidebar_width) {
            $root[] = "--sidebar-width: {$sidebar_width}px";
        }

        $body_font = get_theme_mod('cleaninglight_body_font_family', 'Sora');
        if ($body_font) {
            $root[] = "--body-font: '{$body_font}', sans-serif";
        }

        $heading_font = get_theme_mod('cleaninglight_heading_font_family', 'Marcellus');
        if ($heading_font) {
            $root[] = "--title-font: '{$heading_font}', sans-serif";
        }

        // Append :root variables if any
        if (!empty($root)) {
            $cleaninglight_dynamic .= ":root{" . implode(';', $root) . ";}";
        }

        // Header Navigation Background Color
        $fullnavbg = get_theme_mod('cleaninglight_header_full_nav_bg_color');
        if ($fullnavbg) {
            $cleaninglight_dynamic .= ".nav-classic .nav-menu, .headertwo .nav-classic .nav-menu, .headerthree .nav-classic .nav-menu{background-color: {$fullnavbg};}";
        }

        // Menu Item Color
        $menuitemcolor = get_theme_mod('cleaninglight_menu_item_color');
        if ($menuitemcolor) {
            $cleaninglight_dynamic .= ".box-header-nav .main-menu .page_item a, 
                .box-header-nav .main-menu > .menu-item > a, 
                .menu-item-search a, 
                .headertwo .box-header-nav .main-menu .page_item a, 
                .headertwo .box-header-nav .main-menu > .menu-item > a{color: {$menuitemcolor};}";

            $cleaninglight_dynamic .= ".menu-item-search{border-color: {$menuitemcolor};}";
            $cleaninglight_dynamic .= ".menu-item-sidebar svg{stroke: {$menuitemcolor};}";
        }

        // Define selectors array for reuse
        $selectors = [
            '.hover-style1 .box-header-nav .main-menu .page_item.current_page_item > a',
            '.hover-style1 .box-header-nav .main-menu .page_item:hover > a',
            '.hover-style1 .box-header-nav .main-menu .page_item.focus > a',
            '.hover-style1 .box-header-nav .main-menu > .menu-item.current-menu-item > a',
            '.hover-style1 .box-header-nav .main-menu > .menu-item:hover > a',
            '.hover-style1 .box-header-nav .main-menu > .menu-item.focus > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu .page_item.current_page_item > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu .page_item:hover > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu .page_item.focus > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu > .menu-item.current-menu-item > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu > .menu-item:hover > a',
            '.headertwo.hover-style1 .box-header-nav .main-menu > .menu-item.focus > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu .page_item.current_page_item > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu .page_item:hover > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu .page_item.focus > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu > .menu-item.current-menu-item > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu > .menu-item:hover > a',
            '.headerthree.hover-style1 .box-header-nav .main-menu > .menu-item.focus > a'
        ];

        // Menu Hover Link Color
        $menuitemlinkcolor = get_theme_mod('cleaninglight_menu_item_link_color');
        if ($menuitemlinkcolor) {
            $cleaninglight_dynamic .= implode(',', $selectors) . "{color: {$menuitemlinkcolor};}";
        }

        // Menu Hover Background Color
        $menuitembgcolor = get_theme_mod('cleaninglight_menu_bg_color');
        if ($menuitembgcolor) {
            $cleaninglight_dynamic .= implode(',', $selectors) . "{background-color: {$menuitembgcolor};}";
        }

        // Submenu Background Color
        $submenubgcolor = get_theme_mod('cleaninglight_submenu_bg_color');
        if ($submenubgcolor) {
            $cleaninglight_dynamic .= ".box-header-nav .main-menu .children, .box-header-nav .main-menu .sub-menu{background-color: {$submenubgcolor};}";
        }

        // Submenu Item Color
        $submenuitemcolor = get_theme_mod('cleaninglight_submenu_item_color');
        if ($submenuitemcolor) {
            $cleaninglight_dynamic .= ".box-header-nav .main-menu .children > .page_item > a, 
                .box-header-nav .main-menu .sub-menu > .menu-item > a{color: {$submenuitemcolor};}";
            $cleaninglight_dynamic .= ".box-header-nav .main-menu .children li:not(:first-child)::before, 
                .box-header-nav .main-menu .sub-menu li:not(:first-child)::before{border-color: {$submenuitemcolor};}";
        }

        // Submenu Hover Link Color
        $submenulinkcolor = get_theme_mod('cleaninglight_submenu_item_link_color');
        if ($submenulinkcolor) {
            $cleaninglight_dynamic .= ".nav-menu .main-menu .children li:hover > a, 
                .nav-menu .main-menu .sub-menu li:hover > a{color: {$submenulinkcolor};}";
            $cleaninglight_dynamic .= ".nav-menu .main-menu .children li:hover > a::before, 
                .nav-menu .main-menu .sub-menu li:hover > a::before{background-color: {$submenulinkcolor};}";
        }

        // Submenu Hover Background Color
        $submenuitembgcolor = get_theme_mod('cleaninglight_submenu_item_bg_color');
        if ($submenuitembgcolor) {
            $cleaninglight_dynamic .= ".nav-menu .main-menu .children li:hover > a, 
                .nav-menu .main-menu .sub-menu li:hover > a{background-color: {$submenuitembgcolor};}";
        }


        //Header Button 
        $button_bg_color = get_theme_mod( 'cleaninglight_header_button_bg_color' );
        if( !empty($button_bg_color ) ){
            $cleaninglight_dynamic .= ".ikbutton-single-wrap, .layout_one .ikbutton-single-wrap.style1, .layout_three .ikbutton-single-wrap.style1{background-color: {$button_bg_color};}";
        }

        $button_color = get_theme_mod( 'cleaninglight_header_button_color' );
        if( !empty($button_color ) ){
            $cleaninglight_dynamic .= ".ikbutton-single-wrap{color: {$button_color};}";
            $cleaninglight_dynamic .= ".ikbutton-icon i{border-color: {$button_color};}";
            $cleaninglight_dynamic .= ".ikbutton-single-wrap.style1::after{background-color: {$button_color};}";
        }


        $titlebar_section = get_theme_mod( 'cleaninglight_titlebar_section_seperator' );
        if( !empty($titlebar_section ) ){
            $cleaninglight_dynamic .= ".ikbutton-single-wrap{color: {$button_color};}";
            $cleaninglight_dynamic .= ".ikbutton-icon i{border-color: {$button_color};}";
            $cleaninglight_dynamic .= ".ikbutton-single-wrap.style1::after{background-color: {$button_color};}";
        }
        
        // Home Sections Dynamic CSS
        $home_sections = ['aboutus', 'promoservice', 'service', 'calltoaction', 'video_calltoaction', 'recentwork', 'counter', 'blog', 'testimonial', 'team', 'client', 'contact', 'customa', 'footer'];
        foreach ($home_sections as $sectionname) {
            $sectionclass = '#' . $sectionname . '-section';
            $sectionbgtype = get_theme_mod("cleaninglight_{$sectionname}_bg_type", 'color-bg');
            $sectionbgimage = get_theme_mod("cleaninglight_{$sectionname}_bg_image_url");
            $sectionbgoverlay = get_theme_mod("cleaninglight_{$sectionname}_overlay_color");
            $sectionalignitem = get_theme_mod("cleaninglight_{$sectionname}_align_item", 'top');
            $top_seperator_height = get_theme_mod("cleaninglight_{$sectionname}_ts_height_desktop", 60);
            $bottom_seperator_height = get_theme_mod("cleaninglight_{$sectionname}_bs_height_desktop", 60);
            $top_seperator_height_tablet = get_theme_mod("cleaninglight_{$sectionname}_ts_height_tablet");
            $bottom_seperator_height_tablet = get_theme_mod("cleaninglight_{$sectionname}_bs_height_tablet");
            $top_seperator_height_mobile = get_theme_mod("cleaninglight_{$sectionname}_ts_height_mobile");
            $bottom_seperator_height_mobile = get_theme_mod("cleaninglight_{$sectionname}_bs_height_mobile");
            $section_seperator = get_theme_mod("cleaninglight_{$sectionname}_section_seperator");
            $top_seperator_color = get_theme_mod("cleaninglight_{$sectionname}_ts_color");
            $bottom_seperator_color = get_theme_mod("cleaninglight_{$sectionname}_bs_color");

            $css = [];
            $css1 = [];
            $tab_css = [];
            $mobile_css = [];

            if ($sectionbgtype === 'color-bg' || $sectionbgtype === 'image-bg') {
                $sectionbgcolor = get_theme_mod("cleaninglight_{$sectionname}_bg_color");
                if (!empty($sectionbgcolor)) {
                    $css[] = "background-color: {$sectionbgcolor}";
                }
            }

            if ($sectionbgtype === 'image-bg' && !empty($sectionbgimage)) {
                $css[] = "background-image: url({$sectionbgimage})";
                $css[] = "background-size: cover";
                $css[] = "background-position: center center";
                $css[] = "background-attachment: fixed";
                $css[] = "background-repeat: no-repeat";
                if (!empty($sectionbgoverlay)) {
                    $css1[] = "background-color: {$sectionbgoverlay}";
                }
            }

            if (!empty($css1)) {
                $cleaninglight_dynamic .= "{$sectionclass}::before{" . implode(';', $css1) . ";}";
            }

            if ($sectionbgtype === 'image-bg') {
                $cleaninglight_dynamic .= "{$sectionclass}{ background-color: transparent; }";
            }

            if (!empty($top_seperator_height)) {
                $cleaninglight_dynamic .= "{$sectionclass} .section-seperator.top-section-seperator{height: {$top_seperator_height}px;}";
            }
            if (!empty($top_seperator_height_tablet)) {
                $cleaninglight_dynamic_tablet_style .= "{$sectionclass} .section-seperator.top-section-seperator{height: {$top_seperator_height_tablet}px;}";
            }
            if (!empty($top_seperator_height_mobile)) {
                $cleaninglight_dynamic_mobile_style .= "{$sectionclass} .section-seperator.top-section-seperator{height: {$top_seperator_height_mobile}px;}";
            }

            if (!empty($bottom_seperator_height)) {
                $cleaninglight_dynamic .= "{$sectionclass} .section-seperator.bottom-section-seperator{height: {$bottom_seperator_height}px;}";
            }
            if (!empty($bottom_seperator_height_tablet)) {
                $cleaninglight_dynamic_tablet_style .= "{$sectionclass} .section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_tablet}px;}";
            }
            if (!empty($bottom_seperator_height_mobile)) {
                $cleaninglight_dynamic_mobile_style .= "{$sectionclass} .section-seperator.bottom-section-seperator{height: {$bottom_seperator_height_mobile}px;}";
            }

            if (($section_seperator === 'top' || $section_seperator === 'top-bottom') && !empty($top_seperator_color)) {
                $cleaninglight_dynamic .= ".{$sectionname}-section .top-section-seperator svg{fill: {$top_seperator_color};}";
            }
            if (($section_seperator === 'bottom' || $section_seperator === 'top-bottom') && !empty($bottom_seperator_color)) {
                $cleaninglight_dynamic .= ".{$sectionname}-section .bottom-section-seperator svg{fill: {$bottom_seperator_color};}";
            }

            if ($sectionname === 'footer') {
                if ($sectionbgtype === 'color-bg' && !empty($sectionbgcolor)) {
                    $cleaninglight_dynamic .= ".footer-seprator .section-seperator svg{fill: {$sectionbgcolor};}";
                } elseif (!empty($top_seperator_color)) {
                    $cleaninglight_dynamic .= ".footer-seprator .bottom-section-seperator svg{fill: {$top_seperator_color};}";
                }
                if (!empty($top_seperator_height)) {
                    $cleaninglight_dynamic .= ".footer-seprator .bottom-section-seperator{height: {$top_seperator_height}px;}";
                }
                if (!empty($top_seperator_height_tablet)) {
                    $cleaninglight_dynamic_tablet_style .= ".footer-seprator .bottom-section-seperator{height: {$top_seperator_height_tablet}px;}";
                }
                if (!empty($top_seperator_height_mobile)) {
                    $cleaninglight_dynamic_mobile_style .= ".footer-seprator .bottom-section-seperator{height: {$top_seperator_height_mobile}px;}";
                }
            }

            $section_padding = json_decode(get_theme_mod("cleaninglight_{$sectionname}_padding"), true);
            if ($section_padding) {
                $padding = cleaninglight_themes_dynamic_padding_value($section_padding);
                $css[] = $padding['desktop'];
                $tab_css[] = $padding['tablet'];
                $mobile_css[] = $padding['mobile'];
            }

            if (!empty($css)) {
                $cleaninglight_dynamic .= "{$sectionclass}{" . implode(';', $css) . ";}";
            }
            if (!empty($tab_css)) {
                $cleaninglight_dynamic_tablet_style .= "{$sectionclass}{" . implode(';', $tab_css) . ";}";
            }
            if (!empty($mobile_css)) {
                $cleaninglight_dynamic_mobile_style .= "{$sectionclass}{" . implode(';', $mobile_css) . ";}";
            }
        }

        /**********
         * Breadcrumb
        */
        $css = [];
        $tab_css = [];
        $mobile_css = [];
        
        $sectionbgtype = get_theme_mod('cleaninglight_titlebar_bg_type', 'color-bg');
        if ($sectionbgtype == 'color-bg') {
            $titlebar_bg_color = get_theme_mod('cleaninglight_titlebar_bg_color', '#fbfbfb');
            $cleaninglight_dynamic .= "#titlebar-section, .layout_three #titlebar-section { background-color: {$titlebar_bg_color}; }";
        } elseif ($sectionbgtype == 'image-bg') {
            $sectionbgimage = get_theme_mod('cleaninglight_titlebar_bg_image_url');
            if (!empty($sectionbgimage)) {
                $cleaninglight_dynamic .= "#titlebar-section { background: url({$sectionbgimage}) center center/cover no-repeat; }";
                $sectionbgoverlay = get_theme_mod('cleaninglight_titlebar_overlay_color');
                if (!empty($sectionbgoverlay)) {
                    $cleaninglight_dynamic .= "#titlebar-section::before { background-color: {$sectionbgoverlay}; }";
                }
            }
        }

        $section_padding = get_theme_mod("cleaninglight_titlebar_padding");
        if ($section_padding) {
            $section_padding = json_decode($section_padding, true);
            if (is_array($section_padding)) {
                $padding = cleaninglight_themes_dynamic_padding_value($section_padding);
                if ($padding) {
                    $css[] = $padding['desktop'];
                    $tab_css[] = $padding['tablet'];
                    $mobile_css[] = $padding['mobile'];
                }
            }
        }

        if (!empty($css)) {
            $cleaninglight_dynamic .= "#titlebar-section, .layout_three #titlebar-section { " . implode(';', $css) . " }";
        }
        if (!empty($tab_css)) {
            $cleaninglight_dynamic_tablet_style .= "#titlebar-section, .layout_three #titlebar-section { " . implode(';', $tab_css) . " }";
        }
        if (!empty($mobile_css)) {
            $cleaninglight_dynamic_mobile_style .= "#titlebar-section, .layout_three #titlebar-section { " . implode(';', $mobile_css) . " }";
        }

        // Separator settings
        $titlebar_seperator_color = get_theme_mod("cleaninglight_titlebar_bs_color", '#ffffff');
        if (!empty($titlebar_seperator_color)) {
            $cleaninglight_dynamic .= ".breadcrumb-seprator .bottom-section-seperator svg { fill: {$titlebar_seperator_color}; }";
        }

        $titlebar_seperator_height = get_theme_mod('cleaninglight_titlebar_bs_height_desktop', 40);
        if (!empty($titlebar_seperator_height)) {
            $cleaninglight_dynamic .= ".breadcrumb-seprator .bottom-section-seperator { height: {$titlebar_seperator_height}px; }";
        }
        $titlebar_seperator_height_tablet = get_theme_mod('cleaninglight_titlebar_bs_height_tablet');
        if (!empty($titlebar_seperator_height_tablet)) {
            $cleaninglight_dynamic_tablet_style .= ".breadcrumb-seprator .bottom-section-seperator { height: {$titlebar_seperator_height_tablet}px; }";
        }
        $titlebar_seperator_height_mobile = get_theme_mod('cleaninglight_titlebar_bs_height_mobile');
        if (!empty($titlebar_seperator_height_mobile)) {
            $cleaninglight_dynamic_mobile_style .= ".breadcrumb-seprator .bottom-section-seprator { height: {$titlebar_seperator_height_mobile}px; }";
        }

        /**********
         * Call To Action
        */
        $calltoaction_height = get_theme_mod('cleaninglight_calltoaction_height');
        if (!empty($calltoaction_height)) {
            $cleaninglight_dynamic .= ".call-to-action-bg-img img { height: {$calltoaction_height}px; object-fit: cover; }";
        }
        $cta_title_font_size = get_theme_mod('cleaninglight_cta_title_font_size');
        if (!empty($cta_title_font_size)) {
            $cleaninglight_dynamic .= ".call-to-action-content-wrap h2 { font-size: {$cta_title_font_size}px; }";
        }
        $cta_desc_font_size = get_theme_mod('cleaninglight_cta_desc_font_size');
        if (!empty($cta_desc_font_size)) {
            $cleaninglight_dynamic .= ".call-to-action-content-wrap p { font-size: {$cta_desc_font_size}px; }";
        }
        $cta_box_bg_color = get_theme_mod('cleaninglight_calltoaction_box_bg_color');
        if (!empty($cta_box_bg_color)) {
            $cleaninglight_dynamic .= ".call-to-action-content-wrap, .cover .call-to-action-content-wrap { background-color: {$cta_box_bg_color}; }";
        }
        $cta_title_color = get_theme_mod('cleaninglight_calltoaction_title_color');
        if (!empty($cta_title_color)) {
            $cleaninglight_dynamic .= ".calltoaction-section .section-title, .cover .call-to-action-content-wrap h3 { color: {$cta_title_color}; }";
        }
        $cta_text_color = get_theme_mod('cleaninglight_calltoaction_text_color');
        if (!empty($cta_text_color)) {
            $cleaninglight_dynamic .= ".call-to-action-content-wrap, .cover .call-to-action-content-wrap { color: {$cta_text_color}; }";
        }

        /**********
         * Video Call To Action
        */
        $video_cta_height = get_theme_mod('cleaninglight_video_calltoaction_height');
        if (!empty($video_cta_height)) {
            $cleaninglight_dynamic .= ".video-cat-image-wrap img { height: {$video_cta_height}px; object-fit: cover; }";
        }
        $video_cta_box_bg_color = get_theme_mod('cleaninglight_video_calltoaction_box_bg_color');
        if (!empty($video_cta_box_bg_color)) {
            $cleaninglight_dynamic .= ".video-cat-image-wrap::after, .video-cta-section .contact-form { background-color: {$video_cta_box_bg_color}; }";
        }

        /**********
         * Team Member
        */
        $team_block_height = get_theme_mod('cleaninglight_team_block_height');
        if (!empty($team_block_height)) {
            $cleaninglight_dynamic .= ".team-member-block-image img { height: {$team_block_height}px; object-fit: cover; }";
        }

        /**********
         * Top Header Background Color
        */
        $toph_bg_color = get_theme_mod('cleaninglight_th_bg_color');
        if (!empty($toph_bg_color)) {
            $cleaninglight_dynamic .= ".top-menu-bar { background-color: {$toph_bg_color}; }";
        }

        $header = cleaninglight_themes_dynamic_header_social_links_css();
        $cleaninglight_dynamic .= $header['desktop'];

        $header = cleaninglight_themes_dynamic_slider_css();
        if( isset( $header['desktop'] )){
            $cleaninglight_dynamic .= $header['desktop'];
        }
        if( isset( $header['tablet'] )){
            $cleaninglight_dynamic_tablet_style .= $header['tablet'];
        }
        if( isset( $header['mobile'] )){
            $cleaninglight_dynamic_mobile_style .= $header['mobile'];
        }
       
        $header = cleaninglight_themes_promoservice_dynamic_css();
        if( isset( $header['desktop'] )){
            $cleaninglight_dynamic .= $header['desktop'];
        }
        if( isset( $header['tablet'] )){
            $cleaninglight_dynamic_tablet_style .= $header['tablet'];
        }
        if( isset( $header['mobile'] )){
            $cleaninglight_dynamic_mobile_style .= $header['mobile'];
        }       
        
        $patterns_blocks = cleaninglight_themes_patterns_block_color();
        $cleaninglight_dynamic .= $patterns_blocks['desktop']; 


        // RTL Support - Adjust margins and padding for RTL layouts
        if ( is_rtl() ) {
            $rtl_adjustments = '';
            
            // Adjust flex direction for RTL
            $rtl_adjustments .= '.d-flex { flex-direction: row-reverse; }';
            $rtl_adjustments .= '.about-wrapper { flex-direction: row-reverse; }';
            $rtl_adjustments .= '.cleaninglight-service-area { flex-direction: row-reverse; }';
            
            // Adjust margins for RTL
            $rtl_adjustments .= '.site-branding { margin-left: auto; margin-right: 1rem; }';
            $rtl_adjustments .= '.box-header-nav { margin-left: auto; margin-right: 1rem; }';
            
            // Adjust button direction for RTL
            $rtl_adjustments .= '.btn::after { transform: rotate(180deg); }';
            $rtl_adjustments .= '.ikbutton-single-wrap.style1::after { transform: rotate(180deg); }';
            
            $cleaninglight_dynamic .= $rtl_adjustments;
        }

        // Allow plugin or child theme to inject additional dynamic CSS
        $dynamicfilter = apply_filters('cleaninglight_themes_dynamic_css', [
            'desktop' => '',
            'tablet' => '',
            'mobile' => ''
        ]);

        $dynamic = $dynamicfilter['desktop'] . $cleaninglight_dynamic;

        if (!empty($dynamicfilter['tablet']) || !empty($cleaninglight_dynamic_tablet_style)) {
            $dynamic .= "@media screen and (max-width: 768px) { {$dynamicfilter['tablet']} {$cleaninglight_dynamic_tablet_style} }";
        }
        if (!empty($dynamicfilter['mobile']) || !empty($cleaninglight_dynamic_mobile_style)) {
            $dynamic .= "@media screen and (max-width: 480px) { {$dynamicfilter['mobile']} {$cleaninglight_dynamic_mobile_style} }";
        }

        wp_add_inline_style( 'cleaninglight-style', $dynamic );
	}
}
add_action( 'wp_enqueue_scripts', 'cleaninglight_themes_dynamic_css', 999 );