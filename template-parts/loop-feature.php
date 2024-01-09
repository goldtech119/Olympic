<?php
global $post;
$image = get_field( 'feature-single-image' );
$image_slider = get_field( 'image_slider' );
?>
<article class="loop-feature">
    <?php
    get_template_part_args(
        'template-parts/content-modules-text',
        array(
            'v'  => 'feature-body',
            'o'  => 'f',
            't'  => 'div',
            'tc' => 'loop-feature__body'
        )
    );
    ?>
    <div class="loop-feature__image">
        <?php if ( $image ) : ?>
        <img src="" alt="<?php echo esc_url( $image['url'] ); ?>">
        <?php elseif ( $image_slider ) : ?>
        <img src="" alt="<?php echo esc_url( $image_slider[0]['url'] ); ?>">
        <?php endif; ?>
    </div>
    <div class="loop-feature__name">
        <?php
        get_template_part_args(
            'template-parts/content-modules-text',
            array(
                'v'  => 'feature-name',
                'o'  => 'f',
                't'  => 'h5',
                'tc' => 'loop-feature__name'
            )
        );
        ?>
    </div>
</article>
