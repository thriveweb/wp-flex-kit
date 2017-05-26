<?php

/**
* Store Locator
*
* @package Component
*/

/**
* List of custom arguments
*
* @var	array
*/
$custom_args = array(
  "api_key" => "",
  "options" => array(
    "scrollwheel" => false
  )
);

/**
* Store Locator
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

function store_locator(array $args) {

  wp_enqueue_script(
    'googlemaps',
    'https://maps.googleapis.com/maps/api/js?key=' . $args['api_key'],
    $deps = array(),
    $ver = false,
    $in_footer = true
  );
  ob_start(); ?>

  <section class="store-locator section">
    <div class="store-locator--container container">

      <h2 class="store-locator--heading">Store Locator</h2>
      <h4 class="store-locator--subheading">Enter your suburb or postcode to find your closest retail outlet</h4>

      <div class="store-locator--inputs">
        <label class="store-locator--inputs--location" for="location">
          <input type="text" name="location" value="" placeholder="Enter a location">
        </label>
        <label class="store-locator--inputs--range" for="range">
          Within
          <select name="range" placeholder="Enter a location">
            <option value="25" label="25km"></option>
            <option value="50" label="50km"></option>
            <option value="100" label="100km"></option>
            <option value="500" label="500km"></option>
          </select>
        </label>
      </div>

      <div class="store-locator--map" data-options='<?= json_encode($args['options']); ?>'>

      </div>

    </div>
  </section>

  <?php return ob_get_clean();
}
