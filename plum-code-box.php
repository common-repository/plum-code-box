<?php
	/* ********************************************
		Plugin Name: Plum Code Box
		Plugin URI: http://www.codeplum.com/wordpress-plugins
		Description: Plum Code Box makes it easy to insert and manage code blocks on a website using the Chili javascript syntax highlighter.
		Version: 1.1
		Author: James Thompson
		Author URI: http://codeplum.com
		License: GPL2
		
	   ******************************************* */
	
	if ( is_admin() )
		require 'classes/Plum_Code_Box_Admin.php';
	else
		require 'classes/Plum_Code_Box_Front.php';
?>
