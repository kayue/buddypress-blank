<?php if ( have_posts() ) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php do_action( 'bp_before_blog_post' ) ?>
        
		<div class="post" id="post-<?php the_ID(); ?>">
		
			<div class="post-content">
			    <p class="date"><?php the_time('l, j F Y'); ?> by <?=bp_core_get_userlink( $post->post_author )?></p>
				<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'buddypress' ) ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

				<div class="entry">
					<?php the_content('Continue reading...'); ?>
				</div>
				
				<div class="facebook-like">
				    <fb:like href="<?php the_permalink() ?>" font="arial"></fb:like>
				</div>
				
				<div class="metadata">
				    <p class="categories"><?php the_category(', ') ?></p>
				    <p class="tags"><?php the_tags('', ', ', ''); ?></p>
				    <p class="comments"><?php comments_popup_link( 'No Comments &#187;', '1 Comment &#187;', '% Comments &#187;' ); ?></p>
				</div>
			</div> <!-- / .post-content -->

		</div> <!-- / .post -->
        
		<?php do_action( 'bp_after_blog_post' ) ?>
        
	<?php endwhile; ?>
    
    <?the_theme_pagination()?>
    
<?php else : ?>

	<h2 class="center"><?php _e( 'Not Found', 'buddypress' ) ?></h2>
	<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'buddypress' ) ?></p>

	<?php locate_template( array( 'searchform.php' ), true ) ?>

<?php endif; ?>