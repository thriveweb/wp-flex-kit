<?php

/**
* Theme for simple header
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
* simple_header
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('simple_header')) {
  function simple_header(array $args) {
    ob_start(); ?>
    <header class="header no-barba">
      <div class="container flex-center">

        <a class="logo" href="<?= esc_url(home_url()) ?>">
          <img src="<?= get_asset_url('images/logo.svg'); ?>" alt="<?= get_bloginfo('name'); ?> "/>
        </a>
        <nav class="nav">
          <?php wp_nav_menu(array('menu' => 'main', 'container' => false )); ?>

        </nav>
        <div id="hamburger">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      </div>
    </header>

    <?php // pull from blog page by id
      if (is_home() ? $page_id = 40 : $page_id = ''); ?>
    <?php if (get_field('page_header', $page_id)): ?>
      <section class="section thick page-header">
        <?php $img = get_field('page_header_image', $page_id); ?>
        <div class="background-image" style="background-image: url(<?php echo $img['sizes']['1800w']; ?>);"></div>
        <div class="container">
          <?php if (get_field('page_header_title', $page_id)): ?>
            <h1 class="title"><?php the_field('page_header_title', $page_id); ?></h1>
          <?php endif; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php return ob_get_clean();
  }
}
<?php

/**
* Theme for simple header
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
* simple_header
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/
if (!function_exists('simple_header')) {
  function simple_header(array $args) {
    ob_start(); ?>
    <header class="header no-barba">
      <div class="container flex-center">

        <a class="logo" href="<?= esc_url(home_url()) ?>">
          <img src="<?= get_asset_url('images/logo.svg'); ?>" alt="<?= get_bloginfo('name'); ?> "/>
        </a>
        <nav class="nav">
          <?php wp_nav_menu(array('menu' => 'main', 'container' => false )); ?>

        </nav>
        <div id="hamburger">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      </div>
    </header>

    <?php if(is_home()): ?>
      <?php $page_id = 28; ?>
    <?php endif; ?>
    <?php if (get_field('page_header', $page_id)): ?>
        <section class="section thick page-header">
            <?php $img = get_field('page_header_image', $page_id); ?>
            <div class="background-image" style="background-image: url(<?php echo $img['sizes']['1800w']; ?>);"></div>
            <div class="container">
                <?php if (get_field('page_header_title', $page_id)): ?>
                    <h1 class="title"><?php the_field('page_header_title', $page_id); ?></h1>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>


    <?php return ob_get_clean();
  }
}
