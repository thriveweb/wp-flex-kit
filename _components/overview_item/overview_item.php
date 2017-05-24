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
$custom_args = array();

/**
* Overview Item
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
function overview_item(array $args) {
  $slider_images = get_field('images_slider');
  ob_start();?>
  <a <?= $args['id'] ?> class="overview-block <?= $args['classes'] ?>" href="<?= get_permalink() ?>">
    <img src="<?= $slider_images[0]['image']['sizes']['400w'] ?>" />
    <h4><?= get_the_title() ?></h4>
    <span>See More</span>
  </a>
  <?php
  return ob_get_clean();
}
