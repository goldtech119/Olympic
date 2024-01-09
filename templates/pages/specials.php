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

function specials_promotion( $atts = '10' ) {
	ob_start();
    // Extract and process the parameters
	$parameters = shortcode_atts(
		array(
			'parameter' => '10'
		),
		$atts
	);
	// Access the parameter value
	$parameter_value = $parameters['parameter'];

    $args = array(
        'post_type' => 'promotion',
        'posts_per_page' => $parameter_value // Retrieve all posts
    );
    
    $ind   = 0;
    $query = new WP_Query($args);
    if ( $query->have_posts() ) : ?>
        <div class="specials-promotion">
            <?php while ( $query->have_posts() ) : 
                $query->the_post();
                global $post;
                $ind ++;
                if ( $ind == 1 )
                    $class = 'specials-promotion__item' . (($ind == 1) ? ' specials-promotion__item__big__first' : '');
                else if ($ind == 6)
                    $class = 'specials-promotion__item' . (($ind == 6) ? ' specials-promotion__item__big' : '');
                else $class = 'specials-promotion__item';
                ?>
            <div class="<?php echo esc_attr( $class ); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="item-image"><?php the_post_thumbnail(); ?></div>
                <?php endif; ?>
                <div class="item-info">
                    <h2 class="item-title"><?php the_title(); ?></h2>
                    <a href="<?php the_permalink(); ?>" class="item-cta text-upper btn">Learn More</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'specials_promotion', 'specials_promotion' );
