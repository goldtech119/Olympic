<?php
/**
 * Page Template EStore shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return
  */

function estore_search() {
	ob_start();
	?>
	<div class="estore-search">
		<svg class="tcb-icon" viewBox="0 0 24 24" data-id="icon-search-duotone" data-name="" style=""><path fill="none" d="M0 0h24v24H0V0z"></path><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
		<input type="text" placeholder="Cleaning supplies">
	</div>
	<?php
	return ob_get_clean();
}
function estore_featured_category( $atts = 'estore' ) {
	ob_start();
	$parameters = shortcode_atts(
		array(
			'page' => 'estore'
		),
		$atts
	);
	$page = $parameters['page'];
	$categories = get_field( 'categories', 'option' );
	if ( $categories ) :
		?>
	<div class="estore-category">
		<?php
		foreach ( $categories as $cat ) :
			$category = $cat['category'];
			$image    = $cat['image'];
			if ( $category && $image ) :
				?>
			  <a class="featured-cat" href="<?php echo esc_attr( $page == 'detail' ? get_term_link( $category, 'product_cat' ) : '#'); ?>">
					<?php
					$attr = array(
						'class' => 'featured-cat__image',
					);
					echo wp_get_attachment_image( $image['id'], 'full', '', $attr );
					?>
				  <h5 class="featured-cat__title" data-cat="<?php echo esc_attr( $category->slug ); ?> "><?php echo $category->name; ?></h5>
				</a>
			<?php endif; ?>
			<?php
	  endforeach;
		wp_reset_postdata();
		?>
	</div>
		<?php
	endif;
	return ob_get_clean();
}

function estore_featured_services() {
	ob_start();
	if ( have_rows( 'services' ) ) :
		?>
	<div class="estore-service">
		<?php
		while ( have_rows( 'services' ) ) :
			the_row();
			?>
			  <?php
				$service = get_sub_field( 'title' );
				$image   = get_sub_field( 'image' );
				if ( $service && $image ) :
					?>
			  <a class="estore-service__item" href="#">
					  <?php
						$attr = array(
							'class' => 'estore-service__image',
						);
						echo wp_get_attachment_image( $image['id'], 'full', '', $attr );
						?>
				  <h5 class="estore-service__title"><?php echo esc_html( $service ); ?></h5>
			  </a>
				<?php endif; ?>
			<?php
	  endwhile;
		wp_reset_postdata();
		?>
	</div>
		<?php
	endif;
	return ob_get_clean();
}
function estore_featured_items() {
	ob_start();
	if ( have_rows( 'features' ) ) :
		?>
	<div class="estore-feature">
		<?php
		while ( have_rows( 'features' ) ) :
			the_row();
			?>
			  <?php
				$title       = get_sub_field( 'title' );
				$description = get_sub_field( 'description' );
				$image       = get_sub_field( 'image' );
				?>
			<a class="estore-feature__item" href="#">
				<div class="estore-feature__image">
					<?php
					$attr = array(
						'class' => 'estore-feature__image',
					);
					echo wp_get_attachment_image( $image['id'], 'full', '', $attr );
					?>
				</div>
				<h5 class="estore-feature__title"><?php echo esc_html( $title ); ?></h5>
				<p class="estore-feature__description"><?php echo esc_html( $description ); ?></p>
			</a>
			<?php
	  endwhile;
		wp_reset_postdata();
		?>
	</div>
		<?php
	endif;
	return ob_get_clean();
}

function estore_featured_product() {
	ob_start();
	?>
	<?php
	if ( have_rows( 'categories' ) ) :
			$ind = 0;
		?>
		<div class="estore-products">
		  <?php
			while ( have_rows( 'categories' ) ) :
				the_row();
				?>
				  <?php
					$ind ++;
					$category = get_sub_field( 'category' );
					?>
				<section class="estore-product <?php echo esc_attr( $ind == 1 ? 'active' : '' ); ?>" id="<?php echo esc_attr( $category->slug ); ?>">
					<h2 class="estore-product__subject"><?php echo esc_html( $category->name ); ?></h2>
					<?php
						$args  = array(
							'post_type'      => 'product', // Replace 'product' with your custom post type name if necessary
							'tax_query'      => array(
								array(
									'taxonomy' => 'product_cat', // Replace 'product_category' with your taxonomy name
									'field'    => 'slug',
									'terms'    => $category->slug, // Specify the slug of the category you want to retrieve products from
								),
							),
							'posts_per_page' => 3,
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
							?>
							<div class="estore-product__items">
								<?php
								while ( $query->have_posts() ) :
									$query->the_post();
									global $post;
									$price = get_post_meta( get_the_ID(), '_price', true );
									?>
									<div class="estore-product__item">
										<div class="item-image"><?php the_post_thumbnail(); ?></div>
										<?php
                                            echo apply_filters(
                                                'woocommerce_loop_product_link',
                                                sprintf(
                                                    '<a href="%s" class="button addonify-qvm-button" data-product_id="%s">%s</a>',
                                                    '#',
                                                    esc_attr(get_the_ID()),
                                                    __('Quick View', 'text-domain')
                                                ),
                                                $post
                                            );
                                        ?>
										<div class="item-title"><?php the_title(); ?></div>
										<div class="item-price">$<?php echo esc_html( $price ); ?></div>
										<a href="<?php the_permalink(); ?>" class="btn text-upper item-cta">View product</a>
									</div>
									<?php
								endwhile;
								wp_reset_postdata();
								?>
								
							</div>
						<?php endif; ?>
					<a class="estore-product__seemore text-upper" href="<?php echo get_term_link( $category, 'product_cat' ); ?>">See More</a>
				</section>
				<?php
		  endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
	endif;
	return ob_get_clean();
}


function product_category_shortcode() {
	ob_start();
	global $post;
	$terms = get_the_terms( get_the_ID(), 'product_cat' );
	if ( $terms ) :
		?>
	<div class="hot-tub__category">
		<?php foreach ( $terms as $term ) : ?>
			<h3 class="hot-tub__category__item"><?php echo esc_html( $term->name ); ?></h3>
		<?php endforeach; ?>
	</div>
		<?php
	endif;
	return ob_get_clean();
}


add_shortcode( 'estore_search', 'estore_search' );

add_shortcode( 'estore_featured_category', 'estore_featured_category' );

add_shortcode( 'estore_featured_services', 'estore_featured_services' );

add_shortcode( 'estore_featured_items', 'estore_featured_items' );

add_shortcode( 'estore_featured_product', 'estore_featured_product' );

add_shortcode( 'product_category_shortcode', 'product_category_shortcode' );
