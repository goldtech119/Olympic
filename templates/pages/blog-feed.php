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

function blog_feed() {
	ob_start();
	$categories  = get_categories();
	$total_posts = wp_count_posts()->publish;

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$args  = array(
		'post_type'      => 'post',
		'posts_per_page' => 9,
		'paged'          => $paged,
	);
	$query = new WP_Query( $args );
	?>

	<div class="blog-feed-filters" id="blog-filters">
		<div class="filters">
			<div class="filter filter-post">
				<div class="filter-btn button" data-value="categories">CATEGORIES</div>
				<div class="filter-dropdown">
					<p value="categories" class="initial">CATEGORIES</p>
					<?php
					if ( $categories ) :
						foreach ( $categories as $category ) :
							?>
						<p value="<?php echo esc_attr( $category->slug ); ?>" class="option"><?php echo esc_html( $category->name ); ?></p>
							<?php
						endforeach;
					endif;
					?>
				</div>
			</div>
			<div class="filter-search">
                SEARCH
				<div class="filter-search__icon">
					<svg class="tcb-icon" viewBox="0 0 24 24" data-id="icon-magnify-solid" data-name="" style=""><path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path></svg>
				</div>
			</div>
		</div>
		<div class="clear-filter">Clear Filters</div>
	</div>
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
		<?php
		$current_page = max( 1, get_query_var( 'paged' ) );
		$total_pages  = ceil( $total_posts / 9 ); ?>
		<div class="blog-feed-pagination">
			<a href="#blog-filters" class="pagination-cta pagination-prev">Previous</a>
			<div class="blog-paginations">
				<a href="#blog-filters" class="pagination-num active first" page="1">1</a>
				<a href="#blog-filters" class="pagination-num" page="2">2</a>
				<a href="#blog-filters" class="pagination-num" page="3">3</a>
				<span>...</span>
				<a href="#blog-filters" class="pagination-num" page="<?php echo esc_attr( intval($total_posts / 9)); ?>"><?php echo intval($total_posts / 9); ?></a>
				<a href="#blog-filters" class="pagination-num end" page="<?php echo esc_attr( intval($total_posts / 9 + 1)); ?>"><?php echo intval($total_posts / 9 + 1); ?></a>
			</div>
			<a href="#blog-filters" class="pagination-cta pagination-next">Next</a>
		</div>
	</div>
	<?php endif; ?>
	<?php

	wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'blog_feed', 'blog_feed' );
