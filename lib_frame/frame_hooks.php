<?php 

// ALL HOOK DEFINITIONS	
	
	// header.php
	function bizz_head_before() { do_action( 'bizz_head_before' ); }	
	function bizz_head_title() { do_action( 'bizz_head_title' ); }
	function bizz_head_meta() { do_action( 'bizz_head_meta' ); }
	function bizz_head_stylesheets() { do_action( 'bizz_head_stylesheets' ); }
	function bizz_head_links() { do_action( 'bizz_head_links' ); }
	function bizz_head_scripts() { do_action( 'bizz_head_scripts' ); }
	function bizz_head_after() { do_action( 'bizz_head_after' ); }
	
	// body.php
	function bizz_body_tag() { do_action( 'bizz_body_tag' ); }
	function bizz_body_after() { do_action( 'bizz_body_after' ); }	
	function bizz_head_grid() { do_action( 'bizz_head_grid' ); }
	
	// footer.php
	function bizz_foot_grid() { do_action( 'bizz_head_grid' ); }
	function bizz_foot_before() { do_action( 'bizz_foot_before' ); }	
	function bizz_foot_after() { do_action( 'bizz_foot_after' ); }
	function bizz_foot_branding() { do_action( 'bizz_foot_branding' ); }
	
	// loop.php
	function bizz_hook_before_content($args = '') { 
		do_action( 'bizz_hook_before_content', $args ); 
	}
	function bizz_hook_after_content($args = '') { 
		do_action( 'bizz_hook_after_content', $args ); 
	}
	function bizz_hook_before_post_box($args = '') { 
		do_action( 'bizz_hook_before_post_box', $args ); 
	}
	function bizz_hook_post_box_top($args = '') { 
		do_action( 'bizz_hook_post_box_top', $args ); 
	}
	function bizz_hook_post_box_bottom($args = '') { 
		do_action( 'bizz_hook_post_box_bottom', $args ); 
	}
	function bizz_hook_after_post_box($args = '') { 
		do_action( 'bizz_hook_after_post_box', $args ); 
	}
	function bizz_hook_after_headline($args = '') { 
		do_action( 'bizz_hook_after_headline', $args ); 
	}
	function bizz_hook_query_after_headline($args = '') { 
		do_action( 'bizz_hook_query_after_headline', $args ); 
	}
	function bizz_hook_loop_content($args = '') { 
		do_action( 'bizz_hook_loop_content', $args ); 
	}
	function bizz_hook_query_content($args ='') {
		do_action( 'bizz_hook_query_content', $args ); 
	}
	function bizz_hook_before_post($post_count = false) {
	    do_action('bizz_hook_before_post', $post_count);
	}
	function bizz_hook_after_post($post_count = false) {
	    do_action('bizz_hook_after_post', $post_count);
	}
	
	// custom_template.php
	function bizz_hook_custom_template() { do_action( 'bizz_hook_custom_template' ); }
	
// Hook actions

	add_action( 'bizz_hook_query_content', 'bizz_post_meta_query' );
	function bizz_post_meta_query($args) {
		bizz_post_meta($args);
	}
	add_action( 'bizz_hook_loop_content', 'bizz_post_meta_loop' );
	function bizz_post_meta_loop($args) {
		bizz_post_meta($args);
	}
	add_action( 'bizz_hook_query_content', 'bizz_query_content' );
	function bizz_query_content($args) {
		bizz_post_content_query($args);
	}
	add_action( 'bizz_hook_loop_content', 'bizz_loop_content' );
	function bizz_loop_content($args) {
		bizz_post_content($args);
	}

	