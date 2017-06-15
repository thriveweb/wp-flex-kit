<?php

/**
* Theme Social links
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
  'show_labels' => false,
  'icons' => array(
    'twitter' => 'fa-twitter',
    'facebook' => 'fa-facebook-official',
    'instagram' => 'fa-instagram',
    'linkedin' => 'fa-linkedin',
    'youtube' => 'fa-youtube',
    'email' => 'fa-envelope',
    'pinterest' => 'fa-pinterest-p',
    'google' => 'fa-google-plus'
  )
);

/**
* Social links
*
* Gets HTML for this specific component
*
* @param    (none)
* @return   (none)      HTML of this compnent
*/
if (!function_exists('social_links')) {
  function social_links(array $args) {
    if (($social_links = $args['acf_content']) && count($social_links) > 0) :
      ob_start(); ?>
      <ul <?= $args['id'] ?> class="social_links <?= $args['classes'] ?>">
        <?php foreach ($social_links as $link) : ?>
          <li>
            <a target="_blank" href="<?= $link['url'] ?>">
              <i class="fa <?= $args['icons'][$link['name']['value']] ?>" aria-hidden="true"></i>
              <?= $args['show_labels'] ? $link['name']['label'] : '' ?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
      <?php
    endif;
    return ob_get_clean();
  }
}
