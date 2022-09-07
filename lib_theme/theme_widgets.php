<?php

/* LOAD and REGISTER ALL WIDGETS from WIDGETS FOLDER */
/*------------------------------------------------------------------*/
add_action( 'widgets_init', 'bizz_load_widgets' );
	
function bizz_load_widgets() {

	// Load each widget file
	$preview_template = _preview_theme_template_filter();
	// define widgets directory
	if(!empty($preview_template))
		$bizz_widgets_dir = WP_CONTENT_DIR . "/themes/".$preview_template."/lib_theme/widgets/";
	else
    	$bizz_widgets_dir = WP_CONTENT_DIR . "/themes/".get_option('template')."/lib_theme/widgets/";
	// open files in widgets directory
    if (@is_dir($bizz_widgets_dir)) {
		$bizz_widgets_dh = opendir($bizz_widgets_dir);
		while (($bizz_widgets_file = readdir($bizz_widgets_dh)) !== false) {
			if(strpos($bizz_widgets_file,'.php') && $bizz_widgets_file != "widget-blank.php")
				include_once($bizz_widgets_dir . $bizz_widgets_file);
		}
		closedir($bizz_widgets_dh);
	}

}

/* REGISTER WIDGETIZED GRID */
/*------------------------------------------------------------------*/
if ( function_exists('bizz_register_grids') ){
	bizz_register_grids(array(
		'id' => 'header_area',
		'name' => 'Header Area',
		'container' => 'container_24',
		'show' => 'true',
		'grids' => array(
			'header_one' => array(
				'class' => 'grid_8',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'header_two' => array(
				'class' => 'grid_16 last',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			)
		)
	));
	bizz_register_grids(array(
		'id' => 'main_area',
		'name' => 'Main Area',
		'container' => 'container_24',
		'show' => 'true',
		'grids' => array(
			'main_one' => array(
				'class' => 'grid_16',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'main_two' => array(
				'class' => 'grid_8 last',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			)
		)
	));
	bizz_register_grids(array(
		'id' => 'footer_area',
		'name' => 'Footer Area',
		'container' => 'container_24',
		'show' => 'true',
		'grids' => array(
			'footer_one' => array(
				'class' => 'grid_8',
				'before_grid' => '',
				'after_grid' => '',
				'tree' => ''
			),
			'footer_two' => array(
				'class' => 'grid_16 last',
				'before_grid' => '',
				'after_grid' => apply_filters('bizz_footer_logo', bizz_footer_branding( true )),
				'tree' => ''
			)
		)
	));
}
	
/* REGISTER WIDGETIZED AREAS */
/*------------------------------------------------------------------*/

if ( function_exists('register_sidebars') ){
    register_sidebars(1,array(
	    'name' => 'Header One',
		'class' => 'header_one',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'header_one'
	));
	register_sidebars(1,array(
	    'name' => 'Header Two',
		'class' => 'header_two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'header_two'
	));
	register_sidebars(1,array(
	    'name' => 'Main Two',
		'class' => 'main_two equalh',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'main_two'
	));
	register_sidebars(1,array(
	    'name' => 'Main One',
		'class' => 'main_one equalh',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'main_one'
	));
	register_sidebars(1,array(
	    'name' => 'Footer One',
		'class' => 'footer_one',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'footer_one'
	));
	register_sidebars(1,array(
	    'name' => 'Footer Two',
		'class' => 'footer_two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		'grid' => 'footer_two'
	));
	register_sidebars(1,array( #DO NOT REMOVE!!!
	    'name' => __('Inactive Bizz Widgets'),
		'id' => 'bizz_inactive_widgets',
		'description' => '',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	));
}

/* SET UP DEFAULT WIDGETS */
/*------------------------------------------------------------------*/
/*
function bizz_install_defaults() {
	// Set up default widgets for default theme.
	update_option( 'widget_search', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-posts', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_recent-comments', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
	update_option( 'widget_archives', array ( 2 => array ( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_categories', array ( 2 => array ( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
	update_option( 'widget_meta', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
	update_option( 'sidebars_widgets', array ( 'wp_inactive_widgets' => array ( ), 'sidebar-1' => array ( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', ), 'sidebar-2' => array ( ), 'sidebar-3' => array ( ), 'sidebar-4' => array ( ), 'sidebar-5' => array ( ), 'array_version' => 3 ) );
}
*/

