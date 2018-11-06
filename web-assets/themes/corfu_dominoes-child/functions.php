<?php
if (!defined('ABSPATH')) exit;
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
wp_enqueue_style('theme_original_style', get_template_directory_uri( __FILE__ ) . '/style.css');
}

add_action( 'wp_print_scripts', 'deenque_unwanted_scripts', 100 );
function deenque_unwanted_scripts()
{
wp_dequeue_script( 'map-api' );
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

