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
$custom_args = array();

/**
* Store Locator
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

function store_locator(array $args) {
  ob_start(); ?>

    Store Locator

  <?php return ob_get_clean();
}
