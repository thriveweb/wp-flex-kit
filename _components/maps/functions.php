<?php

$mapsKey = 'AIzaSyDvjdIzMiWHl4yZawMbfkCGuZLYuSm5SjM';

add_action( 'wp_enqueue_scripts', 'maps_script' );
function maps_script() {
  global $mapsKey;
  wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $mapsKey, null, null, true );
}

add_action('acf/init', 'update_maps_api_key');
function update_maps_api_key() {
  global $mapsKey;
  acf_update_setting('google_api_key', $mapsKey);
}
