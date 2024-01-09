<?php

function find_perfect_hottub_regitster_script() {
	wp_register_script('find-perfect-form-script', get_stylesheet_directory_uri() . '/assets/js/perfect-hottub.js', array(), '1.0', true);
	wp_register_style('find-perfect-form-style', get_stylesheet_directory_uri() . '/assets/css/perfect-hottub.css', array(), '1.0', false);
}

function find_perfect_hottub_run_script() {
	wp_enqueue_script('find-perfect-form-script');
	wp_enqueue_style('find-perfect-form-style');
}
add_action('wp_enqueue_scripts', 'find_perfect_hottub_regitster_script');
add_shortcode('find_perfect_hottub', 'find_perfect_hottub_run_script');
