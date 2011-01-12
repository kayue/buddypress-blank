<?php if ( have_posts() ) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php do_action( 'bp_before_blog_post' ) ?>
        
		<div class="post" id="post-<?php the_ID(); ?>">
		
		    <p class="date"><?php the_time('l, j F Y'); ?> by <?=bp_core_get_userlink( $post->post_author )?></p>
		    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<h2 class="title"><?php the_title(); ?></h2>
			</a>

			<div class="entry">
				<?php the_content('Continue reading...'); ?>
			</div>
			
			<div class="metadata">
			    <p class="categories"><?php the_category(', ') ?></p>
			    <p class="tags"><?php the_tags('', ', ', ''); ?></p>
			    <p class="comments"><?php comments_popup_link( 'No Comments &#187;', '1 Comment &#187;', '% Comments &#187;' ); ?></p>
			</div>

		</div> <!-- / .post -->
        
		<?php do_action( 'bp_after_blog_post' ) ?>
        
	<?php endwhile; ?>
    
    <? the_theme_pagination(); ?>
    
<?php else : ?>
    <div class="not-found">
    	<h2>Not Found</h2>
    	<p>Sorry, but you are looking for something that isn't here.</p>
    </div>
<?php endif; ?>