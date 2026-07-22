<?php
	
	/*
	Plugin Name: Basic Portfolio
	Description: Very simple plugin to create a jobs portfolio
	Author: Angel Aparicio
	Version: 0.3
	Text Domain: basic-portfolio
	License: GPLv3 or later
	License URI: https://www.gnu.org/licenses/gpl-3.0.html
	*/
	
	defined('ABSPATH' ) or die('No script kiddies please!' );
	
	/*Definición de constantes*/
	define( 'BASIC_PORTFOLIO_VERSION', '0.3' );
	define( 'BASIC_PORTFOLIO_PATH', plugin_dir_path( __FILE__ ) );
	define( 'BASIC_PORTFOLIO_URL', plugin_dir_url( __FILE__ ) );
	
	/*Añadimos archivos necesarios*/
	require_once BASIC_PORTFOLIO_PATH . 'post_type.php';
	require_once BASIC_PORTFOLIO_PATH . 'metaboxes.php';
	require_once BASIC_PORTFOLIO_PATH . 'shortcode.php';

	
	/*Cargamos css*/
	function basic_portfolio_enqueue_assets() {
		wp_enqueue_style(
			'basic-portfolio-css',
			BASIC_PORTFOLIO_URL . 'assets/basic_portfolio.css',
			array(),
			BASIC_PORTFOLIO_VERSION
		);
	}
	add_action( 'wp_enqueue_scripts', 'basic_portfolio_enqueue_assets' );
	
	
	/**
	 * Modifica el contenido de la vista individual de un portafolio para adjuntar
	 * la imagen destacada y el rango de años trabajados.
	 *
	 * @param string $content Contenido original de la entrada.
	 * @return string Contenido modificado.
	 */
	function basic_portfolio_append_meta_content( $content ) {

		if ( ! is_singular( 'work-portfolio' ) || ! is_main_query() || ! in_the_loop() ) {
			return $content;
		}
	
		$post_id = get_the_ID();
	
		if ( has_post_thumbnail( $post_id ) ) {
			$content = get_the_post_thumbnail( $post_id, 'large' ) . $content;
		}
	
		$work_start_year = get_post_meta( $post_id, 'work_start_year', true );
		$work_end_year   = get_post_meta( $post_id, 'work_end_year', true );
	
		if ( ! empty( $work_start_year ) || ! empty( $work_end_year ) ) {
			$meta_html = sprintf(
				'<div class="meta_years"><strong>%s:</strong> %s - %s</div>',
				esc_html__( 'Fecha', 'basic-portfolio' ),
				esc_html( $work_start_year ),
				esc_html( $work_end_year )
			);
	
			$content .= $meta_html;
		}
	
		return $content;
	}
	add_filter( 'the_content', 'basic_portfolio_append_meta_content' );