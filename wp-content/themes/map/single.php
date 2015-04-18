<?php get_header(); ?>


 
<?php 
while (have_posts()): the_post();
	
	if (  post_password_required() ) { ?>
		<div class='container'> <?php
		echo "<h1>".__("Password protected")."</h1>";		
		echo get_the_password_form();
		?>
		</div>
		<?php
	}
	else {
	get_template_part( "part", "mapa"); ?> 
	
	
	<?php get_sidebar(); 
	}
	?>


<?php endwhile; ?>


<?php get_footer(); ?>
