<?php
/**
 * class bizz_custom_tools
 *
 * @package bizzthemes
 * @since 7.2.5
 */
class bizz_custom_tools {

	function manage_options() {
		global $bizzthemes_site, $wpdb, $themeid, $frameversion;
		
		if (isset($_POST['upload'])) {

			if ($_POST['upload'] == 'all') {
				check_admin_referer('bizzthemes-upload-all', '_wpnonce-bizzthemes-upload-all'); #wp				
				
				// DEFAULT OPTIONS
				$def_theme_id 			= $themeid;
				$def_frame_version 		= $frameversion;
				// UPLOADED OPTIONS
				$new_options 			= file_get_contents($_FILES['file']['tmp_name']);
				$new_options 			= unserialize($new_options);
				$new_theme_id 			= $new_options['theme_id'];
				$new_frame_version 		= $new_options['frame_version'];
				$new_options_id 		= $new_options['options_id'];
				
				if (function_exists('wp_cache_clean_cache')) { #wp
					global $file_prefix;
					wp_cache_clean_cache($file_prefix); #wp
				}
				
				// wrong file		
				$files_array = array('bizzthemes-layouts', 'bizzthemes-settings', 'bizzthemes-design');
				foreach ($files_array as $needle) {
					if (strpos($_FILES['file']['name'], $needle) === false)
						wp_redirect(admin_url('admin.php?page=bizz-tools&type=Layouts&error=wrongfile')); #wp
				}
				// file error
				if ($_FILES['file']['error'] > 0)
					wp_redirect(admin_url('admin.php?page=bizz-tools&type=All&error=file')); #wp
				else { 
				// all fine
					if ($new_options['options_id'] == 'layouts') {
						if (version_compare($def_frame_version, $new_frame_version, '!='))
							wp_redirect(admin_url("admin.php?page=bizz-tools&type=Layouts&error=version&tried=$new_frame_version&yours=$def_frame_version")); #wp
						elseif ($def_theme_id != $new_theme_id)
							wp_redirect(admin_url("admin.php?page=bizz-tools&type=Layouts&error=theme&tried=$new_theme_id&yours=$def_theme_id")); #wp
						else {
							// read options
							$new_all_widgets 		= $new_options['options_value']['all_widgets'];
							$new_sidebars_widgets 	= $new_options['options_value']['sidebars_widgets'];
							$new_widget_posts 		= ( isset($new_options['options_value']['widget_posts']) ) ? $new_options['options_value']['widget_posts'] : array();
							$new_grid_posts 		= ( isset($new_options['options_value']['grid_posts']) ) ? $new_options['options_value']['grid_posts'] : array();
							// reset old grids
							$query = "DELETE FROM $wpdb->posts WHERE post_type LIKE 'bizz_grid' OR post_type LIKE 'bizz_widget' ";
							$wpdb->query($query);
							// reset backed up widgets
							delete_option( $themeid . '_sidebars_widgets' );
							// update defaults option
							update_option('bizz_defaults_' . $themeid, true);
							// insert data
							bizzthemes_update_options( 'set_new', $new_all_widgets );
							bizzthemes_update_options( 'set_new', $new_sidebars_widgets );
							bizzthemes_insert_posts( 'set_new', array_merge($new_widget_posts, $new_grid_posts) );
							// redirect
							wp_redirect(admin_url('admin.php?page=bizz-tools&imported=true&type=Layouts')); #wp
						}
					}
					elseif ($new_options['options_id'] == 'settings') {
						if (version_compare($def_frame_version, $new_frame_version, '!='))
							wp_redirect(admin_url("admin.php?page=bizz-tools&type=Settings&error=version&tried=$new_frame_version&yours=$def_frame_version")); #wp
						else {
							// read options
							$new_options = $new_options['options_value'];
							// insert data
							update_option('bizzthemes_options', $new_options);
							// redirect
							wp_redirect(admin_url('admin.php?page=bizz-tools&imported=true&type=Settings')); #wp
						}
					}
					elseif ($new_options['options_id'] == 'design') {
						if (version_compare($def_frame_version, $new_frame_version, '!='))
							wp_redirect(admin_url("admin.php?page=bizz-tools&type=Design&error=version&tried=$new_frame_version&yours=$def_frame_version")); #wp
						elseif ($def_theme_id != $new_theme_id)
							wp_redirect(admin_url("admin.php?page=bizz-tools&type=Design&error=theme&tried=$new_theme_id&yours=$def_theme_id")); #wp
						else {
							// read options
							$new_options = $new_options['options_value'];
							// insert data
							update_option('bizzthemes_design', $new_options);
							// reset custom designs
							bizz_generate_css();
							// redirect
							wp_redirect(admin_url('admin.php?page=bizz-tools&imported=true&type=Design')); #wp
						}
					}
				}

			}
		}
		elseif (isset($_GET['download'])) {
			if ($_GET['download'] == 'layouts') {
				check_admin_referer('bizzthemes-download-layouts'); #wp
				header("Cache-Control: public, must-revalidate");
				header("Pragma: hack");
				header("Content-Type: text/plain");
				header('Content-Disposition: attachment; filename="bizzthemes-layouts-' . date("Y-m-d") . '.dat"');
					
				$widgets_array 			= bizz_get_active_widgets();
				$bizz_get_widget_posts 	= bizz_get_widget_posts();
				$bizz_get_grid_posts 	= bizz_get_grid_posts();

				echo (serialize(array(
					'theme_id' 			=> $themeid, 
					'frame_version' 	=> $frameversion, 
					'options_id'		=> 'layouts',
					'options_value' 	=> array(
						'all_widgets' 		=> $widgets_array,  
						'widget_posts'	 	=> $bizz_get_widget_posts,
						'grid_posts'		=> $bizz_get_grid_posts,
						'sidebars_widgets' 	=> array(
							'0'	=> array(
								'option_name' 	=> 'sidebars_widgets',
								'option_value' 	=> get_option('sidebars_widgets'),
								'type'		 	=> 'sidebars_widgets'
							)
						)
					)
				)));
				exit();
			}
			elseif ($_GET['download'] == 'settings') {
				check_admin_referer('bizzthemes-download-settings'); #wp
				header("Cache-Control: public, must-revalidate");
				header("Pragma: hack");
				header("Content-Type: text/plain");
				header('Content-Disposition: attachment; filename="bizzthemes-settings-' . date("Y-m-d") . '.dat"');

				echo (serialize(array(
					'theme_id' 			=> $themeid, 
					'frame_version' 	=> $frameversion,
					'options_id'		=> 'settings',
					'options_value' 	=> $GLOBALS['opt']
				)));
				exit();
			}
			elseif ($_GET['download'] == 'design') {
				check_admin_referer('bizzthemes-download-design'); #wp
				header("Cache-Control: public, must-revalidate");
				header("Pragma: hack");
				header("Content-Type: text/plain");
				header('Content-Disposition: attachment; filename="bizzthemes-design-' . date("Y-m-d") . '.dat"');

				echo (serialize(array(
					'theme_id' 			=> $themeid, 
					'frame_version' 	=> $frameversion,
					'options_id'		=> 'design',
					'options_value' 	=> $GLOBALS['optd']
				)));
				exit();
			}
		}
		elseif (isset($_GET['restore'])) {
			if ($_GET['restore'] == 'layouts') {
				check_admin_referer('bizzthemes-restore-layouts'); #wp
				
				// fire the engine
				$default_action = 'set_defaults';
				bizzthemes_default_layouts( $default_action );
				
				wp_redirect(admin_url('admin.php?page=bizz-tools&restored=true&type=Layouts')); #wp
			}
			if ($_GET['restore'] == 'layouts-blank') {
				check_admin_referer('bizzthemes-restore-layouts'); #wp
				
				// fire the engine
				$default_action = 'reset';
				bizzthemes_default_layouts( $default_action );
				
				wp_redirect(admin_url('admin.php?page=bizz-tools&blank=true&type=Layouts')); #wp
			}
			elseif ($_GET['restore'] == 'settings') {
				check_admin_referer('bizzthemes-restore-settings'); #wp
				
				$query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'bizzthemes_options' OR option_name LIKE '%pag_exclude%' OR option_name LIKE '%pst_exclude%' ";
				$wpdb->query($query);
		
				wp_redirect(admin_url('admin.php?page=bizz-tools&restored=true&type=Settings')); #wp
			}
			elseif ($_GET['restore'] == 'design') {
				check_admin_referer('bizzthemes-restore-design'); #wp
				
				$query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'bizzthemes_design' ";
				$wpdb->query($query);
				bizz_generate_css();
				
				wp_redirect(admin_url('admin.php?page=bizz-tools&restored=true&type=Design')); #wp
			}
		}
	}
	
