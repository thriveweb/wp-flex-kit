<?php

function get_base_url($uri = '') {
  return get_site_url() . ($uri[0] === '/' ? $uri : '/' . $uri);
}

function get_asset_url($uri = '') {
  return get_stylesheet_directory_uri() . '/assets' . ($uri[0] === '/' ? $uri : '/' . $uri);
}

function get_asset_dir($file = '') {
  return get_stylesheet_directory() . '/assets' . ($file[0] === '/' ? $file : '/' . $file);
}
