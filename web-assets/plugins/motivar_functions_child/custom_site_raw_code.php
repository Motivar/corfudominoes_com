<?php

if (!defined('ABSPATH')) {
    exit;
}


add_filter('sbp_accommodation_booking_fields_filter', function ($msg) {

    $msg['sbp_arrival_time']['class']= array('sbp_req_for_save', 'sbp_frontend_req');
    $msg['sbp_flight_number'] = array(
       'label' => __('Flight Number', 'motivar'),
       'case' => 'input',
       'type' => 'text',
       'attributes' => array('placeholder' => sbp_fill_in.' '.sbp_Flight_Number),
               'class' => array('sbp_req_for_save', 'sbp_frontend_req'),
               'sbp_show_widget' => false,
               'sbp_show_in_extras' => true,
               'label_class'=>array('dominoes-custom')
   );

    return $msg;
}, 10, 1);

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
