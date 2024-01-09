<?php

/**
 * Theme functions and definitions
 *
 * @package ThriveThemeChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */


require_once 'inc/extras.php';

require_once 'templates/shortcode/feed-archieve.php';

require_once 'templates/shortcode/single-hot-tubs.php';

require_once 'templates/shortcode/single-swim-spas.php';

require_once 'templates/shortcode/single-customer-gallery.php';

require_once 'templates/shortcode/collection.php';

require_once 'templates/shortcode/blog.php';

require_once 'templates/shortcode/user-account.php';

// require_once 'templates/shortcode/career-sub-page.php';

require_once 'templates/shortcode/service.php';

require_once 'templates/shortcode/perfect-hottub.php';


/** pages */
require_once 'templates/pages/brand.php';

require_once 'templates/pages/about.php';

require_once 'templates/pages/specials.php';

require_once 'templates/pages/locations.php';

require_once 'templates/pages/blog-feed.php';

require_once 'templates/pages/news-waves.php';

require_once 'templates/pages/contact.php';

require_once 'templates/pages/estore.php';

require_once 'templates/pages/resources/financing.php';

/** plugins */

function thrive_theme_child_enqueue_scripts() {

	wp_enqueue_style('olympic-child-style', get_stylesheet_directory_uri() . '/assets/css/style.css', null, '1.0.0');
	wp_enqueue_script( 'jquery-validator', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js', array( 'jquery' ), '1.16.0', true );
	wp_enqueue_script('olympic-child-script', get_stylesheet_directory_uri() . '/assets/js/main.js', null, '1.0.1');

	remove_post_type_support('page', 'editor');
}

function enqueue_react_scripts() {
	wp_enqueue_script('design-hottub', get_stylesheet_directory_uri() . '/extra/build/static/js/main.js', array(), '1.0', true);
	wp_enqueue_style('design-hottub', get_stylesheet_directory_uri() . '/extra/build/static/css/main.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'enqueue_react_scripts');
// add_action( 'woocommerce_single_product_summary', 'single_product_syndified', 15 );
add_action('wp_enqueue_scripts', 'thrive_theme_child_enqueue_scripts', 10);

function olympic_remove_feed($feedname) {
	global $wp_rewrite;

	if (in_array($feedname, $wp_rewrite->feeds)) {
		$wp_rewrite->feeds = array_diff($wp_rewrite->feeds, array($feedname));
	}

	$hook = 'do_feed_' . $feedname;

	// Remove default function hook
	remove_all_actions($hook);
	add_action($hook, $hook);

	return $hook;
}
olympic_remove_feed('feed');

// function single_product_syndified() {

// 	global $post;
// 	$dss_bottom_page_content = get_post_meta( $post->ID, 'dss_bottom_page_content', true );
	
// 	var_dump($dss_bottom_page_content);


//     if ( $dss_bottom_page_content)
//     {
//         if (strpos ($dss_bottom_page_content, 'elementor-template') !== false)
//         {
//             echo do_shortcode($dss_bottom_page_content);
//         }
//         else
//         {
//             echo $dss_bottom_page_content;
//         }
//     }
// }


/* CUSTOM PRODUCT TEMPLATES */
//add_filter( 'template_include', 'product_custom_template', 12 );

// function product_custom_template( $template ) {

// 	global $post;
// 	$product_type = get_field( 'product-type', $post->ID );
// 	// var_dump( $product_type );

// 	if ( is_singular( 'product' ) ) {

// 		$woo_template_path = '';

// 		if ( $product_type == 'Hot Tub' ) {
// 			$woo_template_path = '/woocommerce/single-product-hot-tubs.php';
// 		} elseif ( $product_type == 'Watkins Other Products' ) {
// 			$woo_template_path = '/woocommerce/single-product-watkins-other.php';
// 		} elseif ( $product_type == 'Other CDN Product' ) {
// 			$woo_template_path = '/woocommerce/single-produ ct-cdn-other.php';
// 		} elseif ( $product_type == 'endless-spa' ) {
// 			$woo_template_path = '/woocommerce/single-product-endless.php';
// 		} elseif ( $product_type == 'finnleo-sauna' ) {
// 			$woo_template_path = '/woocommerce/single-product-finnleo-sauna.php';
// 		} elseif ( $product_type == 'finnleo-accessory' ) {
// 			$woo_template_path = '/woocommerce/single-product-finnleo-accessory.php';
// 		} elseif ( $product_type == 'Other' ) {

// 			$syndifize_template = '';

// 			$plugin_name = plugin_basename( 'syndifize/dswaves-plugin.php' );

// 			if ( is_plugin_active( $plugin_name ) ) {
// 				$syndifize_template = WP_PLUGIN_DIR . '/syndifize/templates/woocommerce/single-product.php';
// 			}

// 			if ( ! file_exists( $syndifize_template ) ) {
// 				$woo_template_path = '/woocommerce/single-product-other.php';
// 			} else {
// 				$template = $syndifize_template;
// 			}
// 		}
// 		if ( $woo_template_path ) {
// 			$template = get_stylesheet_directory() . $woo_template_path;
// 			// check if file exists if not then use the master theme one.
// 			if ( ! file_exists( $template ) ) {
// 				$template = get_template_directory() . $woo_template_path;
// 			}
// 		}
// 	}
// 	// echo $template; exit();

// 	return $template;
// }

// function get_product_categories( $product_id ) {
// 	$terms = get_the_terms( $product_id, 'product_cat' );
// 	return $terms;
// }

// function get_product_brand( $product ) {
// 	$product_brand = '';
// 	$brands        = array( 'Hot Spring®', 'Caldera® Spas', 'Fantasy® Spas', 'Freeflow® Spas', 'ht-clearance' );
// 	$brandsSlug    = array( 'hot-spring', 'Caldera® Spas', 'fantasy-spas', 'freeflow-spas', 'ht-clearance' );
// 	$current_url   = get_permalink();
// 	$product_id    = $product->get_id();
// 	$categories    = get_product_categories( $product_id );
// 	var_dump( $categories[0]->name );

// 	foreach ( $brands as $key => $brand ) {
// 		if ( stripos( $categories[0]->name, $brand ) !== false ) {
// 			$product_brand = $brandsSlug[ $key ];
// 		}
// 	}
// 	return $product_brand;
// }
// // custom hot tub function

// function get_hottub_pricing_links( $product_brand, $title, $product_cap ) {
// 	$pricing_link  = get_site_url() . '/request-hot-tub-pricing/';
// 	$brochure_link = get_site_url() . '/download-a-brochure/';

// 	switch ( $product_brand ) {
// 		case 'hot-spring':
// 			$product_brand = 'Hot Spring';
// 			$hotTubName    = setHotTubName( $product_brand, $title, $product_cap );

// 			$brochure_link = get_site_url() . '/download-a-brochure/hot-spring-spas-brochure/?hottub=' . $hotTubName;
// 			$pricing_link  = get_site_url() . '/request-hot-tub-pricing/request-a-price-quote-hot-spring-spas/?hottub=' . $hotTubName;
// 			break;
// 		case 'caldera-spas':
// 			$product_brand = 'Caldera Spas';
// 			$hotTubName    = setHotTubName( $product_brand, $title, $product_cap );

// 			$brochure_link = get_site_url() . '/download-a-brochure/caldera-spas-brochure/?hottub=' . $hotTubName;
// 			$pricing_link  = get_site_url() . '/request-hot-tub-pricing/request-a-price-quote-caldera-spas/?hottub=' . $hotTubName;
// 			break;
// 		case 'freeflow-spas':
// 			$product_brand = 'Freeflow Spas';
// 			$hotTubName    = setHotTubName( $product_brand, $title, $product_cap );

// 			$brochure_link  = get_site_url() . '/download-a-brochure/freeflow-spas-brochure/?hottub=' . $hotTubName;
// 			$pricing_link   = get_site_url() . '/request-hot-tub-pricing/request-a-price-quote-freeflow-spas/?hottub=' . $hotTubName;
// 			$deliveryCtaUrl = '/free-setup-delivery-freeflow/';

// 			break;
// 		case 'fantasy-spas':
// 			$product_brand = 'Fantasy Spas';
// 			$hotTubName    = setHotTubName( $product_brand, $title, $product_cap );

// 			$brochure_link = get_site_url() . '/download-a-brochure/fantasy-spas-brochure/?hottub=' . $hotTubName;
// 			$pricing_link  = get_site_url() . '/request-hot-tub-pricing/request-a-price-quote-fantasy-spas/?hottub=' . $hotTubName;
// 			break;
// 		default:
// 			$pricing_link = get_site_url() . '/request-hot-tub-pricing/.';
// 	}

// 	return array(
// 		'pricing_link'  => $pricing_link,
// 		'brochure_link' => $brochure_link,
// 	);
// }
// function setHotTubName( $product_brand, $title, $product_cap ) {
// 	// $newTitle = str_replace(' ®','',$title);
// 	$newTitle   = str_replace( array( ' ®', ' ™' ), '', $title );
// 	$hotTubName = $product_brand . ' - ' . $newTitle . ' - ' . $product_cap . ' Person';
// 	return $hotTubName;
// }
// function get_all_fields_by_prefix( $prefix ) {
// 	$result = array();

// 	// check if ACF plugin is activated
// 	if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
// 		$fields = get_fields(); // Retrieve all fields

// 		foreach ( $fields as $field_name => $field_value ) {
// 			if ( strpos( $field_name, $prefix ) === 0 ) {
// 				// Field name has the prefix
// 				$result[] = array(
// 					'field_name'  => $field_name,
// 					'field_value' => $field_value,
// 				);
// 			}
// 		}
// 	}
// 	return $result;
// }
