		<?php 
			$redirect_map_id = get_post_meta(get_the_ID(), "mapa_redirection", true);  if ($redirect_map_id == "null") $redirect_map_id = null;
			$map_redirect_protected = post_password_required($redirect_map_id); 
		?>
		<!-- Modal windoes di Bootstrap.  Card for <?php the_title(); ?> . In this div we include the info for js, to redirect or open the modal if the hotspot redirects to another map -->
		<div class="modal fade" id="modal-<?php echo $post->post_name; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?php echo $post->post_name; ?>" aria-hidden="true"
				<?php if ($redirect_map_id) { ?> data-redirect='<?php echo get_permalink($redirect_map_id); ?>' 
				data-goredirect='<?php echo  ($map_redirect_protected)? "no" : "si" ?>' 	<?php } ?>
		>
			<div class="modal-dialog modal-md">
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
					<div class="modal-body <?php echo  $redirect_map_id?  "row-fluid clearfix" : "" ; ?>">
						<?php 
						/* CARRUSEL -------------------------------------------------------------------------------------------------------------------
							-----------------------------------------------------------------------------------------------------------------------------------------------   */						
						$carousel_imgs =	array();
						if ($galeria_al_vuelo = get_field("galeria")) {
							if (is_array($galeria_al_vuelo))
								foreach 	($galeria_al_vuelo as $row_galeria) 		$carousel_imgs[] = get_post($row_galeria['imagen']);
						}
						
						if ( ($galeria_id = 	get_post_meta(get_the_ID(), "galeria_id", true)) && wpba_attachments_exist( $galeria_id  ) )  
								$carousel_imgs =  array_merge($carousel_imgs, wpba_get_attachments( $galeria_id  ));					

						if (count($carousel_imgs )) {
							?>
							
							<div id="carousel-<?php echo $post->post_name; ?>" class="carousel slide <?php echo $redirect_map_id?  "col-xs-12 col-sm-6" : "" ; ?>">
								<div class="carousel-inner">
								
						<?php	foreach ($carousel_imgs as $i => $img) : 
						
									global $polylang;	// not used yet, but if we display the title and description, we will need it.
									$post_ids = $polylang->model->get_translations('post', $img->ID);			# GET  	los idiomas a los que está traducido la img
									$lang_slug = pll_current_language("slug");										# GET		current langauag
									if (array_key_exists( $lang_slug, $post_ids)) {									# SI existe imagen traducida al idioma actual --> ACTUALIZAMOS la img a usar
										$img_id	=	$post_ids[$lang_slug];
										$img		= get_post($img_id);
									}
						
						
						
										$img_url				=	wp_get_attachment_image_src( $img->ID,  "medium"  );
										$img_url_large	=	wp_get_attachment_image_src( $img->ID,  "large");
										
						?>
									<div class="item<?php echo ($i == 0)? " active": ""; ?> text-center">
										<img 	class='load-src-on-open-modal' data-preloadsrc="<?php echo $img_url[0]; ?>" data-imagefull="<?php echo $img_url_large[0]; ?>"
													src="<?php echo get_template_directory_uri(); ?>/images/loading-logo.gif">
									</div>								
						<?php endforeach;					?>
								</div>
								
						<?php if (count($carousel_imgs) > 1 ) :?>
								<!-- Controls -->
								<a class="left carousel-control" href="#carousel-<?php echo $post->post_name; ?>" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left"></span>
								</a>

								<a class="right carousel-control" href="#carousel-<?php echo $post->post_name; ?>" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
						<?php endif; ?>
							</div>
						<?php	}	?>
							
						<?php if ($contenido = get_post_meta(get_the_ID(), "contenido", true)) : ?>
							<section class='<?php echo $redirect_map_id?  "col-xs-12 col-sm-6" : "row-fluid clearfix " ; ?> section-contenido'><p>
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
					/* ANTES / AHORA -------------------------------------------------------------------------------------------------------------------
					-----------------------------------------------------------------------------------------------------------------------------------------------   */
					global $antes_ahora, $preload_img;
					$preload_img					= true;
					 $antes_ahora_array		= (($aa = get_field("antes_ahora")) && is_array($aa) && count($aa))?  $aa : null;
					 if (is_array($antes_ahora_array)) foreach ($antes_ahora_array as $aa) {
							$antes_ahora = $aa;
							if ($antes_ahora && ($img_before_id =	$antes_ahora["img_antes"]))

								get_template_part( "part", "before-now");  

									
						}
					?>
						
						
						
						
						
						
						
						
						
						<?php echo $redirect_map_id?  "</div> <!-- modal-body--> \n <div class='row-fluid clearfix'>" : "" ?>
						
						
						<?php if ($map_redirect_protected) :	/* esto sólo para hotspot de Yucatán que redirecionan a mapas protegidos con contraseña */	?>
							
							<section class='row-fluid clearfix section-password-form'>
								<h3 class='container'><?php printf(__("Access to the whole navigation of %s", "map"), get_the_title()); ?></h3>
								<div class='col-xs-1 col-sm-2 col-md-3'>
									<?php $img_mapa	= get_post_meta($redirect_map_id, "mapa_hi", true); ?>
									<img src="<?php echo wp_get_attachment_image_src( $img_mapa, "thumbnail" )[0];?>" class='img-responsive'>
									<!-- img del mapa -->
								</div>
								<div class='col-xs-11 col-sm-10 col-md-9'>
									<?php echo get_the_password_form($redirect_map_id ); ?>
									<?php if (isset($_REQUEST['error-map-password']) && (get_the_ID() == $_REQUEST['error-map-password']) ) 
													echo "<p class='alert alert-danger'>".__("The password you entered is not correct. Please try again.", "map")."</p>";
									?>
								</div>
							</section>
						<?php endif; ?>
						
						

						<?php  	// YA NO HAY PROMOS EN LAS CARDS
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
