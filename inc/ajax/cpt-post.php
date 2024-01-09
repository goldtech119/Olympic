<?php
global $post;
$total_posts = $args['total_posts'];
?>
<div class="blog-feed__item more-news__item" total-pages="<?php echo esc_attr( $total_posts ); ?>">
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
