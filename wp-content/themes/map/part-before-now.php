		<div id="before-now-<?php the_ID();?>" class='before-now'>
			
			<h3 class="h2">
				<?php printf( __('Before / now', 'map') ); ?>
				<a class="btn btn-primary btn-xs pull-right" href='javascript: beforeNowFullScreen ("before-now-<?php the_ID();?>"); '>
						<i class="glyphicon glyphicon-fullscreen"></i>&nbsp;<?php _e("Enlarge", "map");  ?>
				</a>
			</h3>
			
			<a class='only-full-screen btn btn-primary text-center close-btn' href="javascript: beforeNowFullScreen('before-now-<?php the_ID();?>', 'exit'); "><i class="glyphicon glyphicon-remove-sign"></i></a>
	<!--		<small><?php printf( __('Move the handle to compare both states', 'map') ); ?></small> -->
							
	<?php 
		global $antes_ahora;
		if (! isset($antes_ahora))   $antes_ahora		= (($aa = get_field("antes_ahora")) && is_array($aa) && count($aa))?  $aa[0] : null;					 

		if (is_array($antes_ahora) && count($antes_ahora)) :
		
			$img_before_id				=	$antes_ahora['img_antes'];  //get_post_meta(get_the_ID(), "image_before", true);
			$img_now_id					=	$antes_ahora['img_ahora'];  //get_post_meta(get_the_ID(), "image_now", true);
			$img_before_src				= 	wp_get_attachment_image_src( $img_before_id, "medium" ); 
			$img_before_large_src	= 	wp_get_attachment_image_src( $img_before_id, "large" ); 
			$img_now_src					= 	wp_get_attachment_image_src( $img_now_id, "medium" ); 
			$img_now_large_src		= 	wp_get_attachment_image_src( $img_now_id, "large" ); 
			$descripcion						= $antes_ahora['descripcion'];
	?>

			<div class="ba-slider">
			  <img class='img-before' src="<?php echo $img_before_src[0]; ?>" alt="" data-imagefull="<?php echo $img_before_large_src[0]; ?>">       
			  <div class="resize">
				<img class='img-now' src="<?php echo $img_now_src[0]; ?>" alt="" data-imagefull="<?php echo $img_now_large_src[0]; ?>">
			  </div>
			  <span class="handle"></span>
			</div>
	<?php if (strlen($descripcion)) echo "<br><i class='hide-full-screen text-center'>$descripcion</i>"; ?>
	<?php endif; ?>
	
		<br class='only-full-screen'><a class='only-full-screen btn btn-primary text-center close-btn-2' href="javascript: beforeNowFullScreen('before-now-<?php the_ID();?>', 'exit'); "><?php _e("Close", "map");  ?></a>

	</div>