<?php
/**
 * Registro del Custom Post Type y Taxonomías del Portfolio.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Basic_Portfolio_CPT {

	/**
	 * Inicializa los ganchos (hooks) de WordPress.
	 */
	public function init() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	/**
	 * Registra el Custom Post Type 'work-portfolio'.
	 */
	public function register_post_type() {
		$labels = array(
			'name'                  => _x( 'Trabajos', 'Post Type General Name', 'basic-portfolio' ),
			'singular_name'         => _x( 'Trabajo', 'Post Type Singular Name', 'basic-portfolio' ),
			'menu_name'             => __( 'Portafolio', 'basic-portfolio' ),
			'all_items'             => __( 'Todos los trabajos', 'basic-portfolio' ),
			'add_new'               => __( 'Añadir nuevo', 'basic-portfolio' ),
			'add_new_item'          => __( 'Añadir nuevo trabajo', 'basic-portfolio' ),
			'edit_item'             => __( 'Modificar trabajo', 'basic-portfolio' ),
			'view_item'             => __( 'Ver trabajo', 'basic-portfolio' ),
			'search_items'          => __( 'Buscar trabajos', 'basic-portfolio' ),
			'not_found'             => __( 'No se han encontrado resultados', 'basic-portfolio' ),
			'not_found_in_trash'    => __( 'No se han encontrado trabajos en la papelera', 'basic-portfolio' ),
		);

		$args = array(
			'label'               => __( 'Trabajo', 'basic-portfolio' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
			'public'              => true,
			'has_archive'         => true,
			'show_in_rest'        => true, // Habilita el editor Gutenberg y API REST
			'menu_icon'           => 'dashicons-portfolio', // Icono más adecuado que admin-page
			'rewrite'             => array( 'slug' => 'trabajos' ), // URL amigable
		);

		register_post_type( 'work-portfolio', $args );
	}

	/**
	 * Registra la Taxonomía 'categories-work-portfolio'.
	 */
	public function register_taxonomy() {
		$labels = array(
			'name'              => _x( 'Categorías', 'taxonomy general name', 'basic-portfolio' ),
			'singular_name'     => _x( 'Categoría', 'taxonomy singular name', 'basic-portfolio' ),
			'search_items'      => __( 'Buscar por categoría', 'basic-portfolio' ),
			'all_items'         => __( 'Todas las categorías', 'basic-portfolio' ),
			'edit_item'         => __( 'Editar categoría', 'basic-portfolio' ),
			'update_item'       => __( 'Actualizar categoría', 'basic-portfolio' ),
			'add_new_item'      => __( 'Añadir nueva categoría', 'basic-portfolio' ),
			'new_item_name'     => __( 'Nueva categoría', 'basic-portfolio' ),
			'menu_name'         => __( 'Categorías', 'basic-portfolio' ),
		);

		$args = array(
			'hierarchical'      => true, // Cambiado a true si se comportará como categorías (padres e hijas)
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true, // Muestra la columna en la lista del panel de control
			'query_var'         => true,
			'show_in_rest'      => true, // Habilita Gutenberg/REST API para la taxonomía
			'rewrite'           => array( 'slug' => 'categoria-trabajo' ),
		);

		register_taxonomy( 'categories-work-portfolio', array( 'work-portfolio' ), $args );
	}
}

// Inicializar el módulo
$basic_portfolio_cpt = new Basic_Portfolio_CPT();
$basic_portfolio_cpt->init();