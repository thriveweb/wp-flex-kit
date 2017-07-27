<?php
// Custom filter products
function setQuery($target, $arg){
  $url = $_SERVER['QUERY_STRING'];
  parse_str($url, $vals);
  $vals[$target] = $arg;
  if($arg === ''){
    unset($vals[$target]);
  }
  $new_query = '?' . urldecode(http_build_query($vals));
  return $new_query;
}

// Woo list custom taxonomies
function get_terms_checkbox($taxonomies, $args){
  $myterms = get_terms($taxonomies, $args);
  foreach($myterms as $term){
    $root_url = get_bloginfo('url');
    $term_taxonomy=$term->taxonomy;
    $term_slug=$term->slug;
    $term_name =$term->name;
    $link = $root_url.'/'.$term_taxonomy.'/'.$term_slug;
    $output .="<a class='barba ".$term_slug."' href='".$link."'>".$term_name."</a>";
  }
  return $output;
}

// stay on main cat for shop base
function custom_shop_page_redirect() {
    if( is_shop() ){
		$product_cat_id = 16;
		$link = get_term_link( $product_cat_id, 'product_cat' );
        wp_redirect( $link );
        exit();
    }
}
add_action( 'template_redirect', 'custom_shop_page_redirect' );

// General Woo stuff

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

//remove coupons on checkout page
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

//edit �successfully added to your cart� on the Woocommerce single product page
add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
	global $woocommerce;
	$return_to  = get_permalink(woocommerce_get_page_id('shop'));
	$message    = sprintf('<a href="%s" class="button wc-forwards">%s</a> %s', $return_to, __('Continue Shopping?', 'woocommerce'), __('Your cart was updated.', 'woocommerce') );
return $message;
}

// Remove Tabs
//removes the tabs completely, thus also removing the product description.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


//Add details
function product_details() {
	wc_get_template( 'single-product/details.php' );
}
add_action( 'woocommerce_single_product_summary', 'product_details', 21 );
//Add Booking button
function booking_button() {
	wc_get_template( 'single-product/booking_button.php' );
}

//Add full desc
function woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 22 );

//remove short desc
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Remove Related Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_action( 'thrive_related_products', 'woocommerce_output_related_products', 10 );

//wc_remove_related_products
function wc_remove_related_products( $args ) {
	return array();
}
//add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

//add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

//Remove Hooks
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
//remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

add_theme_support( 'woocommerce' );
// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

   if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
       function woocommerce_output_upsells() {
       woocommerce_upsell_display( 5,1 ); // Display 3 products in 1 row
   }
}

// Change number of upsells in single prodict posts
// Set the first number to how many total and the second number to how many rows.
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_upsells', 15 );

   if ( ! function_exists( 'woocommerce_output_upsells' ) ) {
       function woocommerce_output_upsells() {
       woocommerce_upsell_display( 5,1 ); // Display 3 products in 1 row
   }
}

// Disable WooCommerce's Default Stylesheets
function disable_woocommerce_default_css( $styles ) {

 // Disable the stylesheets below via unset():
 unset( $styles['woocommerce-general'] );  // Styling of buttons, dropdowns, etc.
 unset( $styles['woocommerce-layout'] );        // Layout for columns, positioning.
 // unset( $styles['woocommerce-smallscreen'] );   // Responsive design for mobile devices.

 return $styles;
}
add_action('woocommerce_enqueue_styles', 'disable_woocommerce_default_css');

//wordpress.stackexchange.com/questions/15053/use-https-for-img-src
function fix_ssl_attachment_url( $url ) {

	if ( is_ssl() )
		$url = str_replace( 'http://', 'https://', $url );
	return $url;

}
add_filter( 'wp_get_attachment_url', 'fix_ssl_attachment_url' );

// Change WooCommerce �Ship to a different address?� Default State
//bryceadams.com/change-woocommerce-ship-different-address-default-state/
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

// Remove "SKU" from product details page.
add_filter( 'wc_product_sku_enabled', 'mycode_remove_sku_from_product_page' );
function mycode_remove_sku_from_product_page( $boolean ) {
	if ( is_single() ) {
		$boolean = false;
	}
	return $boolean;
}

?>
