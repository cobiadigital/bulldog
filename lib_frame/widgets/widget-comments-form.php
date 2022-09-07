<?php
/**
 * Comments Form Widget
 *
 */

// WIDGET CLASS
class Bizz_Widget_Comments_Form extends WP_Widget {
	
	function Bizz_Widget_Comments_Form() {
		$widget_ops = array( 'classname' => 'bizz-comments-form', 'description' => __( 'Display customized Comment form for current single post', 'comments-loop' ) );
		$control_ops = array( 'width' => 520, 'height' => 350, 'id_base' => 'bizz-comments-form' );
		$this->WP_Widget( 'bizz-comments-form', 'Comments Form', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $post;
		
		// Will not display the comments template if not on single post or page
		if ( !is_singular() OR empty($post) )
			return false;
		
		$form_args = array_merge( $args, $instance );

		bizz_comment_form( $form_args );
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		
		// Checkboxes
		$instance['req'] = $new_instance['req'] ? true : false;
		
		// update $instance with $new_instance;
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 
		    'req' => true, 'req_str' => __( '(required)', 'bizzthemes' ), 
			'name' => __( 'Name', 'comments-loop' ), 
			'email' => __( 'Mail (will not be published)', 'bizzthemes' ), 
			'url' => __( 'Website', 'comments-loop' ),
			'must_log_in' => __( 'You must be <a href="%s">logged in</a> to post a comment.', 'bizzthemes' ),
			'logged_in_as' => __( 'Logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out &raquo;</a>', 'bizzthemes' ),
			'title_reply' => __( 'Leave a Reply', 'bizzthemes' ), 
			'title_reply_to' => __( 'Leave a Reply to %s', 'bizzthemes' ), 
			'cancel_reply_link' => __( 'Click here to cancel reply.', 'bizzthemes' ), 
			'label_submit' => __( 'Submit Comment', 'bizzthemes' ),
			'title_reply_tag' => 'h3',
			'comments_closed' => __( 'Comments are closed.', 'bizzthemes' )
		);
			
		$instance = wp_parse_args( $instance, $defaults );
		$tags = array( 'h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'h5' => 'h5', 'h6' => 'h6', 'p' => 'p', 'span' => 'span', 'div' => 'div' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title_reply_tag' ); ?>">Reply headline tag</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'title_reply_tag' ); ?>" name="<?php echo $this->get_field_name( 'title_reply_tag' ); ?>">
				<?php foreach ( $tags as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['title_reply_tag'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'req' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['req'], true ); ?> id="<?php echo $this->get_field_id( 'req' ); ?>" name="<?php echo $this->get_field_name( 'req' ); ?>" /> <?php _e( 'Require name and email', 'bizzthemes'); ?></label>
		</p>
		<p>
			<br/><label><span class="translate">Translations</span></label>
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo esc_attr($instance['name']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_attr($instance['email']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo esc_attr($instance['url']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'req_str' ); ?>" name="<?php echo $this->get_field_name( 'req_str' ); ?>" value="<?php echo esc_attr($instance['req_str']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'label_submit' ); ?>" name="<?php echo $this->get_field_name( 'label_submit' ); ?>" value="<?php echo esc_attr($instance['label_submit']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'must_log_in' ); ?>" name="<?php echo $this->get_field_name( 'must_log_in' ); ?>" value="<?php echo esc_attr($instance['must_log_in']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'logged_in_as' ); ?>" name="<?php echo $this->get_field_name( 'logged_in_as' ); ?>" value="<?php echo esc_attr($instance['logged_in_as']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'title_reply' ); ?>" name="<?php echo $this->get_field_name( 'title_reply' ); ?>" value="<?php echo esc_attr($instance['title_reply']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'title_reply_to' ); ?>" name="<?php echo $this->get_field_name( 'title_reply_to' ); ?>" value="<?php echo esc_attr($instance['title_reply_to']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'cancel_reply_link' ); ?>" name="<?php echo $this->get_field_name( 'cancel_reply_link' ); ?>" value="<?php echo esc_attr($instance['cancel_reply_link']); ?>" />
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'comments_closed' ); ?>" name="<?php echo $this->get_field_name( 'comments_closed' ); ?>" value="<?php echo esc_attr($instance['comments_closed']); ?>" />
		</p>
		<div style="clear:both;">&nbsp;</div>
		<?php
	}
}

// INITIATE WIDGET
register_widget( 'Bizz_Widget_Comments_Form' );

// CUSTOM COMMENTS FUNCTIONS

/**
 * Outputs a complete commenting form for use within a template.
 * Most strings and form fields may be controlled through the $args array passed
 * into the function, while you may also choose to use the comments_form_default_fields
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the form comments_form_field_$name where $name is the key used
 * in the array of fields.
 *
 * @since 3.0 
 * @param array $args Options for strings, fields etc in the form
 * @param mixed $post_id Post ID to generate the form for, uses the current post if null
 * @return void
 */
function bizz_comment_form( $form_args = array(), $post_id = null ) {
	global $user_identity, $id;
		
	if ( null === $post_id )
		$post_id = $id;
	else
		$id = $post_id;
	
	$commenter = wp_get_current_commenter();
	
	$req = $form_args['req'];
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$req_str  = ( $req ? ' ' . $form_args['req_str'] : '' );
	
	$args = array( 
	    'fields' => apply_filters( 
		    'comment_form_default_fields', array( 
		        'author' => '<input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" size="22" tabindex="1"' . $aria_req . ' /> <label for="author"><small>' . $form_args['name'] . $req_str . '</small></label>', 
				'email'  => '<input type="text" name="email" id="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="22" tabindex="2"' . $aria_req . ' /> <label for="email"><small>' . $form_args['email'] . $req_str . '</small></label>', 
				'url'    => '<input type="text" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="22" tabindex="3" /> <label for="url"><small>' . $form_args['url'] . '</small></label>' 
		    ) 
		),
		'comment_field' => '<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>', 
		'must_log_in' => '<p class="must_log_in">' .  sprintf( $form_args['must_log_in'], wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>', 
		'logged_in_as' => '<p class="logged_in_as">' . sprintf( $form_args['logged_in_as'], admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>', 
		'id_form' => 'commentform', 
		'id_submit' => 'submit', 
		'title_reply' => $form_args['title_reply'], 
		'title_reply_to' => $form_args['title_reply_to'], 
		'cancel_reply_link' => $form_args['cancel_reply_link'], 
		'label_submit' => $form_args['label_submit'],
	);
	
//	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );
		if ( comments_open() ) :
		    echo '<div id="comments-form-'. $post_id .'" class="widget-comments-form">';
			    do_action( 'comment_form_before' );				
?>
				<div id="respond">
<?php
				echo $form_args['before_widget'];
				
				// Title				
				echo "<{$form_args['title_reply_tag']} class=\"title-reply\">";
				comment_form_title( $args['title_reply'], $args['title_reply_to'] );
				echo "</{$form_args['title_reply_tag']}>";
?>
				<div class="cancel-comment-reply">
				    <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small>
				</div>
				
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo $args['logged_in_as']; ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo '<p class="commpadd">' . apply_filters( "comment_form_field_{$name}", $field ) . "</p>\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<p>
							<button class="btn" name="submit" type="submit" id="submit" tabindex="<?php echo ( count( $args['fields'] ) + 2 ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>"><span><span><?php echo stripslashes(__('Add Comment', 'bizzthemes')); ?></span></span></button>
							<?php comment_id_fields(); ?>
						</p>
						<?php do_action( 'comments_form', $post_id ); ?>
					</form>
				<?php endif; ?>
				
				<?php echo $form_args['after_widget']; ?>
				
				</div>
				
				<?php do_action( 'comment_form_after' );
			echo '</div>';

		else : // comments are closed
		
			echo '<!-- If comments are closed. -->';
			if ( $form_args['comments_closed'] ){
				echo $form_args['before_widget'];
				echo '<p class="comments-closed">'. $form_args['comments_closed'] .'</p>';
				echo $form_args['after_widget'];
			}

			do_action( 'comment_form_comments_closed' );
		endif;
}
