<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php new Component('simple_header'); ?>

	<div class="content-wrap">

		<?php get_template_part('inc-edit'); ?>
