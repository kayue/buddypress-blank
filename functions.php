<?php
// stop the theme from killing WordPress if BuddyPress is not enabled.
if ( !class_exists( 'BP_Core_User' ) ) return false;

// remove junks from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// register menu
register_nav_menu( 'primary', 'Primary Menu' );

// add featured image support
add_theme_support('post-thumbnails');

/**
 * Register the widget columns 
 */
register_sidebar( array(
	'name' => 'Primary Sidebar',
	'id' => 'primary-sidebar',
	'description' => 'Appear on every blog page.',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="title">',
	'after_title' => '</h4>'
));

register_sidebar( array(
	'name' => 'Community Sidebar',
	'id' => 'community-sidebar',
	'description' => 'Appear on every buddy press page.',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="title">',
	'after_title' => '</h4>'
));

/**
 * Load Javascript files
 */
function _theme_load_scripts() 
{
    // instruction to only load if it is not the admin area
    if ( is_admin() ) return;
    
    $dir = get_bloginfo('template_directory');
    
    // reload jquery library from google api
    wp_deregister_script("jquery");
    wp_register_script("jquery", "http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js", false, '1.4');
    
    // register scripts
    wp_register_script("global", $dir."/scripts/global.js", array('jquery'), true);
    wp_register_script("buddypress", $dir."/scripts/buddypress.js", array('jquery'), true);
    
    // load scripts
    wp_enqueue_script("global");
    
    if ( !bp_is_blog_page() ) {
        wp_enqueue_script("buddypress");
        
        // Add words that we need to use in JS to the end of the page so they can be translated and still used.
        wp_localize_script( "buddypress", "BP_DTheme", array(
        	'my_favs'           => __( 'My Favorites', 'buddypress' ),
        	'accepted'          => __( 'Accepted', 'buddypress' ),
        	'rejected'          => __( 'Rejected', 'buddypress' ),
        	'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
        	'show_all'          => __( 'Show all', 'buddypress' ),
        	'comments'          => __( 'comments', 'buddypress' ),
        	'close'             => __( 'Close', 'buddypress' ),
        	'mention_explain'   => sprintf( __( "%s is a unique identifier for %s that you can type into any message on this site. %s will be sent a notification and a link to your message any time you use it.", 'buddypress' ), '@' . bp_get_displayed_user_username(), bp_get_user_firstname( bp_get_displayed_user_fullname() ), bp_get_user_firstname( bp_get_displayed_user_fullname() ) )
        ));
    }
}
add_action('wp_print_scripts', '_theme_load_scripts');

function _theme_add_body_class($classes, $custom_classes = false)
{	
    the_post();
    
    // insert buddypress class on buddypress page
    if ( !bp_is_blog_page() ) $classes[] = 'buddypress';
    
    // add category
    if ( is_single() ) { 
        foreach (get_the_category() as $category) {
            $classes[] = "single-".$category->slug;
        }
    }
    
    rewind_posts();
    
    return $classes;
}
add_filter( 'body_class', '_theme_add_body_class', 10, 2 );

// trim excerpt by word
function get_trimmed_excerpt($maxChars = 160, $appendingString = '...', $default_excerpt = "Default page description.") {
	if( !is_single() && !is_page() ) 
	    return $default_excerpt;
	
	the_post();
    
	$content = substr(get_the_excerpt(), 0, $maxChars);
	$content = strip_tags($content);
	$pos = strrpos($content, " ");
	
	if ($pos > 0) {
		$content = substr($content, 0, $pos);
	}
	
	$result = $content.$appendingString;
	
	rewind_posts();
	
	return $result;
}


/**
 * Display pagination
 */
function the_theme_pagination( $pages_around = 3 ) { // pages will be show before and after current page
    
    // don't show in single page
    if ( is_single() || is_singular() ) return; 
    
    global $wp_query, $paged;
    
    $total_page = $wp_query->max_num_pages; // Total pages
    if ( $total_page == 1 ) return; // don't show when only one page
    if ( empty( $paged ) ) $paged = 1; // current page
    
    echo "<div class=\"pagination\">";
    
    // html format
    $page_number_html = '<a class="page-number" href="%1$s" title="%2$s">%2$s</a>'; // 1: link, 2: text
    $current_page_number_html = '<strong class="page-number current-page">%s</strong>'; // 1: link, 2: text
    $dots_html = '<span class="dots">…</span>';
    
    $previous_page_html = '<a class="previous-page" href="%s" title="Previous page">&larr; Previous Entries</a> '; // 1:link
    $disabled_previous_page_html = '<span class="previous-page disabled">&larr; Previous Entries</span> '; //&laquo;
    
    $next_page_html = ' <a class="next-page" href="%s" title="Next page">Next Entries &rarr;</a> '; // 1:link
    $disabled_next_page_html = ' <span class="next-page disabled">Next Entries &rarr;</span> '; //&raquo;
    
    // previous page
    if ($paged > 1) {
        printf($previous_page_html, get_pagenum_link($paged-1));
    } else {
        echo $disabled_previous_page_html;
    }
    
    // next page
    if ($paged < $total_page) {
        printf($next_page_html, get_pagenum_link($paged+1));
    } else {
        echo $disabled_next_page_html;
    }
    
    // page number
    echo '<span class="page-number-container">Page: ';
    if ( $paged > $pages_around + 1 ) printf($page_number_html, esc_html(get_pagenum_link(1)), 1);
    if ( $paged > $pages_around + 2 ) echo $dots_html;
     
    $start = $paged - $pages_around;
    $start = $start <= 0 ? 1 : $start;
    
    $end = $paged + $pages_around;
    $end = $end > $total_page ? $total_page : $end;
    
    for( $i = $start; $i <= $end; $i++ ) { // Middle pages
        
        if($i == $paged) {
            // current page
            printf($current_page_number_html, $i);
            continue;
        }
        
        printf($page_number_html, get_pagenum_link($i), $i);
    }
    
    if ( $paged < $total_page - $pages_around ) echo $dots_html;
    // if ( $paged < $total_page - $pages_around ) printf($format, esc_html(get_pagenum_link($total_page)), "Last");
    
    echo "</span>";
    
    echo "</div>";
}

// include all theme widget
foreach (glob(TEMPLATEPATH.'/widgets/*.php') as $file) {
    include_once $file;
}

// Load the AJAX functions for the theme
require_once( TEMPLATEPATH . '/buddypress-ajax.php' );
