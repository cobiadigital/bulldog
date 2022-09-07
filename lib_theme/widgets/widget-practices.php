<?php
/*	
	
	WIDGET FILTERS:

    widget_title			- widget title
	wpractices_args	 		- arguments for get_posts for slider
	
*/

/*---------------------------------------------------------------------------------*/
/* Address Widget */
/*---------------------------------------------------------------------------------*/
class Bizz_Practices extends WP_Widget {

	function Bizz_Practices() {
		$widget_ops = array('classname' => 'widget_practices', 'description' => __('Add practice list'));
		$this->WP_Widget('bizz_practices', __('Areas of Practice'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		
		$args = array();
		$args['include'] = ( isset($instance['include']) && is_array( $instance['include'] ) ? join( ', ', $instance['include'] ) : '' );
		$args['exclude'] = ( isset($instance['exclude']) && is_array( $instance['exclude'] ) ? join( ', ', $instance['exclude'] ) : '' );
		$args['order'] = (isset($instance['order'])) ? $instance['order'] : 'DESC';
		$args['orderby'] = (isset($instance['orderby'])) ? $instance['orderby'] : 'title';
		$args['link_before'] = $instance['link_before'];
		$args['link_after'] = $instance['link_after'];
		$args['post_type'] = 'bizz_practice';
		$args['title_li'] = '';
		
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
?>
			<ul class="practiceswidget clearfix">
<?php
			wp_reset_query();
			bizz_list_post_types( apply_filters( 'wpractices_args',  $args ) );
?>
			</ul>
			
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['link_before'] = $new_instance['link_before'];
		$instance['link_after'] = $new_instance['link_after'];
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$defaults = array(
			'title' => __( 'Areas of Practice', 'bizzthemes'),
			'include' => '',
			'exclude' => '',
			'order' => 'DESC',
			'orderby' => 'title',
			'link_before' => '',
			'link_after' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$posts = get_posts( array( 'post_type' => 'bizz_practice', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC', 'numberposts' => -1 ) );
		$order = array( 'ASC' => __( 'Ascending', 'bizzthemes' ), 'DESC' => __( 'Descending', 'bizzthemes' ) );
		$orderby = array(
		    'author' => __( 'Author', 'bizzthemes' ), 
			'content' => __( 'Content', 'bizzthemes' ),
			'date' => __( 'Date', 'bizzthemes' ),
			'ID' => __( 'ID', 'bizzthemes' ),
			'menu_order' => __( 'Menu order', 'bizzthemes' ),
			'modified' => __( 'Modified date', 'bizzthemes' ),
			'name' => __( 'Name', 'bizzthemes' ),
			'rand' => __( 'Randomly', 'bizzthemes' ),
			'status' => __( 'Status', 'bizzthemes' ),
			'title' => __( 'Title', 'bizzthemes' ),
		);
?>
		<div class="bizz-widget-controls">
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bizzthemes' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'include' ); ?>">Include</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'include' ); ?>" name="<?php echo $this->get_field_name( 'include' ); ?>[]" size="4" multiple="multiple">
				<?php foreach ( $posts as $post ) { ?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['include'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>[]" size="4" multiple="multiple">
				<?php foreach ( $posts as $post ) { ?>
					<option value="<?php echo $post->ID; ?>" <?php echo ( in_array( $post->ID, (array) $instance['exclude'] ) ? 'selected="selected"' : '' ); ?>><?php echo esc_attr( $post->post_title ); ?></option>
				<?php } ?>
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
			<label for="<?php echo $this->get_field_id( 'link_before' ); ?>">Before link</label>
			<input type="text" class="smallfat code" id="<?php echo $this->get_field_id( 'link_before' ); ?>" name="<?php echo $this->get_field_name( 'link_before' ); ?>" value="<?php echo $instance['link_before']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'link_after' ); ?>">After link</label>
			<input type="text" class="smallfat code" id="<?php echo $this->get_field_id( 'link_after' ); ?>" name="<?php echo $this->get_field_name( 'link_after' ); ?>" value="<?php echo $instance['link_after']; ?>" />
		</p>
		</div>
<?php
	}
}


register_widget('Bizz_Practices');

function bizz_list_post_types( $args ) {
    $defaults = array(
        'numberposts'  => -1,
        'offset'       => 0,
        'orderby'      => $args['orderby'],
		'order'        => $args['order'],
        'post_type'    => $args['post_type'],
        'depth'        => 0,
        'show_date'    => '',
        'date_format'  => get_option('date_format'),
        'child_of'     => 0,
        'exclude'      => $args['exclude'],
        'include'      => $args['include'],
        'title_li'     => $args['title_li'],
        'echo'         => 1,
        'link_before'  => $args['link_before'],
        'link_after'   => $args['link_after'],
        'exclude_tree' => '' );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    $output = '';
    $current_page = 0;

    // sanitize, mostly to keep spaces out
    $r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);

    // Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
    $exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
    $r['exclude'] = implode( ',', apply_filters('wp_list_post_types_excludes', $exclude_array) );

    // Query pages.
    $r['hierarchical'] = 0;
    $pages = get_posts($r);

    if ( !empty($pages) ) {
        if ( $r['title_li'] )
            $output .= '<li class="pagenav">' . $r['title_li'] . '<ul>';

        global $wp_query;
        if ( ($r['post_type'] == get_query_var('post_type')) || is_attachment() )
            $current_page = $wp_query->get_queried_object_id();
        $output .= walk_page_tree($pages, $r['depth'], $current_page, $r);

        if ( $r['title_li'] )
            $output .= '</ul></li>';
    }

    $output = apply_filters('wp_list_pages', $output, $r);

    if ( $r['echo'] )
        echo $output;
    else
        return $output;
}
?>