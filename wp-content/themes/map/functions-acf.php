<?php

if(function_exists("register_field_group"))
{
	
	/*
		the content wp field doesnt work when this plugin is actived. So we replace it for an acf field called content		
	*/
	if ((array_key_exists("post", $_REQUEST)) && ( $rr = $_REQUEST["post"])) 
		$post = get_post($rr);
	
	
	$maps_for_select			=	array( );
	$post_lang					=   function_exists("pll_get_post_language")?    pll_get_post_language($post->ID) : "es";	// use only posts on this language
	$maps_without_parent	= 	get_posts(array("post_type" => "mapa", "posts_per_page" => -1, "post_parent" => 0, "lang" => $post_lang));
																	//"tax_query" => array(array(	"taxonomy" => "language" , "field" => "slug", "terms" => $post_lang))));
	foreach ($maps_without_parent as $i => $mapp)	$maps_for_select[$mapp->ID] = get_the_title($mapp->ID);
	
	
	$promos_for_select = array();
	$promos_posts		= get_posts(array("post_type" => "promo", "posts_per_page" => -1,	"lang" => $post_lang ));
	foreach ($promos_posts as $promo_post)  $promos_for_select[$promo_post->ID] = $promo_post->post_title;
	
	# calcular las categorías que acepta 
	# 1. recogemos la categoría que tiene el mapa padre
	# 2. tomamos todas las categorías hijas
	
	
	/* estos campos se aplican sólo a los mapas: "mapa" que no tienen padre*/
	register_field_group(array (
		'id' => 'acf_campos-del-mapa',		'title' => 'Campos del Mapa',
		'fields' => array (
		
			/* TAB -----------------*/
			array ( 	'type' => 'tab', 'key' => 'field_550ca79f1111111',	'label' => 'Principal',	'name' => '',	),
			/* -----------------------  */
		
			array (		/* TO_DO: reemplazar esto por el título del mapa */
				'key' => 'field_550ca729fb423',				'label' => 'Título a mostrar en la web',				'name' => 'category_name',
				'type' => 'text',
				'instructions' => 'El título de arriba es identificativo a nivel de administración, pero no se vé en la web. Escribe aquí el título que el usuario leerá (traducido al idioma de este mapa)..',
				'default_value' => '',				'placeholder' => 'ej. Mapa de Tulúm',				'prepend' => '',				'append' => '',
				'formatting' => 'html',				'maxlength' => '',
			),
			array (
				'key' => 'field_550b0edb33e4e',				'label' => 'Imagen del mapa HI',				'name' => 'mapa_hi',
				'type' => 'image',
				'instructions' => 'Selecciona una imagen para el mapa. Se recomienda una resolución alta, de unos 3000x3000',
				'required' => 1,
				'save_format' => 'id',				'preview_size' => 'medium',				'library' => 'all',
			),
			
			
			
			
			/* TAB -----------------*/
			array ( 	'type' => 'tab', 'key' => 'field_550ca79222222',	'label' => 'Galería imgs',	'name' => '',	),
			/* -----------------------  */
		array (
				'key' => 'field_551c7191c0a81',
				'label' => 'Galeria',
				'name' => 'galeria_id',
				'type' => 'post_object',
				'instructions' => 'Selecciona la galería que mostrará las . Recuerda que la galería debe haber sido creada previamente.',
				'post_type' => array (
					0 => 'galeria',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
			
			array (
				'key' => 'field_551ac9c287087',
				'label' => 'Galería',
				'name' => 'galeria',
				'type' => 'repeater',
				'instructions' => 'Selecciona las imágenes. Recuerda que al seleccionar la imagen puedes editar su título en diferentes idiomas ',
				'sub_fields' => array (
					array (
						'key' => 'field_551aca0387088',
						'label' => 'Imagen',
						'name' => 'imagen',
						'type' => 'image',
						'instructions' => 'Selcciona imagen',
						'column_width' => 20,
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Nueva imagen',
			),
			
			
			/* TAB -----------------*/
			array ( 	'type' => 'tab', 'key' => 'field_550ca79233333',	'label' => 'Galería videos',	'name' => '',	),
			/* -----------------------  */
			
			array (
				'key' => 'field_551aca496ca5c',
				'label' => 'Galería Videos',
				'name' => 'galeria_videos',
				'type' => 'repeater',
				'instructions' => 'Selecciona los vídeos asociados. Deberás copiar el código html (iframe) en el campo correspondiente ',
				'sub_fields' => array (
					array (
						'key' => 'field_551aca7e6ca5d',
						'label' => 'Titulo',
						'name' => 'titulo',
						'type' => 'text',
						'instructions' => 'Título del video',
						'column_width' => 25,
						'default_value' => '',
						'placeholder' => 'Ej. Visita a Chichén Itzá',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_551acb026ca5e',
						'label' => 'Descripción',
						'name' => 'descripcion',
						'type' => 'textarea',
						'instructions' => 'Descripción del vídeo',
						'column_width' => 25,
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'br',
					),
					array (
						'key' => 'field_551acb396ca5f',
						'label' => 'Imagen preview',
						'name' => 'imagen_preview',
						'type' => 'image',
						'instructions' => 'Selcciona la imagen en miniatura para abrir el vídeo. Si es un video de youtube, no es necesario que crees la imagen (se hará automáticamente)',
						'column_width' => 25,
						'save_format' => 'id',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_551acb5c6ca60',
						'label' => 'Video embed',
						'name' => 'video_embed',
						'type' => 'textarea',
						'instructions' => 'Escríbe el html para embeber el video. iframe recomendado. En youtube, selecciona compartir, y luego insertar, y copiar el código html',
						'column_width' => 25,
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 3,
						'formatting' => 'none',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Añade video',
			),
			
			
			array ( 	'type' => 'tab', 'key' => 'field_550ca79233332',	'label' => 'Antes / Ahora',	'name' => '',	),
			/* -----------------------  */
			
			
			array (
				'key' => 'field_551b17f6e347b',
				'label' => 'Antes / Ahora',
				'name' => 'antes_ahora',
				'type' => 'repeater',
				'instructions' => 'Selecciona las dos imágenes de comparación. Una para antes y otra para ahora.',
				'sub_fields' => array (
					array (
						'key' => 'field_551b1864e347c',
						'label' => 'Imagen Antes',
						'name' => 'img_antes',
						'type' => 'image',
						'instructions' => 'Imagen de antes',
						'column_width' => 50,
						'save_format' => 'id',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_551b1880e347d',
						'label' => 'Imagen_ahora',
						'name' => 'img_ahora',
						'type' => 'image',
						'instructions' => 'Imagen de ahora',
						'column_width' => 50,
						'save_format' => 'id',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_551b1fa3b6589',
						'label' => 'Descripcion',
						'name' => 'descripcion',
						'type' => 'text',
						'instructions' => 'Escribe una breve descripción de las imágenes',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => 1,
				'layout' => 'row',
				'button_label' => 'Añade las imágenes Antes/Ahora',
			),
			
			/* TAB -----------------*/
			array ( 	'type' => 'tab', 'key' => 'field_550ca79244444',	'label' => 'Bloques promo',	'name' => '',	),
			/* -----------------------  */
			/* TAB -----------------*/

			
			array (
				'key' => 'field_551f49f9f8cc0',
				'label' => 'Promos List',
				'name' => 'promos_list',
				'type' => 'repeater',
				'sub_fields' => array (
					array ( 	'name' => 'predefinida_o_custom',  'key' => 'field_551f4a2df8cc1',	'label' => 'Predefinida o Custom',						
						'type' => 'radio',
						'instructions' => 'Si la promo que quieres añadir ya ha sido definida en la sección "Bloque Img+Text", selecciona "Predefinida". Si la quieres crear tú al vuelo selecciona "Customizada"',
						'required' => 1,	'column_width' => 20,
						'choices' => array (	0 => 'Predefinida',		1 => 'Customizada',	),
						'other_choice' => 0,					'save_other_choice' => 0,						'default_value' => 0,						'layout' => 'vertical',
					),
					array ( 	'name' => 'predefinida', 'key' => 'field_551f4aa4f8cc2',	'label' => 'Predefinida',
						'type' => 'select',
						'instructions' => 'Selecciona el nombre de la promo',
						'required' => 1,
						'conditional_logic' => array ('status' => 1,	'rules' => array (	array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '0',),),'allorany' => 'all',),
						'column_width' => 80,
						'choices' => $promos_for_select,
						'default_value' => null, 'allow_null' => 0, 'multiple' => 0,
					),
					
					array ( 'name' => 'imagen_preview','key' => 'field_551ade688542c','label' => 'Imagen preview', 'type' => 'image',
						'instructions' => 'Selecciona una imagen para la columna izquierda. Se aconseja doble de alto que de ancho',
						'save_format' => 'id','preview_size' => 'medium',
						'library' => 'all', 'column_width' => 25,
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),
					),
					array (
						'name' => 'titulo','key' => 'field_551ade688542a','label' => 'Titulo',
						'type' => 'text','instructions' => 'Título en la parte superior del bloque','column_width' => 20,
						'default_value' => '', 'placeholder' => 'Ej. Nuestros ebooks','prepend' => '','append' => '',
						'formatting' => 'html', 'maxlength' => '',
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),						
					),
					array (
						'name' => 'subtitulo','key' => 'field_551ade688542b','label' => 'Subtítulo en cursiva',
						'type' => 'text','instructions' => 'Subtítulo opcional bajo el título (en cursiva)','column_width' => 20,
						'default_value' => '', 'placeholder' => '','prepend' => '','append' => '',
						'formatting' => 'html', 'maxlength' => '',
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),						
					),
					array (
						'key' => 'field_551ade688542b',
						'label' => 'Descripción',
						'name' => 'descripcion',
						'type' => 'textarea',
						'instructions' => 'Texto descriptivo a un lado de la imagen',
						'column_width' => 25,
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => '',
						'rows' => 2,
						'formatting' => 'html',
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),
						
					),
					array ('key' => 'field_551adf418542e','label' => 'link',
						'name' => 'link',	'type' => 'text',
						'instructions' => 'Enlace al clicar en la imagen',
						'column_width' => 15,'default_value' => '','placeholder' => 'Ej	http://www.amazon.com/ebooksveras','prepend' => '','append' => '',
						'formatting' => 'none',				'maxlength' => '',
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),						
					),
					array ('key' => 'field_551adf4fffffff','label' => 'Texto del link',
						'name' => 'link_text',	'type' => 'text',
						'instructions' => 'Texto en el botón del link',
						'column_width' => 10,'default_value' => '','placeholder' => 'Ej	Abre el enlace','prepend' => '','append' => '',
						'formatting' => 'none',				'maxlength' => '',
						'conditional_logic' => array ('status' => 1,'rules' => array (array ('field' => 'field_551f4a2df8cc1','operator' => '==','value' => '1',),),'allorany' => 'all',),						
					),
				),
				'row_min' => '',
				'row_limit' => 6,
				'layout' => 'row',
				'button_label' => 'Añade promo',
			),			
			
			
			
			
			
			
			
			
			
			
			
			
			


		),
		'location' => array (
			array (
				array (		'param' => 'page_parent',	'operator' => '==',	'order_no' => 0, 	'group_no' => 0,	),
				array (		'param' => 'post_type',			'operator' => '==',	'value' => 'mapa',	'order_no' => 1,	'group_no' => 0,		),
			),
		),
		'options' => array (			'position' => 'normal',		'layout' => 'default',		'hide_on_screen' => array (	"excerpt"),		),
		'menu_order' => 0,
	));

	
	
	/* estos campos se aplican sólo a los hotspots: "mapa" que sí tienen padre*/
	register_field_group(array (
		'id' => 'acf_campos-del-monumento',
		'title' => 'Campos del Monumento',
		'fields' => array (
			/* TAB -----------------*/
			array ( 	'type' => 'tab', 'key' => 'field_550ca79faaaaaa',	'label' => 'Hotspot en Mapa',	'name' => '',	),
			/* -----------------------  */
			array (		'name' => '',   'key' => 'field_550b0e5bbbbbb',   'label' => 'Instrucciones',
				'type' => 'message',
				'message' => 'Para saber con exactitud las coordenadas, visita el mapa cuando estés conectado como administrador. Verás las coordenadas del ratón al pasar sobre el mapa.',
			),
			array (
				'name' => 'about',       'key' => 'field_550b0d5ccabababa',				'label' => 'Acerca del monumento',				
				'type' => 'text',
				'instructions' => 'Breve descripción de pocas palabras. Aparecerá en la lista izquierda, ',
				'default_value' => '',				'placeholder' => '',				'prepend' => '',				'append' => '',	'maxlength' => '',
				'formatting' => 'html',				
			),
			array (
				'name' => 'descripcion',       'key' => 'field_550b0d5cccccc',				'label' => 'Descripción de una linea',				
				'type' => 'text',
				'instructions' => 'Breve descripción de pocas palabras que aparecerá en la viñeta sobre el sitio en el mapa, cuando se seleccione desde la lista de monumentos',
				'default_value' => '',				'placeholder' => '',				'prepend' => '',				'append' => '',	'maxlength' => '',
				'formatting' => 'html',				
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
			array (		'name' => 'icono',	'key' => 'field_550b0db7ffffff',	'label' => 'Icono',
				'type' => 'image',
				'instructions' => 'Escoge un icono cuadrado (si no lo es será recortado). No importa el tamaño de la imagen, el programa creará una versión en miniatura.
	Esta imagen aparecerá a la izquierda del nombre del monumento',
				'save_format' => 'id',		'preview_size' => 'thumbnail',	'library' => 'all',
			),			
			array (
				'key' => 'field_55109dabababa',
				'label' => 'Al clicar abrir otro mapa',
				'name' => 'mapa_redirection',
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
				'name' => 'contenido',				'key' => 'field_551179c29e909',			'label' => 'Contenido',
				'type' => 'textarea',
				'instructions' => 'Escribe aquí la descripción completa del emplazamiento.',	'default_value' => '',
				'placeholder' => 'Ej: "La ciudad prehispánica de Chichén Itzá fue la capital más sobresaliente..."',    'maxlength' => '',		'rows' => '',	'formatting' => 'br',
			),
			array (
				'key' => 'field_55118d7411357',
				'label' => 'Video',
				'name' => 'video',
				'type' => 'textarea',
				'instructions' => 'Incluye un video embebido de youtube, vimeo, etc. Es preferible el uso de iframe',
				'default_value' => '',
				'placeholder' => 'Ej:    &lt;iframe src="https://player.vimeo.com/video/56812804" ...',
				'maxlength' => '',
				'rows' => '3',
				'formatting' => 'none',
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
			'hide_on_screen' => array ( 'comments'
			),
		),
		'menu_order' => 0,
	));
	


	$message	= $post_message = "";
	if ($post->post_parent == 0 ) {
		$message = "Esto es un mapa. Si lo que querías era editar un hotspot, tendrás que seleccionar el mapa padre al que pertenece en la caja de arriba, donde pone <b>Superior</b>. <br>";
		if ( (is_object($post)) && ($post->post_type == "mapa")) :
			$children = get_posts(array("post_parent"=> $post->ID, "post_type" => "mapa", "orderby" => "menu_order" , "order" => "ASC"));
			if (is_array($children) && count($children))
			foreach ($children as $i=> $hotspot) {
				if (!strlen($post_message))  $post_message = "<ul>";
				
				$post_message .= "<li><b>$i : </b>Hotspot   <a href='".get_admin_url()."post.php?post=".($hotspot->ID)."&action=edit'> $hotspot->post_title</a></li>";				
			}
			else $post_message .= "<ul><li>Este mapa aún no tiene hotspots asociados</li>";
			$message.= $post_message."</ul>";
		endif; 
	}
	
	
	register_field_group(array (
		'id' => 'acf_hotspot_en_mapa',
		'title' => 'hotspots del mapa',
		'fields' => array (			
			array (
				'key' => 'field_550b0e5bbbbbb',
				'label' => 'Hotspots',
				'name' => '',
				'type' => 'message',
				'message' => $message,
			),
		),
		'location' => array (			
			array (
				array ('param' => 'page_parent','operator' => '==','order_no' => 0,'group_no' => 0,),
				array ('param' => 'post_type','operator' => '==','value' => 'mapa','order_no' => 1,'group_no' => 0,),
			),			
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (),
		),
		'menu_order' => 0,
	));


	// mensage en hotspots y en mapas
	/*global $polylang;
	$curlang 							=  isset($polylang)? $polylang->curlang->slug : ""; 
	if (strlen($curlang) && ($curlang != $post_lang) ) {
			$titulo				= "Aviso importante";
			$message		= 	 '<h1>Atención:	La configuración actual no permitirá que los cambios efectuados se reflejen en la web.</h1><h2> Si quieres realizar cambios en este mapa o hotspot, tendrás que cambiar la opción de la barra superior de idiomas a <b>"Mostrar todos los idiomas"</b>. </h2><br> Clica aquí para resolverlo <a href="javascript: window.location = $(\'#wp-admin-bar-all a:first\').attr(\'href\');">Resuelve</a>';
	}
	else	{
			$titulo				= "Instrucciones";
			$message		= "Instrucciones.";
	}
	
	register_field_group(array (
		'id' => 'acf_mapa-warning',		'title' => $titulo,
		'fields' => array (
			array (
				'type' => 'message',		'key' => 'field_55156fba4107b',		'label' => $titulo,		'name' => '',				
				'message' =>	$message,
			),
		),
		'location' => array (array (		array (		'param' => 'post_type',		'operator' => '==',		'value' => 'mapa',		'order_no' => 0,		'group_no' => 0,		),		),),
		'options' => array (	'position' => 'acf_after_title',	'layout' => 'default',	'hide_on_screen' => array (		),		),
		'menu_order' => 0,
	));
*/


if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_campos-galeroa',
		'title' => 'Instrucciones de las galerías',
		'fields' => array (
			array (		'name' => '',   'key' => 'field_550aa0e5bbbbbb',   'label' => 'Cómo subir imágenes',
				'type' => 'message',
				'message' => 'Las galerías ayudan a ahorrar tiempo en la compilación de contenidos: Creando una galería una vez, se puede asignar a los mapas y hotspots seleccionando la galería deseada. <br><b>Recuerda</b> : las imágenes de la galería deben tener su título traducido a d¡cada idioma. Para ello selecciona la imagen, y en el cuadro de edición que se abrirá, verás la posibilidad de cambiar idioma.',
			),

		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'galeria',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array ( 	0 => 'permalink',				1 => 'excerpt',				2 => 'custom_fields',				3 => 'discussion',				4 => 'comments',				5 => 'slug',				6 => 'author',				7 =>'format',				8 => 'tags',				9 => 'send-trackbacks',		10 => 'the_content'	),
		),
		'menu_order' => 0,
	));
}

		
	
}


	
	
	
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_campos-de-promo',
		'title' => 'Campos de promo',
		'fields' => array (
			array (
				'key' => 'field_5511973154ffc',
				'label' => 'Sobreescribe Título',
				'name' => 'sobreescribe_titulo',
				'type' => 'text',
				'instructions' => 'El título de arriba debe ser identificativo, que permita reconocer este bloque sólo con ese nombre. Si quieres que en pantalla el título sea diferente, escríbelo aquí.',
				'default_value' => '',
				'placeholder' => 'Ej: "También en ebook"',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'name' => 'subtitulo','key' => 'field_551ade688542c','label' => 'Subtítulo en cursiva',
				'type' => 'text','instructions' => 'Subtítulo opcional bajo el título (en cursiva)','column_width' => 20,
				'default_value' => '', 'placeholder' => '','prepend' => '','append' => '',
				'formatting' => 'html', 'maxlength' => '',
			),
			
			array (
						'name' => 'descripcion',		'key' => 'field_551ade68854aa',						'label' => 'Descripción',	
						'type' => 'textarea',						'instructions' => 'Texto descriptivo a un lado de la imagen',	'default_value' => '',	'placeholder' => '','maxlength' => '','rows' => 2,
						'formatting' => 'html',
					),
			/*
			array (
				'name' => 'video_embed',				'key' => 'field_551179caaabbbb',			'label' => 'Video Enlazado',
				'type' => 'textarea',
				'instructions' => 'Si este bloque representa el enlace a un vídeo (youtube, vimeo, daily motion...) escribe aquí el código html embebido. <br> Se recomienda uso de iframe.',	'default_value' => '',
				'placeholder' => 'Ej:    &lt;iframe src="https://player.vimeo.com/video/56812804" ...',  'maxlength' => '',		'rows' => '',	'formatting' => 'br',
			),*/
			array ('key' => 'field_551adf4185fff','label' => 'link',
						'name' => 'link',	'type' => 'text',
						'instructions' => 'Enlace al clicar en la imagen',
						'default_value' => '','placeholder' => 'Ej	http://www.amazon.com/ebooksveras','prepend' => '','append' => '',
						'formatting' => 'none',				'maxlength' => '',			
					),
			array ('key' => 'field_551adf4ffffaaa','label' => 'Texto del link',
						'name' => 'link_text',	'type' => 'text',
						'instructions' => 'Texto en el botón del link',
						'default_value' => '','placeholder' => 'Ej	Abre el enlace','prepend' => '','append' => '',
						'formatting' => 'none',				'maxlength' => '',
										
					),
			array (
				'key' => 'field_5511954134997',
				'label' => 'Imagen',
				'name' => 'imagen',
				'type' => 'image',
				'instructions' => 'Imagen a la izquierda del promo. Se aconseja doble de alto que de ancho, aproximadamente.',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'promo',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'slug',
				6 => 'author',
				7 => 'format',
				8 => 'tags',
				9 => 'send-trackbacks',
				10 => 'the_content'
			),
		),
		'menu_order' => 0,
	));
}

		
	











