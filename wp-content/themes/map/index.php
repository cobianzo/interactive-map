<?php get_header(); ?>


<?php echo "::::::::::::::::::::::::<br>::::::::::::";
	echo "cuurent lan ".pll_current_language();
	//save_mapplic_file("mapplic", pll_current_language()); // TO_DO: apply esto cuando se salve el backend, y crear un file para cada idioma.
	
	//print_array	(array_mapplic_configuration());
 ?>
 
 
<?php get_template_part( "part", "mapa"); ?> 



<?php //  get_sidebar(); ?>


<?php get_footer(); ?>
