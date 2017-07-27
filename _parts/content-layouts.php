<section class="section content-layouts-section">
	<div class="container skinny content-layouts">
	<?php if( have_rows('layouts') ): while ( have_rows('layouts') ) : the_row(); ?>
		<?php if( get_row_layout() == 'fullwidth' ): ?>
			<div class="wrap pullout layouts">
				<?php the_sub_field('content'); ?>
			</div>
		<?php elseif( get_row_layout() == 'two_columns' ): ?>
			<div class="wrap flex-row layouts">
				<div class="one-half">
					<?php the_sub_field('left_content'); ?>
				</div>
				<div class="one-half">
					<?php the_sub_field('right_content'); ?>
				</div>
			</div>
		<?php elseif( get_row_layout() == 'three_columns' ): ?>
			<div class="wrap flex-row layouts">
				<div class="one-third">
					<?php the_sub_field('left_content'); ?>
				</div>
				<div class="one-third">
					<?php the_sub_field('center_content'); ?>
				</div>
				<div class="one-third">
					<?php the_sub_field('right_content'); ?>
				</div>
			</div>
		<?php elseif( get_row_layout() == 'blockquote' ): ?>
			<div class="wrap layouts bquote">
				<blockquote>
					<p>
						<?php the_sub_field('quote'); ?>
					</p>
				</blockquote>
			</div>
		<?php elseif( get_row_layout() == 'text_and_image_left' ): ?>
			<div class="text-image-left layouts">
				<div class="wrap flex-row">
					<?php $img = get_sub_field('image'); ?>
					<div data-aos="fade-in" class="one-third left-image" style="background: url(<?php echo $img['sizes']['800cropped']; ?>) center center no-repeat"></div>
					<div class="two-thirds pullout">
						<h3><?php the_field('title') ?></h3>
						<?php the_sub_field('content') ?>
					</div>
				</div>
			</div>
		<?php elseif( get_row_layout() == 'galleries' ): ?>
			<div class="wrap gallery-wrap layouts">
				<?php if (get_sub_field('gallery_title')): ?>
					<h3 class="title">
						<?php the_sub_field('gallery_title'); ?>
					</h3>
				<?php endif; ?>
				<div class="gallery slider flickity">
					<?php $i = 0; if(get_sub_field('gallery')): while(has_sub_field('gallery')): ?>
						<?php $attachment = get_sub_field('images');  ?>
						<img class="slide" src="<?php echo $attachment['sizes']['600x800']; ?>">
				    <?php $i++; endwhile; endif; ?>
				</div>
			</div>
		<?php elseif( get_row_layout() == 'accordion' ): ?>
			<div class="wrap layouts">
			<?php
				$accordion = get_sub_field('accordion');
				new component('accordion', array(
					'acf_content' => $accordion,
					'classes' => 'accordion',
				));
			?>
			</div>
		<?php endif; ?>
	<?php endwhile; endif; ?>
	</div>
</section>
