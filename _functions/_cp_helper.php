<?php

class Component_helper {

  /**
  * List of requested components
  *
  * @var	array
  */
  protected static $loaded_components = array();

  /**
  * Set_args
  *
  * Checks if supplied arguments are allowed and stores arguments into a global available variable
  *
  * @param    (array)       All arguments for the component
  * @return   (boolean)     so we Know if the validation was success or not
  */
  protected function set_args(array $args) {
    $success = true;
    if (is_array($args)) {
      foreach ($args as $name => $value) {
        if (!array_key_exists($name, $this->default_args)) {
          $success = false;
          break;
        }
        if ($name === 'id' && (is_string($args['id']) && !empty($args['id']))) $args['id'] = 'id="' . $args['id'] . '"';
      }
    }
    return ($success ? array_merge($this->default_args, $args) : false);
  }

  /**
  * Track_cp_load
  *
  * Keeps track of all unique loaded components and stores it into an array
  */
  protected function track_cp_load($cp_name) {
    if (!in_array($cp_name, self::$loaded_components)) self::$loaded_components[] = $cp_name;
  }

  /**
  * Get_cp_file_path
  *
  * Helps to get the component file path
  *
  * @param    (string)      The file extension of the file you want to get
  * @return   (string)      Path to specific component file
  */
  protected function get_cp_file_path($type) {
    $path = $this->defaults['cp_path'] . '/' . $this->cp_name . '.' . $type;
    return (file_exists($path) && !is_dir($path)) ? $path : false;
  }

  /**
  * Add_custom_args
  *
  * Add custom arguments to allowed argruments list if any supplied
  *
  * @param    (array)      The file extension of the file you want to get
  */
  protected function add_custom_args($custom_args = array()) {
    foreach ($custom_args as $key => $val) {
      if (is_numeric($key)) $key = $val;
      if (!$val) $val = '';
      $this->default_args[$key] = $val;
    }
  }

  /**
  * Get_cp_dir_path
  *
  * Helps to get the component file path
  *
  * @param    (string)      name of the requested component
  * @return   (string)      Path to specific component file
  */
  protected static function get_cp_dir_path($cp_name) {
    return (get_stylesheet_directory() . '/_components/' . $cp_name);
  }

  /**
  * Get_cp_cache
  *
  * Gets list of components used in website.
  *
  * @return   (array)      List of components
  */
  protected static function get_cp_cache() {
    $path = self::get_cp_dir_path('.CP_Cache');
    if (file_exists($path) && !is_dir($path)) {
      $content = file_get_contents($path);
      if ($content) return json_decode($content);
    }
    return false;
  }

  /**
  * New_cp_cache
  *
  * Generates new cache file
  */
  protected static function new_cp_cache($new_cache = array()) {
    file_put_contents(self::get_cp_dir_path('.CP_Cache'), json_encode($new_cache));
    unlink(get_stylesheet_directory() . '/flex-kit.min.css');
    unlink(get_stylesheet_directory() . '/js/flex-kit.min.js');
    ob_start(); ?>
    <script>window.location = window.location.href;</script>
    <?php echo ob_get_clean();
  }

  /**
  * Check_clear_cp_cache
  *
  * Removes all component cache files if user calls specific url.
  * Get key refreches every page load and securety key expires after 5 minutes.
  */
  protected static function check_clear_cp_cache() {
    if (is_user_logged_in()) {
      global $current_user;
      wp_get_current_user();
      if ($current_user->ID === 1) {
        if (isset($_SESSION['renew_cp_cache_uri_selector']) && isset($_GET[$_SESSION['renew_cp_cache_uri_selector']])) {
          $page_loaded_at = $_GET[$_SESSION['renew_cp_cache_uri_selector']];
          $now = time();
          if (($now - $page_loaded_at) <= 300) { // 300 = 5 minutes
            unlink(self::get_cp_dir_path('.CP_Cache'));
            unlink(get_stylesheet_directory() . '/flex-kit.min.css');
            unlink(get_stylesheet_directory() . '/js/flex-kit.min.js');
            echo 'Success: cleared component cache.';
          } else {
            echo 'Notice: securety key expited, please try again!';
          }
          echo '<br /><a href="' . get_permalink() . '">Return to page</a>'; exit;
        }
      }
    }
  }
}
