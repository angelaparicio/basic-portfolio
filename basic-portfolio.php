<?php
	
	/*
	Plugin Name: Basic Portfolio
	Description: Very simple plugin to create a works portfolio
	Author: Angel Aparicio
	Version: 0.1
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
	
	
	add_filter( 'the_content', function( $content ) {
		
		global $post;
		
		if ( is_single() && $post->post_type == 'work-portfolio' && has_post_thumbnail($post->ID) ) {
			
			$content = get_the_post_thumbnail($post->ID, 'large') . $content;
			
			$work_start_year = get_post_meta( $post->ID, 'work_start_year', true );
			$work_end_year = get_post_meta( $post->ID, 'work_end_year', true );
			
			$content = $content . '<div class="meta_years"><strong>'.esc_html_e('Fecha', 'basic-portfolio').':</strong> ';
			$content = $content . esc_html($work_start_year).' - '.esc_html($work_end_year);
			$content = $content . '</div>';
		}
		
		return $content;
	});