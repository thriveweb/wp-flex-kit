<?php

/**
* Theme for partner_logos
*
* @package Component
*/

/**
* partner_logos
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('accordion')) {
  function partner_logos(array $args) {
    if (($accordion = $args['acf_content']) && is_array($accordion)) {
      ob_start(); ?>
      <div class="partners <?= $args['classes'] ?>">
        <div class="partner_logos flickity">
        <?php
        foreach ($accordion as $item) :
          ?>
          <?php $image = $item['logo'];?>
          <?php if ($item['url']): ?>
            <a target="_blank" href="<?php echo $item['url']; ?>" class="slide" style="background: url(<?php echo $image['sizes']['medium'] ?>) center center no-repeat;"></a>
          <?php else: ?>
            <div class="slide" style="background: url(<?php echo $image['sizes']['medium'] ?>) center center no-repeat;"></div>
          <?php endif; ?>
          <?php
        endforeach; ?>
        </div>
      </div>
      <?php
    }
    return ob_get_clean();
  }
}
