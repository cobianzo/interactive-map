
		<!-- Modal windoes di Bootstrap.  Card for <?php the_title(); ?> -->
		<div class="modal fade" id="modal-<?php echo $post->post_name; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $post->post_name; ?>" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
						<div>
							<?php
							// El icono
							if ($icono_id = get_post_meta(get_the_ID(), "icono", true)) :
								$icono_src		= 	wp_get_attachment_image_src( $icono_id, "thumbnail" ); 		
							?>
							<img width=35 height=35 class='pull-left img-responsive' src='<?php echo $icono_src[0]; ?>'> 
							<?php endif; ?>
							
							<h4 class="modal-title">
								<?php	// El título<
								if ($titulo_id = get_post_meta(get_the_ID(), "imagen_titulo", true)) :
									$titulo_src		= 	wp_get_attachment_image_src( $titulo_id, "large" ); 		
								?>
									<img alt="<?php echo esc_attr(get_the_title()); ?>" class='img-responsive' src= '<?php echo $titulo_src[0]; ?>'>
								<?php else:  
										the_title();
								endif; ?>
							</h4>
							
						</div>
					</div>
					<div class="modal-body">
						<?php 
						if ( ($galeria_id = 	get_post_meta(get_the_ID(), "galeria_id", true)) && wpba_attachments_exist( $galeria_id  ) )  
						{
							$carousel_imgs =  wpba_get_attachments( $galeria_id  );						?>
							
							<div id="carousel-<?php echo $post->post_name; ?>" class="carousel slide">
								<div class="carousel-inner">
								
						<?php	foreach ($carousel_imgs as $i => $img) : 
						
									global $polylang;	// not used yet, but if we display the title and description, we will need it.
									$post_ids = $polylang->get_translations('post', $img->ID);
									$lang_slug = pll_current_language("slug");
									if (array_key_exists( $lang_slug, $post_ids)) {
										$img_id	=	$post_ids[$lang_slug];
										$img		= get_post($img_id);
									}
						
						
						
										$img_url	=	wp_get_attachment_image_src( $img->ID, "large" );
						?>
									<div class="item<?php echo ($i == 0)? " active": ""; ?>">
										<img src="<?php echo $img_url[0]; ?>" >
									</div>								
						<?php endforeach;					?>
								</div>
								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-<?php echo $post->post_name; ?>" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
								</a>

								<a class="right carousel-control" href="#carousel-<?php echo $post->post_name; ?>" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
							</div>
						<?php	}	?>
							
						<?php if ($contenido = get_post_meta(get_the_ID(), "contenido", true)) : ?>
							<section class='row-fluid clearfix section-contenido'><p>
								<?php echo str_replace("\n", "</p><p>", $contenido); ?>
							</p></section>		
						<?php endif; ?>
							
						<?php if ($video = get_post_meta(get_the_ID(), "video", true)) : ?>
							<section class='row-fluid clearfix section-video'>
							    <div class="flex-video text-center">
								<?php echo $video; ?>
								</div>
							</section>		
						<?php endif; ?>




						<?php 
						$promos	=	get_post_meta(get_the_ID(), "promos", true);
						if (is_array($promos) && (count($promos))) : ?>
							<section class='row-fluid clearfix section-promos'>
							    <?php 
								foreach ($promos as $i => $promo_id) :
									global $post;
									$post	= get_post($promo_id);										
									setup_postdata($post);
									get_template_part( "part", "promo"); 
								endforeach;
								wp_reset_postdata();
								?>

							</section>		
						<?php endif; ?>
						
						
						

							
															
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php  _e("Close", "map"); ?></button>								
					</div>
				</div>
			</div>
		</div>
		<!-- end modal windows -->
