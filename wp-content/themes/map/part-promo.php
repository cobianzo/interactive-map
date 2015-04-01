								<?php
									/* Dos tipos de promos: los escritos directamente sobre el mapa post type , y los que son un custom post type*/								
									global $promo_array;  $promo_post_id;
									if ($promo_post_id) {
										$titulo 								= ($title = get_post_meta($promo_post_id, "sobreescribe_titulo", true))?  $title :  get_the_title($promo_post_id)  ;
										$imagen_preview			=	get_post_meta($promo_post_id, "imagen", true);
										$descripcion					= get_the_content($promo_post_id);
									#$link
									}else
									extract($promo_array);
									/*
										$titulo,
										$descripcion
										$imagen_preview (ID)
										$link									
									*/
									$promo_img					= 	$imagen_preview? wp_get_attachment_image_src( $imagen_preview, "medium" )[0] : null; 
									
								# note: the link to open in modal window works because of a js in the footer
								?>
								<h3><?php echo $titulo; ?></h3>																
								
								<div class="col-xs-12 col-sm-6">
																		
										<img src="<?php echo $promo_img; ?>" class='img-responsive'>
										
								</div>
								<div class="col-xs-12 col-sm-6 ">
									<span class="text-justify">
										<p><?php echo $descripcion; ?></p>
										<!--<a class='btn btn-primary' href='http://www.amazon.com/Chichen-Yucat%C3%A1n-M%C3%A9xico-Victor-Castillo/dp/9685160155' target='_new'>
											Compra el ebook en Amazon
										</a>-->

									</span>
								</div>