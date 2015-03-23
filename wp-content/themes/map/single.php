<?php get_header(); ?>


 
<?php 
while (have_posts()): the_post();
	get_template_part( "part", "mapa"); ?> 
<?php endwhile; ?>


<?php //  get_sidebar(); ?>


<?php get_footer(); ?>
