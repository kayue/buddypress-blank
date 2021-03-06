<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('-', true, 'right'); ?><?php bloginfo('name'); ?></title>
        <meta name="description" content="<?php echo get_trimmed_excerpt() ?>">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>">
        <?php wp_head(); ?>
    </head>
    
    <body <?php body_class() ?>>
    
    <div id="wrapper" class="clearfix">
        
        <?php do_action( 'bp_before_header' ) ?>
        
        <div id="header">
            <h1><a href="<?php bloginfo(url); ?>/"><?php bloginfo('name') ?></a></h1>
            <p><?php bloginfo('description') ?></p>
            <?php include(TEMPLATEPATH.'/searchform.php'); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
        </div>
        
        <?php do_action( 'bp_after_header' ) ?>
        
        <?php do_action( 'bp_before_container' ) ?>
        
        