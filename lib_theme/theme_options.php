<?php

/* GLOBAL DESIGN OPTIONS */
/*------------------------------------------------------------------*/

$design[] = array(	'type' => 'maintabletop');

	////// General Styling

	$design[] = array(	'name' => 'General Styling',
						'type' => 'heading');
					
		$design[] = array(	'name' => 'Layout Control',
							'toggle' => 'true',
							'type' => 'subheadingtop');
							
			$design[] = array(	'name' => 'Predefined Skins',
								'desc' => 'Please select the CSS skin for your website here. CSS skin files are located in your theme skins folder.',
								'id' => $shortname.'_alt_stylesheet',
								'std' => array(
									'value' => '', 
									'css' => ''
								),
								'type' => 'select',
								'show_option_none' => true,
								'options' => $alt_stylesheets);
								
			$design[] = array(	'name' => 'Hide custom.css',
								'label' => 'Hide Custom Stylesheet',
								'desc' => 'Custom.css file allows you to make custom design changes using CSS. You have option to create your own css skin in skins folder or to simply enable and <a href="' . $bloghomeurl . 'wp-admin/theme-editor.php">edit custom.css file</a>.<span class="important">Check this option to disable custom.css file output.</span>',
								'id' => $shortname.'_custom_css',
								'std' => array(
									'value' => false, 
									'css' => ''
								),
								'type' => 'checkbox');	
								
			$design[] = array(	'name' => 'Hide layout.css',
								'label' => 'Hide Design Control Tweaks',
								'desc' => 'If you want to hide all CSS design tweaks you&#8217;ve created using theme design control panel, check this option.',
								'id' => $shortname.'_layout_css',
								'std' => array(
									'value' => false, 
									'css' => ''
								),
								'type' => 'checkbox');
					
		$design[] = array(	'type' => 'subheadingbottom');	

		$design[] = array(	'name' => 'Body Background',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			$design[] = array(  'name' => '<code>body</code> background',
								'desc' => 'Specify <code>body</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_body_img_prop',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => 'body'
								),
								'type' => 'bgproperties');
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Body Links',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			$design[] = array(  'name' => '<code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>body</code> text links.',
								'id' => $shortname.'_c_links',
								'std' => array(
									'color' => '', 
									'css' => 'a'
								),
								'type' => 'color');
								
			$design[] = array(  'name' => '<code>a:hover</code> link text color',
								'desc' => 'Pick a custom onhover link color to be applied to <code>body</code> text links.',
								'id' => $shortname.'_c_links_onhover',
								'std' => array(
									'color' => '', 
									'css' => 'a:hover'
								),
								'type' => 'color');
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Body Text',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			$design[] = array(  'name' => '<code>body</code> fonts (all)',
								'desc' => 'Select the typography you want for all of your texts. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_general',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '',
									'color' => '',
									'css' => 'body'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H1</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H1</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h1',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h1'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H2</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H2</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h2',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h2'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H3</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h3',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h3'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H4</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H4</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h4',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h4'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H5</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H5</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h5',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h5'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => '<code>H6</code> fonts',
								'desc' => 'Select the typography you want for your text, displayed inside <code>H6</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_h6',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'h6'
								),
								'type' => 'typography');
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Body Input Fields',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			$design[] = array(  'name' => 'Inputs fonts',
								'desc' => 'Select the typography you want for your <code>input, textarea</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_inputs',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'input, textarea'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Inputs background color',
								'desc' => 'Specify <code>input, textarea</code> background color.',
								'id' => $shortname.'_bg_inputs',
								'std' => array(
									'background-color' => '', 
									'css' => 'input, textarea'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Inputs border',
								'desc' => 'Specify border properties to be applied to <code>input, textarea</code> tags.',
								'id' => $shortname.'_b_inputs',
								'std' => array(
									'border-position' => 'border',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => 'input, textarea'
								),
								'type' => 'border');
								
			$design[] = array(  'name' => 'Inputs <code>:focus</code> background color',
								'desc' => 'Specify <code>input:focus, textarea:focus</code> background color.',
								'id' => $shortname.'_bg_inputs_focus',
								'std' => array(
									'background-color' => '', 
									'css' => 'input:focus, textarea:focus'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Inputs <code>:focus</code> border',
								'desc' => 'Specify border properties to be applied to <code>input:focus, textarea:focus</code> tags.',
								'id' => $shortname.'_b_inputs_focus',
								'std' => array(
									'border-position' => 'border',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => 'input:focus, textarea:focus'
								),
								'type' => 'border');
								
			$design[] = array(  'name' => 'Submit button fonts',
								'desc' => 'Select the typography you want for your <code>input[type=&#34;submit&#34;], a.button</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_inputs_submit',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'input[type=&#34;submit&#34;], a.button'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Submit button background',
								'desc' => 'Specify <code>input[type=&#34;submit&#34;], a.button</code> background color.',
								'id' => $shortname.'_bg_inputs_submit',
								'std' => array(
									'background-color' => '', 
									'css' => 'input[type=&#34;submit&#34;], a.button'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Submit button <code>:hover</code> fonts',
								'desc' => 'Select the typography you want for your <code>input[type=&#34;submit&#34;]:hover, a.button:hover</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_inputs_submit_hover',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'input[type=&#34;submit&#34;]:hover, a.button:hover'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Submit button <code>:hover</code> background',
								'desc' => 'Specify <code>input[type=&#34;submit&#34;]:hover, a.button:hover</code> background color.',
								'id' => $shortname.'_bg_inputs_submit_hover',
								'std' => array(
									'background-color' => '', 
									'css' => 'input[type=&#34;submit&#34;]:hover, a.button:hover'
								),
								'type' => 'background-color');
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Body Images',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			$design[] = array(  'name' => 'Image caption fonts',
								'desc' => 'Select the typography you want for your <code>.wp-caption</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_imgcaption',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.wp-caption'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Image caption background color',
								'desc' => 'Specify <code>.wp-caption</code> background color.',
								'id' => $shortname.'_bg_imgcaption',
								'std' => array(
									'background-color' => '', 
									'css' => '.wp-caption'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Image caption border',
								'desc' => 'Specify border properties to be applied to <code>.wp-caption</code> tags.',
								'id' => $shortname.'_b_imgcaption',
								'std' => array(
									'border-position' => 'border',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => '.wp-caption'
								),
								'type' => 'border');
								
			$design[] = array(  'name' => 'Image thumbnail background color',
								'desc' => 'Specify <code>.post_box img.thumbnail</code> background color.',
								'id' => $shortname.'_bg_imgthumb',
								'std' => array(
									'background-color' => '', 
									'css' => '.wp-caption'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Image thumbnail border',
								'desc' => 'Specify border properties to be applied to <code>.post_box img.thumbnail</code> tags.',
								'id' => $shortname.'_b_imgthumb',
								'std' => array(
									'border-position' => 'border',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => '.post_box img.thumbnail'
								),
								'type' => 'border');
					
		$design[] = array(	'type' => 'subheadingbottom');
							
	$design[] = array(	'type' => 'maintablebreak');
	
	////// Specific Widget Styling

	$design[] = array(	'name' => 'Content &amp; Comments',
						'type' => 'heading');
								
		$design[] = array(	'name' => 'Typography',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Widget <code>H3</code> title',
								'desc' => 'Select the typography you want for your <code>.widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_wid_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.widget h3'
								),
								'type' => 'typography');
			
			$design[] = array(  'name' => 'Main post headline',
								'desc' => 'Select the typography you want for your <code>.headline_area h1, .headline_area h2</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_content_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.headline_area h1, .headline_area h2'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Archive post headline',
								'desc' => 'Select the typography you want for your <code>.headline_area h1 a, .headline_area h2 a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_content_title_a',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.headline_area h1 a, .headline_area h2 a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Post meta',
								'desc' => 'Select the typography you want for your <code>.headline_meta a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_post_meta',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.headline_meta, .headline_meta a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Post content',
								'desc' => 'Select the typography you want for your <code>.format_text</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_post_text',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.format_text'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Post content links',
								'desc' => 'Select the typography you want for your <code>.format_text a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_post_text_a',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.format_text a'
								),
								'type' => 'typography');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Continue Reading',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Font',
								'desc' => 'Select the typography you want for your <code>span.read-more a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_rmore_a',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'span.read-more a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Background color',
								'desc' => 'Specify <code>span.read-more a</code> background color.',
								'id' => $shortname.'_bg_rmore',
								'std' => array(
									'background-color' => '', 
									'css' => 'span.read-more a'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Background <code>:hover</code> color',
								'desc' => 'Specify <code>span.read-more a:hover</code> background color.',
								'id' => $shortname.'_bg_rmore_hover',
								'std' => array(
									'background-color' => '', 
									'css' => 'span.read-more a:hover'
								),
								'type' => 'background-color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Pagination',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Top border',
								'desc' => 'Specify border properties to be applied to <code>.pagination_area, .loopedSlider ul.pagination</code> tags.',
								'id' => $shortname.'_b_pagination',
								'std' => array(
									'border-position' => 'border-top',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => '.pagination_area, .loopedSlider ul.pagination'
								),
								'type' => 'border');
								
			$design[] = array(  'name' => 'Font',
								'desc' => 'Select the typography you want for your <code>ul.lpag li a, .loopedSlider ul.pagination li a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_pagination_a',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'ul.lpag li a, .loopedSlider ul.pagination li a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Active background color',
								'desc' => 'Specify <code>ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a</code> background color.',
								'id' => $shortname.'_bg_pagination_active',
								'std' => array(
									'background-color' => '', 
									'css' => 'ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Active background font',
								'desc' => 'Select the typography you want for your <code>ul.lpag li.active a, ul.lpag li.current span</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_pagination_active',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => 'ul.lpag li.active a, ul.lpag li.current span, .loopedSlider ul.pagination li.current a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Link <code>:hover</code> background color',
								'desc' => 'Specify <code>ul.lpag li a:hover, .loopedSlider ul.pagination li a:hover</code> background color.',
								'id' => $shortname.'_bg_pagination_a_hover',
								'std' => array(
									'background-color' => '', 
									'css' => 'ul.lpag li a:hover, .loopedSlider ul.pagination li a:hover'
								),
								'type' => 'background-color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
					
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Comments',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Comment header meta font',
								'desc' => 'Select the typography you want for your <code>#comments .comment .text-right .comm-reply, #comments .comment .text-right .comm-reply a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_comment_meta',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#comments .comment .text-right .comm-reply, #comments .comment .text-right .comm-reply a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Comment content font',
								'desc' => 'Select the typography you want for your <code>#comments .comment .text-right .comment-entry</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_comment_content',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#comments .comment .text-right .comment-entry'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Author reply border',
								'desc' => 'Specify border properties to be applied to <code>#comments .comment.bypostauthor .text-right .comm-reply</code> tags.',
								'id' => $shortname.'_b_comment_author',
								'std' => array(
									'border-position' => 'border',
									'border-width' => '', 
									'border-style' => '', 
									'border-color' => '',
									'css' => '#comments .comment.bypostauthor .text-right .comm-reply'
								),
								'type' => 'border');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
					
		$design[] = array(	'type' => 'subheadingbottom');
													
	$design[] = array(	'type' => 'maintablebreak');
							
$design[] = array(	'type' => 'maintablebottom');
	
$design[] = array(	'type' => 'maintabletop');
	
	////// Area Styling

	$design[] = array(	'name' => 'Area Styling',
						'type' => 'heading');
								
		$design[] = array(	'name' => 'Header Area',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Area background',
								'desc' => 'Specify <code>#header_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_header_area',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#header_area'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 1 background',
								'desc' => 'Specify <code>#header_area .header_one</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_header_one',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#header_area .header_one'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 2 background',
								'desc' => 'Specify <code>#header_area .header_two</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_header_two',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#header_area .header_two'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Area font',
								'desc' => 'Select the typography you want for your <code>#header_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_header_area',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#header_area .widget'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget title',
								'desc' => 'Select the typography you want for your <code>#header_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_header_area_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#header_area .widget h3'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget <code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area a</code> text links.',
								'id' => $shortname.'_c_header_area_a',
								'std' => array(
									'color' => '', 
									'css' => '#header_area a'
								),
								'type' => 'color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}

		$design[] = array(	'type' => 'subheadingbottom');
								
		$design[] = array(	'name' => 'Main Area',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Area background',
								'desc' => 'Specify <code>#main_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_main_area',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#main_area'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 1 background',
								'desc' => 'Specify <code>#main_area .main_one</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_main_one',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#main_area .main_one'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 2 background',
								'desc' => 'Specify <code>#main_area .main_two</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_main_two',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#main_area .main_two'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Area font',
								'desc' => 'Select the typography you want for your <code>#main_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_main_area',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#main_area .widget'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget title',
								'desc' => 'Select the typography you want for your <code>#main_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_main_area_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#main_area .widget h3'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget <code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>#main_area a</code> text links.',
								'id' => $shortname.'_c_main_area_a',
								'std' => array(
									'color' => '', 
									'css' => '#main_area a'
								),
								'type' => 'color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
														
		$design[] = array(	'type' => 'subheadingbottom');
								
		$design[] = array(	'name' => 'Footer Area',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Area background',
								'desc' => 'Specify <code>#footer_area</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_footer_area',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#footer_area'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 1 background',
								'desc' => 'Specify <code>#footer_area .footer_one</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_footer_one',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#footer_area .footer_one'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Column 2 background',
								'desc' => 'Specify <code>#footer_area .footer_two</code> background properties. <span class="important">Uploading image is optional, so you may only choose background color if you like.</span>',
								'id' => $shortname.'_bg_footer_two',
								'std' => array(
									'background-image' => '',
									'background-color' => '',
									'background-repeat' => '', 
									'background-position' => '', 
									'css' => '#footer_area .footer_two'
								),
								'type' => 'bgproperties');
								
			$design[] = array(  'name' => 'Area font',
								'desc' => 'Select the typography you want for your <code>#footer_area .widget</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_footer_area',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#footer_area .widget'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget title',
								'desc' => 'Select the typography you want for your <code>#footer_area .widget h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_footer_area_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '#footer_area .widget h3'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Area widget <code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>#footer_area a</code> text links.',
								'id' => $shortname.'_c_footer_area_a',
								'std' => array(
									'color' => '', 
									'css' => '#footer_area a'
								),
								'type' => 'color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
														
		$design[] = array(	'type' => 'subheadingbottom');
																
	$design[] = array(	'type' => 'maintablebreak');
	
	////// Special widgets Styling

	$design[] = array(	'name' => 'Special Widgets',
						'type' => 'heading');
								
		$design[] = array(	'name' => 'Navigation Menu widget',
							'toggle' => 'true',
							'type' => 'subheadingtop');
								
			if ($bizz_package != 'ZnJlZQ=='){
			
			$design[] = array(  'name' => 'Navigation font',
								'desc' => 'Select the typography you want for your <code>.widget .nav-menu a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_main_nav',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.widget .nav-menu a'
								),
								'type' => 'typography');
			
			$design[] = array(  'name' => '<code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu a</code> text links.',
								'id' => $shortname.'_c_header_area_menu_a',
								'std' => array(
									'color' => '', 
									'css' => '#header_area .nav-menu a'
								),
								'type' => 'color');
								
			$design[] = array(  'name' => 'Item <code>a:hover</code> background color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li:hover</code> text links.',
								'id' => $shortname.'_bg_header_area_menu_a_hover',
								'std' => array(
									'background-color' => '', 
									'css' => '#header_area .nav-menu li:hover'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Active item <code>a</code> background color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li.current-menu-item a</code> text links.',
								'id' => $shortname.'_bg_header_area_menu_active',
								'std' => array(
									'background-color' => '', 
									'css' => '#header_area .nav-menu li.current-menu-item a'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Dropdown <code>a</code> link text color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li ul li a, #header_area .nav-menu li ul li.current-menu-item li a</code> text links.',
								'id' => $shortname.'_c_header_area_menu_dropdown_a',
								'std' => array(
									'color' => '', 
									'css' => '#header_area .nav-menu li ul li a, #header_area .nav-menu li ul li.current-menu-item li a'
								),
								'type' => 'color');
								
			$design[] = array(  'name' => 'Dropdown Item <code>a:hover</code> background color',
								'desc' => 'Pick a custom link color to be applied to <code>#header_area .nav-menu li ul li:hover</code> text links.',
								'id' => $shortname.'_bg_header_area_menu_a_hover_dropdown',
								'std' => array(
									'background-color' => '', 
									'css' => '#header_area .nav-menu li ul li:hover'
								),
								'type' => 'background-color');
								
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
														
		$design[] = array(	'type' => 'subheadingbottom');
		
		$design[] = array(	'name' => 'Areas of Practice widget',
							'toggle' => 'true',
							'type' => 'subheadingtop');
	
			if ($bizz_package != 'ZnJlZQ=='){

			$design[] = array(  'name' => 'Widget title',
								'desc' => 'Select the typography you want for your <code>.widget_practices h3</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_practice_title',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.widget_practices h3'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'List background color',
								'desc' => 'Pick a custom link color to be applied to <code>.widget_practices ul.practiceswidget</code> list.',
								'id' => $shortname.'_bg_practice_list',
								'std' => array(
									'background-color' => '', 
									'css' => '.widget_practices ul.practiceswidget'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => '<code>a</code> link font',
								'desc' => 'Select the typography you want for your <code>.widget_practices a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_practice_list',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.widget_practices a'
								),
								'type' => 'typography');
								
			$design[] = array(  'name' => 'Children <code>a</code> link font',
								'desc' => 'Select the typography you want for your <code>.widget_practices li ul li a</code> tags. <span class="important">* Web-safe font.<br/>G Google font.</span>',
								'id' => $shortname.'_f_practice_list_child',
								'std' => array(
									'font-size' => '', 
									'font-family' => '', 
									'font-style' => '', 
									'font-variant' => '',
									'font-weight' => '', 
									'color' => '',
									'css' => '.widget_practices li ul li a'
								),
								'type' => 'typography');
			
			$design[] = array(  'name' => 'Item <code>a:hover</code> background color',
								'desc' => 'Pick a custom link color to be applied to <code>.widget_practices a:hover</code> text links.',
								'id' => $shortname.'_bg_practice_a_hover',
								'std' => array(
									'background-color' => '', 
									'css' => '.widget_practices a'
								),
								'type' => 'background-color');
								
			$design[] = array(  'name' => 'Active item <code>a</code> background color',
								'desc' => 'Pick a custom link color to be applied to <code>.widget_practices li.current_page_item a, .widget_practices li.current_page_item a:hover</code> text links.',
								'id' => $shortname.'_bg_practice_active',
								'std' => array(
									'background-color' => '', 
									'css' => '.widget_practices li.current_page_item a, .widget_practices li.current_page_item a:hover'
								),
								'type' => 'background-color');
																
			} else {
			
			$design[] = array(	"name" => "To use these options, please <a href='" . $bloghomeurl . "wp-admin/admin.php?page=bizz-license'>Upgrade to Standard or Agency Theme Package</a>.",
								"type" => "help");
			
			}
														
		$design[] = array(	'type' => 'subheadingbottom');
																
	$design[] = array(	'type' => 'maintablebreak');
							
$design[] = array(	'type' => 'maintablebottom');


/* GLOBAL THEME OPTIONS */
/*------------------------------------------------------------------*/
			
$options[] = array(	"type" => "maintabletop");
	
	/// empty, ... for now :P
					
$options[] = array(	"type" => "maintablebottom");

/* DEFAULT LAYOUT OPTIONS */
/*------------------------------------------------------------------*/

// set default layouts
$default_layouts_array = 'a:4:{s:8:"theme_id";s:8:"law-firm";s:13:"frame_version";s:5:"7.3.8";s:10:"options_id";s:7:"layouts";s:13:"options_value";a:4:{s:11:"all_widgets";a:21:{i:0;a:3:{s:11:"option_name";s:11:"widget_meta";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:1;a:3:{s:11:"option_name";s:11:"widget_text";s:12:"option_value";a:4:{i:2;a:0:{}i:3;a:3:{s:5:"title";s:0:"";s:4:"text";s:189:"<div class="phone-info"><span class="pmeta">Local<br/>only</span><span class="pnum">0121 876 9468</span><span class="pmeta">Toll<br/>free</span><span class="pnum">0121 876 9469</span></div>";s:6:"filter";b:0;}i:6;a:3:{s:5:"title";s:0:"";s:4:"text";s:42:"&copy; 2011 Law Firm. All rights reserved.";s:6:"filter";b:0;}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:2;a:3:{s:11:"option_name";s:22:"widget_recent-comments";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:3;a:3:{s:11:"option_name";s:10:"widget_rss";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:4;a:3:{s:11:"option_name";s:37:"widget_widgets-reloaded-bizz-archives";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:5;a:3:{s:11:"option_name";s:39:"widget_widgets-reloaded-bizz-categories";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:6;a:3:{s:11:"option_name";s:25:"widget_bizz-comments-form";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:13:{s:15:"title_reply_tag";s:2:"h3";s:3:"req";b:1;s:4:"name";s:4:"Name";s:5:"email";s:28:"Mail (will not be published)";s:3:"url";s:7:"Website";s:7:"req_str";s:10:"(required)";s:12:"label_submit";s:14:"Submit Comment";s:11:"must_log_in";s:57:"You must be <a href="%s">logged in</a> to post a comment.";s:12:"logged_in_as";s:98:"Logged in as <a href="%s">%s</a>. <a href="%s" title="Log out of this account">Log out &raquo;</a>";s:11:"title_reply";s:13:"Leave a Reply";s:14:"title_reply_to";s:19:"Leave a Reply to %s";s:17:"cancel_reply_link";s:27:"Click here to cancel reply.";s:15:"comments_closed";s:20:"Comments are closed.";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:7;a:3:{s:11:"option_name";s:25:"widget_bizz-comments-loop";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:23:{s:4:"type";s:3:"all";s:14:"comment_header";s:2:"h3";s:12:"comment_meta";s:65:"[author] [date before="| "] [link before="| "] [edit before="| "]";s:9:"max_depth";s:1:"5";s:17:"enable_pagination";b:1;s:12:"enable_reply";b:1;s:18:"comment_moderation";s:36:"Your comment is awaiting moderation.";s:10:"reply_text";s:5:"Reply";s:10:"login_text";s:15:"Log in to Reply";s:13:"password_text";s:18:"Password Protected";s:19:"pass_protected_text";s:59:"is password protected. Enter the password to view comments.";s:17:"sing_comment_text";s:7:"comment";s:16:"plu_comment_text";s:8:"comments";s:19:"sing_trackback_text";s:9:"trackback";s:18:"plu_trackback_text";s:10:"trackbacks";s:18:"sing_pingback_text";s:8:"pingback";s:17:"plu_pingback_text";s:9:"pingbacks";s:14:"sing_ping_text";s:4:"ping";s:13:"plu_ping_text";s:5:"pings";s:7:"no_text";s:2:"No";s:7:"to_text";s:2:"to";s:17:"reverse_top_level";b:0;s:15:"comments_closed";s:0:"";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:8;a:3:{s:11:"option_name";s:35:"widget_widgets-reloaded-bizz-c-form";s:12:"option_value";a:4:{i:2;a:0:{}i:3;a:19:{s:5:"title";s:10:"Contact Me";s:9:"wid_email";s:19:"admin@bizzartic.com";s:11:"wid_trans15";s:6:"Email*";s:11:"wid_trans16";s:8:"Message*";s:11:"wid_trans17";s:23:"Send a copy to yourself";s:11:"wid_trans18";s:68:"If you want to submit this form, do not enter anything in this field";s:11:"wid_trans19";s:6:"Submit";s:10:"wid_trans5";s:6:"From: ";s:10:"wid_trans6";s:10:"Reply-To: ";s:10:"wid_trans7";s:12:"You emailed ";s:10:"wid_trans1";s:45:"This field is required. Please enter a value.";s:10:"wid_trans2";s:22:"Invalid email address.";s:10:"wid_trans3";s:29:"Contact Form Submission from ";s:10:"wid_trans9";s:24:"You forgot to enter your";s:11:"wid_trans10";s:22:"You entered an invalid";s:11:"wid_trans11";s:41:"Thanks! Your email was successfully sent.";s:11:"wid_trans12";s:39:"There was an error submitting the form.";s:11:"wid_trans13";s:67:"E-mail has not been setup properly. Please add your contact e-mail!";s:11:"wid_trans14";s:5:"Name*";}i:5;a:19:{s:5:"title";s:10:"Contact Me";s:9:"wid_email";s:0:"";s:11:"wid_trans15";s:6:"Email*";s:11:"wid_trans16";s:8:"Message*";s:11:"wid_trans17";s:23:"Send a copy to yourself";s:11:"wid_trans18";s:68:"If you want to submit this form, do not enter anything in this field";s:11:"wid_trans19";s:6:"Submit";s:10:"wid_trans5";s:6:"From: ";s:10:"wid_trans6";s:10:"Reply-To: ";s:10:"wid_trans7";s:12:"You emailed ";s:10:"wid_trans1";s:45:"This field is required. Please enter a value.";s:10:"wid_trans2";s:22:"Invalid email address.";s:10:"wid_trans3";s:29:"Contact Form Submission from ";s:10:"wid_trans9";s:24:"You forgot to enter your";s:11:"wid_trans10";s:22:"You entered an invalid";s:11:"wid_trans11";s:41:"Thanks! Your email was successfully sent.";s:11:"wid_trans12";s:39:"There was an error submitting the form.";s:11:"wid_trans13";s:67:"E-mail has not been setup properly. Please add your contact e-mail!";s:11:"wid_trans14";s:5:"Name*";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:9;a:3:{s:11:"option_name";s:35:"widget_widgets-reloaded-bizz-flickr";s:12:"option_value";a:5:{i:2;a:0:{}i:3;a:5:{s:5:"title";s:6:"Flickr";s:9:"flickr_id";s:12:"38982010@N00";s:13:"flickr_number";s:1:"6";s:11:"flickr_type";s:4:"user";s:14:"flickr_sorting";s:6:"latest";}i:4;a:5:{s:5:"title";s:6:"Flickr";s:9:"flickr_id";s:12:"38982010@N00";s:13:"flickr_number";s:1:"8";s:11:"flickr_type";s:4:"user";s:14:"flickr_sorting";s:6:"latest";}i:5;a:5:{s:5:"title";s:6:"Flickr";s:9:"flickr_id";s:12:"38982010@N00";s:13:"flickr_number";s:1:"9";s:11:"flickr_type";s:4:"user";s:14:"flickr_sorting";s:6:"latest";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:10;a:3:{s:11:"option_name";s:33:"widget_widgets-reloaded-bizz-logo";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:3:{s:11:"custom_logo";s:8:"def_logo";s:11:"upload_logo";s:0:"";s:11:"custom_link";s:7:"http://";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:11;a:3:{s:11:"option_name";s:33:"widget_widgets-reloaded-bizz-loop";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:22:{s:9:"post_date";i:1;s:12:"post_columns";s:1:"1";s:9:"read_more";i:1;s:14:"read_more_text";s:16:"Continue reading";s:17:"enable_pagination";i:1;s:15:"ajax_pagination";i:1;s:13:"thumb_display";i:1;s:11:"thumb_width";s:3:"150";s:12:"thumb_height";s:3:"150";s:11:"thumb_align";s:10:"alignright";s:11:"thumb_cropp";s:1:"c";s:12:"thumb_filter";s:0:"";s:13:"thumb_sharpen";s:0:"";s:11:"post_author";i:0;s:13:"post_comments";i:0;s:15:"post_categories";i:0;s:9:"post_tags";i:0;s:9:"post_edit";i:0;s:12:"thumb_single";i:0;s:14:"thumb_selflink";i:0;s:12:"remove_posts";i:0;s:10:"full_posts";i:0;}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:12;a:3:{s:11:"option_name";s:37:"widget_widgets-reloaded-bizz-nav-menu";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:16:{s:5:"title";s:0:"";s:4:"menu";s:3:"105";s:9:"container";s:3:"div";s:12:"container_id";s:0:"";s:15:"container_class";s:0:"";s:7:"menu_id";s:0:"";s:10:"menu_class";s:8:"nav-menu";s:5:"depth";s:1:"0";s:6:"before";s:0:"";s:5:"after";s:0:"";s:11:"link_before";s:0:"";s:10:"link_after";s:0:"";s:11:"fallback_cb";s:12:"wp_page_menu";s:6:"walker";s:0:"";s:18:"use_desc_for_title";i:0;s:8:"vertical";i:0;}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:13;a:3:{s:11:"option_name";s:34:"widget_widgets-reloaded-bizz-pages";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:14;a:3:{s:11:"option_name";s:23:"widget_bizz-query-posts";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:15;a:3:{s:11:"option_name";s:37:"widget_widgets-reloaded-bizz-richtext";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:6:{s:5:"title";s:18:"About our Law Firm";s:4:"icon";s:85:"http://bizzthemes.com/demo/law-firm/wp-content/uploads/2011/02/user-business-boss.png";s:10:"title_link";s:7:"http://";s:7:"content";s:446:"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";s:11:"button_text";s:10:"Learn more";s:11:"button_link";s:21:"http://bizzthemes.com";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:16;a:3:{s:11:"option_name";s:35:"widget_widgets-reloaded-bizz-search";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:17;a:3:{s:11:"option_name";s:14:"widget_twitter";s:12:"option_value";a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:18;a:3:{s:11:"option_name";s:21:"widget_bizz_practices";s:12:"option_value";a:3:{i:2;a:0:{}i:3;a:3:{s:5:"title";s:17:"Areas of Practice";s:11:"link_before";s:0:"";s:10:"link_after";s:0:"";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:19;a:3:{s:11:"option_name";s:35:"widget_widgets-reloaded-bizz-slider";s:12:"option_value";a:4:{i:2;a:0:{}i:3;a:24:{s:5:"title";s:0:"";s:6:"before";s:0:"";s:5:"after";s:0:"";s:12:"sliderheight";s:0:"";s:12:"buttonheight";s:2:"50";s:8:"ico_back";s:0:"";s:7:"ico_fwd";s:0:"";s:9:"post_type";s:11:"bizz_slider";s:5:"order";s:4:"DESC";s:7:"orderby";s:4:"date";s:6:"number";s:1:"5";s:10:"autoheight";i:1;s:5:"start";s:1:"1";s:6:"effect";s:10:"fade, fade";s:9:"fadespeed";s:3:"250";s:10:"slidespeed";s:3:"250";s:8:"autoplay";s:1:"0";s:5:"pause";s:1:"0";s:7:"include";a:0:{}s:7:"exclude";a:0:{}s:9:"crossfade";i:0;s:9:"bigtarget";i:0;s:10:"pagination";i:0;s:11:"autorestart";s:0:"";}i:4;a:22:{s:5:"title";s:0:"";s:6:"before";s:0:"";s:5:"after";s:0:"";s:12:"sliderheight";s:0:"";s:12:"buttonheight";s:3:"100";s:8:"ico_back";s:0:"";s:7:"ico_fwd";s:0:"";s:9:"post_type";s:11:"bizz_slider";s:5:"order";s:4:"DESC";s:7:"orderby";s:4:"date";s:6:"number";s:1:"5";s:10:"autoheight";i:1;s:5:"start";s:1:"1";s:6:"effect";s:10:"fade, fade";s:9:"fadespeed";s:3:"250";s:10:"slidespeed";s:3:"250";s:8:"autoplay";s:1:"0";s:5:"pause";s:1:"0";s:9:"crossfade";i:0;s:9:"bigtarget";i:0;s:10:"pagination";i:0;s:11:"autorestart";s:0:"";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}i:20;a:3:{s:11:"option_name";s:18:"widget_bizz_social";s:12:"option_value";a:5:{i:2;a:0:{}i:3;a:5:{s:5:"title";s:0:"";s:8:"facebook";s:24:"http://www.facebook.com/";s:7:"twitter";s:23:"http://www.twitter.com/";s:6:"flickr";s:22:"http://www.flickr.com/";s:7:"youtube";s:23:"http://www.youtube.com/";}i:4;a:5:{s:5:"title";s:0:"";s:8:"facebook";s:19:"http://facebook.com";s:7:"twitter";s:18:"http://twitter.com";s:6:"flickr";s:0:"";s:7:"youtube";s:0:"";}i:5;a:5:{s:5:"title";s:0:"";s:8:"facebook";s:24:"http://www.facebook.com/";s:7:"twitter";s:23:"http://www.twitter.com/";s:6:"flickr";s:17:"http://flickr.com";s:7:"youtube";s:18:"http://youtube.com";}s:12:"_multiwidget";i:1;}s:4:"type";s:6:"widget";}}s:12:"widget_posts";a:21:{i:0;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:161:"a:5:{s:9:"widget-id";s:32:"widgets-reloaded-bizz-nav-menu-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:1;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:157:"a:5:{s:9:"widget-id";s:28:"widgets-reloaded-bizz-logo-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:2;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:157:"a:5:{s:9:"widget-id";s:28:"widgets-reloaded-bizz-loop-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:3;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:142:"a:5:{s:9:"widget-id";s:13:"bizz_social-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:4;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:13:"is_front_page";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:163:"a:5:{s:9:"widget-id";s:28:"widgets-reloaded-bizz-loop-3";s:9:"condition";s:13:"is_front_page";s:4:"item";s:3:"all";s:6:"parent";s:4:"true";s:4:"show";s:5:"false";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:5;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:134:"a:5:{s:9:"widget-id";s:6:"text-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:6;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:13:"is_front_page";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:165:"a:5:{s:9:"widget-id";s:30:"widgets-reloaded-bizz-slider-4";s:9:"condition";s:13:"is_front_page";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:7;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:159:"a:5:{s:9:"widget-id";s:30:"widgets-reloaded-bizz-c-form-5";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:8;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:142:"a:5:{s:9:"widget-id";s:13:"bizz_social-4";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:9;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:13:"is_front_page";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:165:"a:5:{s:9:"widget-id";s:30:"widgets-reloaded-bizz-c-form-4";s:9:"condition";s:13:"is_front_page";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:10;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:159:"a:5:{s:9:"widget-id";s:30:"widgets-reloaded-bizz-search-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:11;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:13:"is_front_page";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:148:"a:5:{s:9:"widget-id";s:13:"bizz_social-4";s:9:"condition";s:13:"is_front_page";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:12;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:134:"a:5:{s:9:"widget-id";s:6:"text-6";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:13;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:13:"is_front_page";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:167:"a:5:{s:9:"widget-id";s:32:"widgets-reloaded-bizz-richtext-3";s:9:"condition";s:13:"is_front_page";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:14;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:161:"a:5:{s:9:"widget-id";s:32:"widgets-reloaded-bizz-archives-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:15;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:145:"a:5:{s:9:"widget-id";s:16:"bizz_practices-3";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:16;a:7:{s:10:"post_title";s:4:"post";s:12:"post_excerpt";s:11:"is_singular";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:154:"a:5:{s:9:"widget-id";s:20:"bizz-comments-form-3";s:9:"condition";s:11:"is_singular";s:4:"item";s:4:"post";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:17;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:9:"is_single";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:150:"a:5:{s:9:"widget-id";s:20:"bizz-comments-form-3";s:9:"condition";s:9:"is_single";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:18;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:9:"is_single";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:150:"a:5:{s:9:"widget-id";s:20:"bizz-comments-loop-3";s:9:"condition";s:9:"is_single";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:19;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:134:"a:5:{s:9:"widget-id";s:6:"text-7";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}i:20;a:7:{s:10:"post_title";s:3:"all";s:12:"post_excerpt";s:8:"is_index";s:11:"post_status";s:7:"publish";s:9:"post_type";s:11:"bizz_widget";s:12:"post_content";s:142:"a:5:{s:9:"widget-id";s:13:"bizz_social-5";s:9:"condition";s:8:"is_index";s:4:"item";s:3:"all";s:6:"parent";s:5:"false";s:4:"show";s:4:"true";}";s:21:"post_content_filtered";s:8:"law-firm";s:4:"type";s:7:"widgets";}}s:10:"grid_posts";N;s:16:"sidebars_widgets";a:1:{i:0;a:3:{s:11:"option_name";s:16:"sidebars_widgets";s:12:"option_value";a:9:{s:21:"bizz_inactive_widgets";a:1:{i:0;s:13:"bizz_social-4";}s:9:"sidebar-1";a:1:{i:0;s:28:"widgets-reloaded-bizz-logo-3";}s:9:"sidebar-2";a:1:{i:0;s:6:"text-3";}s:9:"sidebar-3";a:2:{i:0;s:16:"bizz_practices-3";i:1;s:30:"widgets-reloaded-bizz-c-form-5";}s:9:"sidebar-4";a:7:{i:0;s:32:"widgets-reloaded-bizz-nav-menu-3";i:1;s:30:"widgets-reloaded-bizz-slider-4";i:2;s:32:"widgets-reloaded-bizz-richtext-3";i:3;s:28:"widgets-reloaded-bizz-loop-3";i:4;s:20:"bizz-comments-loop-3";i:5;s:20:"bizz-comments-form-3";i:6;s:13:"bizz_social-5";}s:9:"sidebar-5";a:1:{i:0;s:6:"text-6";}s:9:"sidebar-6";a:0:{}s:19:"wp_inactive_widgets";a:27:{i:0;s:6:"meta-2";i:1;s:6:"text-2";i:2;s:17:"recent-comments-2";i:3;s:5:"rss-2";i:4;s:32:"widgets-reloaded-bizz-archives-2";i:5;s:34:"widgets-reloaded-bizz-categories-2";i:6;s:20:"bizz-comments-form-2";i:7;s:20:"bizz-comments-loop-2";i:8;s:30:"widgets-reloaded-bizz-c-form-2";i:9;s:30:"widgets-reloaded-bizz-c-form-3";i:10;s:30:"widgets-reloaded-bizz-flickr-2";i:11;s:30:"widgets-reloaded-bizz-flickr-3";i:12;s:30:"widgets-reloaded-bizz-flickr-4";i:13;s:30:"widgets-reloaded-bizz-flickr-5";i:14;s:28:"widgets-reloaded-bizz-logo-2";i:15;s:28:"widgets-reloaded-bizz-loop-2";i:16;s:32:"widgets-reloaded-bizz-nav-menu-2";i:17;s:29:"widgets-reloaded-bizz-pages-2";i:18;s:18:"bizz-query-posts-2";i:19;s:32:"widgets-reloaded-bizz-richtext-2";i:20;s:30:"widgets-reloaded-bizz-search-2";i:21;s:9:"twitter-2";i:22;s:16:"bizz_practices-2";i:23;s:30:"widgets-reloaded-bizz-slider-2";i:24;s:30:"widgets-reloaded-bizz-slider-3";i:25;s:13:"bizz_social-2";i:26;s:13:"bizz_social-3";}s:13:"array_version";i:3;}s:4:"type";s:16:"sidebars_widgets";}}}}';
	