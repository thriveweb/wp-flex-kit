<?php

/**
* Theme for Titles
*
* @package Component
*/

/**
* Titles
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('title')) {
  function title(array $args) {
    if (($title = $args['acf_content']) && is_array($title)) {
      ob_start(); ?>
      <div class="title tacenter relative wrap <?= $args['classes'] ?>">
        <?php $i = 1;
        foreach ($title as $item): ?>
          <h2><?= $item['bold']; ?></h2>
          <h3><?= $item['light']; ?></h3>
        <?php $i++;
      endforeach; ?>
      </div>
    <?php
    }
  return ob_get_clean();
  }
}
