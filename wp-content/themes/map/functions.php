<?php

	include_once("functions-custom-pt.php");  	# todo lo relacionado con custom post types
	include_once("functions-acf.php");				# todo lo relacionado con advanced custom fields
	
	
	
	/* ALVARO : mis cosas */
	
	/* register scripts */
	add_action( 'wp_enqueue_scripts', 'load_js_css');
	function load_js_css(){
		$version = '1.0';

	  wp_deregister_script('jquery');
	  wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.2.min.js', array(),'1.11.2', true);
	  wp_enqueue_script('jquery');
		
      wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.62828.js', array(), $version, true);
      wp_enqueue_script('modernizr');
      wp_enqueue_script('jquery');
      wp_register_script('hammer', get_template_directory_uri() . '/js/hammer.min.js', array('jquery'), $version, true);
      wp_enqueue_script('hammer');
      wp_register_script('easing', get_template_directory_uri() . '/js/jquery.easing.js', array('jquery'), $version, true);
      wp_enqueue_script('easing');
      wp_register_script('mousewheel', get_template_directory_uri() . '/js/jquery.mousewheel.js', array('jquery'), $version, true);
      wp_enqueue_script('mousewheel');
      wp_register_script('smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array('jquery'), $version, true);
      wp_enqueue_script('smoothscroll');
      wp_register_script('mapplic', get_template_directory_uri() . '/mapplic/mapplic.js', array('jquery'), $version, true);
      wp_enqueue_script('mapplic');
      wp_register_script('bootstrap', get_template_directory_uri() . '/bootstrap/javascripts/bootstrap.min.js', array('jquery'), $version, true);
      wp_enqueue_script('bootstrap');
	  
	 

	 wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/bootstrap.css', 	array(), 						$version );	 	 
	 wp_enqueue_style( 'style', 			get_stylesheet_uri(),																	array( 'bootstrap' ),	$version );	 
     wp_enqueue_style( 'mapplic', 	get_template_directory_uri() . '/mapplic/mapplic.css', 		array('style'), 				$version );
	  
    }
	
	
	
	
	
	
	
	
	
	/*  REGISTRAR SIDEBARS ---- Una para el widget de idioma en el header, otro para el footer */
	
	
	// enables wigitized sidebars
	if ( function_exists('register_sidebar') )

	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array('name'=>'Sidebar',
		'before_widget' => '<div class="widget-area widget-sidebar"><ul>',
		'after_widget' => '</ul></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Header Widget
	// Location: right after the navigation
	register_sidebar(array('name'=>'Header',
		'before_widget' => '<div class="widget-area widget-header"><ul>',
		'after_widget' => '</ul></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	// Footer Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array('name'=>'Footer',
		'before_widget' => '<div class="widget-area widget-footer"><ul>',
		'after_widget' => '</ul></div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	
	// custom menu support
	/*  REGISTRAR MENU ---- Sólo uno en el header  */
	
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header-menu' => 'Header Menu',	  		)
	  	);
	}

	// custom background support
	add_custom_background();

	// custom header image support
	define('NO_HEADER_TEXT', true );
	define('HEADER_IMAGE', '%s/images/default-logo.png'); // %s is the template dir uri
	define('HEADER_IMAGE_WIDTH', 70); // use width and height appropriate for your theme
	define('HEADER_IMAGE_HEIGHT', 70);
	// gets included in the admin header
	function admin_header_style() {
	    ?><style type="text/css">
	        #headimg {
	            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	        }
	    </style><?php
	}
	add_custom_image_header( '', 'admin_header_style' );

	// adds Post Format support
	// learn more: http://codex.wordpress.org/Post_Formats
	// add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );

	
	
	// removes detailed login error information for security - esto ya lo puede hacer el plugin, pero 
	// add_filter('login_errors',create_function('$a', "return null;"));
	
	// removes the WordPress version from your header for security
	add_filter('the_generator', 'wb_remove_version');
	function wb_remove_version() {
		return '<!-- Verás Editorial built by Cobianzo Ltd. UK-->';
	}
	
	
	// Removes Trackbacks from the comment cout
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $count ) {
		if ( ! is_admin() ) {
			global $id;
			$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
			return count($comments_by_type['comment']);
		} else {
			return $count;
		}
	}

	// invite rss subscribers to comment
	function rss_comment_footer($content) {
		if (is_feed()) {
			if (comments_open()) {
				$content .= 'Comments are open! <a href="'.get_permalink().'">Add yours!</a>';
			}
		}
		return $content;
	}

	// custom excerpt ellipses for 2.9+
	function custom_excerpt_more($more) {
		return 'Read More &raquo;';
	}
	add_filter('excerpt_more', 'custom_excerpt_more');
	// no more jumping for read more link
	function no_more_jumping($post) {
		return '<a href="'.get_permalink($post->ID).'" class="read-more">'.'&nbsp; Continue Reading &raquo;'.'</a>';
	}
	add_filter('excerpt_more', 'no_more_jumping');
	
	// category id in body and post class
	function category_id_class($classes) {
		global $post;
		foreach((get_the_category($post->ID)) as $category)
			$classes [] = 'cat-' . $category->cat_ID . '-id';
			return $classes;
	}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');

	// adds a class to the post if there is a thumbnail
	function has_thumb_class($classes) {
		global $post;
		if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
			return $classes;
	}
	add_filter('post_class', 'has_thumb_class');

	// add_action( 'admin_init', 'theme_options_init' );
	// add_action( 'admin_menu', 'theme_options_add_page' );
	
	// Init plugin options to white list our options
	// function theme_options_init(){
	// 	register_setting( 'tat_options', 'tat_theme_options', 'theme_options_validate' );
	// }
	
	// Load up the menu page
	// function theme_options_add_page() {
	// 	add_theme_page( __( 'Theme Options', 'tat_theme' ), __( 'Theme Options', 'tat_theme' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
	// }
	
	
	
	
	/* LOGIN FUNCTIONS */
	
	function check_url_login(){
			$query_key		= "veras";					# TO_DO: set this in backend or config
			$query_value		= "mapa-de-yucatan";

			return ($_GET[$query_key] === $query_value);		
	}
	
	
	
	
	
	
	
	
	
	
	
	// TO_DO: Niidea de qué es esto. Mirarlo
	
	// begin LifeGuard Assistant
	// learn more about the LifeGuard Assistant: http://wplifeguard.com/lifeguard-plugin/
	// learn more about the affiliate program: http://wplifeguard.com/affiliates/
	add_action('admin_menu', 'lgap_add_pages');
	function lgap_add_pages() {
		add_menu_page(__('Help','menu-test'), __('Help','menu-test'), 'read', 'lifeguard-assistant-plugin', 'lgap_main_page' );
	}
	function lgap_main_page() {
		echo "<h2>" . __( 'Help', 'menu-test' ) . "</h2>";
		// place your affiliate ID between the " on the following line
		$lgap_aff = "";
		// get your affiliate ID here: http://wplifeguard.com/wp-admin/profile.php?page=affiliateearnings
		echo '
		<style type="text/css">
			#wplg { font-family: "Varela",Helvetica,Trebuchet MS,Verdana,"DejaVu Sans",sans-serif; }
			#wplg a:link,#wplg a:visited { color: #21759b; text-decoration: none; }
			#wplg a:hover { color: #d54e21; }
			.wplg-video { background: #f6f6f6; border: 1px solid #dadada; padding: 12px; margin: 0 12px 12px 0; float: left; }
			.wplg-clear { clear: both; }
			.wplg-green-button { box-shadow:inset 0 0 3px rgba(0,0,0,.1); font-size: 20px; line-height: 32px; height: 32px; width: 434px; margin: 0 12px 12px 0; text-align: center; display: block; border: 2px solid #9abf89; background: #7da742; color: #f1ffeb !important; text-shadow: 0 0 3px rgba(125,167,66,.75); }
			.wplg-green-button:hover { border: 2px solid #c0e1aa; background: #8ac636; }
			.wplg-green-button:active { border: 2px solid #88a65e; background: #5d822a; }
		</style>
		<link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" type="text/css">
		<div id="wplg">
			<p>Need help with WordPress? Here is a collection of free WordPress video tutorials from <a href="http://wplifeguard.com/'.$lgap_aff.'">wpLifeGuard</a> to help you get going. <a href="http://wplifeguard.com/get-access/'.$lgap_aff.'">Get access to more videos.</a></p>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32852753?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32856785?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32857648?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32860297?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32872861?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32878118?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32881530?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32864178?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32863614?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32862744?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-video"><iframe src="http://player.vimeo.com/video/32857481?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="412" height="309" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
			<div class="wplg-clear"></div>
			<a class="wplg-green-button" href="http://wplifeguard.com/get-access/'.$lgap_aff.'">Get Full Access Now</a>
		</div>
		';
	}
	// end LifeGuard Assistant

	
	
	
	
	
	
	
	function show_title_tag(){ 
		if ( is_category() ) {
			echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) {
			echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(''); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title('');
		} else {
			echo wp_title(''); echo ' | '; bloginfo( 'name' );
		} 
	}
	
	// devuelve ID
	/*function get_frontpage_in_current_language()
	{
			$frontpage_id = get_option('page_on_front');
			$lang_slug	= pll_current_language("slug");
			$front_page_translated = pll_get_post($frontpage_id, $lang_slug);
			return $front_page_translated;		
	}
	// para que el título de la página esté traducido: se recoge el titulo de la frontpage.
	add_filter( 'bloginfo', 'blogname', 10, 2 );
	function blogname($text_to_filter, $option) {
		if (($option == "name") &&(function_exists("pll_current_language"))) {
			return get_the_title(get_frontpage_in_current_language());			
		}
		return $text_to_filter;
	}*/

	

	/* writes html for the template modal window of bootstrap
		params:
			id, html_header, html_body, html_footer
	*/
	function print_bt_modal($params = array())
	{
		?>
		<div class="modal fade" id="<?php echo $params['id'];?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $params['id'];?>" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<?php echo $params['html_header']; ?>
					</div>
					<div class="modal-body">
						<?php echo $params['html_body']; ?>					
					</div>
					<div class="modal-footer">
						<?php echo $params['html_footer']; ?>
					</div>
				</div>
			</div>
		</div>		
		<?php
	}
	
	
	
	
	
	
	
	/*
	FOR BETTER UNDERSTANDING:
		location, hotspot and monumento is the same (location is the name in Mapplic, monumento de name of the post type in WP
		level and mapa is the same	
	*/
	/* funciones del mapa que podrían venir aparte */
	
	# get_monumentos_by_mapa($id_map)						--> array of posts monumentos
	# array_location_configuration($id_monumento)		--> converts post object monumento in array (ready for converting to json)
	# array_level_configuration($id_map = null)					--> converts post object mapa in array (ready for converting to json)
	//  get_json_map_src ('nombre del mapa');
	//  save_json:map ('nombre del mapa');
	// 	get_maps_url()
	//	get_maps_directory()
	
	
	// returns the array ready for convertion into json (that conertion will be saved into a file)
	// @ $maps_array:  list of maps to include into levels. In not maps_array, all of them included
	function array_mapplic_configuration($lang="es", $maps_array = null){
		
				
		/* defining the args to select the right mapas: the "mapa"  custom types with no parent. Their children are the hotspots (also called locations or monumentos)  */
		
		$query_args = array( "post_type"  =>	"mapa", "posts_per_page"	=> 	-1 , "post_parent" => 0, "orderby" => "menu_order", "order" => "ASC", "lang" => $lang); 
		
		if ($lang)  /* TO_DO: apply this only if polylang plugin is active 
							TO_DO: bug: if the user language is set to something, the tax_query will not work and query_posts filters posts in that language, ignoring our $lang filter.
		*/
		   // $query_args['tax_query']  = array(	array(  'taxonomy' => 'language',	'field'    => 'slug', 'terms'    => $lang,),	)	;
				
		if (is_array($maps_array) && (!empty($maps_array))) $query_args = array_merge($query_args, array('post__in'  =>  $maps_array));
		query_posts( $query_args);
		
		
		/* the loop is ready to be launched now */
				
		$map_width			=	$map_height	=	null;
		$array_categories	=	$array_levels	= array();
		while ( have_posts() ) : the_post(); 
			# The loop for every "mapa"
			global $post;
			if   ((function_exists("pll_get_post_language")) && ( ($post_lang = pll_get_post_language(get_the_ID())) != $lang ) ) continue;	// use only posts on this language

			
			# we get the category name of the mapa to assign the "categories" field to the mapplic json file
			// 1. get the categories of the map. And select their children.
			$post_categories				= wp_get_post_categories(get_the_ID(),array( 'fields' => 'ids'));
			foreach ($post_categories as $cat) {
					foreach (get_categories(  array( 'parent' => $cat)) as $subcat ){
							$array_categories[]	= array(
								"id"  		=>  $subcat->cat_ID,
								"title" 		=>  $subcat->cat_name,
								"color"	=>  "#bb0000",
								"show" 	=>  "true"	);
					}
			}
			/*$category_name		= get_post_meta(get_the_ID(), "category_name", true);
			if (strlen(trim($category_name)))
				$array_categories[]	= array(
					"id"  		=>  get_the_ID(),
					"title" 	=> get_post_meta(get_the_ID(), "category_name", true),
					"color"	=>  "#63aa9c",
					"show" 	=>  "true"
				);
				*/
			# we include the map in the array. The following function will include the locations of the map too
			if ($aa = array_level_configuration(get_the_ID()))	$array_levels[]	=	$aa; 
			if (!$map_width) {
				$map_img_id						=	get_post_meta(get_the_ID(), "mapa_hi", true);
				$map_img_large				= 	wp_get_attachment_image_src( $map_img_id, "large" ); 
				$map_width						=	$map_img_large[1];
				$map_height						=	$map_img_large[2];
				
			}
		endwhile; 
		
		wp_reset_query();			
		
		
		
		// initialize array
		$mapplic	= array(
					"mapwidth"		=>	$map_width,
					"mapheight"		=>	$map_height,
					"categories"		=>	$array_categories,
					"levels"				=>	$array_levels		
		);
		
		return $mapplic;
		
	}	
	
	
	
	
	# MAPAS (tb llamados level en el contexto Mapplic) 
	# --------------------------------------------------------------------------------------------------------
	function get_all_mapas($lang=null){  // esta función prácticamente no tiene utilidad
		$query_args	= array("post_type"=>"mapa","posts_per_page"=>-1,"post_parent"=>0,"orderby"=>"menu_order","order"=>"ASC");
		if ($lang)  /* TO_DO: apply this only if polylang plugin is active */
		   $query_args['lang']  = $lang;
		
		return get_posts($query_args);		
	}
	/*
		@ array_level_configuration
		# 	returns array		
		# 	el array que devuelve se convertirá a json y se grabará en el disco para que lo recoja
		#	param $id_map:  id del post tipo map que devuelve. Si no se espefica, devuelve el primer mapa
	*/
	function array_level_configuration($id_map = null){ 
		
		# 1. Simply validate paramaeter and set the vars ready:  $map_post and $id_map
		if (!$id_map) :
				$map_post	= 	get_all_mapas();
				if (empty($map_post))	{ echo "No existen Mapas aun definidos";  return false;  }
				$map_post	=	array_pop($map_post);
				$id_map		=	$map_post->ID;
		else:
				$map_post	=	get_post($id_map);
		endif;
		
		# 2. We get all the locations for this map and prepare the array (which will be translated into json.		
		$locations				=	get_monumentos_by_mapa($id_map);
		$array_locations	= array();
		foreach ($locations as $i => $location) {
			//echo $location->post_title." -TO_DELETE--" .get_post_meta($location->ID, 'mapa_padre', true)."<br>";
			$array_locations[]	= array_location_configuration($location);			
		}
		
		# 3. We finish the completion of the array by adding the rest of params of it (image, name....)
			# 3.1 - First the image at high resolution and thumbnail.
		$img_id						=	get_post_meta($id_map, "mapa_hi", true);
		$img_thumb_src		= 	wp_get_attachment_image_src( $img_id, "thumbnail" ); 
		$img_hi_src				= 	wp_get_attachment_image_src( $img_id, "large" ); 
		
			# 3.2 - Then the rest of params
		if (!strlen($map_post->post_name)) return false;
		$array_mapa			= array(
				"id"			=>	"map-".$id_map,
				"name"		=>	$map_post->post_name,
				"title"		=>	get_the_title($id_map),
				"map"		=>	$img_hi_src[0],
				"minimap"	=>	$img_thumb_src[0],
				"locations"=>	$array_locations,
		
		);
		//echo "TO_DELETE:::----";  //print_r($array_mapa);
		
		if (!$img_id) return false;	// don't parse levels with no map as it will break the json file
		return $array_mapa;
	}	
	
	
	
	
	
	# MONUMENTOS (tb llamados location en el contexto Mapplic) 
	# --------------------------------------------------------------------------------------------------------
	// devuelve todos los posts de los monumentos del mapa especificado
	function get_monumentos_by_mapa($id_map){
		if ( !$id_map) return false;
		global $polylang;
		if (isset($polylang))	$lang = pll_get_post_language($id_map);
		return get_posts(array(
											"post_type"		=> 	"mapa",	"post_parent"	=> $id_map, "lang" => $lang
											/*"meta_query"	=>	array( array(	'key'     			=> 	"mapa_padre",  'value' 		  	=> 	$id_map,	'compare'		=> '=',	'type'				=> "NUMERIC"  ))*/
		));		
	}
	
	// nos da el array listo para convertirse en json con los datos de la location (monumento) (para ello pasamos el id o el post object del mismo monumento)
	function array_location_configuration($id_monumento){
		  
		$post_monumento  	= (is_object($id_monumento))?  $id_monumento : get_post($id_monumento);
		$id_monumento			=	$post_monumento ->ID;
		$img_id						=	get_post_meta($id_monumento, "icono", true);
		$img_thumb_src		= 	wp_get_attachment_image_src( $img_id, "thumbnail" ); 
		$mapa_padre_id		= wp_get_post_parent_id( $id_monumento );
		$link							=  (($cc = get_post_meta($id_monumento, "mapa_redirection", true)) &&  is_integer($cc))?	get_the_permalink($cc)  :  null;
		if ((!$link )|| (!strlen($link))) 		$link	=	"javascript:   abreLocationCard('$post_monumento->post_name')";
		
		
		$post_categories				= wp_get_post_categories($id_monumento,array( ));
		$category							= (is_array($post_categories) && count($post_categories))?  $post_categories[0] : null;
		
		 
		$array_monumento 	= array(
			"id"						=>	$id_monumento,
			"title"					=>	get_the_title($id_monumento),
			"about"				=>	get_post_meta($id_monumento, "about", true),
			"description"		=>	get_post_meta($id_monumento, "descripcion", true), //$post_monumento->post_excerpt,
			"category"			=>	$category, //($cat = get_post_meta($mapa_padre_id, "category_name", true))? $mapa_padre_id : null,
			"thumbnail"		=>	$img_thumb_src[0],
			"x"						=>	intval(get_post_meta($id_monumento, "pos_x", true)) / 100,
			"y" 						=>	intval(get_post_meta($id_monumento, "pos_y", true)) / 100,
			"link"					=>	$link,
			"zoom"				=>	"2"		
		);		
		return $array_monumento;
	}
	
	# END MONUMENTOS (tb llamados location en el contexto Mapplic) 
	# --------------------------------------------------------------------------------------------------------

	function get_yucatan_mapa($lang = "es"){
			$mapas				= get_posts (array( "post_type"	=> "mapa" , "posts_per_page" => 1,  "post_parent" => 0, "orderby" => "menu_order" , "order" => "ASC",  "lang" => $lang, ));
										// 'tax_query' => array(	array(  'taxonomy' => 'language',	'field'    => 'slug', 'terms'    => $lang,)	)	));
			return $mapas[0];		
	}
	
	
	
	


	# MANEJO DE FICHERO JSON 
	# --------------------------------------------------------------------------------------------------------
	
	//para set to "path" to get path route. Returns C:\routewhatever\www/wp-content/uploads  
	function get_maps_dir($url_or_path = "url" ){  
		$uploads_routes	= wp_upload_dir();
		return ( ( ($url_or_path == "url")?	$uploads_routes["baseurl"] : $uploads_routes["basedir"] ));	
	}
	
	# saves an array in json format into the specific filename, under the /uploads folder
	function save_json_file($filename = null, $array_to_convert = null, $echo = false) {
		if (!$filename || (!is_array($array_to_convert)) ) return;

		if ($echo) echo " <br><i>saving : </i> <a href='".get_maps_dir("url")."/".$filename."'>$filename</a>";
		// stripslashes(json_encode($array))
		$fp = fopen(get_maps_dir("path")."/".$filename , 'w');
		fwrite($fp, json_encode($array_to_convert));
		fclose($fp);		

		
	}
	
	# saves the file with all the maps configuration separated in levels (each map is one level)
	function save_mapplic_file($name = "mapplic", $lang = "es", $array_mapas_id = null, $echo = false) {
		global $polylang;
		$curlang =  isset($polylang)? $polylang->curlang->slug : $lang ;
		
		$array 	= array_mapplic_configuration($lang, $array_mapas_id);
		
		save_json_file($name.".json", $array, $echo);
		
	}
	
	// with this functino we create all json files for all maps (in a language)
	function save_all_files_for_language($lang = "es"){
		$mapas_posts	= get_all_mapas($lang);
		foreach($mapas_posts as $mapa) {
			save_mapplic_file($mapa->post_name."_".$lang, $lang, array($mapa->ID));			
		}		
	}
	
	#	when saving a post type mapa or monumento, we save the file mapplic_{lang}.json with the settings for all maps 
	# Also, we save a file {name-of-map}_{lang}.json for that specific map 
	add_action( 'save_post', 'save_mapplic_on_save', 10, 3 );
	function save_mapplic_on_save( $post_id, $post, $update ){
			
		/*$galeria	= get_field("galeria"); //get_post_meta($post_id, "galeria", true);
		foreach($galeria as $row)
			update_field("field_551aca0387088", $row, 137);
		print_r($galeria); die();		
		*/
		if (!in_array($post->post_type, array("mapa"))) return;		
		$language				=	function_exists("pll_get_post_language")? pll_get_post_language($post_id) : "es";
		
		#  1. save the filename for all maps (we are not using this file anymore)
		save_mapplic_file("mapplic_".$language, $language);
		
		
		# if we are saving a hotspot -> we get the parent 
		$mapa_post	= $post;
		while ($mapa_post->post_parent) 	$mapa_post = get_post($mapa_post->post_parent);				
		#  2. and we save the single file just for the map (only for this language)
		$mapa_filename	=	$mapa_post->post_name."_".$language;
		save_mapplic_file($mapa_filename, $language, array($mapa_post->ID));
	}
	
	
	/* backend admin page */
	
	add_action('admin_menu', 'create_all_mapas_json_menu');
	 
	function create_all_mapas_json_menu(){
			add_menu_page( 'Pagina de creación de json para Mapplic', 'JSON creator', 'manage_options', 'create-all-json', 'create_all_json_page' );
	}
	 
	function create_all_json_page(){
			global $polylang;
						
			if (!isset($polylang))			{
				echo "<h1>Polylang no instalado!</h1>"; return;  
			}
			# 1. seleccioamos cada idioma instalado
			$all_langs 	 = $polylang->get_languages_list();
			foreach ($all_langs as $lang) {
				# 2. Para cada idioma, seleccionamos los mapas (sin padre)
				echo "<h3>$lang->name</h3>";
				$mapas_lang	=	get_all_mapas($lang->slug);
				foreach ($mapas_lang as $mapa) :
				# 3. Para cada mapa, salvamos su json
					save_mapplic_file($mapa->post_name."_".$lang->slug, $lang->slug, array($mapa->ID), $echo = true);			
				endforeach;
				
			}
			//get_all_mapas($lang);
	}
	
	
	
	
	/*  end functiones del mapa*/
	
	
	
	
	add_action( 'save_post', 'sync_galeria_all_languages', 10, 3 );
	function sync_galeria_all_languages( $post_id, $post, $update ){
						
		if (!in_array($post->post_type, array("mapa"))) return;		
		
		
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	# HELPERS
		
	function print_array($array){
		
		foreach ($array as $i => $value)
		{
			echo "<br><b>$i</b> => ";
			if (is_array($value) or is_object($value)) {
				echo "<ul style=''>";
				print_array($value);
				echo "</ul>";
			}
			else echo $value;			
		}		
	}
	
	
	
	add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );
	function hide_admin_bar_from_front_end(){
		return (is_blog_admin());
	}