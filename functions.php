<?php
// stop the theme from killing WordPress if BuddyPress is not enabled.
if ( !class_exists( 'BP_Core_User' ) ) return false;

// disable custom header
define( 'BP_DTHEME_DISABLE_CUSTOM_HEADER', true );


// Remove junks from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/**
 * Register the widget columns 
 */
register_sidebar( array(
	'name' => 'Primary Sidebar',
	'id' => 'primary-sidebar',
	'description' => 'Appear on every blog page.',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widget-title">',
	'after_title' => '</h4>'
));

register_sidebar( array(
	'name' => 'Community Sidebar',
	'id' => 'community-sidebar',
	'description' => 'Appear on every buddy press page.',
	'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="widget-title">',
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

// include all theme widget
foreach (glob(TEMPLATEPATH.'/widgets/*.php') as $file) {
    include_once $file;
}