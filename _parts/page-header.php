<?php if(is_home()): ?>
    <?php $page_id = 60; ?>
<?php elseif(is_archive()): ?>
<?php
    $term_id = get_queried_object()->term_id;
    $page_id = 'product_cat_'.$term_id;
?>
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
