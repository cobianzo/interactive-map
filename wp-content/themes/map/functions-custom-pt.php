<?php

// Register Custom Mapa
// Hook into the 'init' action
add_action( 'init', 'veras_custom_post_types', 0 );
function veras_custom_post_types() {

	// REGISTRAR LOS MAPAS PRINCIPALES: corresponderán al mapa de Yucatán, el de Tulúm ...
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'veras' ),
		'name'                => _x( 'Mapas', 'Mapa General Name', 'veras' ),		'singular_name'       => _x( 'Mapa', 'Mapa Singular Name', 'veras' ),
		'menu_name'           => __( 'Mapa + Hotspots', 'veras' ),										'parent_item_colon'   => __( 'Mapa padre (si este item es un hotspot)', 'veras' ),
		'all_items'           => __( 'Todos los mapas y hotspots', 'veras' ),							'view_item'           => __( 'Ver Mapa  o Hotspot', 'veras' ),
		'add_new_item'        => __( 'Nuevo Mapa o Hotspot', 'veras' ),								'add_new'             => __( 'Añade nuevo mapa o hotspot', 'veras' ),
		'edit_item'           => __( 'Edita Mapa o Hotspot', 'veras' ),									'update_item'         => __( 'Actualiza Mapa o Hotspot', 'veras' ),
		'search_items'        => __( 'Busca Item', 'veras' ),								'not_found'           => __( 'No encontrado', 'veras' ),	);
		
	$args = array(
		'label'               => __( 'mapa', 'veras' ),		'description'         => __( 'Mapa Description', 'veras' ),
		'labels'              => $labels,
		'supports'            => array( 'title',  'page-attributes' ,'thumbnail' , 'excerpt', 'comments' ) ,  /* thumbnail, */
		'taxonomies'          => array( 'category'), 
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,		'show_in_menu'        => true,		'show_in_nav_menus'   => true,		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'mapa', $args );

	
	/*
	$labels = array(		'name'                => _x( 'Monumentos', 'Monumento General Name', 'veras' ),
		'singular_name'       => _x( 'Monumento', 'Monumento Singular Name', 'veras' ),		'menu_name'           => __( 'Monumento', 'veras' ),
		'parent_item_colon'   => __( 'Item padre:', 'veras' ),												'all_items'           => __( 'Todos los items', 'veras' ),
		'view_item'           => __( 'Ver Item', 'veras' ),															'add_new_item'        => __( 'Nuevo Item', 'veras' ),
		'add_new'             => __( 'Añade nuevo', 'veras' ),													'edit_item'           => __( 'Edita Item', 'veras' ),
		'update_item'         => __( 'Actualiza Item', 'veras' ),												'search_items'        => __( 'Busca Item', 'veras' ),
		'not_found'           => __( 'No encontrado', 'veras' ),												'not_found_in_trash'  => __( 'No encontrado en Trash', 'veras' ),
	);
	$args = array(
		'label'               => __( 'monumento', 'veras' ),		'description'         => __( 'Monumento Description', 'veras' ),
		'labels'              => $labels,
		'supports'            => array( 'title',  'page-attributes' , 'thumbnail' , 'excerpt' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,		'show_in_menu'        => true,		'show_in_nav_menus'   => true,		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'monumento', $args );
	*/
	
	
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'veras' ),
		'name'                => _x( 'Promos', 'Promo General Name', 'veras' ),		'singular_name'       => _x( 'Promo', 'Promo Singular Name', 'veras' ),
		'menu_name'           => __( 'Bloque Img+Text', 'veras' ),										'parent_item_colon'   => __( 'bloque padre:', 'veras' ),
		'all_items'           => __( 'Todos los bloques', 'veras' ),							'view_item'           => __( 'Ver bloque', 'veras' ),
		'add_new_item'        => __( 'Nuevo bloque', 'veras' ),								'add_new'             => __( 'Añade nuevo', 'veras' ),
		'edit_item'           => __( 'Edita bloque', 'veras' ),									'update_item'         => __( 'Actualiza bloque', 'veras' ),
		'search_items'        => __( 'Busca Item', 'veras' ),								'not_found'           => __( 'No encontrado', 'veras' ),	);
		
	$args = array(
		'label'               => __( 'promo', 'veras' ),		'description'         => __( 'Promo Description', 'veras' ),
		'labels'              => $labels,
		'supports'            => array( 'title',  'editor', 'page-attributes' ,'thumbnail'  ) ,  /* thumbnail, */
		//'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,		'show_in_menu'        => true,		'show_in_nav_menus'   => true,		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'promo', $args );
 
 
 	
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'veras' ),
		'name'                => _x( 'Galerias', 'Galeria General Name', 'veras' ),		'singular_name'       => _x( 'Galeria', 'Galeria Singular Name', 'veras' ),
		'menu_name'           => __( 'Galerías Imgs', 'veras' ),						'parent_item_colon'   => __( 'Item padre:', 'veras' ),
		'all_items'           => __( 'Todos las galerias', 'veras' ),							'view_item'           => __( 'Ver Item', 'veras' ),
		'add_new_item'        => __( 'Nueva galeria', 'veras' ),								'add_new'             => __( 'Añade nuevo galeria', 'veras' ),
		'edit_item'           => __( 'Edita galeria', 'veras' ),									'update_item'         => __( 'Actualiza galeria', 'veras' ),
		'search_items'        => __( 'Busca galeria', 'veras' ),								'not_found'           => __( 'No encontrado', 'veras' ),	);
		
	$args = array(
		'label'               => __( 'galeria', 'veras' ),		'description'         => __( 'Galeria Description', 'veras' ),
		'labels'              => $labels,
		'supports'            => array( 'title',  'editor', 'page-attributes' ,'thumbnail'  ) ,  /* thumbnail, */
		'taxonomies'          => array(  ),
		'hierarchical'        => false,		'public'              => true,
		'show_ui'             => true,			'show_in_menu'        => true,		'show_in_nav_menus'   => true,		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'can_export'          => true,		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'galeria', $args );

	// unregister_post_type( 'post' ) ;
	
	
}

add_action('admin_menu', 'post_remove');   //adding action for triggering function call
function post_remove ()      {    remove_menu_page('edit.php'); }


function unregister_post_type( $post_type ) {
	
    global $wp_post_types;
	if ( isset( $wp_post_types[ $post_type ] ) ) {
        unset( $wp_post_types[ $post_type ] );
        return true;
    }
    return false;
}
