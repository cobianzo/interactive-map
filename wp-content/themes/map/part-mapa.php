				<a name="mapa" id='mapa' href="#"></a>
				
				
				<section id="map-section" class="inner over">

					<!-- Map -->
					<div class="map-container">
						<div class="window-mockup">
							<div class="window-bar"></div>
						</div>
						<div id="mapplic">
							<!-- this container will be replaced by div.mapplic-element -->
							<p>This is something</p>
						</div>
					</div>
					
					
					
				</section>
				<?php 
				/*
					THIS CONTINUES IN FOOTER.php. 
					There you'll find the call of the <script> that loads the map.
					IN FUNCTIONS.php you'll find the registration of the .js files that we need to make it work	*/
				global $mapplic_json_file, $post;
				print_r($post);
				$language		=	function_exists("pll_current_language")? pll_current_language() : "_es" ;
				if (is_single()){
					$mapplic_json_file	=	get_maps_dir("url" )."/".$post->post_name."_".$language.".json";
				}else
					$mapplic_json_file	=	get_maps_dir("url" )."/mapplic_".$language.".json"					
				?>