<?php
/**
 * Comments Loop Widget
 *
 * @since 0.1
 */

// WIDGET CLASS
class Bizz_Widget_Comments_Loop extends WP_Widget {
	
	function Bizz_Widget_Comments_Loop() {
		$widget_ops = array( 'classname' => 'bizz-comments-loop', 'description' => __( 'Display customized comments list for current single post', 'bizzthemes' ) );
		$control_ops = array( 'width' => 500, 'height' => 350, 'id_base' => 'bizz-comments-loop' );
		$this->WP_Widget( 'bizz-comments-loop', 'Comments Loop', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		global $wpdb, $wp_query, $post, $user_ID;
				
		// local variables, soon to be populated
		global $comment, $overridden_bizzpage;
		
		// Will not display the comments template if not on single post or page, or if the post does not have comments.
		if ( !is_singular() OR empty($post) OR '0' == $post->comment_count )
			return false;

		// Comment author information fetched from the comment cookies.
		$commenter = wp_get_current_commenter();
		
		// The name of the current comment author escaped for use in attributes.
		$comment_author = $commenter['comment_author']; // Escaped by sanitize_comment_cookies()

		// The email address of the current comment author escaped for use in attributes.
		$comment_author_email = $commenter['comment_author_email'];  // Escaped by sanitize_comment_cookies()

		// The url of the current comment author escaped for use in attributes.
		$comment_author_url = esc_url($commenter['comment_author_url']);
		
		// allow widget to override $post->ID
		$post_id = $post->ID;	
		
		// Grabs the comments for the $post->ID from the db.
		if ( $user_ID ) {
			$comments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND (comment_approved = '1' OR ( user_id = %d AND comment_approved = '0' ) )  ORDER BY comment_date_gmt", $post_id, $user_ID));
		} else if ( empty($comment_author) ) {
			$comments = get_comments( array('post_id' => $post_id, 'status' => 'approve', 'order' => 'ASC') );
		} else {
			$comments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND ( comment_approved = '1' OR ( comment_author = %s AND comment_author_email = %s AND comment_approved = '0' ) ) ORDER BY comment_date_gmt", $post_id, wp_specialchars_decode($comment_author,ENT_QUOTES), $comment_author_email));
		}
		
		// Adds the comments retrieved from the db into the main $wp_query
		$wp_query->comments = apply_filters( 'comments_array', $comments, $post_id );
		
		// keep $comments for legacy's sake
		$comments = &$wp_query->comments;
		
		// Set the comment count
		$wp_query->comment_count = count($wp_query->comments);
		
		// Update the cache
		update_comment_cache( $wp_query->comments );
		
		// Paged comments
		$overridden_bizzpage = FALSE;
		if ( '' == get_query_var('bizzpage') && get_option('page_comments') ) {
			set_query_var( 'bizzpage', 'newest' == get_option('default_comments_page') ? get_comment_pages_count() : 1 );
			$overridden_bizzpage = TRUE;
		}
		
		/**//**/// All the preliminary work is complete. Let's get down to business...
		$wp_list_comments_args = array();
		$wp_list_comments_args['type'] = $instance['type'];
		$wp_list_comments_args['reply_text'] = (string) $instance['reply_text'];
		$wp_list_comments_args['login_text'] = (string) $instance['login_text'];
		$wp_list_comments_args['max_depth'] = (int) $instance['max_depth'];
		$wp_list_comments_args['enable_reply'] = $instance['enable_reply'];
		$wp_list_comments_args['comment_meta'] = $instance['comment_meta'];
		$wp_list_comments_args['comment_moderation'] = $instance['comment_moderation'];
		$wp_list_comments_args['callback'] = 'bizz_comments_loop_callback';
		$wp_list_comments_args['password_text'] = $instance['password_text'];
		$wp_list_comments_args['pass_protected_text'] = $instance['pass_protected_text'];
		$wp_list_comments_args['sing_comment_text'] = $instance['sing_comment_text'];
		$wp_list_comments_args['plu_comment_text'] = $instance['plu_comment_text'];
		$wp_list_comments_args['sing_trackback_text'] = $instance['sing_trackback_text'];
		$wp_list_comments_args['plu_trackback_text'] = $instance['plu_trackback_text'];
		$wp_list_comments_args['sing_pingback_text'] = $instance['sing_pingback_text'];
		$wp_list_comments_args['plu_pingback_text'] = $instance['plu_pingback_text'];
		$wp_list_comments_args['sing_ping_text'] = $instance['sing_ping_text'];
		$wp_list_comments_args['plu_ping_text'] = $instance['plu_ping_text'];
		$wp_list_comments_args['no_text'] = $instance['no_text'];
		$wp_list_comments_args['to_text'] = $instance['to_text'];
		$paginate_comments_links = paginate_comments_links( array('echo' => false) );
		$wp_list_comments_args['reverse_top_level'] = $instance['reverse_top_level'];
		$comment_type = 'all' == $instance['type'] ? 'comment' : $instance['type'];
		$type_plural = 'pings' == $comment_type ? $comment_type : "{$comment_type}s";
		$type_singular = 'pings' == $comment_type ? 'ping' : $comment_type;
		
		($type_plural=='comments') ? $type_plural=$wp_list_comments_args['plu_comment_text'] : $type_plural=$type_plural;
		($type_plural=='trackbacks') ? $type_plural=$wp_list_comments_args['plu_trackback_text'] : $type_plural=$type_plural;
		($type_plural=='pingbacks') ? $type_plural=$wp_list_comments_args['plu_pingback_text'] : $type_plural=$type_plural;
		($type_plural=='pings') ? $type_plural=$wp_list_comments_args['plu_ping_text'] : $type_plural=$type_plural;
		
		($type_plural=='comment') ? $type_plural=$wp_list_comments_args['sing_comment_text'] : $type_plural=$type_plural;
		($type_plural=='trackback') ? $type_plural=$wp_list_comments_args['sing_trackback_text'] : $type_plural=$type_plural;
		($type_plural=='pingback') ? $type_plural=$wp_list_comments_args['sing_pingback_text'] : $type_plural=$type_plural;
		($type_plural=='ping') ? $type_plural=$wp_list_comments_args['sing_ping_text'] : $type_plural=$type_plural;
				
		// Check to see if post is password protected
		if ( post_password_required() ) {
			echo "<{$instance['comment_header']}>".$wp_list_comments_args['password_text']."</{$instance['comment_header']}>";
			echo '<p class="'. $post->post_type .'_password_required">'. $post->post_type . $wp_list_comments_args['pass_protected_text'] .'</p>';
			do_action( "{$post->post_type}_password_required" );
			return false;
		}
		
		echo '<div id="bizz-comments-loop-'. $post_id .'" class="widget-bizz-comments-loop">';
		
		/* Open the output of the widget. */
		echo $args['before_widget'];
		
		// If we have comments
		if ( have_comments() ) :
			
			do_action( "before_{$comment_type}_div" );
			
			$div_id = ( 'comment' == $comment_type ) ? 'comments' : $comment_type;
			echo '<div id="'. $div_id .'">'; // div#comments
			
			$title = the_title( '&#8220;', '&#8221;', false );
			$local_comments = $comments;
			$_comments_by_type = &separate_comments( $local_comments );
			
			echo "<{$instance['comment_header']} id=\"comments-number\" class=\"comments-header\">";
			bizz_comments_number( "".$wp_list_comments_args['no_text']." $type_plural ".$wp_list_comments_args['to_text']." $title", "1 $type_singular ".$wp_list_comments_args['to_text']." $title", "% $type_plural ".$wp_list_comments_args['to_text']." $title", $instance['type'], $_comments_by_type );
			echo "</{$instance['comment_header']}>";
			
			unset( $local_comments, $_comments_by_type );
			?>

			<?php if ( $instance['enable_pagination'] and get_option( 'page_comments' ) and $paginate_comments_links ) : ?>
			<div class="comment-navigation paged-navigation">
				<?php echo $paginate_comments_links; ?>
				<?php do_action( "{$comment_type}_pagination" ); ?>
			</div><!-- .comment-navigation -->
			<?php endif; ?>
			
			<?php do_action( "before_{$comment_type}_list" ); ?>

			<ol class="commentlist">
			<?php wp_list_comments( $wp_list_comments_args ); ?>
			</ol>
			
			<?php do_action( "after_{$comment_type}_list" ); ?>

			<?php if ( $instance['enable_pagination'] and get_option( 'page_comments' ) and $paginate_comments_links ) : ?>
			<div class="comment-navigation paged-navigation">
				<?php echo $paginate_comments_links; ?>
				<?php do_action( "{$comment_type}_pagination" ); ?>
			</div><!-- .comment-navigation -->
			<?php endif;
			
			do_action( "after_{$comment_type}_div" );
			
		echo '</div>'; // div#comments

		endif;
		
		/* Close the output of the widget. */
		echo $args['after_widget'];
				
		echo '</div>';
		
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		
		// Checkboxes
		$instance['enable_pagination'] = $new_instance['enable_pagination'] ? true : false;
		$instance['enable_reply'] = $new_instance['enable_reply'] ? true : false;
		$instance['reverse_top_level'] = $new_instance['reverse_top_level'] ? true : false;
		$instance['comments_closed'] = esc_html( $new_instance['comments_closed'] );
				
		// update $instance with $new_instance;
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array( 
		    'max_depth' => get_option('thread_comments_depth'), 
			'type' => 'all',
			'enable_pagination' => true, 
			'enable_reply' => true, 
			'comment_header' => 'h3', 
			'reverse_top_level' => false, //'reverse_children' => false,
			'reply_text' => 'Reply', 
			'login_text' => 'Log in to Reply', 
			'comment_meta' => '[author] [date before="| "] [link before="| "] [edit before="| "]',
			'comment_moderation' => 'Your comment is awaiting moderation.',
			'password_text' => 'Password Protected',
			'pass_protected_text' => 'is password protected. Enter the password to view comments.',
			'sing_comment_text' => 'comment',
			'plu_comment_text' => 'comments',
			'sing_trackback_text' => 'trackback',
			'plu_trackback_text' => 'trackbacks',
			'sing_pingback_text' => 'pingback',
			'plu_pingback_text' => 'pingbacks',
			'sing_ping_text' => 'ping',
			'plu_ping_text' => 'pings',
			'no_text' => 'No',
			'to_text' => 'to'
		);
		$instance = wp_parse_args( $instance, $defaults );
		$tags = array( 'h1' => 'h1', 'h2' => 'h2', 'h3' => 'h3', 'h4' => 'h4', 'h5' => 'h5', 'h6' => 'h6', 'p' => 'p', 'span' => 'span', 'div' => 'div' );
		$type = array( 'all' => 'All', 'comment' => 'Comments', 'trackback' => 'Trackbacks', 'pingback' => 'Pingbacks', 'pings' => 'Trackbacks and Pingbacks' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Comment type</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>">
				<?php foreach ( $type as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['type'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_header' ); ?>">Comment header</label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'comment_header' ); ?>" name="<?php echo $this->get_field_name( 'comment_header' ); ?>">
				<?php foreach ( $tags as $option_value => $option_label ) { ?>
					<option value="<?php echo $option_value; ?>" <?php selected( $instance['comment_header'], $option_value ); ?>><?php echo $option_label; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_meta' ); ?>">Comment meta</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'comment_meta' ); ?>" name="<?php echo $this->get_field_name( 'comment_meta' ); ?>" value="<?php echo esc_attr($instance['comment_meta']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'max_depth' ); ?>">Max depth</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'max_depth' ); ?>" name="<?php echo $this->get_field_name( 'max_depth' ); ?>" value="<?php echo $instance['max_depth']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_pagination' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['enable_pagination'], true ); ?> id="<?php echo $this->get_field_id( 'enable_pagination' ); ?>" name="<?php echo $this->get_field_name( 'enable_pagination' ); ?>" /> <?php _e( 'Enable pagination', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_reply' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['enable_reply'], true ); ?> id="<?php echo $this->get_field_id( 'enable_reply' ); ?>" name="<?php echo $this->get_field_name( 'enable_reply' ); ?>" /> <?php _e( 'Enable comment reply', 'bizzthemes'); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'reverse_top_level' ); ?>">
			<input class="checkbox" type="checkbox" <?php checked( $instance['reverse_top_level'], true ); ?> id="<?php echo $this->get_field_id( 'reverse_top_level' ); ?>" name="<?php echo $this->get_field_name( 'reverse_top_level' ); ?>" /> <?php _e( 'Reverse the comment order', 'bizzthemes'); ?></label>
		</p>
		<p>
			<br/><label><span class="translate">Translations</span></label>
		</p>
		<p>
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'comment_moderation' ); ?>" name="<?php echo $this->get_field_name( 'comment_moderation' ); ?>" value="<?php echo $instance['comment_moderation']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'reply_text' ); ?>" name="<?php echo $this->get_field_name( 'reply_text' ); ?>" value="<?php echo $instance['reply_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'login_text' ); ?>" name="<?php echo $this->get_field_name( 'login_text' ); ?>" value="<?php echo $instance['login_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'password_text' ); ?>" name="<?php echo $this->get_field_name( 'password_text' ); ?>" value="<?php echo $instance['password_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'pass_protected_text' ); ?>" name="<?php echo $this->get_field_name( 'pass_protected_text' ); ?>" value="<?php echo $instance['pass_protected_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'sing_comment_text' ); ?>" name="<?php echo $this->get_field_name( 'sing_comment_text' ); ?>" value="<?php echo $instance['sing_comment_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'plu_comment_text' ); ?>" name="<?php echo $this->get_field_name( 'plu_comment_text' ); ?>" value="<?php echo $instance['plu_comment_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'sing_trackback_text' ); ?>" name="<?php echo $this->get_field_name( 'sing_trackback_text' ); ?>" value="<?php echo $instance['sing_trackback_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'plu_trackback_text' ); ?>" name="<?php echo $this->get_field_name( 'plu_trackback_text' ); ?>" value="<?php echo $instance['plu_trackback_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'sing_pingback_text' ); ?>" name="<?php echo $this->get_field_name( 'sing_pingback_text' ); ?>" value="<?php echo $instance['sing_pingback_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'plu_pingback_text' ); ?>" name="<?php echo $this->get_field_name( 'plu_pingback_text' ); ?>" value="<?php echo $instance['plu_pingback_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'sing_ping_text' ); ?>" name="<?php echo $this->get_field_name( 'sing_ping_text' ); ?>" value="<?php echo $instance['sing_ping_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'plu_ping_text' ); ?>" name="<?php echo $this->get_field_name( 'plu_ping_text' ); ?>" value="<?php echo $instance['plu_ping_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'no_text' ); ?>" name="<?php echo $this->get_field_name( 'no_text' ); ?>" value="<?php echo $instance['no_text']; ?>" />
			<input type="text" class="widefat spb tog" id="<?php echo $this->get_field_id( 'to_text' ); ?>" name="<?php echo $this->get_field_name( 'to_text' ); ?>" value="<?php echo $instance['to_text']; ?>" />
		</p>
		<div style="clear:both;">&nbsp;</div>
		<?php
	}
}

// INITIATE WIDGET
register_widget( 'Bizz_Widget_Comments_Loop' );

// CUSTOM COMMENTS FUNCTIONS
/**
 * Custom Loop callback for wp_list_comments()
 *
 * @since 0.1
 **/
function bizz_comments_loop_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$GLOBALS['comment_depth'] = $depth;
	
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	} ?>
	
	<li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>">
	
	<?php do_action( "before_{$args['type']}" ); ?>
	
	<div id="div-comment-<?php comment_ID(); ?>" class="comment-container">
	
	    <div class="avatar-wrap">
			<?php echo get_avatar( $comment, 48, BIZZ_THEME_IMAGES .'/gravatar.png' ); ?>
		</div><!-- /.meta-wrap -->
		
		<div class="text-right">
		
			<div class="comm-reply <?php if (1 == $comment->user_id) echo "authcomment"; ?>">
				<?php echo bizz_comment_meta( $args['comment_meta'] ); ?>
				<?php if ( $args['enable_reply'] ): ?>
				    <span class="fr">
				    <?php comment_reply_link( array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'])) ); ?>
					</span>
				<?php endif; ?>
			</div><!-- /.comm-reply -->
							
			<div class="comment-entry">
			    <?php comment_text() ?>
				<?php if ( '0' == $comment->comment_approved ) : ?>
				    <p class="comment-moderation"><?php _e( $args['comment_moderation'], 'bizzthemes' ); ?></p>
				<?php endif; ?>
			</div><!-- /.comment-entry -->
			
		</div><!-- /.text-right -->
			
	</div><!-- /.comment-container -->
	
<?php
	
	do_action( "after_{$args['type']}" );
}

/**
 * Display the language string for the number of comments the current post has.
 *
 * @since 0.71
 * @uses $id
 * @uses apply_filters() Calls the 'comments_number' hook on the output and number of comments respectively.
 *
 * @param string $zero Text for no comments
 * @param string $one Text for one comment
 * @param string $more Text for more than one comment
 * @param string $type Comment Type
 * @param array $comments Comments by type
 */
function bizz_comments_number( $zero = false, $one = false, $more = false, $type = 'all', $comments ) {
	if ( 'all' == $type ) {
		$number = count( $comments['comment'] ) + count( $comments['pings'] );
	} else {
		$number = count($comments[$type]);
	}

	if ( $number > 1 )
		$output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', 'bizzthemes') : $more);
	elseif ( $number == 0 )
		$output = ( false === $zero ) ? __('No Comments', 'bizzthemes') : $zero;
	else // must be one
		$output = ( false === $one ) ? __('One Comment', 'bizzthemes') : $one;

	echo apply_filters('comments_number', $output, $number);
}

/**
 * Process any shortcodes applied to $content
 *
 * @since 0.1
 **/
function bizz_comment_meta( $content ) {
	$content = preg_replace( '/\[(.+?)\]/', '[comment_$1]', $content );
	return apply_filters( 'bizz_comment_meta', do_shortcode( $content ) );
}

/**
 * Displays the author's avatar and the author's name/link
 *
 * @since 0.1
 **/
function bizz_comment_author_avatar( $comment, $args ) { ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 )
		echo get_avatar( $comment, $args['avatar_size'] );
	?>
		<cite class="fn"><?php echo bizz_comment_author(); ?></cite>
	</div>
	<?php
}

/**
 * Returns the author's name/link microformatted
 *
 * @since 0.1
 **/
function bizz_comment_author( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '' );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );
	
	$author = esc_html( get_comment_author() );
	$url = esc_url( get_comment_author_url() );

	/* Display link and cite if URL is set. Also, properly cites trackbacks/pingbacks. */
	if ( $url )
		$output = '<cite class="fn" title="' . $url . '"><a href="' . $url . '" title="' . $author . '" class="url" rel="external nofollow">' . $author . '</a></cite>';
	else
		$output = '<cite class="fn">' . $author . '</cite>';

	$output = '<span class="comment-author vcard">' . apply_filters( 'get_comment_author_link', $output ) . '</span>';

	return apply_filters( 'bizz_comment_author', $before . $output . $after );
}

