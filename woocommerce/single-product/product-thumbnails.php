<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $product, $woocommerce;
$attachment_ids = $product->get_gallery_attachment_ids();
if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails <?php echo 'columns-' . $columns; ?>">
		<div id="pslide"> 
			<div class="thumbelina-but horiz left">&#706;</div>
			<ul id="thumbelina"  >
				<?php
					foreach ( $attachment_ids as $attachment_id ) {
						$classes = array( '' );
						if ( $loop == 0 || $loop % $columns == 0 )
							$classes[] = '';
						if ( ( $loop + 1 ) % $columns == 0 )
							$classes[] = '';
						$image_link = wp_get_attachment_url( $attachment_id );
						if ( ! $image_link )
							continue;
						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						$image_class = esc_attr( implode( 'cloud-zoom', $classes ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '
							<li>
								<div href="%s" class="%s thumb" title="%s" data-rel="prettyPhoto[product-gallery]">%s</div>
							</li>'
							, $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
						$loop++;
					}
				?>
			</ul>
			<div class="thumbelina-but horiz right">&#707;</div>
		</div>
	</div>
	<?php
}
