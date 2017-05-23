<?php

/**
* Component loader
*
* This class loads a component into the HTML, if required it adds in the styling and required scripts to get the component working proporley.
*
* Include this file into yout functions.php
* Use this class in your theme as following: new component( 'component_name', array( 'acf_content' => array() ));
*
* Extrended version:
* new component( 'component_name', array(
*   'acf_content' => array()              // Content of acf field, get_field('acf_field_name') | get_sub_field('acf_field_name') or $repeater['acf_field_name']
*   'classes'     => ''                   // (OPTIONAL) Aditional class names for the element
*   'id'          => ''                   // (OPTIONAL) Options to supply component with an id
* ) );
*
* @package Component
* @author Vincent Weltje @ Thrive Web
*/

class Component {

  private static $loaded_components = array();

  private $defaults = array(
    'cp_path' => false                  // (DON'T CHANGE THIS) Path to the components directory, will be set automaticly
  );
  private $default_args = array(        // Arguments for a component and also uded to check if supplied arguments ar allowed
    'id' => '',
    'classes' => '',
    'acf_content' => false
  );
  private $args = false;                // All arguments will be stored in here
  private $cp_name = '';                // Name if component will be stored in here

  /**
  * __construct
  *
  * Automaticly initilyzed when defining a new component
  *
  * @param    (string)      name of the requested component
  * @param    (array)       all arguments for the component
  * @return   (string)      HTML for requested component
  */
  public function __construct($cp_name = '', array $args = array()) {
    $cp_name = (string) $cp_name;
    if (empty($cp_name)) trigger_error('Please supply a component name.');
    $this->defaults['cp_path'] = self::get_cp_dir_path($cp_name);
    if (!file_exists($this->defaults['cp_path']) || !is_dir($this->defaults['cp_path'])) trigger_error("No component found with the name you supplied name: '$cp_name'");
    $this->cp_name = $cp_name;
    if (!$this->set_args($args)) trigger_error("Invalid argument supplied");
    echo $this->get_html();
    return $this->track_cp_load();
  }

  /**
  * Set_args
  *
  * Checks if supplied arguments are allowed and stores arguments into a global available variable
  *
  * @param    (array)       All arguments for the component
  * @return   (boolean)     so we Know if the validation was success or not
  */
  private function set_args(array $args) {
    $return_val = true;
    if (is_array($args)) {
      foreach ($args as $name => $value) {
        if (!array_key_exists($name, $this->default_args)) {
          $return_val = false;
          break;
        }
        if ($name === 'id' && (is_string($args['id']) && !empty($args['id']))) $args['id'] = 'id="' . $args['id'] . '"';
      }
    }
    if ($return_val) $this->args = array_merge($this->default_args, $args);
    return $return_val;
  }

  /**
  * Get_html
  *
  * Gets the HTML for the requested component and sets the css and javascript if needed
  *
  * @return stirng      HTML of the requested component
  */
  public function get_html() {
    include_once($this->get_cp_file_path('php'));
    $included_func_name = $this->cp_name;
    $this->set_cp_assets();
    return $included_func_name($this->args);
  }

  /**
  * Set_cp_assets
  *
  * Loads the assets of the requested component
  */
  private function set_cp_assets() {
    if ($path = $this->get_cp_file_path('min.js')) {
      $js = file_get_contents($path);
      if (isset($_SESSION['cp-scripts'])) {
        $_SESSION['cp-scripts'] .= $js;
      } else {
        $_SESSION['cp-scripts'] = $js;
      }
    }
    if ($path = $this->get_cp_file_path('min.css')) {
      $css = file_get_contents($path);
      if (isset($_SESSION['cp-style'])) {
        $_SESSION['cp-style'] .= $css;
      } else {
        $_SESSION['cp-style'] = $css;
      }
    }
  }

  /**
  * Get_cp_file_path
  *
  * Helps to get the component file path
  *
  * @param    (string)      The file extension of the file you want to get
  * @return   (string)      Path to specific component file
  */
  private function get_cp_file_path($type) {
    $path = $this->defaults['cp_path'] . '/' . $this->cp_name . '.' . $type;
    return (file_exists($path) && !is_dir($path)) ? $path : false;
  }

  /**
  * Track_cp_load
  *
  * Keeps track of all unique loaded components and stores it into an array
  */
  private function track_cp_load() {
    if (!in_array($this->cp_name, self::$loaded_components)) {
      self::$loaded_components[] = $this->cp_name;
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
  private static function get_cp_dir_path($cp_name) {
    return (get_stylesheet_directory() . '/_components/' . $cp_name);
  }

  /**
  * Get_all_requested_cp_assets
  *
  * Creates style and scripts for all requested elements
  */
  public static function get_all_requested_cp_assets() {
    $html = '';
    $css = '<style type="text/css">';
    $js = '<script type="text/javascript">';
    foreach (self::$loaded_components as $cp_name) {
      $cp_dir = self::get_cp_dir_path($cp_name);
      $css_path = $cp_dir . '/' . $cp_name . '.min.css';
      $js_path = $cp_dir . '/' . $cp_name . '.min.js';
      if (file_exists($css_path) && !is_dir($css_path)) {
        $css .= file_get_contents($css_path);
      }
      if (file_exists($js_path) && !is_dir($js_path)) {
        $js .= file_get_contents($js_path);
      }
    }
    $css .= '</style>';
    $js .= '</script>';
    $html = $css . $js;
    echo $html;
  }
}
