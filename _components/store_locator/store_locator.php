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
  "api_key" => "AIzaSyDJYspP2AZKaXukHbxyX4qdvqibk15vyuI",
  "options" => array(
    "scrollwheel" => false,
    "draggable" => true,
    "disableDefaultUI" => false,
  ),
  'markers' => $markers,
);

/**
* Store Locator
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('store_locator')) {
  function store_locator(array $args) {
    wp_enqueue_script(
      'googlemaps',
      'https://maps.googleapis.com/maps/api/js?libraries=places&callback=initMap&key=' . $args['api_key'],
      $deps = array(),
      $ver = false,
      $in_footer = true
    );
    // get all from outlet
    $markers = array();
  	query_posts('post_type=outlet&posts_per_page=-1');
  	while ( have_posts() ) : the_post();
  		$title = get_the_title();
  		$map = get_field('map');
  		//var_dump($maps);
  		$lat = $map['lat'];
  		$long = $map['lng'];
  		$address = $map['address'];
  		$phone = get_field('phone');
  		$email = strtolower(get_field('email'));
  		$booking_URL = get_permalink();
  		// build list of all markers
  		$markers[] = array(
  			'center' => array(
  				"lat" => $lat,
  				"lng" => $long,
  			),
  			"title" => $title,
  			"address" => $address,
  			"phone" => $phone,
  			"email" => $email,
  			"booking_URL" => $booking_URL,
  	);
  	endwhile;
    ob_start(); ?>

    <section class="store-locator section">
    	<div class="store-locator--container container">
    		<div class="store-locator--inputs">
    			<label class="store-locator--inputs--location" for="location">
    				<input type="text" name="location" value="" placeholder="Enter a location">
    			</label>
    		</div>
    		<div class="store-locator--map" data-options='<?= json_encode($args['options']); ?>'>
    			<?php foreach($markers as $marker): ?>
    				<div class="store-locator--marker" data-center='<?= json_encode($marker['center']); ?>'>
    					<h4 class="store-locator--marker--title"><?= $marker['title']; ?></h4>
    					<?php foreach(array('address', 'phone', 'email', 'booking_URL') as $meta): ?>
    						<?php if ($marker[$meta]): ?>
    							<div class="store-locator--marker--meta">
                    <?php if ($meta !== 'booking_URL'): ?>
                      <span class="store-locator--marker--meta--heading"><?= $meta; ?></span>
                    <?php endif; ?>
    								<?php $content = $marker[$meta]; ?>
    								<?php $content = $meta === 'email' ? '<a href="mailto:' . $marker[$meta] . '">' . $marker[$meta] . '</a>' : $content; ?>
    								<?php $content = $meta === 'booking_URL' ? '<a class="button bordered" href="' . ($marker[$meta]) . '">Book now</a>' : $content; ?>
    								<span class="store-locator--marker--meta--content"><?= $content; ?></span>
    							</div>
    						<?php endif; ?>
    					<?php endforeach; ?>
    				</div>
    			<?php endforeach; ?>
    		</div>
    		<div class="store-locator--results"></div>
    	</div>
    </section>
    <?php return ob_get_clean();
  }
}
