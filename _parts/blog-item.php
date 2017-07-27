<a class="blog-item one-third" href="<?php the_permalink() ?>">
  <div class="hover">
    <?php $featimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '800x800' ); ?>
    <img src="<?php echo $featimg[0] ?>" alt="<?php the_title(); ?>">
    <div class="overlay">
      <p>read</p>
    </div>
  </div>
  <h3><?php the_title(); ?></h3>
  <p><?php the_field('excerpt'); ?></p>
</a>
