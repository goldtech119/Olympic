<?php


//Title
$title = get_the_title();
$product_cap = get_field('product_cap');
$product_id = get_the_id();
$product = wc_get_product($product_id);


// category
$product_brand = get_product_brand($product);

$product_desc_title = get_field("product-desc-title") ?? '';
$pricing_link_text = get_field('pricing_button_text') ?? 'Get Pricing';
$links = get_hottub_pricing_links($product_brand, $title, $product_cap);
$pricing_link = $links['pricing_link'];
$brochure_link = $links['brochure_link'];

// specs
$jet_top_image = get_field('jet-top-image_url') ?? get_field('jet-top-image') ?? '';

// specs data
$specs = get_all_fields_by_prefix('spa_');
$width = get_field('spa_width') ?? '';
$height = get_field('spa_height') ?? '';

// features
$features = get_field('features');
$feature_count = intval($features);
// show
$show_features = get_field('show-features');
$show_jets = get_field('show-jets');
$show_reviews = get_field('show-reviews-sec');
$show_specs = get_field('show-specs');
$show_accessories = get_field('show-accessories');
$feature_count = 0;
?>
<div class="hot-tubs">
    <div class="product-heading">
        <div class="row">
            <!-- title of top section -->
            <div class="large-11 large-offset-1 medium-12">
                <!-- begin product title line -->
                <div class="product-title-line">
                    <?php

                    echo '<h1 class="title hot-tub-title">' . $title . ' ' . $product_cap . ' Person Hot Tub</h1>';
                    //Bizarre Voice Reviews
                    $review_code = get_field('reviews_code_embed', false, false);
                    if (!empty($review_code)) {
                        $tub_name = get_the_title();
                        $tub_name = str_ireplace('<r></r>', '', $tub_name);
                        echo $review_code;
                        echo '<hr class="product-title-line" />';
                    }
                    ?>
                </div>
                <!-- end product title line -->

            </div>
        </div>
    </div>
    <div class="product-description large-6 medium-12 small-12 xsmall-12  xsmall-12 columns">
        <h2>
            <?php echo $product_desc_title; ?>
        </h2>
        <div class="product-desc-content">
            <?php the_content(); ?>
        </div>
        <div class="pricing">
            <?php
            echo "<a href='$pricing_link'><div class='product-price-button'>$pricing_link_text</div></a>";
            ?>
        </div>
    </div>
    <!-- specific section -->
    <div class="product-desc-spec">
        <h2> Specs</h2>
        <div>
            <div class="product-desc-height">
                <p>Height</p>
                <p><?php echo $height; ?></p>
            </div>
            <div class="product-desc-width">
                <p>Width</p>
                <p><?php echo $width; ?></p>
            </div>
        </div>
        <div class="spec-buttons">
            <?php
            echo "<a href='$brochure_link'><div class='product-brochure-button'>GET BROCHURE</div></a>";
            ?>
            <?php
            echo "<a href='$brochure_link'><div class='product-brochure-button'>SEE IN YOUR BACKYARD</div></a>";
            ?>
        </div>
    </div>
    <!-- specific section -->
    <section class="product-desc-features">
        <h2> Features </h2>
        <div class="feature-items feature">
            <?php
            foreach ($features as $feature) {
                $post = get_post($feature);
                setup_postdata($post);

                $feature_name = get_field('feature-name');

                $feature_link_name = str_ireplace(' ', '-', $feature_name);
                $feature_link_name = str_ireplace('<r></r>', '', $feature_link_name);

                $name = get_field('feature-name');
                $block_name = str_ireplace(' ', '-', $name);
                $block_name = str_ireplace('<r></r>', '', $block_name);
                $header = get_field('feature-header');
                $body = get_field('feature-body');
                $video = get_field('feature-video');
                $image = get_field('feature-single-image');
                $format = get_field('feature-format');
                $feature_title = get_the_title();
                $feature = get_sub_field('feature');
                $video1 = get_field('feature_video_1');
                $video2 = get_field('feature_video_2');

            ?>
                <div class="feature-item">
                    <div class="tab-content">
                        <div class="row">
                            <?php

                            //IMAGE ONLY
                            if ($format == 'Image') {
                                echo `<div class="large-12 xsmall-12  feature-media columns"><p><img src="$image" /></p></div>`;
                            }
                            //VIDEO ONLY
                            else if ($format == 'Video') {
                            ?>
                                <div class="large-12 xsmall-12  feature-media columns">
                                    <?php echo $video; ?>
                                </div>
                            <?php
                            }
                            //IMAGE SLIDER ONLY
                            else if ($format == 'Image-Slider') {
                            ?>
                                <div class="large-12 xsmall-12  feature-media columns">
                                    <div class="slider">
                                        <?php
                                        if (have_rows('image_slider_cdn')) {
                                            // loop through the rows of data
                                            while (have_rows('image_slider_cdn')) {
                                                the_row();
                                                $image_slide = get_sub_field('image_url');
                                                if (!empty($image_slide)) {
                                                    echo `<div class="gallery-side"><img src="$image_slide" /></div>`;
                                                }
                                            }
                                        }
                                        ?>
                                    </div><!-- end slider-->
                                </div>
                            <?php
                            } else if ($format == 'Double Video') { ?>
                                <div class="large-12 xsmall-12  feature-media columns">
                                    <?php echo $video1; ?>
                                </div>
                                <div class="large-12 xsmall-12  feature-media columns">
                                    <p>
                                        <?php echo $video2 ?>
                                    </p>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div> <!-- feature item end -->
            <?php
                $feature_count++;
                wp_reset_postdata();
            }
            ?>

        </div>
    </section>

    <!-- Specifications -->

    <section class="spec-details large-6 large-pull-6 medium-12 small-12 xsmall-12  columns">
        <h2> <?php echo $product_brand; ?> Specifications</h2>
        <div class="spec-details-image">
            <img src="<?php echo $jet_top_image; ?>" class="spec-details-image_content" />
            <div class="spec-details-buttons">
                <div>
                    <a class="spec-details-button-item" href='#'>
                        WRRANTY
                    </a>
                </div>
                <div>
                    <a class="spec-details-button-item" href='#'>
                        GRANDEE WRRANTY
                    </a>
                </div>
                <div>
                    <a class="spec-details-button-item" href='#'>
                        OWNER'S MANNUAL
                    </a>
                </div>
                <div>
                    <a class="spec-details-button-item" href='#'>
                        PRE-DELIVERY GUIDE
                    </a>
                </div>
            </div>
        </div>

        <!--PRIMARY SPECS-->
        <ul class="prod-specs-list ">
            <div class="tab-content main-specs">
                <ul class="prod-specs-table">
                    <?php
                    if (have_rows('primary_specs')) {
                        while (have_rows('primary_specs')) {
                            the_row();
                    ?>
                            <li>
                                <span>
                                    <p class="table-key"><?php the_sub_field('name'); ?></p>
                                </span>
                                <span>
                                    <p><?php the_sub_field('value'); ?></p>
                                </span>
                            </li>

                    <?php }
                    } ?>

                </ul>
            </div>
        </ul>
        <div class="specs-additional tabs">
            <ul class="prod-specs-list">
                <li><a href="#">ADDITIONAL SPECS</a></li>
                <div class="tab-content">
                    <ul class="prod-specs-table">
                        <?php
                        if (have_rows('additional_specs')) {
                            while (have_rows('additional_specs')) {
                                the_row(); ?>

                                <li>
                                    <span>
                                        <p class="table-key"><?php the_sub_field('name'); ?></p>
                                    </span>
                                    <span>
                                        <p><?php the_sub_field('value'); ?></p>
                                    </span>
                                </li>

                        <?php }
                        } ?>

                    </ul>
                </div>
            </ul>
        </div>
        <?php
        $show_button = get_field("show_warranty_button");
        $button_text = get_field("warranty_button_text");
        $button_link = get_field("warranty_button_link");
        $show_second_button = get_field("show_secondary_button");
        $button_second_text = get_field("secondary_button_text");
        $button_second_link = get_field("secondary_button_link");
        ?>

        <div class="specs-buttons">
            <?php if (!empty($show_button)) { ?>
                <a class="product-price-button warranty-link" href="<?php echo $button_link ?>" target="_blank"><?php echo $button_text ?></a>
            <?php } ?>

            <?php if (!empty($show_second_button)) { ?>
                <a class="product-price-button secondary-button-link" href="<?php echo $button_second_link ?>" target="_blank"><?php echo $button_second_text ?></a>
            <?php } ?>
        </div>
    </section>


    <!---------------------------- ACCESSORIES -------------------------------------->
    <section class="accessorries">
        <h2>Accessories</h2>
        <?php
        if ($product_brand != "ht-clearance") {
            $show_accessory_block = get_field('show-accessories');
            $accessory_type = get_field('accessory_type');
            $accessories_header = get_field("accessories-header");

            if (!empty($show_accessory_block)) {
                /* FEATURE BLOCKS */
                $accessory_brand_slug = $product_brand . '-accessories';
                $prod = get_term_by('slug', $accessory_brand_slug, 'product_cat');
                $brand_accessories_cat_id = $prod->term_id;

                if ($accessory_type == 'cat') {
                    $taxonomy     = 'product_cat';
                    $parent       = $brand_accessories_cat_id;
                    $orderby      = 'name';
                    $show_count   = 0;      // 1 for yes, 0 for no
                    $pad_counts   = 0;      // 1 for yes, 0 for no
                    $hierarchical = 1;      // 1 for yes, 0 for no
                    $title        = '';
                    $empty        = 0;
                    $order        = 'DESC';
                    $args = array(
                        'taxonomy'     => $taxonomy,
                        'parent'       => $parent,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty,
                        'order'        => $order

                    );

                    $sub_accessory_categories = get_categories($args);
                }
            }
        }
        ?>
    </section>
    <!---------------------------- end accessories ---------------------------------->