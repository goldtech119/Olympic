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
