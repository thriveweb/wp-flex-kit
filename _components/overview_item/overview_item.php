<?php

/**
* Theme for overview item product
*
* @package Component
*/

/**
* List of custom argruments
*
* @var	array
*/
$custom_args = array();

/**
* Overview Item product
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('overview_item')) {
  function overview_item(array $args) {
    ob_start();?>
    <a class="one-third <?php echo $args['classes'] ?>" href="<?php the_permalink() ?>">
      <div class="hover">
        <?php $featimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '800x800' ); ?>
        <img src="<?php echo $featimg[0] ?>" alt="<?php the_title(); ?>">
        <div class="overlay">
          <p>read</p>
        </div>
      </div>
      <h3><?php the_title(); ?></h3>
      <p class="cat"><?php
        $id = get_the_id();
        $term_list = wp_get_post_terms($id, 'vendor_category', array("fields" => "all"));
        echo $term_list[0]->name;
      ?></p>
    </a>
    <?php
    return ob_get_clean();
  }
}
