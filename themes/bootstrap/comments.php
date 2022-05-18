<div id="comments" class="comments-area default-max-width">
	<!-- Comments section-->
	<section class="mb-5">
		<div class="card bg-light">
			<div class="card-body">
				<?php
				if (have_comments()) :
				?>
					<ul class="list-unstyled">
						<?php
						wp_list_comments(
							array(
								'avatar_size' => 64,
								'style'       => 'ul',
								'short_ping'  => true,
								'walker'        => new Bootstrap_Comment_Walker(),
							)
						);
						?>
					</ul><!-- .comment-list -->

					<?php if (!comments_open()) : ?>
						<p class="no-comments"><?php esc_html_e('Comments are closed.', 'bootstrap'); ?></p>
					<?php endif; ?>
				<?php endif; ?>

				<?php
				// On affiche le formulaire pour commenter en l'adaptant pour Bootstrap
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
			
				comment_form([
					'class_form' => 'form',
					'comment_field' => '<div class="comment-form-comment form-group"><label for="comment">' . _x( 'Comment', 'bootstrap' ) . '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
					'class_submit' => 'btn btn-secondary',
					'fields' => [
						'author' =>
							'<div class="comment-form-author form-group"><label for="author">' . _x( 'Name', 'bootstrap') .
							( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
							'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" size="30"' . $aria_req . ' /></div>',
			
						'email' =>
							'<div class="comment-form-email form-group"><label for="email">' . _x( 'Email', 'bootstrap') .
							( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
							'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'" size="30"' . $aria_req . ' /></div>',
			
						'url' =>
							'<div class="comment-form-url form-group"><label for="url">' . _x( 'Website', 'bootstrap') . '</label>' .
							'<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
							'" size="30" /></div>'
					]
				]);
				?>
			</div>
		</div>
	</section>

</div><!-- #comments -->