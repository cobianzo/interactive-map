<?php
	/*
	EY: aquí compruebo que el usuario acceda a la web pasando el pw adecuado como params en url	
	*/
	
	if( !is_user_logged_in() ) :
		# si no está loggeado, puede que esté usando el key y value correctos (se loggea), o no (aparece mensaje de error)
		
		if (check_url_login())
		{
			
			$user = get_userdatabylogin('guest');    
			// log in automatically
			$user_id = $user->ID;
			wp_set_current_user( $user_id, $user_login );
			wp_set_auth_cookie( $user_id );
			do_action( 'wp_login', $user_login );
			
		}else {
			get_template_part( "page-not-loggedin");  						
			die();
		}	
	endif;

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
	
	
	
	    <!-- Fixed navbar -->
		<nav id="header-navbar"  class="navbar navbar-default  navbar-fixed-top">
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
						<?php if ((!is_front_page()) && (!is_home())  && $post->post_type == "mapa" ) : ?>
						<li>
							<span class="glyphicon glyphicon-chevron-right pull-left"></span>
							<a  class='active' href="<?php  the_permalink() ?>"><?php echo get_post_meta(get_the_ID(), 'category_name', true); ?></a></li>
						<?php endif;?>
					  </ul>
						</li>
					  </ul>
					  <ul class="nav navbar-nav navbar-right">
						<?php wp_list_pages( array('title_li' => null) ); ?> 
					  </ul>
					</div><!--/.nav-collapse -->
				
				</div> <!-- #navbar row-->
			
			</div> <!-- col-9-->
			<div class='col-xs-2'>
		
				<!--  Mobile botón expandible  que abre el dropdown de idiomas -->
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#language-dropdown-ul" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only"><?php _e("Toggle navigation"); ?></span>	<span class="icon-bar"></span>	<span class="icon-bar"></span>	<span class="icon-bar"></span>
				  </button> 
				  
				  	<div id="language-dropdown" class="dropdown pull-right "> 
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $lang; ?><span class="caret"></span></a>
						  <ul id='language-dropdown-ul' class="dropdown-menu" role="menu">
								<li class="dropdown-header"><?php _e("Otros idiomas"); ?></li>						  
					  			<?php if (function_exists("pll_the_languages")) pll_the_languages(array("hide_current" => 1));; ?>
						   </ul>
					</div>
					

			</div>
				
		  </div>
		</nav>
	
	
	
	
	
	
	
	<!-- abierto queda:   html,  body, #body, .container -->