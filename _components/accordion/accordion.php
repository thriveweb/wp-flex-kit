<?php

/**
* Theme for single accordion
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
  'show_item' => 1
);

/**
* accordion
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

function accordion($args) {
  if (($accordion = $args['acf_content']) && is_array($accordion)) {
    ob_start(); ?>
    <div <?= $args['id'] ?> class="accordion wrap <?= $args['classes'] ?>">
      <?php $i = 1;
      foreach ($accordion as $item) :
        $aditional_show_item = (((isset($args['show_item']) && is_numeric($args['show_item'])) && $i === intval($args['show_item'])) ? 'style="display:block;"' : '');
        ?>
        <div class="accordion-item">
          <h4 class="wrap">
            <?= $item['title'] ?>
            <?php include('plus-icon.svg') ?>
          </h4>
          <div class="wrap" <?= $aditional_show_item ?>>
            <?= $item['content'] ?>
          </div>
        </div>
        <?php $i++;
      endforeach; ?>
    </div>
    <?php
  }
  return ob_get_clean();
}
