<?php
/*
	This chunk prints the galería of images with the corresponding link to the modal window.
	The modal window has to be defined with the funcition print_bt_modal(array("id" => "image-gallery", somewhere (kn this case in sidebar.php)
	The galería works with the custom post type "galeria", associated to a map with "galeria_id" acf. Also you can add custom images for a specific language with repeated field acf
*/
			$all_images	= array();

				if ($hotspots_galleries	= get_post_meta(get_the_ID(), 'add_hotspot_galleries', true)) {
					// para cada hotspot
					foreach (get_monumentos_by_mapa(get_the_ID()) as $hotspot_post) 
						if ($hotspot_galeria_id		= 	get_post_meta($hotspot_post->ID, "galeria_id", true))
							if (wpba_attachments_exist( $hotspot_galeria_id )){
								$hotspot_attachments	= wpba_get_attachments( $hotspot_galeria_id  );
								$all_images					= array_merge($all_images, $hotspot_attachments);
						}					
				}
				
				
				$hay_galeria	= ((($carousel_imgs = get_field("galeria"))&&count($carousel_imgs)) ); // imgs metidas con repeated field en el mapa
				if (($galeria_id = get_post_meta( get_the_ID(), "galeria_id", true)) )		// fields galeria_id , asociado a  better attachments
				{	
					$hay_galeria							=	true;	
					$hay_galeria_attachments 	=	wpba_attachments_exist( $galeria_id);					
				}
				
			?>
		
		
		
			<?php if ($hay_galeria ) : 

					if ($hay_galeria_attachments) $attachments	= wpba_get_attachments( $galeria_id);

					if (is_array($attachments))  $all_images	=	array_merge($all_images, $attachments, $carousel_imgs);
						else	$all_images	=	array_merge($all_images, $carousel_imgs);
				?>
				
				<h2><?php printf( __('Galería multimedia para %s', 'veras'), get_post_meta(get_the_ID(), 'category_name', true) ); ?></h2> 	
		
				<?php 	# $carousel_imgs =  wpba_get_attachments( );  
								
				?>
				<div id='image-gallery-row' class="row-fluid clearfix"> <!-- gallery,-->
		
					<?php	if (is_array($all_images)) foreach ($all_images as $i => $img) : 
									if (is_object($img))
													$img_id						= $img->ID;
									else			$img_id						= $img['imagen'];
									$img_url_thumb	=	wp_get_attachment_image_src( $img_id, "thumbnail" );
									$img_url_large		=	wp_get_attachment_image_src( $img_id, "large" );				
									$title						= 	get_the_title($img_id);
									$desc						=	(is_object($img))? $img->post_excerpt : ""; ?>
					  <div class="col-xs-4 col-sm-3 col-md-3  col-lg-2 thumb">
							<a class="thumbnail thumbnail-landscape" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo esc_attr($title); ?>" data-caption="<?php echo esc_attr($desc); ?>" data-image="<?php echo $img_url_large[0]; ?>" data-target="#image-gallery">
								<img class="img-responsive" src="<?php echo $img_url_thumb[0]; ?>" alt="Alt- <?php echo esc_attr($title); ?>">
							</a>
						</div>	
						
					<?php endforeach;					?>					
					
				</div> <!-- gallery-->
				
			<?php	endif;  # atachments exists ?>		


