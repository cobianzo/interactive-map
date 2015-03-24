
		<!-- Modal windoes di Bootstrap.  Card for <?php the_title(); ?> -->
		<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
						if (wpba_attachments_exist( ) ) {
							$carousel_imgs =  wpba_get_attachments( );
						?>
							<div id="carousel-<?php echo $post->post_name; ?>" class="carousel slide">
								<div class="carousel-inner">
						<?php	foreach ($carousel_imgs as $i => $img) : 
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
							
						<?php if ($descripcion = get_post_meta(get_the_ID(), "descripcion", true)) : ?>
							<section>
								<?php echo $descripcion; ?>
							</section>		
						<?php endif; ?>
							<hr>
							
							<section class='row'>
								<div class='col-xs-12 col-sm-6'>
									<a href='http://www.chichenitza.inah.gob.mx/'><img src='images/yucatan/chichen-pic-360.jpg' class='img-responsive'></a>
								</div>
								<div class='col-xs-12 col-sm-6'>
									<h3>Chichén Itzá a 360 grados</h3>
									<p>
										Visita Chichén Itzá como si estuvieras allí. 
									</p>
									<a class='btn btn-primary' href='http://www.chichenitza.inah.gob.mx/' target='_new'>Visita el recorrido virtual del INAH</a>
								</div>
							</section>
							
							<hr>
							
							<section class='row-fluid text-center'>
								<h3>Video</h3>
								<iframe width="420" height="300" src="https://www.youtube.com/embed/kEISjLgSQzs" frameborder="10" allowfullscreen></iframe>									
							</section>
							
							<hr>
							
							<section class='row-flujid clearfix'>
								<h3>eBooks relacionados</h3>
								<div class='col-xs-12 col-sm-6'>
									<a href='http://www.amazon.com/Chichen-Yucat%C3%A1n-M%C3%A9xico-Victor-Castillo/dp/9685160155' class='text-center'  target='_new'>
										<img src='images/yucatan/chichen-ebook.jpg' class='img-responsive'>
									</a>
								</div>
								<div class='col-xs-12 col-sm-6 '  >
									<h4>Guía del visitante de Chichén Itzá</h4>
									<i>Víctor Vera Castillo</i><br>
									<p class='text-justify'>
									Este kit de viaje consiste de una guía de viaje, un mapa tamaño póster, y un suplemento conocido como la Agenda del Viajero. La guía contiene fotos, ilustraciones, atracciones turísticas, información cultural, la fauna, y la población de la región. El mapa provee servicios y actividades en la región y también distancias y un glosario geográfico. 
									</p>
									<a class='btn btn-primary' href='http://www.amazon.com/Chichen-Yucat%C3%A1n-M%C3%A9xico-Victor-Castillo/dp/9685160155' target='_new'>
										Compra el ebook en Amazon
									</a>
								</div>
							</section>
							
															
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>								
					</div>
				</div>
			</div>
		</div>
		<!-- end modal windows -->
