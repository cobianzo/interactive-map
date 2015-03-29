<?php 
	// el index.php y single.php es idéntico.
get_header(); 


 	if (function_exists("pll_current_language") && (!isset($lang_slug))) 	
		$lang_slug = pll_current_language("slug"); 

	global $post;		# si estamos en homepage (o sea, este file, consideramos q estamos en el post de yucatán.
	$yucatan_post		= $post	=	get_yucatan_mapa($lang_slug);
	setup_postdata($post);
	
	
?>

<?php 
	//save_mapplic_file("mapplic", pll_current_language()); // TO_DO: apply esto cuando se salve el backend, y crear un file para cada idioma.
	
	// seleccionar mapa de yucatán (en realidad muestra el primer mapa ordenado por menu_order)
	
 ?>
 
 
<?php get_template_part( "part", "mapa");  ?> 

<?php get_sidebar(); ?>



<?php get_footer(); 
	wp_reset_postdata();
?>
