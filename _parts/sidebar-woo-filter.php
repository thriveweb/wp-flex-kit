<div class="sidebar-woo-filter">

  <!-- <div class="categories">
    <h2>Categories</h2>
    <?php wp_nav_menu(array('theme_location' => 'sidebar', 'container' => false )); ?>
  </div> -->
  <div class="main-filters">
    <h2>Filter by</h2>
    <?php new component('woo_filter', array(
      'classes' => 'price',
      'tax' => 'price',
    )) ?>
    <?php new component('woo_filter', array(
      'classes' => 'colour',
      'tax' => 'colour',
    )) ?>
    <?php new component('woo_filter', array(
      'classes' => 'style',
      'tax' => 'style',
    )) ?>
    <?php new component('woo_filter', array(
      'classes' => 'silhouette',
      'tax' => 'silhouette',
    )) ?>
    <?php new component('woo_filter', array(
      'classes' => 'sleeve',
      'tax' => 'sleeve',
    )) ?>
    <?php new component('woo_filter', array(
      'classes' => 'designed_by',
      'tax' => 'designed_by',
    )) ?>
  </div>
  <div class="accessorise">
    <h2>Filter by</h2>
    <?php new component('woo_filter', array(
      'classes' => 'accessory',
      'tax' => 'accessorise',
    )) ?>
  </div>
</div>
