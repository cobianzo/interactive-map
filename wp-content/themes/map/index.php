<?php 
	// el index.php y single.php es idéntico.
get_header(); ?>

<?php
	global $post;		# si estamos en homepage (o sea, este file, consideramos q estamos en el post de yucatán.
	$mapas				= get_posts (array( "post_type"	=> "mapa" , "post_parent" => 0, "orderby" => "menu_order" , "order" => "ASC",
										'tax_query' => array(	array(  'taxonomy' => 'language',	'field'    => 'slug', 'terms'    => $lang,)	)	));
	$yucatan_post		= $post	=	$mapas[0];
	setup_postdata($post);
	;
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
