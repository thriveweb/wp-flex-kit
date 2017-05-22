<?php

/**
* Theme for single button
*
* @package Component
*/


/**
* Button
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
function button(array $args) {
  if ($button = $args['acf_content']['button'][0]) {
    if (!empty($button['type'])) {
      $id = (is_string($args['id']) ? 'id="' . $args['id'] . '"' : '');
      $classes = (is_string($args['classes']) ? $args['classes'] : '');
      ob_start(); ?>
      <a <?= $id ?> class="button <?= $classes ?>" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
        <?= $button['label'] ?>
      </a>
      <?php
    }
  }
  return ($html = ob_get_clean()) ? $html : '';
}
