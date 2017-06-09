<?php

/**
* Theme for maps
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
* Map
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('maps')) {
  function maps(array $args) {
    ob_start();
    if ($map = $args['acf_content']) : ?>
      <div <?= $args['id'] ?> class="cp-maps <?= $args['classes'] ?>">
        <div class="marker" data-lat="<?= $map['lat']; ?>" data-lng="<?= $map['lng']; ?>"></div>
      </div>
    <?php endif;
    return ob_get_clean();
  }
}
