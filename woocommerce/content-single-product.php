<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.4.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
exit(0);
?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form();
	return;
}
?>
<style>
.single-product .product {
	padding-top:0.2em;
}

.product-title-line .title {
	text-align:center;
}
</style>
<div class="product-heading single-product-heading">


	<div class="row">
<!-- title of top section 1-->
		<div class="product-title-line" style="text-align:center">
		<?php
			$title       = get_the_title();
			$product_cap = get_field( 'product_cap' );
			echo '<h2 class="title">' . $title . ' ' . $product_cap . '</h2>';
		?>
		</div><!-- end product title line -->
		<div style="clear:both;"></div>
		<div class="breadcrumbs" typeof="BreadcrumbList" style="text-align:center" vocab="http://schema.org/">
			<div class="row">
			<?php
			if ( function_exists( 'bcn_display' ) ) {
				bcn_display();
				?>
						<br>
		<hr>
						<?php
			}
			?>
			</div>
		</div>

				<?
					if(!has_category("product-cat-finnleo-saunas")){

				?>
						<div id="GURBOX" style="top:20%;">
							<!-- GUB content -->
							<div class="GURB-content">
								<div class="alert-close">×</div>
								<img src="/wp-content/uploads/2016/06/monthly-specials.png" alt="Monthly Specials" />
								<div class="prod btns">
									<a href="/promotions" class="button">View Monthly Specials</a>
								</div>
							</div>
						</div>
				<?
					}
				?>



<div id="product-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>



	<div class="summary entry-summary">







		<?php
			$show_pricing = get_field( 'show_pricing_values' );
		?>

		<?php
		if ( ! empty( $show_pricing ) ) {
			/**
				* woocommerce_single_product_summary hook.
				*
				* @hooked woocommerce_template_single_title - 5
				* @hooked woocommerce_template_single_rating - 10
				* @hooked woocommerce_template_single_price - 10
				* @hooked woocommerce_template_single_excerpt - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked woocommerce_template_single_sharing - 50
			*/
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
			do_action( 'woocommerce_single_product_summary' );

		} else {
			/**
				* woocommerce_single_product_summary hook.
				*
				* @hooked woocommerce_template_single_title - 5
				* @hooked woocommerce_template_single_rating - 10
				* @hooked woocommerce_template_single_price - 10
				* @hooked woocommerce_template_single_excerpt - 20
				* @hooked woocommerce_template_single_add_to_cart - 30
				* @hooked woocommerce_template_single_meta - 40
				* @hooked woocommerce_template_single_sharing - 50
			*/
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
			do_action( 'woocommerce_single_product_summary' );
		}


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


		?>











	</div><!-- .summary -->


</div>
<br>











<?php
	$showspecs     = get_field( 'general_show_product_specs_tab' );
	$specstabtitle = get_field( 'product_specs_tab_title' );
if ( empty( $specstabtitle ) ) {
	$specstabtitle = 'Product Specs';
}
	$showswatches     = get_field( 'general_show_swatches_tab' );
	$swatchestabtitle = get_field( 'swatches_tab_title' );
if ( empty( $swatchestabtitle ) ) {
	$swatchestabtitle = 'Product Swatches';
}
	$showcustom     = get_field( 'show_gener_content_tab' );
	$customtabtitle = get_field( 'gen_content_tab_title' );
if ( empty( $customtabtitle ) ) {
	$customtabtitle = 'More';
}
	$showmedia     = get_field( 'show_media_library' );
	$mediatabtitle = get_field( 'media_tab_title' );
if ( empty( $mediatabtitle ) ) {
	$mediatabtitle = 'Media Gallery';
}
	$showvl     = get_field( 'show_visual_list_tab' );
	$vltabtitle = get_field( 'visual_list_tab_title' );
if ( empty( $vltabtitle ) ) {
	$vltabtitle = 'More Details';
}
	$showgl     = get_field( 'show_grid_tab' );
	$gltabtitle = get_field( 'grid_section_title' );
if ( empty( $gltabtitle ) ) {
	$gltabtitle = 'More Details';
}
	$theDesc      = get_the_content();
	$showProdDesc = get_field( 'general_show_description_tab' );

	$showRelatedProducts       = get_field( 'general_show_related_products_tab' );
		$showCrossSellProducts = get_field( 'general_show_crosssell_products_tab' );

