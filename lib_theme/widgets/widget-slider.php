<?php
/*	
	
	WIDGET FILTERS:

    widget_title			- widget title
	wslider_args	 		- arguments for get_posts for slider
	wslider_post_title		- slider post title
	wslider_post_content	- slider post content
	
*/

// WIDGET CLASS
class Bizz_Widget_Slider extends WP_Widget {

	var $prefix;
	var $textdomain;

	/**
	 * Set up the widget's unique name, ID, class, description, and other options.
	 * @since 0.6
	 */
	function Bizz_Widget_Slider() {
		$this->prefix = bizz_get_prefix();
		
		$widget_ops = array( 'classname' => 'slider', 'description' => __( 'Displaying any of your posts inside slider.', 'bizzthemes' ) );
		$control_ops = array( 'width' => 550, 'height' => 350, 'id_base' => "{$this->prefix}-slider" );
		$this->WP_Widget( "{$this->prefix}-slider", __( 'Slider', 'bizzthemes' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 * @since 0.6
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$args = array();

		$args['before'] = $instance['before'];
		$args['after'] = $instance['after'];
		
		$args['post_type'] = $instance['post_type'];
		$args['include'] = isset( $instance['include'] ) ? $instance['include'] : '';
		$args['exclude'] = isset( $instance['exclude'] ) ? $instance['exclude'] : '';
		$args['order'] = $instance['order'];
		$args['orderby'] = $instance['orderby'];
		$args['number'] = intval( $instance['number'] );
				
		$args['effect'] =  isset( $instance['effect'] ) ? $instance['effect'] : 'fade';
		$args['start'] = isset( $instance['start'] ) ? $instance['start'] : 1;
		$args['fadespeed'] = isset( $instance['fadespeed'] ) ? $instance['fadespeed'] : 250;
		$args['slidespeed'] = isset( $instance['slidespeed'] ) ? $instance['slidespeed'] : 250;
		$args['crossfade'] = isset( $instance['crossfade'] ) ? $instance['crossfade'] : false;
		$args['bigtarget'] = isset( $instance['bigtarget'] ) ? $instance['bigtarget'] : false;
		$args['autoheight'] = isset( $instance['autoheight'] ) ? $instance['autoheight'] : false;
		$args['pagination'] = isset( $instance['pagination'] ) ? $instance['pagination'] : false;
		$args['autoplay'] = isset( $instance['autoplay'] ) ? $instance['autoplay'] : 0;
		$args['pause'] = isset( $instance['pause'] ) ? $instance['pause'] : 0;
		
		$args['sliderheight'] = intval($instance['sliderheight']);
		$sliderheight = ( !empty($args['sliderheight']) && empty($instance['autoheight']) ) ? ' style="height:' . $args['sliderheight'] . 'px"' : '';
		$args['buttonheight'] = intval($instance['buttonheight']);
		$buttonheight = ( !empty($args['buttonheight']) ) ? ' style="top:' . $args['buttonheight'] . 'px"' : '';
		$args['ico_fwd'] = $instance['ico_fwd'];
		$args['ico_back'] = $instance['ico_back'];
		
		$widget_id = preg_replace("/[^0-9\.]/", '', $widget_id);
		$widget_id = 'loopedSlider'.$widget_id;

		echo $before_widget;
		
		/* If there is a title given, add it along with the $before_title and $after_title variables. */
		if ( $instance['title'] )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;
		
		if ( $instance['ico_fwd'] != '' )
		    $nxt_img = $instance['ico_fwd'];
		else
		    $nxt_img = BIZZ_THEME_IMAGES .'/arr-right-trans.png';
			
		if ( $instance['ico_back'] != '' )
		    $prev_img = $instance['ico_back'];
		else
		    $prev_img = BIZZ_THEME_IMAGES .'/arr-left-trans.png';
		
		// get included slides		
		$count = 0;
		$slide_args = array(
		    'post_type'     => $args['post_type'],
			'include'       => $args['include'],
			'exclude'       => $args['exclude'],
			'order'         => $args['order'],
			'orderby'       => $args['orderby'],
			'numberposts'   => $args['number']
		); 
		$islide = get_posts( apply_filters( 'wslider_args',  $slide_args ) );
		
		if ( !empty($instance['before']) )
			echo $instance['before'];
								
?>
								
<div id="<?php echo $widget_id; ?>" class="clearfix loopedSlider">

    <div class="slider-inner">
<?php
	global $post;
	foreach ($islide as $post) {
		setup_postdata($post);
		$count++;
		$hidden = ( $count != 1 ) ? ' style="display:none"' : '';
		$hide_title = get_post_meta($post->ID, 'bizzthemes_hide_title', true);
		if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
?>
			<div id="slide-<?php echo $count; ?>" class="slide"<?php echo stripslashes($sliderheight); ?><?php echo $hidden; ?>>
<?php
				if ( !$hide_title ){
?>
					<?php echo apply_filters( 'wslider_post_title',  '<h3 class="stitle">'. get_the_title(). '</h3>' ); ?>
<?php
				}
?>
				<div class="format_text">
				<div class="fix"></div>
				<?php echo apply_filters( 'wslider_post_content',  get_the_content() ); ?>
				<div class="fix"></div>
				</div><!-- /.format_text -->
			</div><!-- /.slide -->
<?php					
		}
	}
?>
	</div><!-- /.slider-inner -->
	<input type="hidden" class="slider-id" name="slider-id" value="<?php echo $widget_id; ?>" />
	<input type="hidden" class="slider-effect" name="slider-effect" value="<?php echo $args['effect']; ?>" />
	<input type="hidden" class="slider-start" name="slider-start" value="<?php echo $args['start']; ?>" />
	<input type="hidden" class="slider-fadespeed" name="slider-fadespeed" value="<?php echo $args['fadespeed']; ?>" />
	<input type="hidden" class="slider-slidespeed" name="slider-slidespeed" value="<?php echo $args['slidespeed']; ?>" />
	<input type="hidden" class="slider-crossfade" name="slider-crossfade" value="<?php echo $args['crossfade']; ?>" />
	<input type="hidden" class="slider-bigtarget" name="slider-bigtarget" value="<?php echo $args['bigtarget']; ?>" />
    <input type="hidden" class="slider-autoheight" name="slider-autoheight" value="<?php echo $args['autoheight']; ?>" />
    <input type="hidden" class="slider-pagination" name="slider-pagination" value="<?php echo $args['pagination']; ?>" />
	<input type="hidden" class="slider-autoplay" name="slider-autoplay" value="<?php echo $args['autoplay']; ?>" />
	<input type="hidden" class="slider-pause" name="slider-pause" value="<?php echo $args['pause']; ?>" />
	<input type="hidden" class="slider-loadingimg" name="slider-loadingimg" value="<?php echo get_template_directory_uri() . '/lib_theme/images/ajax-loader.gif'; ?>" />

    <div class="prev"<?php echo stripslashes($buttonheight); ?>>
		<a href="#" class="previous"><img src="<?php echo $prev_img; ?>" alt="Back" /></a> 
	</div>
	<div class="nxt"<?php echo stripslashes($buttonheight); ?>>
		<a href="#" class="next"><img src="<?php echo $nxt_img; ?>" alt="Forward" /></a> 
	</div>
	
</div><!-- /#loopedSlider -->

<?php 
        if ( !empty($instance['after']) )
			echo $instance['after'];

		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 * @since 0.6
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['post_type'] = (isset($new_instance['post_type'])) ? $new_instance['post_type'] : 'bizz_sliders';
		if ( $instance['post_type'] !== $old_instance['post_type'] ) {
			$instance['include'] = array();
			$instance['exclude'] = array();
		}
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['number'] = strip_tags( $new_instance['number'] );

		$instance['before'] = strip_tags( $new_instance['before'] );
		$instance['after'] = strip_tags( $new_instance['after'] );
			
		$instance['effect'] = strip_tags( $new_instance['effect'] );
		$instance['start'] = strip_tags( $new_instance['start'] );
		$instance['fadespeed'] = strip_tags( $new_instance['fadespeed'] );
		$instance['slidespeed'] = strip_tags( $new_instance['slidespeed'] );
		$instance['crossfade'] = ( isset( $new_instance['crossfade'] ) ? 1 : 0 );
		$instance['bigtarget'] = ( isset( $new_instance['bigtarget'] ) ? 1 : 0 );
		$instance['autoheight'] = ( isset( $new_instance['autoheight'] ) ? 1 : 0 );
		$instance['pagination'] = ( isset( $new_instance['pagination'] ) ? 1 : 0 );
		$instance['autoplay'] = strip_tags( $new_instance['autoplay'] );
		$instance['pause'] = strip_tags( $new_instance['pause'] );
		$instance['autorestart'] = strip_tags( $new_instance['autorestart'] );
		$instance['sliderheight'] = strip_tags( $new_instance['sliderheight'] );
		$instance['buttonheight'] = strip_tags( $new_instance['buttonheight'] );		
		$instance['ico_fwd'] = strip_tags( $new_instance['ico_fwd'] );
		$instance['ico_back'] = strip_tags( $new_instance['ico_back'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 * @since 0.6
	 */
	function form( $instance ) {

		//Defaults
		$defaults = array(
			'title' => '',
			'before' => '',
			'after' => '',
			'post_type' => 'bizz_slider',
			'include' => '',
			'exclude' => '',
			'order' => 'DESC',
			'orderby' => 'date',
			'number' => 5,
			'effect' => 'fade, fade',
			'start' => 1,
			'fadespeed' => 250,
			'slidespeed' => 250,
			'crossfade' => false,
			'bigtarget' => false,
			'autoheight' => true,
			'pagination' => false,
			'autoplay' => false,
			'pause' => false,
			'sliderheight' => '',
			'buttonheight' => 100,
			'ico_fwd' => '',
			'ico_back' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$post_types = get_post_types('','names');
		$posts = get_posts( array( 'post_type' => $instance['post_type'], 'post_status' => 'publish', 'post_mime_type' => '', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => -1 ) );

		$num_array['0'] = 'Disable';
		for ($i = 250; $i <= 15000; $i += 250){
			$num_array[$i] = $i.' ms';
		}
		$order = array( 'ASC' => __( 'Ascending', 'bizzthemes' ), 'DESC' => __( 'Descending', 'bizzthemes' ) );
		$orderby = array(
		    'author' => __( 'Author', 'bizzthemes' ), 
			'category' => __( 'Category', 'bizzthemes' ),
			'content' => __( 'Content', 'bizzthemes' ),
			'date' => __( 'Date', 'bizzthemes' ),
			'ID' => __( 'ID', 'bizzthemes' ),
			'menu_order' => __( 'Menu order', 'bizzthemes' ),
			'mime_type' => __( 'Mime type (attachments)', 'bizzthemes' ),
			'modified' => __( 'Modified date', 'bizzthemes' ),
			'name' => __( 'Name', 'bizzthemes' ),
			'parent' => __( 'Parent ID', 'bizzthemes' ),
			'rand' => __( 'Randomly', 'bizzthemes' ),
			'status' => __( 'Status', 'bizzthemes' ),
			'title' => __( 'Title', 'bizzthemes' ),
			'category' => __( 'Category', 'bizzthemes' ),
		);
		$effect = array(
		    'fade' => __( 'fade, fade', 'bizzthemes' ), 
			'slide' => __( 'slide, slide', 'bizzthemes' ),
			'fade_slide' => __( 'fade, slide', 'bizzthemes' ),
			'slide_fade' => __( 'slide, fade', 'bizzthemes' )
		);	
?>

		<div class="bizz-widget-controls columns-3">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<small class="section">Slider Settings</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'before' ); ?>">Before slider (any HTML)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'before' ); ?>" name="<?php echo $this->get_field_name( 'before' ); ?>" value="<?php echo $instance['before']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'after' ); ?>">After slider (any HTML)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'after' ); ?>" name="<?php echo $this->get_field_name( 'after' ); ?>" value="<?php echo $instance['after']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sliderheight' ); ?>">Slider height (px)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'sliderheight' ); ?>" name="<?php echo $this->get_field_name( 'sliderheight' ); ?>" value="<?php echo $instance['sliderheight']; ?>" />
		</p>
		<small class="section">Custom Buttons</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'buttonheight' ); ?>">Button height (px)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'buttonheight' ); ?>" name="<?php echo $this->get_field_name( 'buttonheight' ); ?>" value="<?php echo $instance['buttonheight']; ?>" />
		</p>
		<p>
			<div class="wid_upload_wrap">
			    <label for="<?php echo $this->get_field_id( 'ico_back' ); ?>"><?php _e( 'Custom back Icon:', 'bizzthemes' ); ?></label>
				<div class="wid_upload_button" id="<?php echo $this->get_field_id('ico_back'); ?>">Choose File</div>
			    <input type="text" class="widefat wid_upload_input" id="<?php echo $this->get_field_id('ico_back'); ?>" name="<?php echo $this->get_field_name('ico_back'); ?>" value="<?php echo $instance['ico_back']; ?>" />
			</div>
		</p>
		<p>
			<div class="wid_upload_wrap">
			    <label for="<?php echo $this->get_field_id( 'ico_fwd' ); ?>"><?php _e( 'Custom forward Icon:', 'bizzthemes' ); ?></label>
				<div class="wid_upload_button" id="<?php echo $this->get_field_id('ico_fwd'); ?>">Choose File</div>
			    <input type="text" class="widefat wid_upload_input" id="<?php echo $this->get_field_id('ico_fwd'); ?>" name="<?php echo $this->get_field_name('ico_fwd'); ?>" value="<?php echo $instance['ico_fwd']; ?>" />
			</div>
		</p>
		</div>
		
		<div class="bizz-widget-controls columns-3">
		<small class="section">Select Slides</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">Post Type</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<option value="any" <?php selected( $instance['post_type'], 'any' ); ?>>All post types</option>
<?php 
				foreach ( $post_types as $post_type ) { 
				    if ( $post_type != 'revision' && $post_type != 'nav_menu_item' && $post_type != 'bizz_widget' && $post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post_type; ?>" <?php selected( $instance['post_type'], $post_type ); ?>><?php echo $post_type; ?></option>
<?php
				    }
				}
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>">Include slides</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $posts as $post ) {
				    if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['include'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
<?php 
				    }
				} 
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude slides</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>[]" size="4" multiple="multiple">
<?php 
				foreach ( $posts as $post ) {
				    if ( $post->post_type != 'revision' && $post->post_type != 'nav_menu_item' && $post->post_type != 'bizz_widget' && $post->post_type != 'bizz_grid' ){
?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['exclude'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
<?php 
				    }
				} 
?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>">Order</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
				<?php foreach ( $order as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<?php foreach ( $orderby as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['orderby'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Limit (-1 removes the limit)</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
		</div>

		<div class="bizz-widget-controls columns-3 column-last">
		<small class="section">Animation Settings</small>
		<p>
			<label for="<?php echo $this->get_field_id( 'pagination' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['pagination'], true ); ?> id="<?php echo $this->get_field_id( 'pagination' ); ?>" name="<?php echo $this->get_field_name( 'pagination' ); ?>" /> <?php _e( 'Add pagination?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'crossfade' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['crossfade'], true ); ?> id="<?php echo $this->get_field_id( 'crossfade' ); ?>" name="<?php echo $this->get_field_name( 'crossfade' ); ?>" /> <?php _e( 'Crossfade content?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'bigtarget' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['bigtarget'], true ); ?> id="<?php echo $this->get_field_id( 'bigtarget' ); ?>" name="<?php echo $this->get_field_name( 'bigtarget' ); ?>" /> <?php _e( 'Click content for next?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoheight' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['autoheight'], true ); ?> id="<?php echo $this->get_field_id( 'autoheight' ); ?>" name="<?php echo $this->get_field_name( 'autoheight' ); ?>" /> <?php _e( 'Auto height adjustment?', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'start' ); ?>">Start with slide #</label>
			<input type="text" class="widefat code" id="<?php echo $this->get_field_id( 'start' ); ?>" name="<?php echo $this->get_field_name( 'start' ); ?>" value="<?php echo $instance['start']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'effect' ); ?>">Effect (next/prev, pagination)</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'effect' ); ?>" name="<?php echo $this->get_field_name( 'effect' ); ?>">
				<?php foreach ( $effect as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_label; ?>" <?php selected( $instance['effect'], $option_label ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'fadespeed' ); ?>">Fading speed</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'fadespeed' ); ?>" name="<?php echo $this->get_field_name( 'fadespeed' ); ?>">
				<?php foreach ( $num_array as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['fadespeed'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'slidespeed' ); ?>">Sliding speed</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'slidespeed' ); ?>" name="<?php echo $this->get_field_name( 'slidespeed' ); ?>">
				<?php foreach ( $num_array as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['slidespeed'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Play</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>">
				<?php foreach ( $num_array as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['autoplay'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pause' ); ?>">Pause</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'pause' ); ?>" name="<?php echo $this->get_field_name( 'pause' ); ?>">
				<?php foreach ( $num_array as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['pause'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

// INITIATE WIDGET
register_widget( 'Bizz_Widget_Slider' );