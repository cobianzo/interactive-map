								<?php 
									$video_embed	= get_post_meta(get_the_ID(), "video_embed", true);
									$link_a				= $video_embed? '<a class="thumbnail" href="#" data-image-id="1" data-toggle="modal" data-title="'.esc_attr(get_the_title()).'" data-caption="'.esc_attr(get_the_title()).'"   data-content="'.esc_attr("<section class='row-fluid clearfix section-video'><div class=\"flex-video text-center\">
".$video_embed).'</div></section>"  data-target="#image-gallery"> ' : null;
									# note: the link to open in modal window works because of a js in the footer
								?>
								
								<h3><?php echo ($title = get_post_meta(get_the_ID(), "sobreescribe_titulo", true))?  $title :  get_the_title()  ;?></h3>																
								
								<div class='col-xs-12 col-sm-6'>
									<?php
									$promo_img_id						=	get_post_meta(get_the_ID(), "imagen", true);
									$promo_img							= 	wp_get_attachment_image_src( $promo_img_id, "medium" ); 
									?>
									
									<?php if ($link_a) echo $link_a; ?>
										<img src="<?php echo $promo_img[0]; ?>" class='img-responsive'>
										<?php echo $video_embed? '<span class="glyphicon glyphicon-play-circle"></span>' :''; ?>
									<?php if ($link_a) echo "</a>"; ?>
								</div>
								<div class='col-xs-12 col-sm-6 '  >
									<span class='text-justify'>
										<?php 
										the_content(); ?>
									</span>
									<!--<a class='btn btn-primary' href='http://www.amazon.com/Chichen-Yucat%C3%A1n-M%C3%A9xico-Victor-Castillo/dp/9685160155' target='_new'>
										Compra el ebook en Amazon
									</a>-->
								</div>
