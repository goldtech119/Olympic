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

function career_sub_page_content() {
	ob_start();
    if ( have_rows( 'modules' ) ) : 
        while ( have_rows( 'modules' ) ) :
            the_row();
            if ( 'text_block' == get_row_layout() ) : 
                get_template_part_args(
                    'template-parts/content-modules-text',
                    array(
                        'v'  => 'text',
                        'w'  => 'div',
                        'wc' => 'career-sub-page__text'
                    )
                );
                
             endif; 
        endwhile; ?>
        <?php while ( have_rows( 'modules' ) ) :
            the_row();
            if ( 'button' == get_row_layout() ) : ?>
                <a href="mailto:hr@olympichottub.com" class="career-sub-page__submit text-upper">Submit Resume</a>
            <?php endif; 
        endwhile;
        ?>
        <p class="career-sub-page__ready">Ready for success?</p>
        <?php while ( have_rows( 'modules' ) ) :
            the_row();
            if ( 'form' == get_row_layout() ) : ?>
                <h2 class="career-sub-page__apply">Apply Now</h2>
                <?php $shortcode = get_sub_field( 'form' );
                echo do_shortcode( $shortcode );
             endif; 
        endwhile;
    endif;
    
	return ob_get_clean();
}

add_shortcode( 'career_sub_page_content', 'career_sub_page_content' );
