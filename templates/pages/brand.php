<?php
/**
 * Page Template Brand shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return
  */

function browse_our_collections() {
	ob_start();
    global $post;
    $collections = get_field ( 'collections' );
    foreach ( $collections as $post ) {
        setup_postdata( $post );
        get_template_part( 'template-parts/loop', 'collection' );
    }
    wp_reset_postdata();
	return ob_get_clean();
}
function brand_springspas_advantage() {
    ob_start();
    get_template_part_args(
        'template-parts/content-modules-text',
        array(
            'v'  => 'brand_description',
            'o'  => 'f',
            't'  => 'div',
            'tc' => 'collection-brand_description'
        )
    );
    return ob_get_clean();
}

add_shortcode( 'browse_our_collections', 'browse_our_collections' );

add_shortcode( 'brand_springspas_advantage', 'brand_springspas_advantage' );