/**
 * Displays the comment date
 *
 * @since 0.1
 */
function bizz_comment_date( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '' );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );
	
	$output = '<abbr class="comment-date" title="' . get_comment_date(get_option('date_format')) . '">' . get_comment_date() . '</abbr>';
	
	return apply_filters( 'bizz_comment_date', $before . $output . $after );
}

/**
 * Displays the comment time
 *
 * @since 0.1
 */
function bizz_comment_time( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '' );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );
	
	$output = '<span class="comment-time"><abbr title="' . get_comment_date( __( 'g:i a', 'bizzthemes' ) ) . '">' . get_comment_time() . '</abbr></span>';
	
	return apply_filters( 'bizz_comment_time', $before . $output . $after );
}

/**
 * Displays the comment count
 *
 * @since 0.1
 **/
function bizz_comment_count( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '' );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );
	
	global $comment_count;
	
	if ( !isset($comment_count) )
		$comment_count = 1;
	
	$comment_type = get_comment_type();
	
	$output = "<span class=\"$comment_type-count\">$comment_count</span>";
	
	$comment_count++;
	
	return apply_filters( 'bizz_comment_count', $before . $output . $after );
}

/**
 * Displays a list of comma seperated tags
 *
 * @since 0.1
 **/
function bizz_comment_link( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '', 'label' => __( 'Permalink', 'bizzthemes' ) );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );

	$output = '<span class="comment-permalink"><a href="' . esc_url(get_comment_link()) . '" title="' . sprintf( __( 'Permalink to %1$s %2$s', 'bizzthemes' ), get_comment_type(), get_comment_ID() ) . '">' . $label . '</a></span>';

	return apply_filters( 'bizz_comment_link', $before . $output . $after );
}

