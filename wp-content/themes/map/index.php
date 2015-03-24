<?php get_header(); ?>


<?php echo "::::::::::::::::::::::::<br>::::::::::::";
	//save_mapplic_file("mapplic", pll_current_language()); // TO_DO: apply esto cuando se salve el backend, y crear un file para cada idioma.
	
	//print_array	(array_mapplic_configuration());
	
	// seleccionar mapa de yucatán
	
 ?>
 
 
<?php get_template_part( "part", "mapa"); ?> 


<?php //  get_sidebar(); 

?>


<?php get_footer(); 
	wp_reset_postdata();
?>
