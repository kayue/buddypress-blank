<?php get_header(); ?>

<div id="content-container">
    
    <?php do_action( 'bp_before_blog_home' ) ?>
    
    <div id="content">
        <? get_template_part( 'loop', 'home' ); ?>
    </div> <!-- #content -->
    
    <?php do_action( 'bp_after_blog_home' ) ?>
    
</div> <!-- #content-container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>