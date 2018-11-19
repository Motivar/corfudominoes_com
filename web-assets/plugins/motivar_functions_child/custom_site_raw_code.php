<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_init', function () {
    if (current_user_can('administrator')) {
        if (function_exists('acf_add_options_page')) {
            $option_page1 = acf_add_options_page(array(
            'page_title' => 'General Options',
            'menu_title' => 'General Options',
            'menu_slug' => 'mtv_general_options',
            'capability' => 'read',
            'redirect' => false,
        ));
        }
    } else {
    }
}, 10, 1);

function custom_menu_page_removing()
{
    if (!current_user_can('administrator')) {
        remove_menu_page('toplevel_page_wpcf7');
    }
}
add_action('admin_menu', 'custom_menu_page_removing');

add_filter('sbp_services_availability_fields_filter', function ($metas) {
    $metas['_child'] = array(
        'label' => __('Child Price', 'simple-bookings-plugin'),
        'case' => 'input',
        'type' => 'number',
        'class' => array(
            'sbp_req',
        ),
        'attributes' => array(
            'min' => 0,
            'data-key' => 'child',
            'data-thesis' => 2,
        ),
    );

    return $metas;
}, 10, 1);
