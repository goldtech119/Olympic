<?php
/**
 * Page Template Brand shortcodes
 *
 * @package ThriveThemeChild
 */

 /**
  * Load child theme css and optional scripts
  *
  * @return
  */

function about_leadership_team() {
	ob_start();
    $args = array(
        'post_type' => 'leadership',
        'posts_per_page' => -1, // Retrieve all posts
    );
    
    $query = new WP_Query($args);
    if ( $query->have_posts() ) : ?>
        <div class="leadership-team">
            <?php while ( $query->have_posts() ) : 
                $query->the_post();
                global $post; ?>
            <div class="leadership-team__item">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="leadership-team__item__image"><?php the_post_thumbnail(); ?></div>
                <h5 class="leadership-team__item__title"><?php the_title(); ?></h5>
                <?php endif; 
                    $phone = get_field( 'phone_number' );
                    $email = get_field( 'email' );
                    $cta_1 = get_field( 'cta1' );
                    $cta_2 = get_field( 'cta2' );
                    $cta_3 = get_field( 'cta3' );
                ?>
                <div class="leadership-modal">
                    <div class="leadership-modal__content">
                        <div class="leadership-modal__image"><?php echo the_post_thumbnail(); ?></div>
                        <div class="leadership-modal__data">
                            <h3 class="leadership-modal__title">My name is <?php echo the_title(); ?></h3>
                            <div class="leadership-modal__description"><?php echo the_content(); ?></div>
                            <h5 class="leadership-modal__phone">Office: <?php echo esc_html( $phone ); ?></h5>
                            <h5 class="leadership-modal__email"><?php echo esc_html( $email ); ?></h5>
                            <ul class="leadership-modal__social">
                                <li class="leadership-modal__social__item"><a href="<?php esc_attr( $cta_1 ); ?>" class="leadership-modal__social__item__link"><svg class="tcb-icon" viewBox="0 0 576 512" data-id="youtube" data-name=""> <path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"></path> </svg></a></li>
                                <li class="leadership-modal__social__item"><a href="<?php esc_attr( $cta_2 ); ?>" class="leadership-modal__social__item__link"><svg class="tcb-icon" viewBox="0 0 512 512" data-id="icon-facebook-brands" data-name=""><path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg></a></li>
                                <li class="leadership-modal__social__item"><a href="<?php esc_attr( $cta_3 ); ?>" class="leadership-modal__social__item__link"><svg class="tcb-icon" viewBox="0 0 448 512" data-id="instagram" data-name=""> <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path> </svg></a></li>
                            </ul>
                        </div>
                        <div class="close"></div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata();
	return ob_get_clean();
}

add_shortcode( 'about_leadership_team', 'about_leadership_team' );
