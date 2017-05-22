<?php

/*
* Theme for ...
*
* @package Components
*/

wp_enqueue_script( 'hippo', get_asset_url('/_components/test/test.js'), null, null, true );

function test($args) {
  ob_start(); ?>
  <a <?= is_string($args['id']) ? $args['id'] : '' ?> class="button <?= is_string($args['classes']) ? $args['classes'] : '' ?>">
    crocccc;
  </a>
  <?php return ob_get_clean();
}
