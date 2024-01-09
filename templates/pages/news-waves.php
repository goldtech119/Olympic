<?php
/**
 * Theme Blog Feed Page shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return void
  */

function news_waves() {
	ob_start();
	$categories  = get_categories();
	$total_posts = wp_count_posts()->publish;

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args  = array(
		'post_type'      => 'newswaves',
		'posts_per_page' => -1,
		'paged'          => $paged,
	);
	$query = new WP_Query( $args );
	?>

	<?php if ( $query->have_posts() ) : ?>
	<div class="blog-feed-news">
		<div class="container more-news cpt-list"
				data-cat=""
				data-post-type="post" 
				data-paged="1" 
				data-search="" 
				total-pages="<?php echo esc_attr( $total_posts ); ?>"
				data-posts-per-page="9">
			<?php
			while ( $query->have_posts() ) :
				$query->the_post();
				?>
				<div class="blog-feed__item more-news__item">
					<a href="<?php the_permalink(); ?>"  class="blog-feed__item__image more-news__item__image">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
						?>
					</a>
					<a href="<?php the_permalink(); ?>"  class="blog-feed__item__title more-news__item__title"><?php the_title(); ?></a>
					<div class="blog-feed__item__content more-news__item__content"><?php the_content(); ?></div>
					<a href="<?php the_permalink(); ?>" class="blog-feed__item__cta more-news__item__cta text-upper">Read More</a>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
	<?php

	wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'news_waves', 'news_waves' );
