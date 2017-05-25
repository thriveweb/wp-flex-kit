<?php

/*
Template Name: Home page
*/

get_header(); ?>
<?php //get_template_part('inc-edit'); ?>



<section class="section">
	<div class="container">
		<?php new component('overview', array(
			'post_type' => 'coffin',
			'posts_per_page' => '-1',
		)); ?>
	</div>
</section>



<?php if ($banner = get_field('banner')) :
	$banner = $banner[0];
	?>
	<section class="section">
		<div class="container">
			<?php
			new component('button', array( 'acf_content' => $banner['button2']));
			new component('button', array(
				'acf_content' => $banner['button3'],
				'classes' => 'secondary',
				'id' => 'unique_id',
			));
			new component('button', array( 'acf_content' => $banner['button1']));
			new component('button', array(
				'acf_content' => $banner['button4'],
				'classes' => 'bordered secondary',
				'id' => 'unique_id'
			));
			?>
		</div>
	</section>
<?php endif; ?>

<?php if ($acord = get_field('info_acordion')) : ?>
	<section class="section">
		<div class="container">
			<?php new component('accordion', array(
				'acf_content' => $acord,
				'classes' => 'bordered secondary',
				'id' => 'unique_id',
				'show_item' => 1
			)); ?>
		</div>
	</section>
<?php endif; ?>

<section class="section">
	<div class="container">
		<?php new component('instagram_banner', array(
			'username' => '',
			'picture_count' => 10
		)); ?>
	</div>
</section>


<?php get_footer(); ?>