?>
	 <ul class="tab-links cf">
		 <?php if ( ! empty( $showProdDesc ) ) { ?>
				<?php if ( ! empty( $theDesc ) ) { ?>
				 <li><a href="javascript:;" class="theDescription">Description</a></li>
			 <?php } ?>
		 <?php } ?>
		 <?php if ( ! empty( $showspecs ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $specstabtitle ); ?>" href="javascript:;"><?php echo $specstabtitle; ?></a></li>
		 <?php } ?>
		 <?php if ( ! empty( $showswatches ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $swatchestabtitle ); ?>" href="javascript:;"><?php echo $swatchestabtitle; ?></a></li>
		 <?php } ?>
		<?php if ( ! empty( $showcustom ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $customtabtitle ); ?>" href="javascript:;"><?php echo $customtabtitle; ?></a></li>
		 <?php } ?>
		<?php if ( ! empty( $showmedia ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $mediatabtitle ); ?>" href="javascript:;"><?php echo $mediatabtitle; ?></a></li>
		 <?php } ?>
		<?php if ( ! empty( $showvl ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $vltabtitle ); ?>" href="javascript:;"><?php echo $vltabtitle; ?></a></li>
		 <?php } ?>
		<?php if ( ! empty( $showgl ) ) { ?>
			 <li><a class="<?php echo str_replace( ' ', '_', $gltabtitle ); ?>" href="javascript:;"><?php echo $gltabtitle; ?></a></li>
		 <?php } ?>
		  <?php if ( ! empty( $showRelatedProducts ) ) { ?>
			 <li><a href="javascript:;" class="RelatedProducts">Related Products</a></li>
		 <?php } ?>
				 <?php if ( ! empty( $showCrossSellProducts ) ) { ?>
						<li><a href="javascript:;" class="CrossSellProducts">Cross Sell Products</a></li>
				<?php } ?>
	 </ul>

