<?php

/**
* Theme for Inline Banner
*
* @package Component
*/

/**
* Inline Banner
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('inline_banner')) {
  function inline_banner(array $args) {
    if (($inline_banner = $args['acf_content']) && is_array($inline_banner)) {
      ob_start(); ?>
      <div <?= $args['id'] ?> class="inline-banner wrap <?= $args['classes'] ?>">
        <?php $i = 1;
        foreach ($inline_banner as $item): ?>
        <div class="slide text-<?php echo $item['algin_text']; ?>">
          <?php $img = $item['image']['sizes']['1800w']; ?>
          <div data-index="<?php echo $i; ?>" class="background-image" style="background-image: url(<?php echo $img; ?>);"></div>
          <div class="overlay relative">
            <?php if ($item['gold_title']): ?>
              <h3><?php echo $item['gold_title']; ?></h3>
            <?php endif; ?>
            <?php if ($item['main_title']): ?>
              <h2><?php echo $item['main_title']; ?></h2>
            <?php endif; ?>

            <?php new component('button',
                array( 'acf_content' => $item['link'])
              );
            ?>

          </div>
        </div>
        <?php $i++;
      endforeach; ?>
    </div>
    <?php
    }
  return ob_get_clean();
  }
}
