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

require_once('_cp_helper.php');

class Component extends Component_helper {

  /**
  * Name of the reqiested component
  *
  * @var	string
  */
  protected $cp_name = '';                // Name if component will be stored in here

  /**
  * List of default argruments
  *
  * @var	array
  */
  protected $default_args = array(        // Arguments for a component and also uded to check if supplied arguments ar allowed
    'id' => '',
    'classes' => '',
    'acf_content' => array()
  );

  /**
  * List of all argruments, default aswell as custom argruments
  *
  * @var	array
  */
  private $args = array();                  // All arguments will be stored in here

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
    require($this->get_cp_file_path('php'));
    if (isset($custom_args) && is_array($custom_args)) $this->add_custom_args($custom_args);
    if (!($this->args = $this->set_args($args))) trigger_error("Invalid argument supplied");
    echo $this->get_html();
    return $this->track_cp_load($this->cp_name);
  }

  /**
  * Get_html
  *
  * Gets the HTML for the requested component and sets the css and javascript if needed
  *
  * @return stirng      HTML of the requested component
  */
  public function get_html() {
    $included_func_name = $this->cp_name;
    return $included_func_name($this->args);
  }

  /**
  * Create_assets
  *
  * Builds a single stylesheet and javascript file for all required components
  *
  * @return   (boolean)
  */
  public static function create_assets() {
    self::check_clear_cp_cache();
    $css_path = get_stylesheet_directory() . '/flex-kit.min.css';
    $js_path = get_stylesheet_directory() . '/js/flex-kit.min.js';
    $build_css = ENVIRONMENT === 'development' ? true : !file_exists($css_path);
    $build_js = ENVIRONMENT === 'development' ? true : !file_exists($js_path);
    if (($build_css || $build_js) && $cp_cache = self::get_cp_cache()) {
      $css = $js = "/*! WP Flex Kit | (c) Thrive Web | thriveweb.com.au */";
      foreach ($cp_cache as $cp_name) {
        $cp_path = self::get_cp_dir_path($cp_name) . '/' . $cp_name;
        $js_path = $cp_path . '.min.js';
        $css_path = $cp_path . '.min.css';
        if ($build_css && file_exists($css_path) && !is_dir($css_path)) $css .= file_get_contents($css_path);
        if ($build_js && file_exists($js_path) && !is_dir($js_path)) $js .= file_get_contents($js_path);
      }
      if ($build_css) file_put_contents(get_stylesheet_directory() . '/flex-kit.min.css', $css);
      if ($build_js) file_put_contents(get_stylesheet_directory() . '/js/flex-kit.min.js', $js);
      return true;
    }
    return false;
  }

  /**
  * Load_check
  *
  * Checks if all reqested components are loaded properly
  *
  * @return   (boolean)
  */
  public static function load_check() {
    $new_cache = $cache = self::get_cp_cache();
    $load = self::$loaded_components;
    foreach ($load as $key => $name) {
      if (!in_array($name, $cache)) $new_cache[] = $name;
    }
    if ($new_cache !== $cache) {
      self::new_cp_cache($new_cache);
      self::create_assets();
    }
  }
}
