								<?php 
									global $video_array;
									extract($video_array);
									$video_img					= 	$imagen_preview? wp_get_attachment_image_src( $imagen_preview, "medium" )[0] : null; 
									$video_embed_html	= $video_embed;
									if (!$video_img):
										if (strpos($video_embed, "youtube") ) {		// TO_DO: falta validación
											if (substr($video_embed, 0 , 4) == "http")	$video_url = $video_embed;
											else{
												preg_match('/src="([^"]+)"/', html_entity_decode($video_embed), $match);
												$video_url = $match[1]; 
											}
											# sacamos el video_id de youtube desde la url
											if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match)) {
												$video_id = $match[1];
											}											

											$video_img					= "http://img.youtube.com/vi/".$video_id."/0.jpg";
											//$video_embed_html	= htmlentities('<iframe width=560 height=315 src='.$video_url.' frameborder=0 allowfullscreen></iframe>');;
										}
									endif;
									
									$video_embed_html				= ($video_embed_html)? "<section class='row-fluid clearfix section-video'><div class=\"flex-video text-center\">
".$video_embed_html."</div></section> " : null;
											
								# note: the link to open in modal window works because of a js in the footer
								?>
								
								<div class="col-xs-12 col-sm-6 no-padding-left">
																		
									<a class="thumbnail" href="#" data-image-id="<?php echo $i; ?>" data-toggle="modal" data-title="<?php echo esc_attr($titulo); ?>" data-caption="<?php echo esc_attr($descripcion); ?>" data-content="<?php echo esc_attr($video_embed_html); ?>"  data-target="#image-gallery">									
										<img src="<?php echo $video_img; ?>" class='img-responsive'>
										<span class="glyphicon glyphicon-play-circle"></span>									
									</a>								
								</div>
								<div class="col-xs-12 col-sm-6 no-padding-left no-padding-right">
								
									<h3 class='h4 no-margin-top'><?php echo $titulo; ?></h3>																
								
									<span class="text-justify">
										<p><?php echo $descripcion; ?></p>
									</span>
									<!--<a class='btn btn-primary' href='http://www.amazon.com/Chichen-Yucat%C3%A1n-M%C3%A9xico-Victor-Castillo/dp/9685160155' target='_new'>
										Compra el ebook en Amazon
									</a>-->
								</div>
