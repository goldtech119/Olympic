<?php
$image = $args['image'];
$video = $args['video'];
$url   = key_exists('url', $args) ? $args['url'] : null;
$class = $args['class'];
$size  = key_exists('size', $args) ? $args['size'] : null;
$cont  = key_exists('control', $args) ? $args['control'] : true;

if ( $image ) :
    if ( $size ) :
        $bg_url    = $image['sizes'][$size];
        $bg_url_2x = $image['sizes'][$size . '-2x'];
    else :
        $bg_url    = $image['url'];
    endif;
endif;
if ( $url ) : ?>
    <video
        id="video-player"
        muted 
        autoplay
        <?php echo $cont ? 'controls' : ''; ?>
        loop
        playsinline
        src="<?php echo esc_url( $url ); ?>" 
        class="video-player"> 
    </video>
<?php elseif ( $video ) : ?>
    <video class="<?php echo esc_attr( $class ); ?>" src="<?php echo esc_url( $video ); ?>" muted playsinline loop <?php echo $cont ? 'controls' : ''; ?> <?php echo $image ? 'poster="' . $image['url'] . '"' : ''; ?>>
        <source src="<?php echo esc_url( $video ); ?>" type="video/mp4">
    </video>
<?php elseif ( $image ) : ?>
    <img src="<?php echo esc_url( $bg_url ); ?>" 
        alt="<?php echo esc_attr( $image['alt'] ); ?>"
        class="<?php echo esc_attr( $class ); ?>">
<?php endif; ?>