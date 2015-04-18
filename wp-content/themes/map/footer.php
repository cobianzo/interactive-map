	
	<div id="footer" class='row-fluid'><footer>
		<div class="container">
			<?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?><!--Wigitized Footer--><?php endif ?>

			<span class='col-xs-12 col-sm-3 text-center'>
				<!--<a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow"><?php _e('Entries (RSS)', "map"); ?></a> |  -->
				<a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e('Comments (RSS)', "map"); ?></a>
			</span>
			<span class='col-xs-12 col-sm-7 text-center'>
					&copy; <?php echo date("Y") ?> 
					<a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>. 
					<?php _e('All Rights Reserved.', "map"); ?>
			</span>
			<span class="col-xs-12 col-sm-2 text-center"><a href="#body"><?php _e('Top', "map"); ?></a></span>

		</div><!--.container-->
	</footer></div><!--#footer-->



	<?php // hs added to display this when clicking on a page link. (see footer).
		$html_header	= '  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="page-modal-title"></h4>';
		print_bt_modal(array("id" => "page-modal",   "html_header" => $html_header,  "html_body" => "<div id='page-content'></div>","html_footer" => "", ))
	?>
	


	<!-- cerramos del header:    ,  #body, body, html, -->
</div><!--#body-->


<?php wp_footer(); /* this is used by many Wordpress features and plugins to work proporly */ ?>

			<script type="text/javascript">
			<?php
			global $mapplic_json_file, $current_user;			
			?>			
			$(document).ready(function() {
				$('#mapplic').mapplic({
					source: "<?php echo $mapplic_json_file;  ?>?v=3", //  'http://localhost/interactive-map/www/mapplic/yucatan.json?v=10',
					height: 500,
					animate: true,
					mapfill: true,
					sidebar: true,
					minimap: true,
					deeplinking: true,
					fullscreen: true,
					hovertip: true,
					developer: <?php echo ( !user_can( $current_user, "subscriber" ) )? 'true' : 'false';?>,
					maxscale: 1
				});

				$('.usage').click(function(e) {
					e.preventDefault();
					
					$('.editor-window').slideToggle(200);
				});

				$('.editor-window .window-mockup').click(function() {
					$('.editor-window').slideUp(200);
				});
			});
			
			
			
			
			/* Mapplic map: opens the card of a hotspot, previously hidden on html */
			function abreLocationCard(locationCardName){
				
				/* dos opciones: si el hotspot redirecciona a otro mapa, y se tiene acceso a él (no protegido por contraseña o ya introducida, se redirecciona*/
				if ( (url_redirect = $("#modal-"+locationCardName).attr("data-redirect")) && ( $("#modal-"+locationCardName).attr("data-goredirect") == "si"))
					window.location	=	url_redirect; 
				else 
				$("#modal-"+locationCardName).modal({show: 'false'});				
				
			}
			
			// al cerrar el modal devolvemos la visibilidad del mapa en fullScreen
			jQuery(".modal").on('hidden.bs.modal', function () {
				// no es necesario... el ppopup se ve bien				
			});
			
			
			
			
			/* opens modal to display the page */
			$(document).ready(function(){
				
							
							
				$(".page_item a").click(function(e){					
					
					$("#page-modal-title").text($(this).text());
					$("#page-content").html("Loading");
					// load with ajax the content of the  page
					jQuery.post(	ajaxurl, {
												'action': 			'open_page_ajax',
												'page_url':   	$(this).attr("href")
											}, 
										function(response){
												$("#page-content").html(response);
											}
					);									
					e.preventDefault();				
					$("#page-modal").modal({show: 'false'});				
				});
				
			});
			
			
			
			
			
			
			
			
			
			
			
			
			
			// gallery javascript lightbox with bt modal. TO_DO: convert into a js plugin enqueued
			$(document).ready(function(){

				loadGallery(true, 'a.thumbnail');

				//This function disables buttons when needed
				function disableButtons(counter_max, counter_current){
					if (typeof(counter_current) === "undefined" ) return;
					$('#show-previous-image, #show-next-image').show();
					$('#image-gallery-image').bind("click", function(){ $('#show-next-image').click() });	// clicar la imagen pasa a la siguiente img
					if(counter_max == counter_current){
						$('#show-next-image').hide();
						$('#image-gallery-image').unbind("click");						// si no hay siguiente img cancelamos ese efecto
					} else {						
						if (counter_current == 1){
						$('#show-previous-image').hide();
						}
					}
				}

				/**
				 *
				 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
				 * @param setClickAttr  Sets the attribute for the click handler.
				 */

				function loadGallery(setIDs, setClickAttr){
					var current_image,
						selector,
						counter = 0;

					$('#show-next-image, #show-previous-image').click(function(){
						if($(this).attr('id') == 'show-previous-image'){
							current_image--;
						} else {
							current_image++;
						}

						selector = $('[data-image-id="' + current_image + '"]');
						updateGallery(selector);
					});

					function updateGallery(selector) { 
						var $sel = selector;
						current_image = $sel.data('image-id');
						$('#image-gallery-caption').text($sel.data('caption'));
						$('#image-gallery-title').text($sel.data('title'));
						$('#image-gallery-image').hide();
						$('#content-gallery').html("");
						
							
						if (typeof($sel.attr("data-image")) !== "undefined") {
							$('#image-gallery-image').attr('src', $sel.data('image')).fadeIn("slow", function(){$('#image-gallery-image').show()} );
						}
						if (typeof($sel.attr("data-content")) !== "undefined") 
							$('#content-gallery').html($sel.attr("data-content"));
						disableButtons(counter, $sel.data('image-id'));						
					}

					if(setIDs == true){
						$('[data-image-id]').each(function(){
							counter++;
							$(this).attr('data-image-id',counter);
						});
					}
					$(setClickAttr).on('click',function(){
						updateGallery($(this));
					});
				}
			});
			
			
			
			
			/* plugin before now */
			
			/* esto es mio para hacerlo fullscreen*/
			function beforeNowFullScreen (action){
				if (action === "exit") $("#before-now").removeClass("fullscreen");
				else {
					$("#before-now").addClass("fullscreen");
					$("#img-before").attr("src", $("#img-before").attr("data-imagefull"));
					$("#img-now").attr("src", $("#img-now").attr("data-imagefull"));
				}
				$(window).resize();
				return ;
			}	
			//$("#before-now").click(function(){   beforeNowFullScreen ("exit") });
			
			
			
			// Call & init
				$(document).ready(function(){
				  $('.ba-slider').each(function(){
					var cur = $(this);
					// Adjust the slider
					var width = cur.width()+'px';
					cur.find('.resize img').css('width', width);
					// Bind dragging events
					drags(cur.find('.handle'), cur.find('.resize'), cur);
				  });
				});

				// Update sliders on resize. 
				// Because we all do this: i.imgur.com/YkbaV.gif
				$(window).resize(function(){
				  $('.ba-slider').each(function(){
					var cur = $(this);
					var width = cur.width()+'px';
					cur.find('.resize img').css('width', width);
				  });
				});

				function drags(dragElement, resizeElement, container) {
					
				  // Initialize the dragging event on mousedown.
				  dragElement.on('mousedown touchstart', function(e) {
					
					dragElement.addClass('draggable');
					resizeElement.addClass('resizable');
					
					// Check if it's a mouse or touch event and pass along the correct value
					var startX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;
					
					// Get the initial position
					var dragWidth = dragElement.outerWidth(),
						posX = dragElement.offset().left + dragWidth - startX,
						containerOffset = container.offset().left,
						containerWidth = container.outerWidth();
				 
					// Set limits
					minLeft = containerOffset + 10;
					maxLeft = containerOffset + containerWidth - dragWidth - 10;
					
					// Calculate the dragging distance on mousemove.
					dragElement.parents().on("mousemove touchmove", function(e) {
						
					  // Check if it's a mouse or touch event and pass along the correct value
					  var moveX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;
					  
					  leftValue = moveX + posX - dragWidth;
					  
					  // Prevent going off limits
					  if ( leftValue < minLeft) {
						leftValue = minLeft;
					  } else if (leftValue > maxLeft) {
						leftValue = maxLeft;
					  }
					  
					  // Translate the handle's left value to masked divs width.
					  widthValue = (leftValue + dragWidth/2 - containerOffset)*100/containerWidth+'%';
							
					  // Set the new values for the slider and the handle. 
					  // Bind mouseup events to stop dragging.
					  $('.draggable').css('left', widthValue).on('mouseup touchend touchcancel', function () {
						$(this).removeClass('draggable');
						resizeElement.removeClass('resizable');
					  });
					  $('.resizable').css('width', widthValue);
					}).on('mouseup touchend touchcancel', function(){
					  dragElement.removeClass('draggable');
					  resizeElement.removeClass('resizable');
					});
					e.preventDefault();
				  }).on('mouseup touchend touchcancel', function(e){
					dragElement.removeClass('draggable');
					resizeElement.removeClass('resizable');
				  });
				}
			
			
			
			
		</script>


</body>
</html>