<?php if ( ! empty( $showspecs ) || ! empty( $showswatches ) || ! empty( $showcustom ) || ! empty( $showmedia ) || ! empty( $showvl ) || ! empty( $showgl ) ) { ?>
<div class="tabs-wrapper cf" style="margin-bottom:1.5em;">

	<?php if ( ! empty( $showProdDesc ) ) { ?>
		<?php if ( ! empty( $theDesc ) ) { ?>
		<div class="theDescription tab">
		   <section class="productDescription">
			  <div class="container cf" style="padding-top:2.75em;">
				  <h2><?php echo the_title(); ?></h2>
				  <?php echo $theDesc; ?>
			  </div>
		   </section>
		</div>
	<?php } ?>
	<?php } ?>

	<?php if ( ! empty( $showCrossSellProducts ) ) { ?>
<div class="CrossSellProducts tab">
	<section class="CrossSellProducts">
		<div class="container cf">
					<?php
							// Remove standard Related Products section
							remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
							// Remove the WooCommerce Upsell hook
							remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
							remove_action( 'woocommerce_after_single_product_summary', 'woo_wc_upsell_display', 15 );
							// Add a custom action to display Upsells
							add_action( 'mpd1_after_single_product_summary', 'woocommerce_output_related_products', 20 );
							do_action( 'mpd1_after_single_product_summary' );
					?>
	   </div>
	</section>
</div>
	<?php } ?>

	<?php if ( ! empty( $showRelatedProducts ) ) { ?>
<div class="RelatedProducts tab">
	<section class="RelatedProducts">
		<div class="container cf">
						<?php
								// Remove standard Related Products section
								remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
								// Remove the WooCommerce Upsell hook
								remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
								remove_action( 'woocommerce_after_single_product_summary', 'woo_wc_upsell_display', 15 );
								// Add a custom action to display Upsells
								add_action( 'mpd_after_single_product_summary', 'woocommerce_upsell_display', 15 );
								do_action( 'mpd_after_single_product_summary' );
						?>
	   </div>
	</section>
</div>
	<?php } ?>

	<?php
	$specstitle = get_field( 'general_product_specs_section_title' );
	if ( empty( $specstitle ) ) {
		$specstitle = 'Specifications';
	}
	$heightspec = get_field( 'general_product_height' );
	$widthspec  = get_field( 'general_product_spec_width' );
	$specimg    = get_field( 'general_product_specs_image' );
	?>

	<?php if ( ! empty( $showspecs ) ) { ?>

   <div class="<?php echo str_replace( ' ', '_', $specstabtitle ); ?> tab">
	<section class="gen specs">
	   <div class="container cf">
		<h3><?php echo $specstitle; ?></h3>
		<?php if ( ! empty( $specimg ) ) { ?>
			<div class="thespecslist">
		<?php } else { ?>
			<div class="thespecslist" style="float:none; margin: 0 auto;">
		<?php } ?>

		   <a class="title expander-link">Primary Specs</a>
		   <ul>
			   <?php if ( ! empty( $widthspec ) ) { ?>
				   <li class="cf">
					   <div><p>Width:</p></div>
					   <div><p><?php echo $widthspec; ?></p></div>
				   </li>
			   <?php } ?>
			   <?php if ( ! empty( $heightspec ) ) { ?>
			   <li class="cf">
				   <div><p>Height:</p></div>
				   <div><p><?php echo $heightspec; ?></p></div>
			   </li>
			   <?php } ?>
				<?php
				if ( get_field( 'general_primary_product_spec_fields' ) ) {
					while ( the_repeater_field( 'general_primary_product_spec_fields' ) ) {
						?>
					<li class="cf">
						<div><p><?php echo get_sub_field( 'label' ); ?></p></div>
						<div><p><?php echo get_sub_field( 'value' ); ?></p></div>
					</li>
						<?php
					}//end while general_primary_product_spec_fields
				}//end if general_primary_product_spec_fields
				?>
			</ul>

			<a class="title expander-link">Additional Specs</a>
			<ul>
				<?php
				if ( get_field( 'additional_product_spec_fields' ) ) {
					?>
					<?php
					while ( the_repeater_field( 'additional_product_spec_fields' ) ) {
						?>
					<li class="cf">
						<div><p><?php echo get_sub_field( 'label' ); ?></p></div>
						<div><p><?php echo get_sub_field( 'value' ); ?></p></div>
					</li>
						<?php
					}//end while general_primary_product_spec_fields
				}//end if general_primary_product_spec_fields
				?>
			</ul>
		</div>
			<?php
			if ( ! empty( $specimg ) ) {
				?>
		<div class="specsimg">
		   <div class="img-container">
			   <img src="<?php echo $specimg; ?>" alt="">
				<?php if ( ! empty( $heightspec ) && ! empty( $widthspec ) ) { ?>
			   <div class="height"><p><?php echo $heightspec; ?></p></div>
			   <div class="width"><p><?php echo $widthspec; ?></p></div>
			   <?php }; ?>
		   </div>
		</div>
		<?php }; ?>
		</div>
	</section>
	</div>
	<?php }//end if show specs not empty ?>


	<?php
	$swatch_section_title = get_field( 'swatches_section_title' );
	if ( empty( $swatch_section_title ) ) {
		$swatch_section_title = 'Swatches';
	}
	?>
	<?php if ( ! empty( $showswatches ) ) { ?>

	<div class="<?php echo str_replace( ' ', '_', $swatchestabtitle ); ?> tab">
		<section class="swatches cf">
			<h3><?php echo $swatch_section_title; ?></h3>
			<div class="swatches-wrapper cf">
				<?php if ( get_field( 'swatches' ) ) { ?>
					<?php while ( the_repeater_field( 'swatches' ) ) { ?>

					   <div class="swatch matchHeight2">

						<? if( get_sub_field('swatch_type') == 'color' ){ ?>
							<div class="swatch-type" style="background-color:<?php the_sub_field( 'swatch_color' ); ?>"></div>
						<?php } ?>

						<? if( get_sub_field('swatch_type') == 'image' ){ ?>
							<div class="swatch-type" style="background-image:url(<?php the_sub_field( 'swatch_image' ); ?>)"></div>
						<?php } ?>

						   <div>
							<p><?php echo the_sub_field( 'swatch_name' ); ?></p>
						</div>

					  </div>
					<?php }//end while swatches ?>
				<?php }//end if swatches ?>
			</div>
		</section>
	</div>

<?php };//end iof show swatches not empty ?>

<?php if ( ! empty( $showcustom ) ) { ?>
	<?php

	$custom_section_title = get_field( 'ge_section_title' );
	if ( empty( $custom_section_title ) ) {
		$custom_section_title = 'More Details';
	}

	$numcol = get_field( 'general_content_type' );
	if ( $numcol == 'onec' ) {
		$numcol  = 1;
		$column1 = get_field( 'column_content' );
	}
	if ( $numcol == 'twoc' ) {
		$numcol  = 2;
		$column1 = get_field( 'column_content' );
		$column2 = get_field( 'column_content_2' );
	}
	if ( $numcol == 'threec' ) {
		$numcol  = 3;
		$column1 = get_field( 'column_content' );
		$column2 = get_field( 'column_content_2' );
		$column3 = get_field( 'column_content_3' );
	}
	if ( $numcol == 'fourc' ) {
		$numcol  = 4;
		$column1 = get_field( 'column_content' );
		$column2 = get_field( 'column_content_2' );
		$column3 = get_field( 'column_content_3' );
		$column4 = get_field( 'column_content_4' );
	}
	?>
	<div class="<?php echo str_replace( ' ', '_', $customtabtitle ); ?> tab">
		<section class="cf">
			<h3><?php echo $custom_section_title; ?></h3>
			<?php if ( ! empty( $column1 ) ) { ?>
				<div class="col-<?php echo $numcol; ?> matchHeight"><?php echo $column1; ?></div>
			<?php } ?>
			<?php if ( ! empty( $column2 ) ) { ?>
				<div class="col-<?php echo $numcol; ?> matchHeight"><?php echo $column2; ?></div>
			<?php } ?>
			<?php if ( ! empty( $column3 ) ) { ?>
				<div class="col-<?php echo $numcol; ?> matchHeight"><?php echo $column3; ?></div>
			<?php } ?>
			<?php if ( ! empty( $column4 ) ) { ?>
				<div class="col-<?php echo $numcol; ?> matchHeight"><?php echo $column4; ?></div>
			<?php } ?>
		</section>
	</div>
<?php }//end if show custom not empty ?>

<?php if ( ! empty( $showmedia ) ) { ?>
	<?php
	$media_section_title = get_field( 'media_section_title' );
	if ( empty( $media_section_title ) ) {
		$media_section_title = 'Our Gallery';
	}
	$images = get_field( 'add_images' );
	?>



<div class="<?php echo str_replace( ' ', '_', $mediatabtitle ); ?> tab">
	<section class="cf">
		<h3><?php echo $media_section_title; ?></h3>

		<?php if ( $images ) : ?>
			<div class="gallery-page-product">
			<?php foreach ( $images as $image ) : ?>
			<div>
				<img src="<?php echo $image['url']; ?>" alt="">
			</div>
			<?php endforeach; ?>
			</div>
		<?php endif; ?>






		<?php
		if ( have_rows( 'add_video' ) ) {
			while ( have_rows( 'add_video' ) ) {
				$video_repeater = the_row();

				foreach ( $video_repeater as $repeater_value ) {
					echo $repeater_value . '<br>';
				}
			}
		}
		?>


		<span class="testingBitch"></span>













	</section>
</div>

<?php }//end if show media not empty ?>

<?php if ( ! empty( $showvl ) ) { ?>

<div class="<?php echo str_replace( ' ', '_', $vltabtitle ); ?> tab">
	<section class="cf">
		<h3><?php echo $vltabtitle; ?></h3>

	<?php if ( get_field( 'visual_list' ) ) { ?>
		<?php while ( the_repeater_field( 'visual_list' ) ) { ?>

	<div class="vl-item cf imgp_<?php echo get_sub_field( 'vl_img_position' ); ?>">
		<div class="fifty-50 the-image">
			<img src="<?php echo get_sub_field( 'vl_image' ); ?>" alt="">
		</div>
		<div class="fifty-50 the-content">
			<?php echo get_sub_field( 'vl_content' ); ?>
		</div>
	</div>

	<?php }//end while visual_list ?>
	<?php }//end if visual_list ?>

	</section>
</div>

<?php }//end if show vl not empty ?>



<?php if ( ! empty( $showgl ) ) { ?>

<div class="<?php echo str_replace( ' ', '_', $gltabtitle ); ?> tab">
	<section class="cf">
		<h3><?php echo $gltabtitle; ?></h3>

	<?php if ( get_field( 'grid_list_items' ) ) { ?>
   <div class="grid-list">
		<?php while ( the_repeater_field( 'grid_list_items' ) ) { ?>

		<div class="grid-item matchHeight3">
		   <img src="<?php echo the_sub_field( 'grid_img' ); ?>" alt="">
		   <h4><?php strip_tags( the_sub_field( 'grid_title' ) ); ?></h4>
		   <p><?php strip_tags( the_sub_field( 'grid_subtitle' ) ); ?></p>
		</div>

	<?php }//end while drid list ?>
	</div>
	<?php }//end if grid list ?>

	</section>
</div>

<?php }//end if show vl not empty ?>


	</div><!--tabs-wrapper end -->
<?php };//and if only show if one of them is not empty ?>

<!-------------------------------------------------------------CUSTOM CODE END ------------------------->



	<?php wp_reset_postdata(); ?>
	<?php wp_reset_query(); ?>










		</div>
	</div>
