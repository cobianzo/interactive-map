	
	<div id="footer"><footer>
		<div class="container">
			<?php if ( ! dynamic_sidebar( 'Footer' ) ) : ?><!--Wigitized Footer--><?php endif ?>

			<p class="clear"><a href="#main"><?php _e('Top'); ?></a></p>
			<p><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow"><?php _e('Entries (RSS)'); ?></a> | <a href="<?php bloginfo('comments_rss2_url'); ?>" rel="nofollow"><?php _e('Comments (RSS)'); ?></a></p>
			<p>&copy; <?php echo date("Y") ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved.'); ?></p>

		</div><!--.container-->
	</footer></div><!--#footer-->





	<!-- cerramos del header:    ,  #body, body, html, -->
</div><!--#body-->


<?php wp_footer(); /* this is used by many Wordpress features and plugins to work proporly */ ?>

			<script type="text/javascript">
			$(document).ready(function() {
				$('#mapplic').mapplic({
					source: "<?php echo get_maps_dir("url" )."/mapplic.json";  ?>", //  'http://localhost/interactive-map/www/mapplic/yucatan.json?v=10',
					height: 500,
					animate: true,
					mapfill: true,
					sidebar: true,
					minimap: true,
					deeplinking: true,
					fullscreen: true,
					hovertip: true,
					developer: true,
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
		</script>


</body>
</html>