<?php
	/*
	EY: aquí compruebo que el usuario acceda a la web pasando el pw adecuado como params en url	
	*/

	
	//print_array($_POST); die();
	
	if( ! is_user_logged_in() ) :	# BOOK:LOGINSITE
		# si no está loggeado, puede que esté usando el key y value correctos (se loggea), o no (aparece mensaje de error)
		
		if (check_url_login())
		{
			
			$user = get_userdatabylogin('guest');    
			// log in automatically
			$user_id = $user->ID;
			wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login );
			
		}
	endif;
	
	
	
	// si al abrir la página ya está seleccionado un hotspot, es posible que se acabe de submitir la form del password. Y si es correcta, hay que redireccionar al mapa al que apunta
	if (isset($_REQUEST['location']) && $hotspot_id = $_REQUEST['location']) {
		if (($link_to_map = hotspot_apunta_a_mapa_no_protegido($hotspot_id)) && (!isset($_REQUEST['no-redirect-to-map'])) )  //  redireccionar a ese mapa
				wp_redirect($link_to_map);	
		elseif ( $link_to_map === 0 ) {
		// si el hotspot seleccionado apunta  a un mapa protegido, estamos en la página recargada trasa haber metido mal el passwrd
				$_REQUEST['error-map-password'] = $hotspot_id; // paso la variable para más adelanto mostrar mensaje de error en la tarjeta q se abrirá
		}
	}

?><!DOCTYPE html>

<?php	if (function_exists("pll_current_language")) 	
{
	$lang 			= pll_current_language("name"); 
	$lang_slug	= pll_current_language("slug");
}
?>

<html <?php language_attributes(); ?>>
<head>
	<title><?php show_title_tag(); ?> </title>
	<meta name="description" content="<?php wp_title(''); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
	<!-- Viewport for Responsivity -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<?php /* Add "maximum-scale=1" to fix the Mobile Safari auto-zoom bug on orientation changes, but keep in mind that it will disable user-zooming completely. Bad for accessibility. */ ?>
	
	
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/whiteboard_favicon.ico" type="image/x-icon" />
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_url'); ?>/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_url'); ?>/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_url'); ?>/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_url'); ?>/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php bloginfo('template_url'); ?>/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php bloginfo('template_url'); ?>/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/images/favicon-16x16.png">
	<link rel="manifest" href="<?php bloginfo('template_url'); ?>/images/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">



	
	<?php wp_enqueue_script("jquery"); /* Loads jQuery if it hasn't been loaded already */ ?>
	
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/mapplic/mapplic-ie.css">
		<script type="text/javascript" src=<?php bloginfo('template_url'); ?>/js/html5shiv.js"></script>
	<![endif]-->
	
	<?php 
	
	/* Enqueing scripts, css and others ..........................................  */
	/* ************************************************************************   */
	
			wp_head();  
			
	/* ************************************************************************   */
	/* ************************************************************************   */
	
	?>
	
	
</head>


<body <?php body_class(); ?>>
<div id="body"><!-- this encompasses the entire Web site -->
<?php
	
	if( ! is_user_logged_in() ) :		# BOOK:LOGINSITE
		# si no está loggeado, puede que esté usando el key y value correctos (se loggea), o no (aparece mensaje de error)
			get_template_part( "page-not-loggedin");  						
			die();
	endif;
?>

	
	
	    <!-- Fixed navbar -->
		<nav id="header-navbar"  class="navbar navbar-default ">
		  <div class="row-fluid">
		  
			<div class="navbar-header col-xs-1">
			
			  <a id='logo' href="<?php home_url(); ?>">
					<img src="<?php echo( get_header_image() ); ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
			  </a>	  
			  
			</div>
			
			<!-- menu navigation-->
			<div class='col-xs-9'>
				<div id="titulo" class='row-fluid'>
					
					<h1 class=''><?php bloginfo("blog_title"); ?></h1>
				
				</div>
		
		
				<?php  // BREADCRUMBS
					$yucatan_post	= get_yucatan_mapa($lang_slug);
				?>
				<div id="navbar"  class='row-fluid'>
					<div class="hidden-xs">
					  <ul id='breadcrums' class="nav navbar-nav">
							<li <?php if (is_home() || is_front_page()) { ?> class="active" <?php } ?>>
								<a href="<?php echo get_home_url(); //the_permalink($yucatan_post->ID); ?>"><b><?php echo get_post_meta($yucatan_post->ID, 'category_name', true);?></b></a>
							</li>
							<li>
								<span class="glyphicon glyphicon-chevron-right pull-left"></span>
								<div class="dropdown pull-left">
									<a class='dropdown-toggle btn btn-default btn-xs' href="<?php  the_permalink() ?>"  data-toggle="dropdown" role="button" aria-expanded="false">
										<?php 
													if ((!is_front_page()) && (!is_home())  && $post->post_type == "mapa" ) 
																echo get_post_meta(get_the_ID(), 'category_name', true);
													else		echo __("Select site", "map");								
										  ?>
										<span class="caret"></span>
									</a>
									<ul id='map-dropdown-ul' class="dropdown-menu" role="menu">
										<li class="dropdown-header"><?php _e("Other maps", "map"); ?></li>
								<?php foreach (get_all_mapas() as $mapa_post) :
												if ($yucatan_post->ID != $mapa_post->ID) echo 
												"<li><a href='".get_permalink($mapa_post->ID)."'>".get_post_meta($mapa_post->ID, 'category_name', true)."</a></li>";
											endforeach;	?>
									</ul>
								</div>
							</li>
							<?php // endif;?>
						  </ul>
							</li>
					  </ul>
				<!-- end breadcrums -->
					  
					  <ul class="nav navbar-nav navbar-right">					  
						<?php  wp_list_pages( array('title_li' => null) ); ?> 
					  </ul>
					</div><!--/.nav-collapse -->
				
				</div> <!-- #navbar row-->
			
			</div> <!-- col-9-->
			<div class='col-xs-2'>
		
				  
				  	<div id="language-dropdown" class="dropdown pull-right "> 
						  <a href="#" class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang; ?><span class="caret"></span></a>
						  <ul id='language-dropdown-ul' class="dropdown-menu" role="menu">
								<li class="dropdown-header"><?php _e("Other languages", "map"); ?></li>						  
					  			<?php if (function_exists("pll_the_languages")) pll_the_languages(array("hide_current" => 1));; ?>
						   </ul>
					</div>
					

			</div>
				
		  </div>
		</nav>
	
		<nav id='mobile-nav' class="nav navbar-nav navbar-right text-right" >
						<!--  MOBILE  botón expandible  que abre el dropdown de idiomas -->
				  
				  	<div id="language-dropdown-mobile" class="dropdown pull-right "> 
						  <a href="#" class="dropdown-toggle btn btn-primary btn-xs" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang; ?><span class="caret"></span></a>
						  <ul id='language-dropdown-mobile-ul' class="dropdown-menu" role="menu">
								<li class="dropdown-header"><?php _e("Other languages", "map"); ?></li>						  
					  			<?php if (function_exists("pll_the_languages")) pll_the_languages(array("hide_current" => 1));; ?>
						   </ul>
					</div>

		</nav>

		<a id='mobile-home-btn' class="btn btn-default btn-xs" href="<?php home_url(); ?>"><i class="glyphicon glyphicon-home"></i></a>
	
	
	
	
	<!-- abierto queda:   html,  body, #body, .container -->