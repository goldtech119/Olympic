<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( has_term( 'Syndified™', 'product_tag', $post->ID ) ) {
    // Do something if the product has the 'Syndified™' tag
	$title = get_field( 'title' );
	$short_description = get_field( 'short_description' );
	?>
	<div class="woocommerce-product-details__short-description">
		<?php echo ( $short_description ); ?>
	</div>
	<a href="/product-inquiry/?product-name<?php echo esc_attr( $title ); ?>" class="btn btn-blue">Get Pricing</a>
	<?php
} else {
    // Do something else if the product does not have the 'Syndified™' tag

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>
<?php
echo '<div class="prod btns">';

$show_question = get_field( 'show_question' );
$question_text = get_field( 'question_text' );
$product_title = get_the_title();
$product_meta  = str_ireplace( '<r></r>', '', $product_title );
$home_url      = esc_url( home_url( '/' ) );

$downloadb = get_field( 'show_download_brochure_btn' );
$db_text   = get_field( 'download_brochure_text' );
$db_link   = get_field( 'download_brochure_link' );

$inquiryLinkOverride = get_field( 'inquiry_button_link_override' );

if ( empty( $db_text ) ) {
	$db_text = 'Download Brochure';
}

if ( ! empty( $show_question ) ) {
	if ( empty( $question_text ) ) {
		$question_text = 'Request More Info';
	}
	if ( ! empty( $show_pricing ) ) {
		echo '<div class="orSeparator cf"><span class="orLine"></span><p>or</p><span class="orLine"></span></div>';
	};

	if ( empty( $inquiryLinkOverride ) ) {
		echo '<a class="button ask-question" href="' . $home_url . 'product-inquiry/?product_name_field=' . $product_meta . '">' . $question_text . '</a>';
	} else {
		echo '<a class="button ask-question" href="' . $inquiryLinkOverride . '">' . $question_text . '</a>';
	}

	if ( ! empty( $downloadb ) ) {
		echo '<div class="orSeparator cf"><span class="orLine"></span><p>or</p><span class="orLine"></span></div>';
		echo '<a class="dwlbrochure button" href="' . $db_link . '">' . $db_text . '</a>';
	}
}

echo '</div>';

}
