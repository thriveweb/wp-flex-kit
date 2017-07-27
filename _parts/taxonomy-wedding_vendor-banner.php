<?php if (is_post_type_archive('wedding_vendor')): ?>
  <section class="section page-header single-vendor">
    <div class="background-image" style="background-image: url(<?php bloginfo('stylesheet_directory') ?>/images/banner.jpg);"></div>
    <h2 class="title">Wedding vendors</h2>
  </section>
  <section class="section thin">
  	<div class="container skinny">
      <div class="title tacenter relative wrap">
          <h2>Local</h2>
          <h3>wedding vendors</h3>
      </div>
    </div>
  </section>
<?php else: ?>
  <section class="section page-header single-vendor">
  <?php
    $id = get_the_id();
    $term_list = wp_get_post_terms($id, 'vendor_category', array("fields" => "all"));
  ?>
  <?php
    $cat = get_terms( 'vendor_category');
    $id = 'vendor_category_' . $term_list[0]->term_id;
    $featimg = get_field('banner', $id);
  ?>
  <div class="background-image" style="background-image: url(<?= $featimg['sizes']['1800w']; ?>);"></div>
    <h2 class="title"><?php echo $term_list[0]->name; ?></h2>
    <p class="breadcrumbs">
      <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
      <a href="/wedding_vendor/" class="">Back to all</a>
       /
      <a href="<?php echo get_term_link( $term_list[0] ); ?>"><?php echo $term_list[0]->name; ?></a>
    </p>
  </section>
<?php endif; ?>

<?php if (!is_single()): ?>
  <section class="section thin">
    <div class="container skinny cpt-filter flex">
      <h3>Sort by</h3>
      <div class="dropdown">
        <a class="dropdown-link" href="#">Category</a>
        <?php new component('taxonomy_filter', array(
          'classes' => 'vendor_category',
          'tax' => 'vendor_category',
        )) ?>
      </div>
      <div class="dropdown">
        <a class="dropdown-link" href="#">Location</a>
        <?php new component('taxonomy_filter', array(
          'classes' => 'vendor_location',
          'tax' => 'vendor_location',
        )) ?>
      </div>
    </div>
  </section>
<?php endif; ?>
