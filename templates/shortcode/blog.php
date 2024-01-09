<?php
/**
 * Theme Blog shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return void
  */

function more_news() {
	ob_start();
	$args  = array(
		'post_type'      => 'post',
		'posts_per_page' => '3',
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) : ?>
	<div class="more-news">
		<?php
		while ( $query->have_posts() ) :
				$query->the_post();
			?>
			<div class="more-news__item">
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="more-news__item__image"><?php the_post_thumbnail(); ?></div>
				<?php endif; ?>
				<h5 class="more-news__item__title"><?php the_title(); ?></h5>
				<!-- <div class="more-news__item__content"><?php the_content(); ?></div> -->
				<a href="<?php the_permalink(); ?>" class="more-news__item__cta text-upper">Read More</a>
			</div>
		<?php endwhile; ?>
	</div>
	<a href="/about/news/" class="btn btn-trans-blue see-more-news text-upper">See more news</a>
		<?php
	endif;
	wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'more_news', 'more_news' );