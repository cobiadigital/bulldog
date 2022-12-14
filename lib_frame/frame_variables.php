<?php
/**
 * FRAMEWORK VARIABLES
 *
 * Defines the necessary constants and includes the necessary files for frameworks’ operation.
 * @since 7.0
 */
 
// Define framework variables
$frameversion 	= '7.6.6';
$bloghomeurl 	= trailingslashit( site_url() ); #deprecated
$frameurl 		= 'http://tinyurl.com/36qq7rh'; #deprecated
$shortname 		= 'bizzthemes'; #deprecated

// Define directory constants
define('BIZZ_FRAME_ROOT', get_template_directory_uri() . '/lib_frame');
define('BIZZ_FRAME_CSS', get_template_directory_uri() . '/lib_frame/css');
define('BIZZ_FRAME_IMAGES', get_template_directory_uri() . '/lib_frame/images');
define('BIZZ_FRAME_JS', get_template_directory_uri() . '/lib_frame/js');
define('BIZZ_FRAME_SCRIPTS', get_template_directory_uri() . '/lib_frame/scripts');
define('BIZZ_FRAME_CLASSES', BIZZ_LIB_FRAME . '/classes');

// Define WordPress core addons
add_theme_support('nav-menus');
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
// add_editor_style();

// Define and include all framework files
require_once (BIZZ_FRAME_CLASSES . '/loop.php');
require_once (BIZZ_FRAME_CLASSES . '/fonts.php');
require_once (BIZZ_FRAME_CLASSES . '/design.php');
require_once (BIZZ_FRAME_CLASSES . '/menu_description.php');
require_once (BIZZ_FRAME_CLASSES . '/akismet.php');
require_once (BIZZ_FRAME_CLASSES . '/frame_editor.php');
require_once (BIZZ_FRAME_CLASSES . '/frame_tools.php');
require_once (BIZZ_LIB_FRAME . '/frame_license.php');
require_once (BIZZ_LIB_FRAME . '/frame_functions.php');
require_once (BIZZ_LIB_FRAME . '/frame_scripts.php'); 
require_once (BIZZ_LIB_FRAME . '/frame_ajax.php');
require_once (BIZZ_LIB_FRAME . '/frame_settings.php'); 
require_once (BIZZ_LIB_FRAME . '/frame_options.php'); #frame
require_once (BIZZ_LIB_THEME . '/theme_options.php'); #theme
require_once (BIZZ_LIB_FRAME . '/frame_updates.php');
require_once (BIZZ_LIB_FRAME . '/frame_metaboxes.php');
require_once (BIZZ_LIB_FRAME . '/frame_hooks.php');
require_once (BIZZ_LIB_FRAME . '/frame_layout.php');
require_once (BIZZ_LIB_FRAME . '/frame_shortcodes.php');
require_once (BIZZ_LIB_FRAME . '/frame_html.php');
require_once (BIZZ_LIB_FRAME . '/frame_html_widgets.php');
require_once (BIZZ_LIB_FRAME . '/frame_html_scripts.php');
require_once (BIZZ_LIB_FRAME . '/frame_html_content.php');

// Pull theme options from database

$theme_options = get_option('bizzthemes_options'); # get theme options

// options by default
global $options;
$default_options = array();
foreach ($options as $key => $value){
	if (isset($value['id']) && isset($value['std']))
		$default_options[$value['id']] = $value['std'];
}
// options saved
if (!empty($theme_options)){
	$theme_options = bizz_reverse_escape( $theme_options );
	$opt = stripslashes_deep($theme_options);
}
// default options
else {
	$opt = stripslashes_deep($default_options);
}

// Pull design options from database

$theme_optionsd = get_option('bizzthemes_design'); # get design options
	
// options by default
global $design;
$default_optionsd = array();
foreach ($design as $key => $value){
	if (isset($value['id']) && isset($value['std'])){
		unset($value['std']['border-position']);
		$default_optionsd[$value['id']] = $value['std'];
	}
}
// options saved
if (!empty($theme_optionsd)){
	$theme_optionsd = bizz_reverse_escape( $theme_optionsd );
	$optd = stripslashes_deep($theme_optionsd);
}
// default options
else {
	$optd =  stripslashes_deep($default_optionsd);
	update_option('bizzthemes_design', $optd);
	bizz_generate_css(); // updates layout.css file
}
