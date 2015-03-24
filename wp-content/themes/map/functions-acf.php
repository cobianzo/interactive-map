<?php

if(function_exists("register_field_group"))
{
	
	/*
		the content wp field doesnt work when this plugin is actived. So we replace it for an acf field called content		
	*/
	if ((array_key_exists("post", $_REQUEST)) && ( $rr = $_REQUEST["post"])) 
		$post = get_post($rr);
	
	
	$maps_for_select			=	array();
	$post_lang					=   function_exists("pll_get_post_language")?    pll_get_post_language($post->ID) : "es";	// use only posts on this language
	$maps_without_parent	= 	get_posts(array("post_type" => "mapa", "posts_per_page" => -1, "post_parent" => 0,
																	"tax_query" => array(array(	"taxonomy" => "language" , "field" => "slug", "terms" => $post_lang))));
	foreach ($maps_without_parent as $i => $mapp)	$maps_for_select[$mapp->ID] = get_the_title($mapp->ID);
	//$is_mapa_with_parent = null;
	//if ( (is_object($post)) && ($post->post_type == "mapa")) :
		//$is_mapa_with_parent = wp_get_post_parent_id( $post->ID );
		//$children = get_pages('child_of='.$post->ID."&sort_column=menu_order&sort_order=ASC");
		//if (count($children)) $is_mapa_with_children = true;
	//endif; 
	
	
	
	
	register_field_group(array (
		'id' => 'acf_campos-del-mapa',
		'title' => 'Campos del Mapa',
		'fields' => array (
			array (
				'key' => 'field_550b0edb33e4e',
				'label' => 'Imagen del mapa HI',
				'name' => 'mapa_hi',
				'type' => 'image',
				'instructions' => 'Selecciona una imagen para el mapa. Se recomienda una resolución alta, de unos 3000x3000',
				'required' => 1,
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (		/* TO_DO: reemplazar esto por el título del mapa */
				'key' => 'field_550ca729fb423',
				'label' => 'Nombre a mostrar en Lista',
				'name' => 'category_name',
				'type' => 'text',
				'instructions' => 'En la parte izquierda del mapa aparece una lista con los monumentos de este mapa. Por ejemplo, si el mapa corresponde a la península de Yucatán puedes poner "Emplazamientos arqueológicos", si el mapa es de Tulúm puedes escribir sencillamente "Tulúm". Deja vacío para que no se cree una categoría en la lista.',
				'default_value' => '',
				'placeholder' => 'ej. Monumentos de Tulúm',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_parent',
					'operator' => '==',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mapa',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	
	

	register_field_group(array (
		'id' => 'acf_campos-del-monumento',
		'title' => 'Campos del Monumento',
		'fields' => array (
			array (
				'key' => 'field_550ca79faaaaaa',
				'label' => 'Hotspot en Mapa',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_550b0e5bbbbbb',
				'label' => 'Instrucciones',
				'name' => '',
				'type' => 'message',
				'message' => 'Para saber con exactitud las coordenadas, visita el mapa cuando estés conectado como administrador. Verás las coordenadas del ratón al pasar sobre el mapa.',
			),
			array (
				'key' => 'field_550b0d5cccccc',
				'label' => 'Descripción de una linea',
				'name' => 'descripcion',
				'type' => 'text',
				'instructions' => 'Breve descripción de pocas palabras',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_550b0c1dddddd',
				'label' => 'Coordenada X',
				'name' => 'pos_x',
				'type' => 'number',
				'instructions' => 'Coordenada X en %',
				'required' => 1,
				'default_value' => 50,
				'placeholder' => 'entre 0 y 100',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			array (
				'key' => 'field_550c851eeeeee',
				'label' => 'Coordenada Y',
				'name' => 'pos_y',
				'type' => 'number',
				'instructions' => 'Posición en % del eje Y',
				'required' => 1,
				'default_value' => 50,
				'placeholder' => 'entre 0 y 100',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			array (
				'key' => 'field_550b0db7ffffff',
				'label' => 'Icono',
				'name' => 'icono',
				'type' => 'image',
				'instructions' => 'Escoge un icono cuadrado (si no lo es será recortado). No importa el tamaño de la imagen, el programa creará una versión en miniatura.
	Esta imagen aparecerá a la izquierda del nombre del monumento',
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),			
			array (
				'key' => 'field_55109d9e479f3',
				'label' => 'selection',
				'name' => 'selection',
				'type' => 'select',
				'instructions' => 'Si deseas que al clicar en este hotspot, se cargue otro mapa, selecciona cual. Normalmente esta casilla estará vacía, y al clicar en el hotspot se abrirá una ventana con información adicional del monumento, que se rellena en la pesta&ntilde;a "Popop del monumento"',
				'choices' => $maps_for_select,
				'default_value' => null,
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_550ca7aaaaa',
				'label' => 'Popup de monumento',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_550ca8bbbbba',
				'label' => 'Imagen de título',
				'name' => 'imagen_titulo',
				'type' => 'image',
				'instructions' => 'Si deseas que el popup muestre una imagen para el título, selecciónala de la galería o súbela aquí.',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_551179c29e909',
				'label' => 'Contenido',
				'name' => 'contenido',
				'type' => 'textarea',
				'instructions' => 'Escribe aquí la descripción completa del emplazamiento.',
				'default_value' => '',
				'placeholder' => 'Ej: "La ciudad prehispánica de Chichén Itzá fue la capital más sobresaliente..."',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (			
			array (
				array (
					'param' => 'page_parent',
					'operator' => '!=',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'mapa',
					'order_no' => 1,
					'group_no' => 0,
				),
			),			
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
