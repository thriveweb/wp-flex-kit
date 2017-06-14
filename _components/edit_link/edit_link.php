<?php

/**
* Theme for edit link
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array();

/**
* Button
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('edit_link')) {
  function edit_link(array $args) {
    if (is_user_logged_in()) {
      global $current_user;
      wp_get_current_user();
      edit_post_link('<i class="fa fa-pencil" aria-hidden="true"></i> <span>Edit Page</span>', '<p ' . $args['id'] . 'class="edit_link ' . $args['classes'] . '">', '</p>');
    }
  }
}
