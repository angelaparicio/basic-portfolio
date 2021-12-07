<?php

	add_shortcode( 'show_portfolio', function(){
		
		$shortcode = '<div id="work-porfolio-wrapper">';
		
		$posts = get_posts( array(
			'post_type' => 'work-portfolio',
			'numberposts' => 20
		));
		
		foreach ( $posts as $post ):
			
			$shortcode .= '<div id="work-porfolio-element-'.$post->ID.'" class="work-porfolio-element">';
				
				$shortcode .= '<a href="'.$post->guid.'">';
					$shortcode .= '<div class="work-porfolio-image">';
						$shortcode .= get_the_post_thumbnail($post->ID);
					$shortcode .= '</div>';
					$shortcode .= '<div class="work-porfolio-title">'.$post->post_title.'</div>';
				$shortcode .= '</a>';
				 
			$shortcode .= '</div>';
			
		endforeach;
		
		$shortcode .= '</div>';

		return $shortcode;
	});