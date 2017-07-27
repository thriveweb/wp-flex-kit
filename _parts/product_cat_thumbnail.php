<?php
  $term_id = get_queried_object()->term_id;
  if (empty($term_id)) {
    $term =  get_the_terms( $post->ID, 'product_cat' );
    $term_id = $term[0]->term_id;
    $title = $term[0]->name;
  } else {
    $title = get_queried_object()->name;
  }
  $thumbnail_id = get_woocommerce_term_meta($term_id, 'thumbnail_id', true);
  $image = wp_get_attachment_image_src($thumbnail_id, '1800w');
?>
<div class="cat-banner">
  <div class="bg" style="background: url(<?php echo $image[0]; ?>) center no-repeat;"></div>
  <h1><?php echo $title; ?></h1>
</div>
