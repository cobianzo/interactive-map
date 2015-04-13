		<div class="row-fluid clearfix">
			<h3 class='col-xs-7'><?php 	comments_number('No comments', 'One comment', '% comments'); ?></h3>
			<a class="col-xs-4 btn btn-primary btn-xs margin-top" href="javascript:   $('#modal-comments').modal({show: 'false'}); ">
				<?php _e("Añadir comentario"); ?>
			</a>
		</div>

			
			<?php
			$comments	=	get_comments(array("post_id" => get_the_ID())); ?>
			<ul id='comments-list' class='row-fluid'> <?php 
			if (!count ($comments )) echo "<li><blockquote>".__("Nadie ha comentado este mapa aún. Sé el primero en hacerlo")."</blockquote></li>";
			foreach($comments as $comment) : ?>
	    	<?php $comment_type = get_comment_type(); ?> <!-- checks for comment type -->
	    	<?php if($comment_type == 'comment') { ?> <!-- outputs only comments -->
		        <li id="comment-<?php comment_ID(); ?>" class="row-fluid clearfix comment <?php if($i&1) { echo 'odd';} else {echo 'even';} ?> <?php $user_info = get_userdata(1); if ($user_info->ID == $comment->user_id) echo 'authorComment'; ?> <?php if ($comment->user_id > 0) echo 'user-comment'; ?>">
					<i class="glyphicon glyphicon-comment col-xs-1"></i>
					<div class=col-xs-11>
		            <?php if ($comment->comment_approved == '0') : ?> <!-- if comment is awaiting approval -->
		                <p class="waiting-for-approval">
		                	<em><?php _e('Your comment is awaiting approval.'); ?></em>
		                </p>
		            <?php endif; ?>
						<div class="comment-text">
							<?php comment_text(); ?>
						</div><!--.commentText-->
						<div class="comment-meta small"><i>
							<?php edit_comment_link('Edit Comment', '', ''); ?>
							<!--<?php comment_type(); ?> by <?php comment_author_link(); ?> on --><?php comment_date(); ?> at <?php comment_time(); ?>
				         </i></div><!--.commentMeta-->
					</div>
		        </li>
			<?php } else { $trackback = true; } ?>
	    <?php endforeach;  ?> 
			</ul> 

		<div class="modal fade" id="modal-comments" tabindex="-1" role="dialog" aria-labelledby="modal-comments" aria-hidden="true">
			<div class="modal-dialog"> 
				<div class="modal-content">
					<div class="modal-header">
						<h1><?php _e("Añade un comentario"); ?></h1>
					</div>
					<div class="modal-body">
						<?php  // TO_DO: editar campos y formato 	
						$commenter = wp_get_current_commenter();
						$req = get_option( 'require_name_email' );
						$aria_req = ( $req ? " aria-required='true'" : '' );
					
						comment_form( array(
								"logged_in_as" => "<br>&nbsp;",
								'title_reply' 			=>	'',
								'author' 				=> '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
									'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
								'email'  				=> '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
									'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
								'class_submit' 	=>  "btn btn-primary",
								'comment_notes_after' => '',
							));
						
						?> 
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal"><?php  _e("Cerrar"); ?></button>								
					</div>
				</div>
			</div>
		</div>
			
			
			
			
			
			
			
			
			
			<?php if ( 0 &&  have_comments() ) : ?>
			<h2 class="comments-title">
			<?php
			echo "POST: $post->ID, $post->post_title";
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'twentyfifteen' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
			</h2>

			<?php echo "LISTA DE COMENTARIOS";  ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 56,
					) );
				?>
			</ol><!-- .comment-list -->


		<?php endif; // have_comments() ?>

			
		<?php 
		
		?>