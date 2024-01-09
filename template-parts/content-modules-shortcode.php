<?php extract( $template_args ); ?>
<?php $val = isset( $v ) && ! empty( $v ) ? $v : 'code'; ?>
<?php $tag = isset( $t ) && ! empty( $t ) ? $t : false; ?>
<?php $tclass = isset( $tc ) && ! empty( $tc ) ? $tc : ''; ?>
<?php $option = isset( $o ) && ! empty( $o ) ? $o : false; ?>

<?php
if ( 'o' == $option ) {
	$code = get_field( $val, 'option' );
} elseif ( 'f' == $option ) {
	$code = get_field( $val );
} else {
	$code = get_sub_field( $val );
}
?>
 
<?php if ( $code ) : ?> 
	<?php if ( $tag ) : ?>
		<<?php echo esc_attr( $tag ); ?> <?php
		if ( $tclass ) {
			echo 'class="' . esc_attr( $tclass ) . '"'; }
		?>
		>
	<?php endif ?>
	<?php
		// code may contain other HTML tags, so ignore escaping validation here.
		echo do_shortcode( $code );
	?>
	<?php if ( $tag ) : ?>
		</<?php echo esc_attr( $tag ); ?>>
	<?php endif ?>
<?php endif; ?>
