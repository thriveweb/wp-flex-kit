<?php
/**
* Is_password_protected
*
* Allow passwords for password protected pages to be parsed in trhouth the url as a get parameter.
* To set a password just go to a post or page and change the visibility to password protected.
*
* Example:
* https://thriveweb.com.au/post?p_auth=your_password
*
*/

add_action('wp', 'graph_uri_password');

if (!function_exists('graph_uri_password')) {
  function graph_uri_password() {
    session_start();
    global $post; // get global post data
    if (!empty($post->post_password) && $password = $post->post_password) { // check if posts requiers a password
      if (isset($_GET['p_auth']) && $_GET['p_auth'] && $_GET['p_auth'] === $password) { // checks is uri paramiter exists
        global $hasher;
        $hash = wp_hash_password(wp_unslash(esc_attr($password))); // creates our password hash
        $cookie_name = 'wp-postpass_' . COOKIEHASH;
        if (isset($_SESSION['post_p_auth_called']) && $_SESSION['post_p_auth_called']) {
          unset($_SESSION['post_p_auth_called']);
        } else if (!isset($_COOKIE[$cookie_name]) || (isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] !== $hash)) {
          $_SESSION['post_p_auth_called'] = true;
          setcookie('wp-postpass_' . COOKIEHASH, $hash, (time() + 86400), COOKIEPATH); // set cookie so wordpress thinks we filled in the login form.
          header("Refresh:0");
        }
      }
    }
  }
}
