<?php
	
	defined('ABSPATH' ) or die('No script kiddies please!' );

	add_shortcode( 'show_portfolio', function(){
		
		$shortcode = '<div id="work-porfolio-wrapper">';
		
		$posts = get_posts( array(
			'post_type' => 'work-portfolio',
			'numberposts' => 20
		));
		
		foreach ( $posts as $post ):
			
			$work_start_year = get_post_meta( $post->ID, 'work_start_year', true );
			$work_end_year = get_post_meta( $post->ID, 'work_end_year', true );
			
			$years = '';
			if ( $work_start_year && $work_end_year ){
				$years = ' ('.$work_start_year.' - '.$work_end_year.')';
			}
			else 
			if ( $work_start_year && !$work_end_year ){
				$years = ' ('.$work_start_year.')';
			}
			else 
			if ( !$work_start_year && $work_end_year ){
				$years = ' ('.$work_end_year.')';
			}
			
			
			$shortcode .= '<div id="work-porfolio-element-'.$post->ID.'" class="work-porfolio-element">';
				
				$shortcode .= '<a href="'.$post->guid.'">';
					$shortcode .= '<div class="work-porfolio-image">';
						$shortcode .= get_the_post_thumbnail($post->ID);
					$shortcode .= '</div>';
					$shortcode .= '<div class="work-porfolio-title">'.$post->post_title.$years.'</div>';
				$shortcode .= '</a>';
				 
			$shortcode .= '</div>';
			
		endforeach;
		
		$shortcode .= '</div>';

		return $shortcode;
	});