<?php get_header(); ?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>



<div class="postcontainer" id="post-<?php the_ID(); ?>">
	<?php if(!is_single()): ?>
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<?php else: ?>
		<h2><?php the_title(); ?></h2>
	<?php endif; ?>
	
	<div class="postcontent">
		<?php the_content(); ?>
	</div>
	<p>
		<a href="<?php the_permalink() ?>#kommentare" rel="comment">Kommentare</a>
	</p>
</div>



<?php comments_template(); ?>



<?php endwhile; ?>



<?php else: ?>



<div class="postcontainer">
	<h2>Nichts gefunden</h2>
	<p>
		Es konnten keine der Anfrage entsprechenden Beiträge oder Seiten gefunden werden.
	</p>
</div>



<?php endif; ?>



<?php get_sidebar(); ?>



<?php get_footer(); ?>