<?php
/**
 * Page Template Specials shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return
  */

function locations_all() {
	ob_start();
	$args  = array(
		'post_type'      => 'location',
		'posts_per_page' => -1, // Retrieve all posts
		'orderby'        => 'date',
		'order'          => 'ASC',
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) : ?>
		<div class="locations">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				global $post;
				$info = get_field( 'intro_info' );
				?>
				<a  href="<?php the_permalink(); ?>" class="locations-item">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="item-image"><?php the_post_thumbnail(); ?></div>
					<?php endif; ?>
					<div class="item-content">
						<h5 class="item-title"><?php the_title(); ?></h5>
						<p class="item-info"><?php echo nl2br( $info ); ?></p>
						<button class="text-upper">See Map</button>
					</div>
				</a>
			<?php endwhile; ?>
		</div>
		<?php
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'locations_all', 'locations_all' );
