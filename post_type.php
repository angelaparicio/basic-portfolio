<?php

	defined('ABSPATH' ) or die('No script kiddies please!' );

	/*Custom post type*/
	add_action( 'init', function(){
	
		$labels = array(
			'name'               	=> __( 'Trabajos' ),
			'singular_name'      	=> __( 'Trabajo' ),
			'add_new'            	=> __( 'Nuevo trabajo' ),
			'add_new_item'       	=> __( 'Nuevo trabajo' ),
			'edit_item'          	=> __( 'Modificar trabajo' ),
			'view_item'          	=> __( 'Ver trabajo' ),
			'search_items'       	=> __( 'Buscar trabajos' ),
			'not_found'          	=> __( 'No se han encontrado resultados' ),
	    );
	    
		register_post_type('work-portfolio', array(
	     	'public' => true,
	        'has_archive' => true,     	
	     	'labels' => $labels,
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
	     	'menu_icon' => 'dashicons-admin-page',
		));
		
	  	register_taxonomy( 'categories-work-portfolio', 'work-portfolio', array(
	    	'hierarchical'       => false,
	    	'show_ui'            => true,
	    	'query_var'          => true,
	    	'rewrite'            => array( 'slug' => 'categories-work-portfolio' ),
	    	'labels'             => array(
			    'name'             => _x( 'Categorías', 'taxonomy general name' ),
			    'singular_name'    => _x( 'Categoría', 'taxonomy singular name' ),
			    'search_items'     => __( 'Buscar por categoría' ),
			    'all_items'        => __( 'Todas las categorías' ),
			    'parent_item'      => null,
			    'parent_item_colon'=> null,
			    'edit_item'        => __( 'Editar categoría' ),
			    'update_item'      => __( 'Actualizar categoría' ),
			    'add_new_item'     => __( 'Añadir nueva categoría' ),
			    'new_item_name'    => __( 'Nueva categoría' ),
			    'most_used'		   => __( 'Más utilizadas'),
			  )
	  	));
	  
	});	