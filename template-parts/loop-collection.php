<?php
global $post;
$terms = get_the_terms( $post->ID, 'collection_cat' );
?>

<article class="loop-collection">
    <a href="<?php the_permalink(); ?>">
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="loop-collection__image">
            <?php the_post_thumbnail(); ?>
            <h5 class="loop-collection__title"><?php the_title(); ?></h5>
        </div>
        <?php endif; ?>
        <?php if ( $terms ) : ?>
        <div class="loop-collection__watermark">
            <img src="/wp-content/themes/olympic/assets/img/salt-system.png" alt="salt png">
        </div>
        <?php endif; ?>
        <div class="loop-collection__content"><?php the_excerpt(); ?></div>
    </a>
</article>