<?php 
	$img_before_id				=	get_post_meta(get_the_ID(), "image_before", true);
	$img_now_id					=	get_post_meta(get_the_ID(), "image_now", true);
	$img_before_src				= 	wp_get_attachment_image_src( $img_before_id, "medium" ); 
	$img_now_src					= 	wp_get_attachment_image_src( $img_now_id, "medium" ); 
?>

<div class="ba-slider">
  <img src="<?php echo $img_before_src[0]; ?>" alt="">       
  <div class="resize">
    <img src="<?php echo $img_now_src[0]; ?>" alt="">
  </div>
  <span class="handle"></span>
</div>