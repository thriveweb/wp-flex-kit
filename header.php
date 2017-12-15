<!doctype html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />

	<meta name="google-site-verification" content="_dvJbwcrL6miDaxPd3oYM1hH7Vw38oStzKxFatxx2sQ" />
	<meta name="msvalidate.01" content="B0112812CA622A13C327AF572E2BA5B5" />

	<?php
	Component::create_assets();
	wp_head();
	?>

</head>

<body <?php body_class() ?>>

	<?php new Component('simple_header') ?>

	<div class="content-wrap">

		<?php get_template_part('inc-edit') ?>
