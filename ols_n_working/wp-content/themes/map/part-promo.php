								<?php
									/* Dos tipos de promos: los escritos directamente sobre el mapa post type , y los que son un custom post type*/								
									
									global $promo_array, $promo_post_id, $promo_format_md;	/* promo_format_md -> apaisado, vertical*/
									
									
									
									if ($promo_post_id = $promo_array['predefinida']) {
										$titulo 								= ($title = get_post_meta($promo_post_id, "sobreescribe_titulo", true))?  $title :  get_the_title($promo_post_id)  ;
										$subtitulo						= get_post_meta($promo_post_id, "subtitulo", true);
										$imagen_preview			=	get_post_meta($promo_post_id, "imagen", true);
										$descripcion					= get_post_meta($promo_post_id, "descripcion", true);
										$link								= get_post_meta($promo_post_id, "link", true);
										$link_text						= get_post_meta($promo_post_id, "link_text", true);
									}else
									extract($promo_array);
									/*
										$titulo, $subtitulo
										$descripcion
										$imagen_preview (ID)
										$link, $link_text						
									*/
									$link_a							= 	$link?	"<a href='$link' class='btn btn-primary btn-xs' target='_new'>" : null;
									$link_a_img					= 	$link?	"<a href='$link' class='' target='_new'>" : null;
									$promo_img					= 	$imagen_preview? wp_get_attachment_image_src( $imagen_preview, "medium" )[0] : null; 
									
								# note: the link to open in modal window works because of a js in the footer
								?>
								<h3><?php echo $titulo; ?></h3>																
								<?php echo (strlen($subtitulo))? "<p class='text-justify small'><i>$subtitulo</i></p>" : "" ;?>
								
								<div class=" col-xs-4 <?php echo $promo_format_md == "apaisado"? "col-md-2" : "col-md-6"; ?> no-padding-left text-center">
										<?php echo $link_a_img? $link_a_img : ""; ?>
										<img src="<?php echo $promo_img; ?>" class='img-responsive shadow'>
										<?php echo $link_a_img? "</a>" : ""; ?>
								</div>
								<div class=" col-xs-8 <?php echo $promo_format_md == "apaisado"? "col-md-10" : "col-md-6"; ?> no-padding-left no-padding-right">
									<span class="text-justify">
										<p><?php echo $descripcion; ?></p>
										
										<?php if ($link_a) {
												echo "<p class='text-center'>".$link_a;						?>
											<?php echo ($link_text)?  $link_text :   __("Open link", "map") ;?>
												</a></p>
										<?php } ?>
									</span>
								</div>