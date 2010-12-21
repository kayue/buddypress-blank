<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <?php
            if(is_single() OR is_page()){
                the_post();
                $description = trim(strip_tags(str_replace(array("\n", '[...]'), ' ', get_the_excerpt())));
                rewind_posts();
            }
            else{
                $description = 'Default description';
            }
        ?>
        <meta name="description" content="<?php echo $description; ?>">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>">
        <link rel="shortcut icon" href="<?php bloginfo(url); ?>/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="<?php bloginfo(url); ?>/apple-touch-icon.png" type="image/png">
        <?php wp_head(); ?>
    </head>
    
    <?if(is_single() && $post = $wp_query->post) $cat_class = get_the_category();?>
    <body <?php body_class("single-".$cat_class[0]->slug) ?> id="popbee-bp">
    
    <div id="container">
        <div id="header">
            <h1><a href="<?php bloginfo(url); ?>/"><?php bloginfo('name') ?></a></h1>
            <p><?php bloginfo('description') ?></p>
            <?php include(TEMPLATEPATH.'/searchform.php'); ?>
        </div>