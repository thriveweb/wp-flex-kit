<?php

/**
* Theme for overview item product
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array();

/**
* Overview Item product
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('masonry_item')) {
  function masonry_item(array $args) {
    ob_start();?>
    <a class="grid-item <?php echo $args['classes']; ?>" href="<?php the_permalink() ?>">
      <div class="hover">
        <?php $featimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '600x800' ); ?>
        <img src="<?php echo $featimg[0] ?>" alt="<?php the_title(); ?>">
        <div class="overlay">
          <div class="date"><?php echo get_the_date('d.m.y'); ?></div>
          <div class="title"><?php the_title(); ?></div>
          <?php if(get_field('dress')): while(has_sub_field('dress')): ?>
            <?php if(get_sub_field('light')): ?>
                <div class="lights"><?php the_sub_field('light'); ?></div>
            <?php endif; ?>
            <?php if(get_sub_field('bold')): ?>
                <div class="bolds"><?php the_sub_field('bold'); ?></div>
            <?php endif; ?>
          <?php endwhile; endif; ?>
          <p>read</p>
        </div>
      </div>
    </a>
    <?php
    return ob_get_clean();
  }
}
