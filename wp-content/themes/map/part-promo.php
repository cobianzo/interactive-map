								<h3><?php echo ($title = get_post_meta(get_the_ID(), "sobreescribe_titulo", true))?  $title :  get_the_title()  ;?></h3>																
								
								<div class='col-xs-12 col-sm-6'>
									<?php
									$promo_img_id						=	get_post_meta(get_the_ID(), "imagen", true);
									$promo_img							= 	wp_get_attachment_image_src( $promo_img_id, "medium" ); 
									?>
									
									<!--<a href="" class='text-center'  target='_new'>-->
										<img src="<?php echo $promo_img[0]; ?>" class='img-responsive'>
									<!--</a>-->
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
