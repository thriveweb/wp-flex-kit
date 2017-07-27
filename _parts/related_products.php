<?php
global $product;
$id = get_the_id();
$related = wc_get_related_products($id);
    if ($related): ?>
    <section class="section thin mid mid-band related-products-grid">
        <div class="container skinny grid-container">
            <?php do_action('thrive_related_products'); ?>
        </div>
    </section>
<?php endif; ?>
