<?php 
/**
 * BizzThemes WordPress theme framework by Zeljan Topic
 * Do not modify unless you know what you're doing, SERIOUSLY!
 */

// DEFINE DIRECTORY CONSTANTS
define('BIZZ_LIB_FRAME', TEMPLATEPATH . '/lib_frame');        # Framework Library
define('BIZZ_LIB_THEME', TEMPLATEPATH . '/lib_theme');        # Theme Library
define('BIZZ_LIB_CUSTOM', TEMPLATEPATH . '/custom');          # Custom Library
	
// DEFINE CSS FILE CONSTANTS
define('BIZZ_STYLE_CSS', TEMPLATEPATH . '/style.css');        # General CSS styles

if (file_exists(TEMPLATEPATH . '/custom')){
	define('BIZZ_LAYOUT_CSS', BIZZ_LIB_CUSTOM . '/layout.css');   # Layout CSS styles (generated automatically)
	define('BIZZ_CUSTOM_CSS', BIZZ_LIB_CUSTOM . '/custom.css');   # Custom CSS styles (generated manually by user)
}

// DEFINE VARIABLE CONSTANTS
require_once (BIZZ_LIB_THEME . '/theme_variables.php');       # THEME VARIABLES
require_once (BIZZ_LIB_FRAME . '/frame_variables.php');       # FRAMEWORK VARIABLES	
require_once (BIZZ_LIB_THEME . '/theme_constants.php');       # THEME CONSTANTS

if (file_exists(TEMPLATEPATH . '/custom')){
	include_once (BIZZ_LIB_CUSTOM . '/custom_functions.php');     # CUSTOM FILES
}
	
// MAKE THEME TRANSLATABLE
load_theme_textdomain($GLOBALS['shortname'], BIZZ_LIB_CUSTOM . '/lang' );
