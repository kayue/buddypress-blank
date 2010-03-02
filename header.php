<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php wp_title(); ?></title>
		<meta name="keywords" content="">
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
		<meta name="author" content="">
		<meta name="language" content="">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css"> 
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>">
		<link rel="shortcut icon" href="<?php bloginfo(url); ?>/favicon.ico" type="image/x-icon">
		<link rel="apple-touch-icon" href="<?php bloginfo(url); ?>/apple-touch-icon.png" type="image/png">
		<?php wp_head(); ?>
	</head>

	<!--[if IE 6]><body id="ie6"><![endif]-->
	<!--[if IE 7]><body id="ie7"><![endif]-->
	<!--[if IE 8]><body id="ie8"><![endif]-->
	<!--[if !IE]><!--><body><!-- <![endif]-->


		<div id="seitenanfang"></div>


		<div id="header">
			<h1><a href="<?php bloginfo(url); ?>/"><?php bloginfo('name') ?></a></h1>
			<p>
				<?php bloginfo('description') ?>
			</p>
			<h2>Seite durchsuchen</h2>
			<?php include(TEMPLATEPATH.'/searchform.php'); ?>
		</div>
