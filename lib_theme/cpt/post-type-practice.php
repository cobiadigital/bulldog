<?php

/*

  FILE STRUCTURE:

- Custom Post Type icons
- Custom Post Type init
- Columns for post types
- Post type demo posts
- Custom Post Type Metabox Setup

*/

/* Custom post type icons */
/*------------------------------------------------------------------*/
function bizz_practices_post_types_icons() {
?>
	<style type="text/css" media="screen">
        #menu-posts-bizz_practice .wp-menu-image, #menu-posts-bizzpractice .wp-menu-image {
			background: url(<?php echo get_template_directory_uri() ?>/lib_theme/cpt/icons-practice.png) no-repeat 6px -17px !important;
		}
		#menu-posts-bizz_practice:hover .wp-menu-image, #menu-posts-bizzpractice.wp-has-current-submenu .wp-menu-image {
			background-position:6px 7px!important;
		}
    </style>
<?php 
}
add_action( 'admin_head', 'bizz_practices_post_types_icons' );

/* Custom post type init */
/*------------------------------------------------------------------*/
function bizz_practices_post_types_init() {

	register_post_type( 'bizz_practice',
        array(
        	'label' 				=> __('Practices', 'bizzthemes'),
			'labels' 				=> array(	
				'name' 					=> __('Practices', 'bizzthemes'),
				'singular_name' 		=> __('Practice', 'bizzthemes'),
				'add_new' 				=> __('Add New', 'bizzthemes'),
				'add_new_item' 			=> __('Add New Practice', 'bizzthemes'),
				'edit' 					=> __('Edit', 'bizzthemes'),
				'edit_item' 			=> __('Edit Practice', 'bizzthemes'),
				'new_item' 				=> __('New Practice', 'bizzthemes'),
				'view_item'				=> __('View Practice', 'bizzthemes'),
				'search_items' 			=> __('Search Practice', 'bizzthemes'),
				'not_found' 			=> __('No Practices found', 'bizzthemes'),
				'not_found_in_trash' 	=> __('No Practices found in trash', 'bizzthemes'),
				'parent' 				=> __('Parent Practice', 'bizzthemes' ),				
			),
            'description' => __( 'This is where you can create new practices for your site.', 'bizzthemes' ),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'page',
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'practice', 'with_front' => false ),
            'query_var' => true,
            'has_archive' => false,
            'supports' => array(	
				'title', 
				'editor', 
				'comments',
				'custom-fields', 
				'page-attributes'	
			),
        )
    );

}
add_action( 'init', 'bizz_practices_post_types_init' );

/* Columns for post types */
/*------------------------------------------------------------------*/
function bizz_practices_edit_columns($columns){
	$columns = array(
		"cb" 					=> "<input type=\"checkbox\" />",
		"title" 				=> "Practice Title",
		"author" 				=> "Author",
		"comments" 				=> '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>',
		"date"					=> "Date"
	);
	return $columns;
}
add_filter('manage_edit-bizz_practices_columns','bizz_practices_edit_columns');

function bizz_practices_custom_columns($column){
	global $post;
	switch ($column){
		case "author":
			the_author();
		break;
	}
}
add_action('manage_posts_custom_column', 'bizz_practices_custom_columns', 2);

/* Post type demo posts */
/*------------------------------------------------------------------*/
function bizz_practices_demo_posts() {
	
	if (get_option('bizz_install_parents_complete') != 'true') {

		// INSERT POSTS
		$demo_post = array(
				"post_title"	=>	'Defective/Dangerous Products',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_practice',
				"post_content"	=>	'
		At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
				'
				
		);
		wp_insert_post( $demo_post );
		
		$demo_post = array(
				"post_title"	=>	'Employee Discrimination',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_practice',
				"post_content"	=>	'
		At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
				'
		);
		$parent_post_1 = wp_insert_post( $demo_post );
		
			$demo_post = array(
					"post_title"	=>	'Pregnancy Rights',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_1,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
			
			$demo_post = array(
					"post_title"	=>	'Age Discrimination',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_1,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
			
			$demo_post = array(
					"post_title"	=>	'Race / National Origin',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_1,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
		
		$demo_post = array(
				"post_title"	=>	'Personal Injury / Serious Injury',
				"post_status"	=>	'publish',
				"post_type"	    =>	'bizz_practice',
				"post_content"	=>	'
		At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
				'
		);
		$parent_post_2 = wp_insert_post( $demo_post );
		
			$demo_post = array(
					"post_title"	=>	'Burn Injuries',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_2,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
			
			$demo_post = array(
					"post_title"	=>	'Medical Negligence',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_2,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
			
			$demo_post = array(
					"post_title"	=>	'Motor Vehicle Accident',
					"post_status"	=>	'publish',
					"post_type"	    =>	'bizz_practice',
					"post_parent"	=>	$parent_post_2,
					"post_content"	=>	'
			At vero eos et accusamus et iusto odio dignissimos ducimus qui  blanditiis praesentium voluptatum deleniti atque corrupti quos dolores  et quas molestias excepturi sint occaecati cupiditate non provident,  similique sunt in culpa qui officia deserunt mollitia animi, id est  laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita  distinctio. Nam libero tempore, cum soluta nobis est eligendi optio  cumque nihil impedit quo minus id quod maxime placeat facere possimus,  omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem  quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet  ut et voluptates repudiandae sint et molestiae non recusandae. Itaque  earum rerum hic tenetur a sapiente delectus, ut aut reiciendis  voluptatibus maiores alias consequatur aut perferendis doloribus  asperiores repellat.
					'
			);
			wp_insert_post( $demo_post );
		
		//installation complete
		update_option('bizz_install_parents_complete', 'true');
	}
	
}
add_action( 'init', 'bizz_practices_demo_posts' );


/* Post type demo posts */
/*------------------------------------------------------------------*/
// empty

