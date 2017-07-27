<?php

session_start();

switch ($_SERVER['HTTP_HOST']) {
  case file_exists(str_replace('public/', '', ABSPATH) . 'vagrantfile') :
  case in_array($_SERVER['REMOTE_ADDR'], array( 'localhost', '127.0.0.1', '::1' )) :
  case preg_match('/.dev/') :
  define('ENVIRONMENT', 'development');
  break; case preg_match('/.thrivex.io/') :
  define('ENVIRONMENT', 'testing');
  break; default:
  define('ENVIRONMENT', 'production');
  break;
}

require_once('_functions/_cp_loader.php');
require_once('_functions/_cp_functions.php');

require_once('_functions/helpers.php');
require_once('_functions/default.php');
require_once('_functions/admin.php');
require_once('_functions/enqueue.php');
require_once('_functions/images.php');
require_once('_functions/acf.php');
require_once('_functions/gravityforms.php');
require_once('_functions/yoast.php');
require_once('_functions/woo.php');

// require_once('_functions/cpt.php');
require_once('_functions/pagination.php');
