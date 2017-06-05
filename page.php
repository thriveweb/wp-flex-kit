<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<section class="section">
		<div class="container skinny">
			<h1><?php the_title(); ?></h1>
			<?php the_content();?>
		</div>
	</section>

<?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>
