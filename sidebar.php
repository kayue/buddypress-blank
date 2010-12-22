<div id="sidebar-container">
    
    <?php do_action( 'bp_before_sidebar' ) ?>
    
    <div id="sidebar">
        
        <? do_action( 'bp_inside_before_sidebar' ); ?>
    	
    	<? if(bp_is_blog_page()):
        	    dynamic_sidebar( 'primary-sidebar' );
        	else:
        	    dynamic_sidebar( 'community-sidebar' );
        	endif;
        ?>
        
        <? do_action( 'bp_inside_after_sidebar' ); ?>
        
    </div>
    
    <?php do_action( 'bp_after_sidebar' ) ?>
    
</div>