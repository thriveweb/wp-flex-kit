<?php

/**
* Loads all required worpdress functions for the sprcified components.
*
* @package Component
*/

 /**
 * List of component names which require custom functions
 *
 * @var	array
 */
 $components = array(
   'social_links'
 );

 /**
 * This loads al required component function files
 */
foreach ($components as $component) {
  require_once(get_stylesheet_directory() . '/_components/' . $component . '/functions.php');
}
