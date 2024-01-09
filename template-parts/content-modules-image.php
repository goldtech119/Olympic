<!-- content-modules-image -->
<?php extract( $template_args ); ?>
<?php
	$val = isset( $v ) && ! empty( $v ) ? $v : 'image';
if ( isset( $v ) && ! empty( $v ) ) {
	if ( false === $v2x ) {
		$val2x = false;
	} else {
		$val2x = isset( $v2x ) && ! empty( $v2x ) ? $v2x : $val;
	}
} else {
	$val2x = 'image_2x';
}

	$image_size    = isset( $is ) && ! empty( $is ) ? $is : false;
	$image_size_2x = isset( $is_2x ) && ! empty( $is_2x ) ? $is_2x : $image_size . '-2x';

	$class = isset( $c ) && ! empty( $c ) ? $c : '';
?>
<?php $option = isset( $o ) && ! empty( $o ) ? $o : false; ?>
<?php $ww = isset( $w ) && ! empty( $w ) ? $w : false; ?>
<?php $wclass = isset( $wc ) && ! empty( $wc ) ? $wc : ''; ?>
<?php
if ( 'o' == $option ) {
	$image    = get_field( $val, 'option' );
	$image_2x = get_field( $val2x, 'option' );
} elseif ( 'f' == $option ) {
	$image    = get_field( $val );
	$image_2x = get_field( $val2x );
} else {
	$image    = get_sub_field( $val );
	$image_2x = get_sub_field( $val2x );
}
?>
<?php if ( false == $is && false == $is_2x ) : ?>
	<?php if ( ! empty( $image ) ) : ?>
		<?php if ( $ww ) : ?>
			<<?php echo esc_attr( $ww ); ?> <?php
			if ( $wclass ) {
				echo 'class="' . esc_attr( $wclass ) . '"'; }
			?>
			>
		<?php endif ?>
			<?php $bg_url = $image['url']; ?>
			<?php $bg_url_2x = $image['url']; ?>
			<?php if ( false === $val2x ) : ?>
					<img class="<?php echo esc_attr( $class ); ?>" src="<?php echo esc_url( $bg_url ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
			<?php else : ?>	
					<img class="<?php echo esc_attr( $class ); ?>" src="<?php echo esc_url( $bg_url ); ?>" srcset="<?php echo esc_url( $bg_url_2x ); ?> 2x" alt="<?php echo esc_attr( $image['alt'] ); ?>" loading="lazy">
			<?php endif ?>
		<?php if ( $ww ) : ?>
			</<?php echo esc_attr( $ww ); ?>>
		<?php endif; ?>
	<?php endif; ?>
<?php else : ?>	
	<?php if ( ! empty( $image ) ) : ?>
		<?php if ( $ww ) : ?>
			<<?php echo esc_attr( $ww ); ?> <?php
			if ( $wclass ) {
				echo 'class="' . esc_attr( $wclass ) . '"'; }
			?>
			>
		<?php endif ?>
			<?php $bg_url = $image['sizes'][ $image_size ]; ?>
			<?php $bg_url_2x = $image['sizes'][ $image_size_2x ]; ?>
				<img class="<?php echo esc_attr( $class ); ?>" 
					src="<?php echo esc_url( $bg_url ); ?>" 
					<?php
					if ( $bg_url_2x ) :
						?>
						srcset="<?php echo esc_url( $bg_url_2x ); ?> 2x"<?php endif; ?>
					alt="<?php echo esc_attr( $image['alt'] ); ?>"
					loading="lazy">
		<?php if ( $ww ) : ?>
			</<?php echo esc_attr( $ww ); ?>>
		<?php endif; ?>
	<?php endif; ?>
<?php endif ?>
