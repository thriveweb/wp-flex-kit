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
$custom_args = array(
  'api_key' => ''
);

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
    wp_enqueue_script(
      'googlemaps',
      'https://maps.googleapis.com/maps/api/js?libraries=places&callback=singleInitMap&key=' . $args['api_key'],
      $deps = array(),
      $ver = false,
      $in_footer = true
    );
    $markerthumb = get_template_directory_uri() . '/images/marker.png';
    ob_start();
    if ($map = $args['acf_content']) : ?>
      <div <?= $args['id'] ?> class="cp-map <?= $args['classes'] ?>">
        <div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>" data-icon="<?php echo $markerthumb; ?>">
					<p><strong><?php the_title(); ?></strong><br>
					<a target="_blank" class="directions" href="https://www.google.com/maps?saddr=My+Location&daddr=<?php echo $map['lat'] . ',' . $map['lng']; ?>"><?php _e('Get Directions','roots'); ?></a></p>
				</div>
      </div>
    <?php endif;
    return ob_get_clean();
  }
}
