<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, maximum-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="header">
		<div class="header_wrap container flex">
			<a class="logo" href="<?php echo esc_url( home_url() ); ?>">
				<img src="<?= get_asset_url('images/logo.svg') ?>" alt="<?php bloginfo('name'); ?> "/>
			</a>
			<nav class="header_nav">
				<?php wp_nav_menu(array('theme_location' => 'main', 'container' => false )); ?>
			</nav>
		</div>
	</header>


	<?php
	$cp_name = 'test';
	$args = array(
		'id' => 'my-id',
		'classes' => 'class1 class2',
		'data' => array(
			'atribute-one' => 'true',
			'second-attribute' => 'show-next'
		)
	);
	// new Component('test', $args);
	// new Component($cp_name);


	// duplicate css / js
	// supply acf selector
	?>
