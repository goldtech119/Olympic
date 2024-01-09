<?php
// Shortcode for adding custom CSS code in the header
function find_perfect_hottub_css_func($atts, $content = null) {
	ob_start();
?>
	<style type="text/css">
		<?php echo $content; ?>
	</style>
<?php
	return ob_get_clean();
}
add_shortcode('find_perfect_hottub_css', 'find_perfect_hottub_css_func');

// Shortcode for adding custom JavaScript code in the footer
function find_perfect_hottub_js_func($atts, $content = null) {
	ob_start();
?>
	<script type="text/javascript">
		<?php echo $content; ?>
	</script>
<?php
	return ob_get_clean();
}
add_shortcode('find_perfect_hottub_js', 'find_perfect_hottub_js_func');
