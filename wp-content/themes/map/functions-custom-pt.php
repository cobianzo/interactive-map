<?php

// Register Custom Mapa
// Hook into the 'init' action
add_action( 'init', 'veras_custom_post_types', 0 );
function veras_custom_post_types() {

	// REGISTRAR LOS MAPAS PRINCIPALES: corresponderán al mapa de Yucatán, el de Tulúm ...
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'admin-map' ),
		'name'                => _x( 'Mapas', 'Mapa General Name', 'admin-map' ),		'singular_name'       => _x( 'Mapa', 'Mapa Singular Name', 'admin-map' ),
		'menu_name'           => __( 'Mapa + Hotspots', 'admin-map' ),										'parent_item_colon'   => __( 'Mapa padre (si este item es un hotspot)', 'admin-map' ),	
		'all_items'           => __( 'Todos los mapas y hotspots', 'admin-map' ),							'view_item'           => __( 'Ver Mapa  o Hotspot', 'admin-map' ),
		'add_new_item'        => __( 'Nuevo Mapa o Hotspot', 'admin-map' ),								'add_new'             => __( 'Añade nuevo mapa o hotspot', 'admin-map' ),
		'edit_item'           => __( 'Edita Mapa o Hotspot', 'admin-map' ),									'update_item'         => __( 'Actualiza Mapa o Hotspot', 'admin-map' ),
		'search_items'        => __( 'Busca Item', 'admin-map' ),								'not_found'           => __( 'No encontrado', 'admin-map' ),	);
		
	$args = array(
		'label'               => __( 'mapa', 'admin-map' ),		'description'         => __( 'Mapa Description', 'admin-map' ),
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
	$labels = array(		'name'                => _x( 'Monumentos', 'Monumento General Name', 'admin-map' ),
		'singular_name'       => _x( 'Monumento', 'Monumento Singular Name', 'admin-map' ),		'menu_name'           => __( 'Monumento', 'admin-map' ),
		'parent_item_colon'   => __( 'Item padre:', 'admin-map' ),												'all_items'           => __( 'Todos los items', 'admin-map' ),
		'view_item'           => __( 'Ver Item', 'admin-map' ),															'add_new_item'        => __( 'Nuevo Item', 'admin-map' ),
		'add_new'             => __( 'Añade nuevo', 'admin-map' ),													'edit_item'           => __( 'Edita Item', 'admin-map' ),
		'update_item'         => __( 'Actualiza Item', 'admin-map' ),												'search_items'        => __( 'Busca Item', 'admin-map' ),
		'not_found'           => __( 'No encontrado', 'admin-map' ),												'not_found_in_trash'  => __( 'No encontrado en Trash', 'admin-map' ),
	);
	$args = array(
		'label'               => __( 'monumento', 'admin-map' ),		'description'         => __( 'Monumento Description', 'admin-map' ),
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
	
	
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'admin-map' ),
		'name'                => _x( 'Promos', 'Promo General Name', 'admin-map' ),		'singular_name'       => _x( 'Promo', 'Promo Singular Name', 'admin-map' ),
		'menu_name'           => __( 'Bloque Img+Text', 'admin-map' ),										'parent_item_colon'   => __( 'bloque padre:', 'admin-map' ),
		'all_items'           => __( 'Todos los bloques', 'admin-map' ),							'view_item'           => __( 'Ver bloque', 'admin-map' ),
		'add_new_item'        => __( 'Nuevo bloque', 'admin-map' ),								'add_new'             => __( 'Añade nuevo', 'admin-map' ),
		'edit_item'           => __( 'Edita bloque', 'admin-map' ),									'update_item'         => __( 'Actualiza bloque', 'admin-map' ),
		'search_items'        => __( 'Busca Item', 'admin-map' ),								'not_found'           => __( 'No encontrado', 'admin-map' ),	);
		
	$args = array(
		'label'               => __( 'promo', 'admin-map' ),		'description'         => __( 'Promo Description', 'admin-map' ),
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
 
 
 	
	$labels = array(				'not_found_in_trash'  => __( 'No encontrado en Trash', 'admin-map' ),
		'name'                => _x( 'Galerias', 'Galeria General Name', 'admin-map' ),		'singular_name'       => _x( 'Galeria', 'Galeria Singular Name', 'admin-map' ),
		'menu_name'           => __( 'Galerías Imgs', 'admin-map' ),						'parent_item_colon'   => __( 'Item padre:', 'admin-map' ),
		'all_items'           => __( 'Todos las galerias', 'admin-map' ),							'view_item'           => __( 'Ver Item', 'admin-map' ),
		'add_new_item'        => __( 'Nueva galeria', 'admin-map' ),								'add_new'             => __( 'Añade nuevo galeria', 'admin-map' ),
		'edit_item'           => __( 'Edita galeria', 'admin-map' ),									'update_item'         => __( 'Actualiza galeria', 'admin-map' ),
		'search_items'        => __( 'Busca galeria', 'admin-map' ),								'not_found'           => __( 'No encontrado', 'admin-map' ),	);
		
	$args = array(
		'label'               => __( 'galeria', 'admin-map' ),		'description'         => __( 'Galeria Description', 'admin-map' ),
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
