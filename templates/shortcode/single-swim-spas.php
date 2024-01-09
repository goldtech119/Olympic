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

function single_swim_spas_shortcode() {
	ob_start();
	global $post;
	?>
	<div class="hot-tub-intro">
		<div class="container">
			<div class="hot-tub-intro__content">
				<?php
				get_template_part_args(
					'template-parts/content-modules-text',
					array(
						'v'  => 'intro_content',
						't'  => 'div',
						'o'  => 'f',
						'tc' => 'hot-tub-intro__content__text',
					)
				);
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'get_price_cta',
						'o' => 'f',
						'c' => 'hot-tub-intro__content__cta btn btn-blue text-upper',
					)
				);
				?>
			</div>
			<div class="hot-tub-intro__image" id="root">
				<?php
					$design_my_tub = get_field( 'design_my_tub' );

				if ( $design_my_tub ) :
					$design_my_tub_data = array(); // Array to store the values

					foreach ( $design_my_tub as $data ) {
						$cabinet_image_url = $data['cabinet_image']['url'];
						$cabinet_name      = $data['cabinet_name'];
						$shell_data        = array();

						foreach ( $data['shell'] as $shell ) {
							$shell_name      = $shell['shell_name'];
							$shell_image_url = $shell['shell_image']['url'];
							$media_image_url = $shell['media_image']['url'];

							// Store the values in an array
							$shell_data[] = array( $shell_name, $shell_image_url, $media_image_url );
						}

						// Store the cabinet image URL and shell data in the main array
						$design_my_tub_data[] = array( $cabinet_image_url, $cabinet_name, $shell_data );
					}
					$jsonArray = json_encode( $design_my_tub_data, JSON_HEX_QUOT );
					echo '<script>';
					echo 'var hot_tubs = ' . $jsonArray;
					echo '</script>';
					?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="hot-tub-simple-specs">
		<div class="container">
			<h2 class="hot-tub-simple-specs__title">Specs</h2>
			<ul class="specs-items">
				<?php
				$people           = get_field( 'people' );
				$jets             = get_field( 'jets' );
				$seating          = get_field( 'seating' );
				$dimentions       = get_field( 'dimentions' );
				$water_care       = get_field( 'water_care' );
				$water_capacity   = get_field( 'water_capacity' );
				$weight           = get_field( 'weight' );
				$additional_specs = get_field( 'additoinal_specs' );
				?>
				<li class="specs-item">
					<h5 class="specs-item__title">People</h5>
					<p class="specs-item__data"><?php echo esc_html( $people ); ?></p>
				</li>
				<li class="specs-item">
					<h5 class="specs-item__title">Jets</h5>
					<p class="specs-item__data"><?php echo esc_html( get_first_line( $jets, ' ' ) ); ?></p>
				</li>
				<li class="specs-item">
					<h5 class="specs-item__title">Seating</h5>
					<p class="specs-item__data"><?php echo esc_html( $seating ); ?></p>
				</li>
				<li class="specs-item">
					<h5 class="specs-item__title">Dimensions</h5>
					<p class="specs-item__data"><?php echo esc_html( get_first_line( $dimentions ) ); ?></p>
				</li>
				<li class="specs-item">
					<h5 class="specs-item__title">Water Care</h5>
					<p class="specs-item__data"><?php echo esc_html( $water_care ); ?></p>
				</li>
			</ul>
			<div class="specs-ctas">
				<?php
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'get_brochure_cta',
						'o' => 'f',
						'c' => 'specs-cta btn btn-trans-sky text-upper',
					)
				);
				get_template_part_args(
					'template-parts/content-modules-cta',
					array(
						'v' => 'see_backyard_cta',
						'o' => 'f',
						'c' => 'specs-cta btn btn-trans-sky text-upper',
					)
				);
				?>
			</div>
		</div>
	</div>
	<div class="hot-tub-features">
		<div class="container">
			<h2 class="hot-tub-features__title">Features</h2>
			<?php
			if ( have_rows( 'features' ) ) :
				?>
			<div class="features-items">
				<?php
				while ( have_rows( 'features' ) ) :
					the_row();
					?>
					<div class="loop-feature">
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'description',
								't'  => 'div',
								'tc' => 'loop-feature__body',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'image',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'w'     => 'div',
								'wc'    => 'loop-feature__image',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'title',
								't'  => 'h5',
								'tc' => 'loop-feature__name',
							)
						);
						?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="hot-tub__specification">
		<img class="custom-wave custom-wave__top" src="/wp-content/uploads/2023/08/wave_core_blue.png" alt="wave" >
		<div class="container">
			<h2 class="hot-tub__specification__title"><?php the_title(); ?> Specifications</h2>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'specification_title',
					'o'  => 'f',
					't'  => 'p',
					'tc' => 'hot-tub__specification__content',
				)
			);
			?>
			<div class="hot-tub__specification__info">
				<div class="info-left">
					<div class="info-left__image">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail();
						endif;
						?>
					</div>
					<div class="info-left__ctas">
						<?php
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'warranty_cta',
								'o' => 'f',
								'c' => 'info-left__cta btn btn-trans-blue text-upper',
							)
						);
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'specs_cta',
								'o' => 'f',
								'c' => 'info-left__cta btn btn-trans-blue text-upper',
							)
						);
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'owner_manual_cta',
								'o' => 'f',
								'c' => 'info-left__cta btn btn-trans-blue text-upper',
							)
						);
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'delivery_guide_cta',
								'o' => 'f',
								'c' => 'info-left__cta btn btn-trans-blue text-upper',
							)
						);
						get_template_part_args(
							'template-parts/content-modules-cta',
							array(
								'v' => 'swim_with_confidence_cta',
								'o' => 'o',
								'c' => 'info-left__cta btn btn-trans-blue text-upper',
							)
						);
						?>
					</div>
				</div>
				<div class="info-right">
					<ul class="info-right__specs">
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Seating Capacity</h5>
							<p class="specs-item__data"><?php echo esc_html( $people ); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Dimensions</h5>
							<p class="specs-item__data"><?php echo nl2br($dimentions); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Water Capacity</h5>
							<p class="specs-item__data"><?php echo esc_html( $water_capacity ); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Weight</h5>
							<p class="specs-item__data"><?php echo nl2br($weight); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Jets</h5>
							<p class="specs-item__data"><?php echo nl2br($jets); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Water Care System<span>(Optional)<span></h5>
							<p class="specs-item__data"><?php echo esc_html( $water_care ); ?></p>
						</li>
						<li class="info-right__specs__item">
							<h5 class="item-title text-upper">Seating</h5>
							<p class="specs-item__data"><?php echo esc_html( $seating ); ?></p>
						</li>
						<?php if ( $additional_specs ) : ?>
						<li class="info-right__specs__item additional-specs">
							<h5 class="item-title text-upper">Additional Specs</h5>
							<div class="specs-item__data"><?php echo $additional_specs; ?></div>
						</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="hot-tub__accessories">
		<img class="custom-wave custom-wave__top" src="/wp-content/uploads/2023/08/wave_core_blue.png" alt="wave" >
		<div class="container">
			<h2 class="hot-tub__accessories__title">Accessories</h2>
			<?php
			get_template_part_args(
				'template-parts/content-modules-text',
				array(
					'v'  => 'accessories_description',
					'o'  => 'f',
					't'  => 'p',
					'tc' => 'hot-tub__accessories__description',
				)
			);
			?>
			<?php
			if ( have_rows( 'accessories' ) ) :
				?>
			<div class="accessory-items">
				<?php
				while ( have_rows( 'accessories' ) ) :
					the_row();
					?>
					<div class="loop-accessory">
						<?php
						get_template_part_args(
							'template-parts/content-modules-image',
							array(
								'v'     => 'image',
								'v2x'   => false,
								'is'    => false,
								'is_2x' => false,
								'w'     => 'div',
								'wc'    => 'loop-accessory__image',
							)
						);
						?>
						<?php
						get_template_part_args(
							'template-parts/content-modules-text',
							array(
								'v'  => 'title',
								't'  => 'h5',
								'tc' => 'loop-accessory__name',
							)
						);
						?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

function single_swim_spas_pricing_form_shortcode() {
	ob_start();
	if (function_exists('tve_leads_form_display')) 
	{ 
		tve_leads_form_display(0, 23048145); 
	}
	return ob_get_clean();
}

function single_swim_spas_category_shortcode() {
	ob_start();
	global $post;
	$terms = get_the_terms( get_the_ID(), 'swim_spas_cat' );
	if ( $terms ) :
		?>
	<div class="hot-tub__category">
		<?php foreach ( $terms as $ind => $term ) : 
			if ( $ind < 1 ) continue;
			?>
			<h3 class="hot-tub__category__item"><?php echo esc_html( $term->name ); ?></h3>
		<?php endforeach; ?>
	</div>
		<?php
	endif;
	return ob_get_clean();
}

add_shortcode( 'single_swim_spas_category_shortcode', 'single_swim_spas_category_shortcode' );

add_shortcode( 'single_swim_spas_shortcode', 'single_swim_spas_shortcode' );

add_shortcode( 'single_swim_spas_pricing_form_shortcode', 'single_swim_spas_pricing_form_shortcode' );
