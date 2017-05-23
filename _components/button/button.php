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
      $target = '';
      if (is_array($button['target']) && isset($button['target'][0]) && $button['target'][0] === '_blank') $target = 'target="_blank"';
      ob_start(); ?>
      <a <?= $args['id'] ?> class="button <?= $args['classes'] ?>" href="<?= $button['url'] ?>" <?= $target ?>>
        <?= $button['label'] ?>
      </a>
      <?php
    }
  }
  return ($html = ob_get_clean()) ? $html : '';
}
