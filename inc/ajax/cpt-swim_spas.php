<?php
global $post;
				
$permalink = get_permalink();
$my_tub    = get_field( 'design_my_tub' );
$first_tub = $my_tub[0]['shell'];
$image_2   = $first_tub[0]['media_image'];
$people    = get_field( 'people' );
$parts     = explode(' ', $people);

echo '<a class="hot-tub-product__item" href="' . $permalink . '">';
echo '<div class="hot-tub-product__item__image">' . get_the_post_thumbnail() . '</div>';
?>
<div class="hot-tub-product__item__image_2"><?php the_post_thumbnail(); ?><</div>
<?php
$product_categories = get_the_terms( get_the_id(), 'swim_spas_cat' );

// var_dump($product_categories);
echo '<div class="hot-tub-product__item__categories">';
// foreach ( $product_categories as $category ) {
    echo '<h5 class="hot-tub-product__item__category">' . $product_categories[0]->name . '</h5>';
// }
echo '</div>';
echo '<h3 class="hot-tub-product__item__name">' . get_the_title() . '</h3>';
?>
<p class="hot-tub-product__item__seats">Seats <?php echo esc_html($parts[0]); ?> | $$$$</p>
<?php
echo '</a>';
