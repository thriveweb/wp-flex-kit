<?php
/**
* Theme for Split Slider
*
* @package Component
*/

/**
* Flex Split Slider
*
* Gets HTML for this specific component
*
* @param    (array)       All arguments for the component
* @return   (string)      HTML of this compnent
*/

if (!function_exists('split_slider')) {
  function split_slider() {
    ob_start(); ?>
    <div class="flex">
      <div class="one-half first">
        <?php if(get_field('testimonials_title')): while(has_sub_field('testimonials_title')): ?>
          <?php if(get_sub_field('bold')): ?>
              <h2><?php the_sub_field('bold'); ?></h2>
          <?php endif; ?>

            <?php if(get_sub_field('light')): ?>
                <h3><?php
                $light = get_sub_field('light');
                $light = explode(" ", $light);
                $count = count($light);
                $i = 1;
                foreach($light as $word) {
                  if($i++ === $count) {
                    echo $word;
                  } else {
                    echo '<em>' . $word . ' </em>';
                  }
                }
                ?></h3>
            <?php endif; ?>
        <?php endwhile; endif; ?>
        <div class="flickity story-excerpt">
          <?php
          $args = array(
            'post_type' => 'story',
            'posts_per_page' => 10
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
          ?>
            <div class="slide">
              <div class="excerpt">
                <?php if(get_field('excerpt')): ?>
                  <p><em><?php the_field('excerpt'); ?></em></p>
                <?php endif; ?>
                <p><?php the_title(); ?></p>
              </div>
            </div>
          <?php
          endwhile;
          ?>
        </div>
      </div>
      <div class="one-half last">
        <div class="flickity story-images">
          <?php
          $args = array(
            'post_type' => 'story',
            'posts_per_page' => 10
          );
          $loop = new WP_Query( $args );
          while ( $loop->have_posts() ) : $loop->the_post();
          ?>
            <div class="slide">
              <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '600x800' ); ?>

              <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
            </div>
          <?php
          endwhile;
          ?>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}
