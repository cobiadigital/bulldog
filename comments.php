<?php

/* 
   WARNING! DO NOT EDIT THIS FILE!

*/

	// Prevent direct access to this file
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('' . __('Please do not load this page directly. Thanks!', 'bizzthemes') . '');
	// Check for password protection
	if ( post_password_required() ) { 
	    echo "<p>" . __('This post is password protected. Enter the password to view comments.', 'bizzthemes') . "</p>\n";
		return; 
	}
	
    comments_template( '', false );