/**
 * Comment Reply link
 *
 * @since 0.1
 */
function bizz_comment_reply( $atts = array() ) {
	$defaults = array(
		'reply_text' => __( 'Reply', 'bizzthemes' ),
		'login_text' => __( 'Log in to reply.', 'bizzthemes' ),
		'depth' => $GLOBALS['comment_depth'],
		'max_depth' => get_option( 'thread_comments_depth' ),
		'before' => '',
		'after' => ''
	);
	$args = shortcode_atts( $defaults, $args );

	if ( !get_option( 'thread_comments' ) || 'comment' !== get_comment_type() )
		return '';

	return get_comment_reply_link( $args );
}

/**
 * Comment Edit link
 *
 * @since 0.1
 **/
function bizz_comment_edit( $atts = array() ) {
	$defaults = array( 'before' => '', 'after' => '', 'label' => __( 'Edit', 'bizzthemes' ) );
	$args = shortcode_atts( $defaults, $atts );
	extract( $args, EXTR_SKIP );
	
	$edit_link = get_edit_comment_link( get_comment_ID() );

	if ( !$edit_link )
		return '';

	$output = '<span class="comment-edit"><a href="' . $edit_link . '" title="' . $label . '">' . $label . '</a></span>';
	
	return apply_filters( 'bizz_comment_edit', $before . $output . $after );
}

// Shortcodes
add_shortcode( 'comment_author', 'bizz_comment_author' );
add_shortcode( 'comment_date', 'bizz_comment_date' );
add_shortcode( 'comment_time', 'bizz_comment_time' );
add_shortcode( 'comment_count', 'bizz_comment_count' );
add_shortcode( 'comment_link', 'bizz_comment_link' );
add_shortcode( 'comment_reply', 'bizz_comment_reply' );
add_shortcode( 'comment_edit', 'bizz_comment_edit' );
