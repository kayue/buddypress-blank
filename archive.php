<?php get_header(); ?>

<div id="content-container">
    
    <?php do_action( 'bp_before_archive' ) ?>
    
    <div id="content">
        <? if ( have_posts() ) the_post(); ?>
        <h1 class="page-title">
            <? if ( is_day() ) : ?>
            	<?php printf( "Daily Archives: <span>%s</span>", get_the_date() ); ?>
            <? elseif ( is_month() ) : ?>
            	<?php printf( "Monthly Archives: <span>%s</span>", get_the_date('F Y') ); ?>
            <? elseif ( is_year() ) : ?>
            	<?php printf( "Yearly Archives: <span>%s</span>", get_the_date('Y') ); ?>
            <? else : ?>
            	Blog Archives
            <? endif; ?>
		</h1>
        <? rewind_posts(); ?>
        
        <? get_template_part( 'loop', 'home' ); ?>
    </div> <!-- #content -->
    
    <?php do_action( 'bp_after_archive' ) ?>
    
</div> <!-- #content-container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>