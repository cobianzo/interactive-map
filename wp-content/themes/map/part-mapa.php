				<a name="mapa" id='mapa' href="#"></a>
				
				
				<section id="map-section" class="inner over">

					<!-- Map -->
					<div class="map-container">
						<div class="window-mockup">
							<div class="window-bar"></div>
						</div>	
						<div id="mapplic">
							<!-- this container will be replaced by div.mapplic-element -->
							
							<?php
							query_posts(array(	"post_type" 			=> "mapa",	"posts_per_page"	=> -1,	"post_parent"		=> get_the_ID(),));
							while (have_posts()) :  the_post();
								get_template_part( "part", "hotspot-card"); 
							endwhile;
							wp_reset_query();
							?>
							
							
							
						</div>
					</div>
					
					
					
				</section>
				<?php 
				/*	THIS CONTINUES IN FOOTER.php.   ----->	There you'll find the call of the <script> that loads the map.
					IN FUNCTIONS.php you'll find the registration of the .js files that we need to make it work	*/
				global $mapplic_json_file, $post;
				$language				=	function_exists("pll_current_language")? pll_current_language() : "_es" ;
				$mapplic_json_file	=	(is_single())?   get_maps_dir("url" )."/".$post->post_name."_".$language.".json"  : $mapplic_json_file	=	get_maps_dir("url" )."/mapplic_".$language.".json";				
										
				?>
				
				<hr><hr>
				<a href="javascript:   $('#modal-piramide-de-kukulkan').modal({show: 'false'}); ">Abre modal </a>
