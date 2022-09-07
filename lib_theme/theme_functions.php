<?php

/* Custom Post Types */
/*------------------------------------------------------------------*/
require_once (BIZZ_LIB_THEME . '/cpt/post-type-slider.php'); #slider post type
require_once (BIZZ_LIB_THEME . '/cpt/post-type-practice.php'); #practice post type

/* Extra Profile Fields */
/*------------------------------------------------------------------*/
add_action( 'show_user_profile', 'bizz_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'bizz_extra_user_profile_fields' );
function bizz_extra_user_profile_fields( $user ) {
?>
	<h3><?php _e('Extra profile information', 'bizzthemes'); ?></h3>
	<table class="form-table">
	<tr>
		<th><label for="phone"><?php _e('Phone', 'bizzthemes'); ?></label></th>
		<td>
			<input type="text" name="phone" id="phone" class="regular-text" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" /><br />
			<span class="description"><?php _e('Please enter your phone.', 'bizzthemes'); ?></span>
		</td>
	</tr>
	</table>
<?php
}

add_action( 'personal_options_update', 'bizz_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'bizz_save_extra_user_profile_fields' );
function bizz_save_extra_user_profile_fields( $user_id ) {
  $saved = false;
  if ( current_user_can( 'edit_user', $user_id ) ) {
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
    $saved = true;
  }
  return true;
}

/* Force pretty Permalinks for Post types */
/* > always leave at the end of all post types */
/*------------------------------------------------------------------*/
add_action('init', 'my_rewrite');
function my_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->add_permastruct('typename', 'typename/%postname%/', true, 1);
    add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
    $wp_rewrite->flush_rules(); // !!!
}

/* Set the content width based on the theme's design and stylesheet. */
/*------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 600;

/* Uregister default widgets. */
/*------------------------------------------------------------------*/
add_action( 'widgets_init', 'custom_unregister_widgets' );
function custom_unregister_widgets() {
	unregister_widget( 'Bizz_Widget_Authors' );
	unregister_widget( 'Bizz_Widget_Bookmarks' );
	unregister_widget( 'Bizz_Widget_Tags' );
	unregister_widget( 'Bizz_Widget_Calendar' );
}
