<?php

if (!defined('ABSPATH')) {
    exit;
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('theme_original_style', get_template_directory_uri(__FILE__).'/style.css');
}

add_action('wp_print_scripts', 'deenque_unwanted_scripts', 100);
function deenque_unwanted_scripts()
{
    wp_dequeue_script('map-api');
}

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/*add_filter('sbp_archive_title_section_filter', function($content){
  $default_img = get_field('archives_default_img', 'options') ?: '';


  return "xristos";
},10,1);*/

add_shortcode('home_carousel', function () {
    return do_shortcode('[sbp_carousel post_type="sbp_accommodation" columns="3"  filter="0"]');
});

add_shortcode('home_carousel_amenities', function () {
    return do_shortcode('[sbp_amenities_carousel columns="5" ids="125,66,67,68,77,65,80"]');
});
