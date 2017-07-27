<?php

/**
* Theme for overview
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/

$custom_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'orderby' => 'menu_order',
  'order' => 'ASC',
  'posts_per_page'=> '-1',
  'post__in' => array(),
  'taxonomy' => false,
  'taxonomy_terms' => false,
  'operator' => 'IN', //  Possible values are 'IN', 'NOT IN', 'AND', 'EXISTS' and 'NOT EXISTS'. Default value is 'IN'.
  'meta_key' => false,
  'meta_value' => false,
  'aos' => '',
);

/**
* Overview
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('overview')) {
  function overview(array $args) {
    $result = new WP_Query(get_query_args($args));
    ob_start();?>
    <div <?= $args['id'] ?> class="flex overview <?= $args['classes'] ?>">
      <?php if($result->have_posts()) {
        while($result->have_posts()) {
          $result->the_post();
          global $post;
          if ($args['post_type'] == "product") {
            new component('overview_item_product', array(
              'aos' => $args['aos'],
            ));
          } else {
            new component('overview_item');
          }
        }
      } ?>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}

/**
* Get_query_args
*
* Creates query arguments array
*
* @param    (array)       all arguments for the component
* @return   (array)       readable array for WP_Query with needed arguments
*/
if (!function_exists('get_query_args')) {
  function get_query_args(array $args) {
    $exprected_args = array(
      'post_type',
      'orderby',
      'order',
      'posts_per_page',
      'post__in',
      'taxonomy',
      'taxonomy_terms',
      'operator',
      'meta_key',
      'meta_value',
    );
    $query_args = array();
    foreach ($args as $arg => $val) {
      if (in_array($arg, $exprected_args)) {
        if ($val && (!empty($val) || count($val) > 0)) {
          if ($arg === 'taxonomy' || $arg === 'taxonomy_terms' || $arg === 'operator') {
            continue;
          }
          $query_args[$arg] = $val;
          unset($args[$arg]);
        }
      }
    }
    if (!$args['taxonomy'] && $args['taxonomy_terms']) exit('Please, supply a taxonomy');
    if (!$args['taxonomy_terms'] && $args['taxonomy']) exit('Please, supply taxonomy terms');
    if (!$args['operator']) { $operator = "IN"; } else { $operator = $args['operator']; }
    if ($args['taxonomy'] && $args['taxonomy_terms']) {

      $query_args['tax_query'] = array(
        array(
          'taxonomy' => $args['taxonomy'],
          'field' => 'slug',
          'terms' => $args['taxonomy_terms'],
          'operator' => $operator,
        )
      );

    }
    return $query_args;
  }
}
