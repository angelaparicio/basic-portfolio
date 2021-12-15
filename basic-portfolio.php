<?php
	
	/*
	Plugin Name: Basic Portfolio
	Description: Plugin muy simple para crear un portfolio de trabajos
	Author: Angel Aparicio
	Version: 0.2
	License: GPLv3 or later
	License URI: https://www.gnu.org/licenses/gpl-3.0.html
	*/
	
	defined('ABSPATH' ) or die('No script kiddies please!' );

	include( dirname( __FILE__ ) . '/post_type.php' );
	include( dirname( __FILE__ ) . '/metaboxes.php' );
	include( dirname( __FILE__ ) . '/shortcode.php' );

	
	add_action('wp_head', function(){
		wp_enqueue_style( 'basic_portafolio_css', plugins_url('assets/basic_portfolio.css', __FILE__) );
	});