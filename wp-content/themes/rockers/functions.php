<?php
define('RC_TEMPLATE_DIR_URI',get_stylesheet_directory_uri());	
define('RC_TEMPLATE_DIR',get_stylesheet_directory());

add_action( 'wp_enqueue_scripts', 'rockers_theme_css',999);
function rockers_theme_css() {
    wp_enqueue_style( 'rockers-parent-style', ST_TEMPLATE_DIR_URI . '/style.css' );
	wp_enqueue_style('bootstrap', ST_TEMPLATE_DIR . '/css/bootstrap.css');
	wp_enqueue_style('theme-menu-style', RC_TEMPLATE_DIR_URI .'/css/theme-menu.css');
    wp_enqueue_style('rockers-child-style',RC_TEMPLATE_DIR_URI . '/style.css',array('parent-style'));
	wp_enqueue_style('default-style-css', RC_TEMPLATE_DIR_URI."/css/default.css" );
	wp_enqueue_style('media-responsive-css', RC_TEMPLATE_DIR_URI."/css/media-responsive.css" );
	wp_dequeue_style('default-css', ST_TEMPLATE_DIR_URI .'/css/default.css');
	
}

require( RC_TEMPLATE_DIR .'/functions/widgets/wdl_social_icon.php');
require( RC_TEMPLATE_DIR .'/functions/widgets/wdl_header_topbar_info_ct_widget.php');
require( RC_TEMPLATE_DIR . '/functions/widgets/sidebars.php');



if ( ! function_exists( 'rockers_theme_setup' ) ) :

function rockers_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain( 'rockers', RC_TEMPLATE_DIR . '/languages' );

require( RC_TEMPLATE_DIR . '/functions/customizer/customizer_general_settings.php' );

if ( is_admin() ) {
				require RC_TEMPLATE_DIR . '/admin/admin-init.php';
			}

}
endif; 
add_action( 'after_setup_theme', 'rockers_theme_setup' );

add_action( 'admin_init', 'rockers_detect_button' );
	function rockers_detect_button() {
	wp_enqueue_style('rockers-info-button', RC_TEMPLATE_DIR_URI .'/css/import-button.css');
}

/**
 * Import options from SpicePress
 *
 */
function rockers_get_lite_options() {
	$spicepress_mods = get_option( 'theme_mods_spicepress' );
	if ( ! empty( $spicepress_mods ) ) {
		foreach ( $spicepress_mods as $spicepress_mod_k => $spicepress_mod_v ) {
			set_theme_mod( $spicepress_mod_k, $spicepress_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'rockers_get_lite_options' );