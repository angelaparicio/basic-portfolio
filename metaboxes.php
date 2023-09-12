<?php

defined('ABSPATH' ) or die('No script kiddies please!' );

add_action( 'add_meta_boxes', function() {
	add_meta_box( 'work_portfolio_custom_fields', esc_html_e('Fecha inicio y final', 'basic-portfolio'), 'apbp_work_portfolio_custom_fields_render' , 'work-portfolio' );
});


function apbp_work_portfolio_custom_fields_render($post){

	$work_start_year = get_post_meta( $post->ID, 'work_start_year', true );
	$work_end_year = get_post_meta( $post->ID, 'work_end_year', true );

	wp_nonce_field( 'work_portfolio_save', 'work_portfolio_nonce' );	
	
	echo '<p><label for="work_start_year" style="width: 150px;display: inline-block;">'.esc_html_e('Año de inicio', 'basic-portfolio').'</label>';
	echo '<input type="number" name="work_start_year" id="work_start_year" value="'.esc_html($work_start_year).'" /></p>';
	
	echo '<p><label for="work_end_year" style="width: 150px;display: inline-block;">'.esc_html_e('Año de finalización', 'basic-portfolio').'</label>'; 
	echo '<input type="number" name="work_end_year" id="work_end_year" value="'.esc_html($work_end_year).'" /></p>';
}



add_action( 'save_post', function($post_id) {

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;

	if ( empty($_REQUEST['work_portfolio_nonce']) || !wp_verify_nonce( wp_unslash($_POST['work_portfolio_nonce']), 'work_portfolio_save' ) ) return;
	
	if ( !current_user_can('edit_posts') ) return;

	$work_start_year = sanitize_text_field($_POST['work_start_year']);
	if ( $work_start_year ){
		update_post_meta( $post_id, 'work_start_year', $work_start_year );
	}

	$work_end_year = sanitize_text_field($_POST['work_end_year']);
	if ( $work_end_year ){
		update_post_meta( $post_id, 'work_end_year', $work_end_year);
	}
	
});