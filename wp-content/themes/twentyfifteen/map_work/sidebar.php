<?php 
				# initializing array for promos and array for videos
					global $promo_array;
					$promos				= get_field("promos_list");					
					$current_promo	=	0;			// we'll increment this as we display promos of this mapa
?>

<?php
				//  we create the modal window (initilly hidden, will show on clicking on a thumbnail).  We use it in gallery of images and in videos section. Opens this modal window
						$html_header	= '  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>';
						$html_body		=  '                <img id="image-gallery-image" class="img-responsive" src=""> <div id="content-gallery"><!-- this can be any html in data-content --></div>';
						$html_footer		=	'<div class="col-md-2">  <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>  </div>
                <div class="col-md-8 text-justify" id="image-gallery-caption"> This text will be overwritten by jQuery </div>
                <div class="col-md-2"> <button type="button" id="show-next-image" class="btn btn-default">Next</button>  </div>';
						print_bt_modal(array("id" => "image-gallery",   "html_header" => $html_header,  "html_body" => $html_body,"html_footer" => $html_footer, ))
?>



<section id="sidebar" class='clearfix row-fluid'>
	<div class='row-fluid'> <!-- includes gallery, video, before/now, and collumn comments with promo  (everything but the bottom row) -->
	
		<div class='col-sm-12 col-md-8'>  <!-- img gallery, video and before/now-->
			
			<?php get_template_part( "part", "galeria");  	 ?>
			
			
			<div class='row'> <!-- row video + before/now-->
			
				<div class='col-sm-12 col-md-6' id='col-video'> <!-- col  video -->
				<?php
				$videos		= get_field("galeria_videos");
				if (is_array($videos) && count($videos)) : 		?>
				
					<h3 class="h2"><?php printf( __('Videos', 'veras') ); ?></h3>
					<?php 
					
					#foreach ($videos as $video_id) : 
					
					foreach ($videos as $i => $video_block) :  ?>
					<div class='row-fluid clearfix'> 
					<?php
						global $video_array;		$video_array = $video_block;
						get_template_part( "part", "video");  						
					?>
					</div>
					<?php
					endforeach;

				else : 
					if (is_array($promos) && (count($promos) > $current_promo)) {
						$promo_array	= $promos[$current_promo++];						
						get_template_part( "part", "promo"); 
					}
				endif;
				
				?>
				</div> <!-- col videos-->
				<div class='col-sm-12 col-md-6'> <!-- col  before/now-->	<?php
					 if ($img_before_id =	get_post_meta(get_the_ID(), "image_before", true)): ?>

							<?php get_template_part( "part", "before-now");  ?>

					<?php else :
					if (is_array($promos) && (count($promos) > $current_promo)) {
								$promo_array	= $promos[$current_promo++];
								get_template_part( "part", "promo"); 
							}	
					endif; ?>
				</div>
				
			</div><!-- / row video + before/now-->
		
		
		</div> <!-- / col imagegallery , video and before/now-->
		

		<!-- verdadero sidebar: comentarios y primera promo -->
		<aside id='aside' class='col-sm-12 col-md-4'>
			<div class='row-fluid' id='comments-container'>
				<?php 	get_template_part( "part", "comments"); ?> 
			</div>
			
			
			<hr class="greca md-hidden lg-hidden xl-hidden">
	
			<div class='row-fluid' id='promo-aside'>
				<?php 	
					if (is_array($promos) && (count($promos) > $current_promo)) {
						$promo_array	= $promos[$current_promo++];
						get_template_part( "part", "promo"); 
					}
				?> 
			</div>
		</aside>
		
		
	</div>  <!-- row after section -->

	
	
	
	
	
	

	<?php if (is_array($promos) && (count($promos) > $current_promo))  :?>
	<div class='row-fluid' id='bottom-row'>
			<?php for ($i = $current_promo; $i < count($promos); $i++) { ?>
				<div class='col-xs-12 col-sm-6 col-md-3'>
				<?php 
						$promo_array	= $promos[$i];						
						get_template_part( "part", "promo"); 
				?>
				</div>			
			<?php } ?>			
	</div>
	<?php endif; 
	setup_postdata($current_post);		
	$post	= $current_post;
	?>

	
</section><!--sidebar-->
