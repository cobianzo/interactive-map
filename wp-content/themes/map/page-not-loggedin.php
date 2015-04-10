<?php 
	// el index.php y single.php es idéntico.
get_header(); 


 	if (function_exists("pll_current_language") && (!isset($lang_slug))) 	
		$lang_slug = pll_current_language("slug"); 
?>

<div class="container">

	<h1><?php _e("Sin acceso"); ?></h1>
	
	<p>
	<?php _e("Lo siento, no puedes acceder a esta aplicación web sin la clave de acceso inicial facilitada en la url del folleto de la Editorial Verás" ); ?>
	
	
	</p>

</div>



<?php get_footer(); 
?>
