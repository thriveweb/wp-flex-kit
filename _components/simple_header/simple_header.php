<?php

/**
* Theme for simple header
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
* simple_header
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('simple_header')) {
  function simple_header(array $args) {
    ob_start(); ?>
    <header>
      <div class="container flex-center">
        <div id="hamburger">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
        <a class="logo" href="<?= esc_url(home_url()) ?>">
          <img src="<?= get_asset_url('images/logo.svg') ?>" alt="<?= get_bloginfo('name') ?> "/>
        </a>
        <nav>
          <?php wp_nav_menu(array('menu' => 'header', 'container' => false )) ?>
        </nav>
      </div>
    </header>
    <?php return ob_get_clean();
  }
}
