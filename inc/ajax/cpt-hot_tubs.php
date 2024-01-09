<?php
global $post;
				
$permalink = get_permalink();
$my_tub    = get_field( 'design_my_tub' );
$freeflow  = get_field( 'design_freeflow' );
$first_tub = $my_tub[0]['shell'];
$image_2   = $first_tub[0]['media_image'];
$image_3   = $freeflow[0]['cabinet_image'];

echo '<a class="hot-tub-product__item" href="' . $permalink . '">';
echo '<div class="hot-tub-product__item__image">' . get_the_post_thumbnail() . '</div>';
?>
<?php 
$product_categories = get_the_terms( get_the_id(), 'hot_tubs_cat' );
$secondLastElement = array_slice($product_categories, -2, 1)[0];
if ( end($product_categories)->slug == 'hot-spring-spas' || $secondLastElement->slug == 'hot-spring-spas' ) : ?>
    <div class="hot-tub-product__item__image_2"><img src="<?php echo esc_attr( $image_2['url'] ); ?>" alt="Hot Tub"></div>
<?php else : ?>
    <div class="hot-tub-product__item__image_2"><img src="<?php echo esc_attr( $image_3['url'] ); ?>" alt="Hot Tub"></div>
<?php endif; ?>
<?php

// var_dump($product_categories);
echo '<div class="hot-tub-product__item__categories">';
// foreach ( $product_categories as $category ) {
    echo '<h5 class="hot-tub-product__item__category">' . end($product_categories)->name . '</h5>';
// }
echo '</div>';
echo '<h3 class="hot-tub-product__item__name">' . get_the_title() . '</h3>';
?>
<p class="hot-tub-product__item__seats">Seats <?php echo esc_html($product_categories[1]->name . ' | ' . $product_categories[0]->name); ?></p>
<?php
echo '</a>';
