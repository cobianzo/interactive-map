		<h3 class="h2"><?php printf( __('Antes / ahora', 'veras') ); ?></h3>
		<small><?php printf( __('Mueve el cursor para comparar los estados del monumento', 'veras') ); ?></small>
						
<?php 
	$antes_ahora					= get_field("antes_ahora");
	if (is_array($antes_ahora) && count($antes_ahora)) :
	
		$antes_ahora					= $antes_ahora[0];
		$img_before_id				=	$antes_ahora['img_antes'];  //get_post_meta(get_the_ID(), "image_before", true);
		$img_now_id					=	$antes_ahora['img_ahora'];  //get_post_meta(get_the_ID(), "image_now", true);
		$img_before_src				= 	wp_get_attachment_image_src( $img_before_id, "medium" ); 
		$img_now_src					= 	wp_get_attachment_image_src( $img_now_id, "medium" ); 
		$descripcion						= $antes_ahora['descripcion'];
?>

		<div class="ba-slider">
		  <img src="<?php echo $img_before_src[0]; ?>" alt="">       
		  <div class="resize">
			<img src="<?php echo $img_now_src[0]; ?>" alt="">
		  </div>
		  <span class="handle"></span>
		</div>
<?php if (strlen($descripcion)) echo "<blockquote>$descripcion</blockquote>"; ?>
<?php endif; ?>