	function status_check() {
		if (isset($_GET['error']) && $_GET['error'] == 'file') {
			echo "\t\t<div id=\"updated\" class=\"error\">\n";
			echo "\t\t\t<p>" . sprintf(__('<strong>Oh noez!</strong> There was an error with the file upload. Please try it again, or else download a new, valid %s Options file.', 'bizzthemes'), $_GET['type']) . "</p>\n";
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['error']) && $_GET['error'] == 'version') {
			global $bizzthemes_site;
			echo "\t\t<div id=\"updated\" class=\"error\">\n";
			echo "\t\t\t<p>" . sprintf(__('<strong>Whoa there!</strong> The %1$s you attempted to upload are from framework version <strong>%2$s</strong> and are not compatible with version <strong>%3$s.</strong>', 'bizzthemes'), $_GET['type'], $_GET['tried'], $_GET['yours']) . "</p>\n";
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['error']) && $_GET['error'] == 'theme') {
			global $bizzthemes_site;
			echo "\t\t<div id=\"updated\" class=\"error\">\n";
			echo "\t\t\t<p>" . sprintf(__('<strong>Whoa there!</strong> The %1$s you attempted to upload are from theme <strong>%2$s</strong> and are not compatible with theme <strong>%3$s.</strong>', 'bizzthemes'), $_GET['type'], $_GET['tried'], $_GET['yours']) . "</p>\n";
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['error']) && $_GET['error'] == 'wrongfile') {
			echo "\t\t<div id=\"updated\" class=\"error\">\n";
			echo "\t\t\t<p>" . sprintf(__('<strong>Whoops!</strong> The file you attempted to upload is not a valid %1$s file. Please try uploading the file again, or else download a new, valid %1$s Options file.', 'bizzthemes'), $_GET['type']) . "</p>\n";
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['blank']) && $_GET['blank']) {
			$options = ($_GET['type'] == 'All') ? 'All default bizzthemes options' : $_GET['type'] . '';
			echo "\t\t<div id=\"updated\" class=\"updated fade\">\n";
			echo "\t\t\t<p>" . sprintf(__('%1$s reset! <a href="%2$s">Check out your site &rarr;</a>', 'bizzthemes'), $options, home_url()) . "</p>\n"; #wp
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['restored']) && $_GET['restored']) {
			$options = ($_GET['type'] == 'All') ? 'All default bizzthemes options' : 'Default ' . $_GET['type'] . '';
			echo "\t\t<div id=\"updated\" class=\"updated fade\">\n";
			echo "\t\t\t<p>" . sprintf(__('%1$s restored! <a href="%2$s">Check out your site &rarr;</a>', 'bizzthemes'), $options, home_url()) . "</p>\n"; #wp
			echo "\t\t</div>\n";
		}
		elseif (isset($_GET['imported']) && $_GET['imported']) {
			echo "\t\t<div id=\"updated\" class=\"updated fade\">\n";
			echo "\t\t\t<p>" . sprintf(__('%1$s imported! <a href="%2$s">Check out your site &rarr;</a>', 'bizzthemes'), $_GET['type'], home_url()) . "</p>\n"; #wp
			echo "\t\t</div>\n";
		}
	}

	function bizzthemes_tools() {
		$rtl = (get_bloginfo('text_direction') == 'rtl') ? ' rtl' : ''; #wp
		echo "<div id=\"bizz_options\" class=\"wrap$rtl\">\n";
		
		// options header
		bizzthemes_options_header( $options_title = 'Tools', $toggle = false );
		
		echo "\t<h2>".__('Import &amp; Export Tools', 'bizzthemes')."</h2>\n";
		
		// check for errors
		bizz_custom_tools::status_check();		
?>	
	<p><?php _e('Howdy! Welcome to BizzThemes theme options exporter/importer tool.', 'bizzthemes'); ?></p>
	<p><?php _e('Once you have saved the .dat export file, you can use the Import options tool in another WordPress installation to import theme options.', 'bizzthemes'); ?></p>
	<p><?php printf( __('Notice: this tool does not export your site posts, pages, comments, custom fields, categories, and tags, use <a href="%s">WP Export</a> for that purpose.', 'bizzthemes'), 'export.php' ); ?></p>
	<div class="options_column">
		<h3><span><?php _e('Import options', 'bizzthemes'); ?></span></h3> 
		<div class="module_subsection">
			<h5><?php _e('Choose a file from your computer', 'bizzthemes'); ?></h5>
			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('bizzthemes-upload-all', '_wpnonce-bizzthemes-upload-all'); ?>
				<input type="hidden" name="upload" value="all" />
				<input type="file" class="text_input" name="file" id="all-options-file" />
				<p class="submit"><input type="submit" class="button-primary" value="Upload file and import" onclick="return confirm('<?php _e('Whoa there! Sure you want to override current options?', 'bizzthemes'); ?>');" /></p>
			</form>
		</div> 
	</div>
	<div class="options_column">
		<h3><span><?php _e('Export options', 'bizzthemes'); ?></span></h3> 
		<div class="module_subsection">
			<h5><?php _e('Layouts', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin"><a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;download=layouts'), 'bizzthemes-download-layouts'); ?>"><?php _e('Download layouts', 'bizzthemes'); ?></a></p>
		</div>
		<div class="module_subsection">
			<h5><?php _e('Settings', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin"><a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;download=settings'), 'bizzthemes-download-settings'); ?>"><?php _e('Download settings', 'bizzthemes'); ?></a></p>
		</div>
		<div class="module_subsection">
			<h5><?php _e('Design', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin"><a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;download=design'), 'bizzthemes-download-design'); ?>"><?php _e('Download design', 'bizzthemes'); ?></a></p>
		</div>
	</div>
	<div class="options_column last">
		<h3><span><?php _e('Set default options', 'bizzthemes'); ?></span></h3> 
		<div class="module_subsection">
			<h5><?php _e('Layouts', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin">
			<a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;restore=layouts'), 'bizzthemes-restore-layouts'); ?>" onclick="return confirm('<?php _e('All current theme layouts will be lost! Click OK to reset.', 'bizzthemes'); ?>');"><?php _e('Set default layouts', 'bizzthemes'); ?></a>
			<a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;restore=layouts-blank'), 'bizzthemes-restore-layouts'); ?>" onclick="return confirm('<?php _e('All current theme layouts will be lost! Click OK to reset.', 'bizzthemes'); ?>');"><?php _e('Reset', 'bizzthemes'); ?></a>
			</p>
		</div>
		<div class="module_subsection">
			<h5><?php _e('Settings', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin"><a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;restore=settings'), 'bizzthemes-restore-settings'); ?>" onclick="return confirm('<?php _e('All current theme settings will be lost! Click OK to reset.', 'bizzthemes'); ?>');"><?php _e('Set default settings', 'bizzthemes'); ?></a></p>
		</div>
		<div class="module_subsection">
			<h5><?php _e('Design', 'bizzthemes'); ?></h5>
			<p class="add_extra_margin"><a class="button" href="<?php echo wp_nonce_url(admin_url('admin.php?page=bizz-tools&amp;restore=design'), 'bizzthemes-restore-design'); ?>" onclick="return confirm('<?php _e('All current theme design options will be lost! Click OK to reset.', 'bizzthemes'); ?>');"><?php _e('Set default design', 'bizzthemes'); ?></a></p>
		</div>
	</div>
<?php		
		echo "</div>\n";
		echo "</div>\n";
	}
}

add_action('init', 'bizz_options_head');

function bizz_options_head() {
	if (isset($_GET['page']) && $_GET['page'] == 'bizz-tools') {
		$manager = new bizz_custom_tools;
		$manager->manage_options();
	}
}

/* SET DEFAULT LAYOUTS or RESET */
/*------------------------------------------------------------------*/
function bizzthemes_default_layouts($default_action = '') {
    global $wpdb, $default_layouts_array, $themeid;
	      
    if ( isset($default_action) && $default_action == 'reset' ){ # RESET ALL
		// reset sidebars
		// update_option( 'sidebars_widgets', NULL );
		delete_option( $themeid . '_sidebars_widgets' );
		// updated defaults option
		delete_option('bizz_defaults_' . $themeid);
		// reset all option
		update_option('bizz_reset_' . $themeid, true);
		
		// reset widgets & grids
		$query = "DELETE FROM $wpdb->posts WHERE post_type LIKE 'bizz_widget' OR post_type LIKE 'bizz_grid' ";
		$wpdb->query($query);
    }
    elseif ( isset($default_action) && $default_action == 'set_defaults' ){ # SET DEFAULT GRIDS and WIDGETS
		// read options
		$new_options 			= $default_layouts_array;
		$new_options 			= unserialize($new_options);
		$new_all_widgets 		= $new_options['options_value']['all_widgets'];
		$new_sidebars_widgets 	= $new_options['options_value']['sidebars_widgets'];
		$new_widget_posts 		= ( isset($new_options['options_value']['widget_posts']) ) ? $new_options['options_value']['widget_posts'] : array();
		$new_grid_posts 		= ( isset($new_options['options_value']['grid_posts']) ) ? $new_options['options_value']['grid_posts'] : array();
		// reset old grids
		$query = "DELETE FROM $wpdb->posts WHERE post_type LIKE 'bizz_grid' OR post_type LIKE 'bizz_widget' ";
		$wpdb->query($query);
		// reset backed up widgets
		delete_option( $themeid . '_sidebars_widgets' );
		// update defaults option
		update_option('bizz_defaults_' . $themeid, true);
		// insert data
		bizzthemes_update_options( 'set_new', $new_all_widgets );
		bizzthemes_update_options( 'set_new', $new_sidebars_widgets );
		bizzthemes_insert_posts( 'set_new', array_merge($new_widget_posts, $new_grid_posts) );
							
    }
   
}

/* Insert default posts */
/*------------------------------------------------------------------*/
function bizzthemes_insert_posts($default_action = '', $default_array = '') {
    global $insert_post, $wpdb, $themeid;
		
	if ( !empty($default_array) )
		$insert_array = $default_array;
	else
		$insert_array = $insert_post;
	
	for( $i=0; $i<count($insert_array); $i++ ){
	    
		// check if title $my_post_name already exists in wpdb
		$my_post_name = $insert_array[$i]['post_title'];
		
		if($insert_array[$i]['type'] == 'posts' && $wpdb->get_row("SELECT post_title FROM wp_posts WHERE post_title = '" . $my_post_name . "'", 'ARRAY_A')) {
		    $my_post_exists = 'true'; 
		}
		else {
		    $my_post_exists = 'false'; 
		}
		
		// insert post
		if ( $insert_array[$i]['type'] != '' && $my_post_exists == 'false' ) {
			$post_content = $insert_array[$i]['post_content'];
			$post_content = preg_replace('!s:(\d+):"(.*?)";!se', '"s:".strlen("$2").":\"$2\";"', $post_content );
			$post_content_filtered = ( isset($insert_array[$i]['post_content_filtered']) ) ? $insert_array[$i]['post_content_filtered'] : $themeid;
			$post_parent = ( isset($insert_array[$i]['post_parent']) ) ? $insert_array[$i]['post_parent'] : 0;
			$post_widgetlogic = array(
			    'post_title'   			=> $insert_array[$i]['post_title'],
				'post_excerpt' 			=> $insert_array[$i]['post_excerpt'],
				'post_type'    			=> $insert_array[$i]['post_type'],
				'post_status'  			=> $insert_array[$i]['post_status'],
				'post_content_filtered' => $post_content_filtered,
				'post_content' 			=> $post_content,
				'post_parent' 			=> $post_parent
			);
			$post_id = wp_insert_post( $post_widgetlogic );
		}
		
	}

}

/* Update default options */
/*------------------------------------------------------------------*/
function bizzthemes_update_options($default_action = '', $default_array = '') {
    global $update_option;
	
	if ( isset($default_array) && $default_array != '' )
		$options_array = $default_array;
	else
		$options_array = $update_option;
			
	for( $i=0; $i<count($options_array); $i++ ){
	    if ( isset($options_array[$i]['type']) && $options_array[$i]['type'] != '' ) {
		    $option_value = $options_array[$i]['option_value'];
			if ( !is_serialized( $option_value ) )
				$option_value = serialize($option_value);
			$option_value = preg_replace('!s:(\d+):"(.*?)";!se', '"s:".strlen("$2").":\"$2\";"', $option_value );
			$option_value = maybe_unserialize($option_value);
			$option_name  = $options_array[$i]['option_name'];
			update_option( $option_name, $option_value );
		}
	}

}

// LIST ALL ACTIVE WIDGETS
function bizz_get_active_widgets() {
	global $wp_registered_widgets;
	
	$avail_widgets = '';
	foreach ( $wp_registered_widgets as $widget ) { #get registered widgets
		$option_name 	= $widget['callback']['0'];
		$avail_widgets .= $option_name->option_name . ',';
	}
	$avail_widgets = substr_replace($avail_widgets ,"",-1);
	$avail_widgets = explode(",",$avail_widgets);
	$avail_widgets = array_unique($avail_widgets);
	foreach ( $avail_widgets as $widget ) { #put widgets into array
		$widgets_array[] = array(
			'option_name' 	=> $widget, 
			'option_value'	=> get_option( $widget ),
			'type'			=> 'widget'
		);
	}
	
	return $widgets_array;
}

// LIST ALL WIDGET POSTS
function bizz_get_widget_posts() {
	global $post, $themeid;
	
	$args = array(
		'post_type' 	=> 'bizz_widget',
		'numberposts' 	=> -1,
		'orderby' 		=> 'date',
		'order' 		=> 'DESC',
		'post_status' 	=> 'publish'
	);
	$layout_widgets = get_posts( $args );
	foreach ( $layout_widgets as $post ) {
		setup_postdata($post);
		
		$widget_posts_array[] = array(
			'post_title' 				=> $post->post_title, 
			'post_excerpt' 				=> $post->post_excerpt,
			'post_status' 				=> $post->post_status,
			'post_type' 				=> $post->post_type,
			'post_content' 				=> $post->post_content,
			'post_content_filtered' 	=> $themeid,
			'type'						=> 'widgets'
		);
	}
	
	return $widget_posts_array;
}

// LIST ALL GRID POSTS
function bizz_get_grid_posts() {
	global $post, $themeid;
	
	$args = array(
		'post_type' 	=> 'bizz_grid',
		'numberposts' 	=> -1,
		'orderby' 		=> 'date',
		'order' 		=> 'DESC',
		'post_status' 	=> 'publish'
	);
	$layout_grids = get_posts( $args );
	foreach ( $layout_grids as $post ) {
		setup_postdata($post);
		
		$grid_posts_array[] = array(
			'post_title' 				=> $post->post_title, 
			'post_excerpt' 				=> $post->post_excerpt,
			'post_status' 				=> $post->post_status,
			'post_type' 				=> $post->post_type,
			'post_content' 				=> $post->post_content,
			'post_content_filtered' 	=> $themeid,
			'type'						=> 'grids'
		);
	}
	if ( isset($grid_posts_array) )
		return $grid_posts_array;
}

// CLEAN DATA, EVEN ARRAYS: part 1
function bizz_sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val)
            $output[$var] = bizz_sanitize($val);
    }
    else {
        if (get_magic_quotes_gpc())
            $input = stripslashes($input);
        $output = htmlentities($input, ENT_QUOTES, "UTF-8");
    }
	if ( isset($output) )
		return $output;
}
