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
}
