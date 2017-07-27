<?php

/**
* Theme for taxonomy_filter
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array(
  'orderby'                => 'menu_order',
  'order'                  => 'ASC',
  'hide_empty'             => false,
  'hierarchical'           => true,
  'child_of'               => 0,
  'parent'                 => '',
  'childless'              => true,
  'tax'                    => false,
);

/**
* Overview
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

if (!function_exists('taxonomy_filter')) {
  function taxonomy_filter(array $args) {
    ob_start();?>
    <div class="filter taxonomy-filter <?php echo $args['classes']; ?>">
      <ul>
        <?php
        $tax = $args['tax'];
        $taxonomies = array($tax);
        $terms = get_terms($taxonomies, $args);
        foreach($terms as $tag) :
          $new_query = setQuery($tax, $tag->slug);
          $className = '';
          if((isset($_GET[$tax])) && $_GET[$tax] === $tag->slug){
            $className = 'class="active"';
            $new_query = setQuery($tax, '');
          }
        ?>
          <li <?php echo $className; ?>>
            <a style="background: <?php echo $tag->description; ?>" href="<?php echo $new_query; ?>" title="<?php echo $tag->name; ?>"><?php echo $tag->name; ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}
