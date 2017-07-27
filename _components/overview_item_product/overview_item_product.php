<?php

/**
* Theme for overview item
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
  'aos' => ''
);

/**
* Overview Item
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('overview_item_product')) {
  function overview_item_product(array $args) {
    $id = get_the_ID();
    $image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'single-post-thumbnail' );
    ob_start();?>
    <a <?= $args['id'] ?> class="overview-block-product <?= $args['classes'] ?>" href="<?= get_permalink() ?>" data-aos="<?= $args['aos'] ?>">
      <div class="hover">
        <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
        <span>view collection</span>
      </div>
      <h4><?= get_the_title() ?></h4>
      <span class="cat">
        <?php $term_list = wp_get_post_terms($id,'product_cat',array('fields'=>'all')); ?>
        <?php echo $term_list[0]->name; ?>
      </span>
    </a>
    <?php
    return ob_get_clean();
  }
}
