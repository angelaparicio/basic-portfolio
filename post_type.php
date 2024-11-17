<?php

	defined('ABSPATH' ) or die('No script kiddies please!' );

	/*Custom post type*/
	add_action( 'init', function(){
	
		$labels = array(
			'name'               	=> __( 'Trabajos', 'basic-portfolio'),
			'singular_name'      	=> __( 'Trabajo', 'basic-portfolio'),
			'add_new'            	=> __( 'Nuevo trabajo', 'basic-portfolio'),
			'add_new_item'       	=> __( 'Nuevo trabajo', 'basic-portfolio'),
			'edit_item'          	=> __( 'Modificar trabajo', 'basic-portfolio'),
			'view_item'          	=> __( 'Ver trabajo', 'basic-portfolio'),
			'search_items'       	=> __( 'Buscar trabajos', 'basic-portfolio'),
			'not_found'          	=> __( 'No se han encontrado resultados', 'basic-portfolio'),
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
			    'name'             => _x( 'Categorías', 'taxonomy general name', 'basic-portfolio'),
			    'singular_name'    => _x( 'Categoría', 'taxonomy singular name', 'basic-portfolio'),
			    'search_items'     => __( 'Buscar por categoría', 'basic-portfolio'),
			    'all_items'        => __( 'Todas las categorías', 'basic-portfolio'),
			    'parent_item'      => null,
			    'parent_item_colon'=> null,
			    'edit_item'        => __( 'Editar categoría', 'basic-portfolio'),
			    'update_item'      => __( 'Actualizar categoría', 'basic-portfolio'),
			    'add_new_item'     => __( 'Añadir nueva categoría', 'basic-portfolio'),
			    'new_item_name'    => __( 'Nueva categoría', 'basic-portfolio'),
			    'most_used'		   => __( 'Más utilizadas', 'basic-portfolio'),
			  )
	  	));
	  
	});	