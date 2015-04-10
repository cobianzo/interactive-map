<?php
/*
	This chunk prints the galería of images with the corresponding link to the modal window.
	The modal window has to be defined with the funcition print_bt_modal(array("id" => "image-gallery", somewhere (kn this case in sidebar.php)
	The galería works with the custom post type "galeria", associated to a map with "galeria_id" acf. Also you can add custom images for a specific language with repeated field acf
*/

				$hay_galeria	= ((($carousel_imgs = get_field("galeria"))&&count($carousel_imgs)) );
				if (($galeria_id = get_post_meta( get_the_ID(), "galeria_id", true)) )
				{	
					$hay_galeria							=	true;	
					$hay_galeria_attachments 	=	wpba_attachments_exist( $galeria_id);					
				}
				
			?>
		
		
		
			<?php if ($hay_galeria ) : 

					if ($hay_galeria_attachments) $attachments	= wpba_get_attachments( $galeria_id);

					if (is_array($attachments))  $all_images	=	array_merge($attachments, $carousel_imgs);
						else	$all_images	=	$carousel_imgs;
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
					  <div class="col-xs-6 col-sm-4 col-md-3  col-lg-2 thumb">
							<a class="thumbnail thumbnail-landscape" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo esc_attr($title); ?>" data-caption="<?php echo esc_attr($desc); ?>" data-image="<?php echo $img_url_large[0]; ?>" data-target="#image-gallery">
								<img class="img-responsive" src="<?php echo $img_url_thumb[0]; ?>" alt="Alt- <?php echo esc_attr($title); ?>">
							</a>
						</div>	
						
					<?php endforeach;					?>					
					
				</div> <!-- gallery-->
				
			<?php	endif;  # atachments exists ?>		


