<?php get_header(); ?>

<div id="content-container">
    <div id="content">
        
        <?php do_action( 'bp_before_blog_home' ) ?>
        
        <div class="page" id="blog-latest">
            <? get_template_part( 'loop', 'home' ); ?>
        </div>
        
        <?php do_action( 'bp_after_blog_home' ) ?>

    </div> <!-- #content -->
</div> <!-- #content-container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>