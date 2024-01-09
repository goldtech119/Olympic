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

function hot_tub_shortcode( $atts = '9' ) {
	ob_start();
	// Extract and process the parameters
	$parameters = shortcode_atts(
		array(
			'parameter' => '9',
			'page'      => 'feed',
			'category'  => 'all'
		),
		$atts
	);
	// Access the parameter value
	$parameter_value = $parameters['parameter'];
	$page_value      = $parameters['page'];
	$category        = $parameters['category'];

	if ( $category == 'all' ) {
		$args = array(
			'post_type'      => 'hot_tubs',
			'posts_per_page' => $parameter_value,
			'order' 		 => 'ASC'
		);
	}
	else {
		$args = array(
			'post_type'      => 'hot_tubs',
			'posts_per_page' => $parameter_value,
			'order' 		 => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'hot_tubs_cat',
					'field' => 'slug',
					'terms' => $category,
				),
			),
		);
	}
	$products = new WP_Query( $args );

	// Filters
	?>
	<?php if( $page_value == 'feed' ) : ?>
	<div class="hot-tub-filters" id="hot-tub-filters">
		<div class="filters">
			<div class="filter filter-brand">
				<div class="filter-btn button" data-value="brand">BRAND</div>
				<div class="filter-dropdown">
					<p class="initial">BRAND</p>
					<p value="hot-spring-spas" class="option">Hot Spring Spas</p>
					<p value="freeflow-spas" class="option">Freeflow Spas</p>
				</div>
			</div>
			<div class="filter filter-capacity">
				<div class="filter-btn button" data-value="capacity">SEATING CAPACITY</div>
				<div class="filter-dropdown">
					<p class="initial">SEATING CAPACITY</p>
					<p value="1-3" class="option">1-3</p>
					<p value="4-5" class="option">4-5</p>
					<p value="6-8" class="option">6-8</p>
				</div>
			</div>
			<div class="filter filter-saltwater">
				<div class="filter-btn button" data-value="saltwater">SALTWATER READY</div>
				<div class="filter-dropdown">
					<p class="initial">SALTWATER READY </p>
					<p value="highlife-collection" class="option">Highlife Collection</p>
					<p value="limelight-collection" class="option">Limelight Collection</p>
					<p value="hot-spot-collection" class="option">Hot Spot Collection</p>
					<p value="freeflow-sport-series" class="option">Freeflow Sport Series</p>
					<p value="freeflow-premier-series" class="option">Freeflow Premier Series</p>
				</div>
			</div>
			<div class="filter filter-price">
				<div class="filter-btn button" data-value="price">PRICE LEVEL</div>
				<div class="filter-dropdown">
					<p class="initial">PRICE LEVEL</p>
					<p value="10003736" class="option">$$$$</p>
					<p value="10003737" class="option">$$$</p>
					<p value="10003738" class="option">$$</p>
					<p value="10003739" class="option">$</p>
				</div>
			</div>
		</div>
		<div class="clear-filter">Clear Filters</div>
	</div>
	<?php
	endif;
	// Products

	if ( $products->have_posts() ) {
		?>
		<div class="hot-tub-product cpt-list"
                data-cat="" 
                data-post-type="hot_tubs" 
                data-paged="" 
                data-posts-per-page="9">

		<?php while ( $products->have_posts() ) {
			$products->the_post();
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
		}
		echo '</div>';
		wp_reset_postdata();
		?>
		<?php if ( $page_value == 'feed' ) : ?>
			<a class="hot-tub-product__seemore btn" href="#hot-tub-filters">See More</a>
		<?php
			endif;
	} else {
		// No products found
	}

	return ob_get_clean();
}

function swim_spa_shortcode( $atts = '9' ) {
	ob_start();
	// Extract and process the parameters
	$parameters = shortcode_atts(
		array(
			'parameter' => '9',
			'page'      => 'feed',
			'category'  => 'all'
		),
		$atts
	);
	// Access the parameter value
	$parameter_value = $parameters['parameter'];
	$page_value      = $parameters['page'];
	$category        = $parameters['category'];

	if ( $category == 'all' ) {
		$args = array(
			'post_type'      => 'swim_spas',
			'posts_per_page' => $parameter_value,
			'order' 		 => 'ASC'
		);
	}
	else {
		$args = array(
			'post_type'      => 'swim_spas',
			'posts_per_page' => $parameter_value,
			'order' 		 => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'swim_spas_cat',
					'field' => 'slug',
					'terms' => $category,
				),
			),
		);
	}
	$products = new WP_Query( $args );

	// Filters
	?>
	<?php if( $page_value == 'feed' ) : ?>
	<div class="hot-tub-filters swim-spas-filters" id="hot-tub-filters">
		<div class="filters">
			<div class="filter filter-brand">
				<div class="filter-btn button" data-value="brand">BRAND</div>
				<div class="filter-dropdown">
					<p class="initial">BRAND</p>
					<p value="endless-pools-fitness-systems" class="option">Endless Pools Fitness Systems</p>
					<p value="recsport-recreation-systems" class="option">RecSport Recreation Systems</p>
					<p value="swimcross-exercise-systems" class="option">SwimCross Exercise Systems</p>
				</div>
			</div>
			<div class="filter filter-capacity">
				<div class="filter-btn button" data-value="capacity">SEATING CAPACITY</div>
				<div class="filter-dropdown">
					<p class="initial">SEATING CAPACITY</p>
					<p value="12" class="option">12</p>
					<p value="15" class="option">15</p>
					<p value="17" class="option">17</p>
					<p value="20" class="option">20</p>
				</div>
			</div>
		</div>
		<div class="clear-filter">Clear Filters</div>
	</div>
	<?php
	endif;
	// Products

	if ( $products->have_posts() ) {
		?>
		<div class="hot-tub-product cpt-list"
                data-cat="" 
                data-post-type="swim_spas" 
                data-paged="" 
                data-posts-per-page="9">

		<?php while ( $products->have_posts() ) {
			$products->the_post();
			$permalink = get_permalink();
			$my_tub    = get_field( 'design_my_tub' );
			$first_tub = $my_tub[0]['shell'];
			$image_2   = $first_tub[0]['media_image'];
			$people    = get_field( 'people' );
			$parts     = explode(' ', $people);

			echo '<a class="hot-tub-product__item" href="' . $permalink . '">';
			echo '<div class="hot-tub-product__item__image">' . get_the_post_thumbnail() . '</div>';
			?>
			<div class="hot-tub-product__item__image_2"><?php the_post_thumbnail(); ?></div>
			<?php
			$product_categories = get_the_terms( get_the_id(), 'swim_spas_cat' );

			// var_dump($product_categories);
			echo '<div class="hot-tub-product__item__categories">';
			// foreach ( $product_categories as $category ) {
				echo '<h5 class="hot-tub-product__item__category">' . end($product_categories)->name . '</h5>';
			// }
			echo '</div>';
			echo '<h3 class="hot-tub-product__item__name">' . get_the_title() . '</h3>';
			?>
			<p class="hot-tub-product__item__seats">Seats <?php echo esc_html($product_categories[0]->name); ?></p>
			<?php
			echo '</a>';
		}
		echo '</div>';
		wp_reset_postdata();
		?>
		<?php
	} else {
		// No products found
	}

	return ob_get_clean();
}

add_shortcode( 'hot_tub_shortcode', 'hot_tub_shortcode' );

add_shortcode( 'swim_spa_shortcode', 'swim_spa_shortcode' );
