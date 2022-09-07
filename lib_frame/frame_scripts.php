<?php
/**
 * ADMIN JAVASCRIPTS
 *
 * print admin javascripts
 * @since 7.0
 */
if (is_admin()) add_action('admin_print_scripts', 'bizz_print_admin_scripts');
function bizz_print_admin_scripts() {
    global $pagenow;
		
	if ( is_admin() && ( 'admin.php' == $pagenow ) ) {
	
		wp_deregister_script( 'jquery' ); #deregister current jquery
		wp_deregister_script( 'jquery-ui' ); #deregister current jquery ui
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'); #header
		wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js', '', '', true ); #footer
	
		/* offline
		wp_enqueue_script( 'jquery'); #header
		wp_enqueue_script( 'jquery-ui-core' ); #header
		wp_enqueue_script( 'jquery-ui-tabs' ); #header
		wp_enqueue_script( 'jquery-ui-draggable' ); #header
		wp_enqueue_script( 'jquery-ui-droppable' ); #header
		wp_enqueue_script( 'jquery-ui-sortable' ); #header
		*/
		
		wp_enqueue_script( 'bizz-frame', BIZZ_FRAME_SCRIPTS . '/frame.all.min.js', array( 'jquery' ), '', true ); #footer
		wp_enqueue_script( 'bizz-admin', BIZZ_FRAME_SCRIPTS . '/admin.dev.js', array( 'jquery' ), '', true ); #footer
		wp_enqueue_script( 'bizz-widgets', BIZZ_FRAME_SCRIPTS . '/widgets.dev.js', array( 'jquery' ), '', true ); #footer
		wp_enqueue_script( 'jscolor', BIZZ_FRAME_SCRIPTS . '/jscolor/jscolor.js', '', '', true ); #footer
		wp_enqueue_script( 'jquery-jwysiwyg', BIZZ_FRAME_SCRIPTS . '/jwysiwyg/jquery.wysiwyg.min.dev.js', '', '', true ); #footer
				
	}

}

/**
 * ADMIN STYLESHEETS
 *
 * print admin stylesheets
 * @since 7.0
 */
if (is_admin()) add_action('admin_print_styles', 'bizz_print_admin_styles');
function bizz_print_admin_styles() {
    global $pagenow;
	
	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' ) { #post editing only
		wp_enqueue_style( 'admin_metabox', BIZZ_FRAME_CSS .'/admin_metabox_dev.css'); #header
		wp_enqueue_style( 'jquery_ui_style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css'); #header
		wp_enqueue_script( 'jquery_datepicker', BIZZ_FRAME_SCRIPTS . '/ui.datepicker.js', array( 'jquery' ), '', '', true ); #footer
		wp_enqueue_script( 'admin_custom', BIZZ_FRAME_SCRIPTS . '/admin.custom.js', array( 'jquery' ), '', '', true ); #footer
	}
	
	if ( 'admin.php' == $pagenow ) {
		if ( isset($_GET['page']) && $_GET['page'] == 'bizz-layout' && version_compare(get_bloginfo('version'), '3.2.3', '<=') )
			wp_admin_css( 'widgets' );
		wp_enqueue_style( 'admin_style', BIZZ_FRAME_CSS .'/admin_style_dev.css'); #header
		wp_enqueue_style( 'jwysiwyg_style', BIZZ_FRAME_SCRIPTS .'/jwysiwyg/jquery.wysiwyg.css'); #header
	}
	
}

/**
 * FEATURE POINTERS
 *
 * print admin stylesheets
 * @since 7.6.5
 */
add_action( 'admin_head', 'bizz_frame_pointers' );
function bizz_frame_pointers() {
	if( !is_admin() || version_compare(get_bloginfo('version'), '3.2.3', '<=') )
		return;
	
	if ( apply_filters( 'show_wp_pointer_admin_bar', TRUE ) && get_user_setting( 'p_step_1', 0 ) && get_user_setting( 'p_step_2', 0 ) && get_user_setting( 'p_license_what', 0 ) )
		return;

	// Get Proper CSS involved - probably already included, but we want to be safe.
	wp_enqueue_style( 'wp-pointer' );
	wp_print_styles();

	// Get Proper bundled jQuery plugin involved - probably already included, but just to be safe
	wp_enqueue_script( 'wp-pointer' );
	wp_print_scripts();

	// Define text for the Pointer. Make sure you escape stuff
	$step_1 = '<h3>' . __( 'Step 1: Select a Template to Edit', 'bizzthemes' ) . '</h3>';
	$step_1 .= '<p>' . __( "<p>Builder replaces static WordPress templates (like index.php, single.php, archive.php etc.) with dynamic ones, which you may select here.</p>", 'bizzthemes') . '</p>';
	$step_1_hide = get_user_setting( 'p_step_1', 0 ); // check settings on user

	$step_2 = '<h3>' . __( 'Step 2: Add Widgets to a Template', 'bizzthemes' ) . '</h3>';
	$step_2 .= '<p>' . __( "<p>Drag \"Available Widgets\" from the list on the left and drop them into the \"sidebars\" within the grids on the right hand side to build up your template content.</p>", 'bizzthemes') . '</p>';
	$step_2_hide = get_user_setting( 'p_step_2', 0 ); // check settings on user

	$license_what = '<h3>' . __( 'A License Key?', 'bizzthemes' ) . '</h3>';
	$license_what .= '<p>' . __( "<p>Even though, themes are GPL licensed, we keep rights for issuing three versions of this theme: free, standard and agency. Whereas, free version does not require a license to function, standard and agency need license key, which you get after your theme purchase inside your BizzThemes account.</p>", 'bizzthemes') . '</p>';
	$license_what_hide = get_user_setting( 'p_license_what', 0 ); // check settings on user
  
?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		<?php if ( !$step_1_hide && apply_filters( 'show_wp_pointer_admin_bar', TRUE ) ) { ?>
		jQuery('#template-menu:not(.closed)').pointer({
			content    : '<?php echo $step_1 ?>',
			position   : 'left',
			close: function() {
				setUserSetting( 'p_step_1', '1' );
			}
		}).pointer('open');
		<?php } ?>
		<?php if ( !$step_2_hide && apply_filters( 'show_wp_pointer_admin_bar', TRUE ) ) { ?>
		jQuery('#available-widgets').pointer({
			content    : '<?php echo $step_2 ?>',
			position   : 'left',
			close: function() {
				setUserSetting( 'p_step_2', '1' );
			}
		}).pointer('open');
		<?php } ?>
		<?php if ( !$license_what_hide && apply_filters( 'show_wp_pointer_admin_bar', TRUE ) ) { ?>
		jQuery('#license-what').pointer({
			content    : '<?php echo $license_what ?>',
			position: {
				my: 'left top',
				at: 'center bottom',
				offset: '-70 10'
			},
			close: function() {
				setUserSetting( 'p_license_what', '1' );
			}
		}).pointer('open');
		<?php } ?>
	});
	</script>
<?php
}

