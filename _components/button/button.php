<?php

/**
* Theme for single button
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
* Button
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('button')) {
  function button(array $args) {
    if ($button = $args['acf_content']['button'][0]) {
      if (!empty($button['type'])) {
        ob_start(); ?>
        <a <?= $args['id'] ?> class="button <?= $args['classes'] ?>" href="<?= $button[$button['type']] ?>" target="<?= $button['new_tab'] ? '_blank' : '_self' ?>">
          <?= $button['label'] ?>
        </a>
        <?php
      }
    }
    return ob_get_clean();
  }
}
