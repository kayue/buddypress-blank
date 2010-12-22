<?php get_header() ?>

<div id="content-container">
    <div id="content">
    
    	<?php do_action( 'bp_before_blog_single_post' ) ?>
    
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	
    	<div class="post" id="post-<?php the_ID(); ?>">
            
    	    <p class="date"><?php the_time('l, j F Y'); ?> by <?=bp_core_get_userlink( $post->post_author )?></p>
    	    
    		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
    		    <h1 class="title"><?php the_title(); ?></h1>
		    </a>
            
    		<div class="entry">
    			<?php the_content('Continue reading...'); ?>
    		</div>
    		
    		<?php wp_link_pages(); ?>
    		
    		<div class="metadata">
    		    <p class="categories"><?php the_category(', ') ?></p>
    		    <p class="tags"><?php the_tags('', ', ', ''); ?></p>
    		</div>
    
    	</div>
        
    	<?php comments_template(); ?>
    
    	<?php endwhile; else: ?>
    
    		<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ) ?></p>
    
    	<?php endif; ?>
    
    	<?php do_action( 'bp_after_blog_single_post' ) ?>
    
    </div> <!-- #content -->
</div> <!-- #content-container -->

<?php get_sidebar() ?>

<?php get_footer() ?>