<?php get_header(); ?>

<div id="content-container">
    
    <div id="content">
        <h1 class="page-title">
            <? printf( "Category Archives: %s", '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
		</h1>
        
        <?php
        	$category_description = category_description();
        	if ( ! empty( $category_description ) )
        		echo '<div class="category-description">' . $category_description . '</div>';
        ?>
        
        <? get_template_part( 'loop', 'home' ); ?>
    </div> <!-- #content -->
    
</div> <!-- #content-container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>