<?php

/**
* Theme for Banner slider
*
* @package Component
*/

/**
* Banner
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('banner')) {
  function banner(array $args) {
    if (($banner = $args['acf_content']) && is_array($banner)) {
      ob_start(); ?>
      <div <?= $args['id'] ?> class="banner wrap <?= $args['classes'] ?>">
        <?php $i = 1;
        foreach ($banner as $item): ?>
        <div class="slide">
          <?php $img = $item['image']['sizes']['1800w']; ?>
          <div data-index="<?php echo $i; ?>" class="background-image" style="background-image: url(<?php echo $img; ?>);"></div>
        </div>
        <?php $i++;
      endforeach; ?>
    </div>
    <?php
    }
  return ob_get_clean();
  }
}
