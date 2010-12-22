<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <meta name="description" content="<?php echo get_trimmed_excerpt() ?>">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css">
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>">
        <link rel="shortcut icon" href="<?php bloginfo(url); ?>/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="<?php bloginfo(url); ?>/apple-touch-icon.png" type="image/png">
        <?php wp_head(); ?>
    </head>
    
    <body <?php body_class() ?>>
    
    <div id="container">
        <div id="header">
            <h1><a href="<?php bloginfo(url); ?>/"><?php bloginfo('name') ?></a></h1>
            <p><?php bloginfo('description') ?></p>
            <?php include(TEMPLATEPATH.'/searchform.php'); ?>
        </div>