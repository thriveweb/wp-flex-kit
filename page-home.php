<?php

/*
Template Name: Home page
*/

get_header(); ?>
<?php //get_template_part('inc-edit'); ?>

<?php if ($banner = get_field('banner')) :
	$banner = $banner[0];
	?>
	<section class="section" style="background-image: url('<?= $banner['image']['sizes']['1800w'] ?>'); height: 50vh;">
		<div class="container skinny">
			<div>
				<?php

				new component('button', array( 'acf_content' => $banner['button2']));

				new component('button', array(
					'acf_content' => $banner['button3'],
					'classes' => 'bordered secondary',
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
		</div>
	</section>
<?php endif; ?>

<?php get_footer(); ?>
