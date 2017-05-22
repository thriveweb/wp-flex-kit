<?php

function get_base_url($uri = '') {
  return get_site_url() . ($uri[0] === '/' ? $uri : '/' . $uri);
}

function get_asset_url($uri = '') {
  return get_stylesheet_directory_uri() . ($uri[0] === '/' ? $uri : '/' . $uri);
}
