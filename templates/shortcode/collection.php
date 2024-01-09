<?php
/**
 * Theme shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return void
  */

function collection_brand_shortcode() {
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
function collection_watermark_shortcode() {
    ob_start();
    $terms = get_the_terms( get_the_ID(), 'collection_cat' );
    if ( $terms ) : ?>
        <div class="collectoin-watermark">
            <img src="/wp-content/themes/olympic/assets/img/salt-system.png" alt="salt system">
        </div>
    <?php endif;
    return ob_get_clean();
}

function collection_springspas_advantage() {
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
function collection_features() {
    ob_start();
    global $post;
    $features = get_field( 'features' );
    if ( $features ) : ?>
    <div class="collection-features">
        <?php foreach ( $features as $feature ) : ?>
        <div class="collection-features__item">
            <div class="collection-features__item__image">
                <img src="<?php echo esc_attr( $feature['image']['url'] ); ?>" alt="Feature Image">
            </div>
            <h5 class="collection-features__item__title"><?php echo esc_html( $feature['title'] ); ?></h5>
            <h5 class="collection-features__item__learn_more text-upper">learn more</h5>
            <div class="collection-features__modal">
                <div class="collection-features__modal__content">
                    <div class="collection-features__modal__image">
                        <img src="<?php echo esc_attr( $feature['image']['url'] ); ?>" alt="Feature Image">
                    </div>
                    <div class="collection-features__modal__info">
                        <h5 class="collection-features__modal__title"><?php echo esc_html( $feature['title'] ); ?></h5>
                        <div class="collection-features__modal__description"><?php echo  $feature['description']; ?></div>
                    </div>
                    <div class="close"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif;
    return ob_get_clean();
}

add_shortcode( 'collection_springspas_advantage', 'collection_springspas_advantage' );

add_shortcode( 'collection_brand_shortcode', 'collection_brand_shortcode' );

add_shortcode( 'collection_watermark_shortcode', 'collection_watermark_shortcode' );

add_shortcode( 'collection_features', 'collection_features' );
