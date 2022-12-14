<?php
/*	
	
	WIDGET FILTERS:

    widget_title			- widget title
	wlogo_title		 		- logo titl
	wlogo_description		- logo description/tagline
	
*/
/**
 * Logo Widget Class
 *
 * Logo widget allows you to choose default site title + tagline or
 * to upload your own logo and replace existing one
 */
 
// WIDGET CLASS
class Bizz_Widget_Logo extends WP_Widget {

	function Bizz_Widget_Logo() {
		$widget_ops = array( 'classname' => 'logo', 'description' => __( 'Control the output of your logotype.', 'bizzthemes') );
		$control_ops = array( 'width' => 500, 'height' => 350, 'id_base' => "widgets-reloaded-bizz-logo" );
		$this->WP_Widget( "widgets-reloaded-bizz-logo", __( 'Logo', 'bizzthemes'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $widget_id;
		
		extract( $args, EXTR_SKIP );
		
		$args = array();

		$args['custom_logo'] = $instance['custom_logo'];
		$args['upload_logo'] = $instance['upload_logo'];
		$args['custom_link'] = $instance['custom_link'];
		
		if(isset($instance['custom_link']) && $instance['custom_link']!='' && $instance['custom_link']!='http://')
		    $logo_link = $instance['custom_link'];
		else
		    $logo_link = home_url();
		
		if ( isset($instance['custom_logo']) && $instance['custom_logo'] == 'cus_logo' && $instance['upload_logo'] != '' )
		    $logo_src = $instance['upload_logo'];
		elseif ( isset($GLOBALS['opt']['bizzthemes_logo_url']['value']) && $GLOBALS['opt']['bizzthemes_logo_url']['value'] != '' )
		    $logo_src = $GLOBALS['opt']['bizzthemes_logo_url']['value'];
		else
		    $logo_src = BIZZ_THEME_IMAGES .'/logo-trans.png';

		/* Open the output of the widget. */
		echo $before_widget;

		/* Output the logo. */
		echo '<div class="logo-spot">';
		if ( isset($instance['custom_logo']) && $instance['custom_logo'] == 'def_title' ) { 
		
		    echo '<div class="blog-title"><a href="'. $logo_link .'">' . apply_filters( 'wlogo_title',  get_bloginfo( 'name' ) ) . '</a></div>';
			echo '<div class="blog-description">' . apply_filters( 'wlogo_description',  get_bloginfo( 'description' ) ) . '</div>';
			
		} 
		else { 
		
		    echo '<div class="logo">';
			echo '<a href="'. $logo_link .'" title="'.get_bloginfo( 'name' ).'">';
			echo '<img src="'. $logo_src .'" alt="'.get_bloginfo( 'name' ).'" />';
			echo '</a>';
			echo '</div><!--/.logo-->';
			
		}
		echo '</div>';

		/* Close the output of the widget. */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;

		$instance['custom_logo'] = strip_tags( $new_instance['custom_logo'] );
		$instance['upload_logo'] = strip_tags( $new_instance['upload_logo'] );
		$instance['custom_link'] = strip_tags( $new_instance['custom_link'] );

		return $instance;
	}

	function form( $instance ) {

		//Defaults
		$defaults = array(
			'custom_logo' => 'def_logo',
			'upload_logo' => '',
			'custom_link' => 'http://'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$custom_logo = array( 'def_logo' => __( 'Default logo (configure defult logo inside theme options panel)', 'bizzthemes' ), 'def_title' => __( 'Default blog title &amp; tagline (configure Title &amp; Tagline inside Settings/General)', 'bizzthemes' ), 'cus_logo' => __( 'Custom logo (upload custom logo for this widget only - setup below)', 'bizzthemes' ) );
		
		?>

		<div class="bizz-widget-controls columns-1">
		<?php foreach ( $custom_logo as $option_value => $option_label ) { ?>
		    <p class="logo-controls">
			    <label for="<?php echo $this->get_field_id( 'custom_logo' ); ?>">
			    <input value="<?php echo $option_value; ?>" class="radio showhide" type="radio" <?php checked( $instance['custom_logo'], $option_value ); ?> id="<?php echo $this->get_field_id( 'custom_logo' ); ?>" name="<?php echo $this->get_field_name( 'custom_logo' ); ?>" /> <?php echo $option_label; ?></label>
		    </p>
		<?php } ?>
		<div class="showhidediv">
		<p>
			<div class="wid_upload_wrap">
			    <label for="<?php echo $this->get_field_id( 'upload_logo' ); ?>"><?php _e( 'Upload custom logo:', 'bizzthemes' ); ?></label>
				<div class="wid_upload_button" id="<?php echo $this->get_field_id('upload_logo'); ?>">Choose File</div>
			    <input type="text" class="widefat wid_upload_input" id="<?php echo $this->get_field_id('upload_logo'); ?>" name="<?php echo $this->get_field_name('upload_logo'); ?>" value="<?php echo $instance['upload_logo']; ?>" />
			</div>
		</p>
		<p>
		    <label for="<?php echo $this->get_field_id( 'custom_link' ); ?>"><?php _e( 'Choose a custom link:', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'custom_link' ); ?>" name="<?php echo $this->get_field_name( 'custom_link' ); ?>" value="<?php echo $instance['custom_link']; ?>" />
		</p>
		</div>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

// INITIATE WIDGET
register_widget( 'Bizz_Widget_Logo' );
