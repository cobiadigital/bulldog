<?php

/*

  FILE STRUCTURE:

- THEME SCRIPTS

*/

/* THEME SCRIPTS */
/*------------------------------------------------------------------*/

// Add Theme Javascript
if (!is_admin()) add_action( 'wp_print_scripts', 'bizz_add_javascript' );
function bizz_add_javascript( ) {

	wp_deregister_script( 'jquery' ); #deregister current jquery
	wp_deregister_script( 'jquery-color' ); #deregister current jquery color
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', '', '', true ); # footer
	
	wp_enqueue_script( 'theme-js', BIZZ_THEME_JS .'/theme.js', array( 'jquery' ), '', true ); # footer
	if ( (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.') !== FALSE) ) # if IE6
	    wp_enqueue_script( 'pngfix', BIZZ_THEME_JS .'/pngfix.js', '', '', true ); # footer

}
