<?php

//// Options Page
add_action( 'init', 'social' );
function social(){
  //// ACF Options Page
  if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
      'page_title' => 'Social Media',
      'icon_url' => 'dashicons-thumbs-up',
      'position' => 54
    ));
  }
}
