<?php if ( post_password_required() ) : ?>
    <div id="commetns">
        <p class="alert password-protected">This post is password protected. Enter the password to view any comments.</p>
    </div>
    <? return; ?>
<?endif;?>

<? if ( have_comments() ) : ?>
    
    <div id="comments">
        
        <h2>Comments</h2>
        <p><strong><?php comments_number('No comments','1 Comment','% Comments'); ?></strong> on "<?php the_title(); ?>"</p>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
    	<?php do_action( 'bp_before_blog_comment_list' ) ?>
        
        <? foreach ($comments as $comment) : ?>
            <div class="comment" id="comment-<?php comment_ID(); ?>">
                
                <div class="avatar">
                	<?php if ( $comment->user_id ) : ?>
                	    <a href="<?php echo get_comment_author_url() ?>" rel="nofollow">
                		<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => 50, 'height' => 50, 'email' => $comment->comment_author_email ) ); ?>
                		</a>
                	<?php else : ?>
                		<?php echo get_avatar( $comment, 50 ) ?>
                	<?php endif; ?>
                </div>
                
            	<p class="info">
                	<strong class="author">
                	    <?php if ( $comment->user_id ) : ?>
                    	    <a href="<?php echo get_comment_author_url() ?>" rel="nofollow"><?php echo get_comment_author(); ?></a>
                	    <? else: ?>
                	        <?php echo get_comment_author(); ?>
                	    <?endif;?>
                	    
                	</strong>
                    <em class="date"><?php comment_date('j F Y'); ?></em>
                </p>
                
                <div class="text">
      				<?php if ( $comment->comment_approved == '0' ) : ?>
      				 	<p class="moderate">Your comment is awaiting moderation.</p>
      				<?php endif; ?>
      	
      				<?php comment_text() ?>
      	            
      	            <div class="comment-options">
      	            	<?php echo comment_reply_link( array('depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ?>
      	            	<?php edit_comment_link( 'Edit','','' ); ?>
      	            </div>
                </div>
            
            </div> <!-- / .comment -->
        <? endforeach; ?>
        
    	<?php do_action( 'bp_after_blog_comment_list' ) ?>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
        	<div class="navigation">
        		<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
        		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
        	</div> <!-- .navigation -->
        <?php endif; // check for comment navigation ?>
        
    </div><!-- #comments -->
    
<?php else : // have_comments() == false ?>
    
    <?php if ( pings_open() && !comments_open() && is_single() ) : ?>
    	<p class="comments-closed pings-open">
    		<?php printf( 'Comments are closed, but <a href="%1$s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', trackback_url( '0' ) ); ?>
    	</p>
    <?php elseif ( !comments_open() && is_single() ) : ?>
    	<p class="comments-closed">
    		Comments are closed.
    	</p>
    <?php endif; ?>

<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<div class="avatar">
		<?php if ( bp_loggedin_user_id() ) : ?>
			<a href="<?php echo bp_loggedin_user_domain() ?>">
				<?php echo get_avatar( bp_loggedin_user_id(), 100 ); ?>
			</a>
		<?php else : ?>
			<?php echo get_avatar( 0, 100 ); ?>
		<?php endif; ?>
	</div>
    
	<div class="comment-content">

		<h3 id="reply" class="comments-header">
			<?php comment_form_title( __( 'Leave a Reply', 'buddypress' ), __( 'Leave a Reply to %s', 'buddypress' ), true ); ?>
		</h3>

		<p id="cancel-comment-reply">
			<?php cancel_comment_reply_link( __( 'Click here to cancel reply.', 'buddypress' ) ); ?>
		</p>

		<?php if ( get_option( 'comment_registration' ) && !$user_ID ) : ?>

			<p class="alert">
				<?php printf( __('You must be <a href="%1$s" title="Log in">logged in</a> to post a comment.', 'buddypress'), wp_login_url( get_permalink() ) ); ?>
			</p>

		<?php else : ?>

			<?php do_action( 'bp_before_blog_comment_form' ) ?>

			<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform" class="standard-form">

				<?php if ( $user_ID ) : ?>

					<p class="log-in-out">
						<?php printf( __('Logged in as <a href="%1$s" title="%2$s">%2$s</a>.', 'buddypress'), bp_loggedin_user_domain(), $user_identity ); ?> <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="<?php _e('Log out of this account', 'buddypress'); ?>"><?php _e('Log out &rarr;', 'buddypress'); ?></a>
					</p>

				<?php else : ?>

					<?php $req = get_option( 'require_name_email' ); ?>

					<p class="form-author">
						<label for="author"><?php _e('Name', 'buddypress'); ?> <?php if ( $req ) : ?><span class="required"><?php _e('*', 'buddypress'); ?></span><?php endif; ?></label>
						<input type="text" class="text-input" name="author" id="author" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />
					</p>

					<p class="form-email">
						<label for="email"><?php _e('Email', 'buddypress'); ?>  <?php if ( $req ) : ?><span class="required"><?php _e('*', 'buddypress'); ?></span><?php endif; ?></label>
						<input type="text" class="text-input" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />
					</p>

					<p class="form-url">
						<label for="url"><?php _e('Website', 'buddypress'); ?></label>
						<input type="text" class="text-input" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="40" tabindex="3" />
					</p>

				<?php endif; ?>

				<p class="form-textarea">
					<label for="comment"><?php _e('Comment', 'buddypress'); ?></label>
					<textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea>
				</p>

				<?php do_action( 'bp_blog_comment_form' ) ?>

				<p class="form-submit">
					<input class="submit-comment button" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit', 'buddypress'); ?>" />
					<?php comment_id_fields(); ?>
				</p>

				<div class="comment-action">
					<?php do_action( 'comment_form', $post->ID ); ?>
				</div>

			</form>

			<?php do_action( 'bp_after_blog_comment_form' ) ?>

		<?php endif; ?>

	</div><!-- .comment-content -->
</div><!-- #respond -->

<?php endif; ?>

<?php if ( $numTrackBacks ) : ?>
	<div id="trackbacks">

		<span class="title"><?php the_title() ?></span>

		<?php if ( 1 == $numTrackBacks ) : ?>
			<h3><?php printf( __( '%d Trackback', 'buddypress' ), $numTrackBacks ) ?></h3>
		<?php else : ?>
			<h3><?php printf( __( '%d Trackbacks', 'buddypress' ), $numTrackBacks ) ?></h3>
		<?php endif; ?>

		<ul id="trackbacklist">
			<?php foreach ( (array)$comments as $comment ) : ?>

				<?php if ( get_comment_type() != 'comment' ) : ?>
					<li><h5><?php comment_author_link() ?></h5><em>on <?php comment_date() ?></em></li>
					<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>