<!DOCTYPE html>
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
	
	<div id="header"><header>
		
		<div class="container">
		
			<?php if (function_exists("pll_the_languages")) pll_the_languages(array());; ?>
		</div><!--.container-->
	</header></div><!--#header-->
	
	
	
	
	<!-- abierto queda:   html,  body, #body, .container -->