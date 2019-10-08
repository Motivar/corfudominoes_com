<?php

if (!defined('ABSPATH')) {
    exit;
}

function sbp_get_posts_constuct($post_type, $exclude = '', $query_attrs = array(), $number = '-1', $meta_on = 1, $remove_meta = 0)
{
/*
developer notices:
$post_type => the post type you want to show
$exlude => post to exclude, either id or array of ids
$query_attrs => extra arguments for get_posts define like this : array('arg'=>'value','arg2'=>'valu2')
$number by default =-1 or yyou put yourself
BRUTE FORCE
https://wpml.org/forums/topic/query-posts-of-a-specific-language/ */
$return = array();
if (!empty($post_type)) {
$general_args = array(
'post_type' => $post_type,
'posts_per_page' => $number,
'post_status' => 'publish',
);
$gereral_args = apply_filters('sbp_get_posts_args_filter', $general_args);
$meta_array = $return = array();
if (!is_array($post_type)) {
$post_type = array($post_type);
}
/*fix what you want to show depending on the post_meta*/
switch ($post_type[0]) {
case 'sbp_services':
$meta_array = array('sbp_gallery', 'sbp_video_online', 'sbp_video', '_sbp_calendar_original', '_sbp_calendar_id', 'sbp_ext_button', 'sbp_ext_url');
break;
case 'sbp_map_points':
$meta_array = array('sbp_distances_array', 'sbp_description', 'sbp_gallery', 'sbp_video_online', 'sbp_video', 'sbp_external_link', 'map_point_target', 'visible_in_front', 'sbp_google_map');
break;
case 'page':
$meta_array = array(
'_thumbnail_id',
);
break;
case 'sbp_package':
$meta_array = array('sbp_description', 'sbp_gallery', '_sbp_calendar_original',
'_sbp_calendar_id');
break;
case 'sbp_travel_services':
$meta_array = array(
'sbp_video',
'sbp_online_video',
'_thumbnail_id',
'dsc_slider_desc_subheader',
'sbp_description',
'sbp_gallery',
'_sbp_calendar_original',
'_sbp_calendar_id',
);
break;
default:
$meta_array = array('_sbp_calendar_original', '_sbp_calendar_id');
break;
}
if (!empty($exclude)) {
if (!is_array($exclude)) {
$exclude = array($exclude);
}
$general_args['post__not_in'] = $exclude;
}
if (!empty($query_attrs)) {
foreach ($query_attrs as $k => $v) {
$general_args[$k] = $v;
}
}
if ($remove_meta == 1) {
$general_args['meta_query'] = array();
}
$posts = get_posts(apply_filters('sbp_get_posts_args_filter', $general_args));
if (!empty($posts)) {
foreach ($posts as $p => $k) {
/*general actions for all post types*/
if (isset($general_args['fields']) && $general_args['fields'] == 'ids') {
$return[$k] = $k;
} else {
$return[$k->ID]['main'] = $k;
$return[$k->ID]['permalink'] = get_post_permalink($k->ID);
if ($meta_on == 1) {
if (!empty($meta_array)) {
foreach ($meta_array as $meta) {
$return[$k->ID]['metas'][$meta] = get_post_meta($k->ID, $meta, true) ?: '';
}
}
}
}
}
}
}
return $return;
}
add_filter('sbp_get_some_posts', 'sbp_get_posts_constuct', 10, 6);

add_filter('filox_settings_meta_taxes_configuration_filter', function ($metas) {
    
    $metas['options']['include']['amount']['type']='text';
    return $metas;

}, 10, 1);

/*
add_filter('sbp_change_tax_amount', function ($amount,$tax, $pricing) {
    //echo $amount;
    switch ($tax['calculation']) {
        case 'product_day':
        foreach ($pricing as $key => $value) {
            $extra_amount = $tax['amount']*$amount;
        }
        //$tax['amount']=$extra_amount;
        $amount=$extra_amount;
        break;
    }
    return $amount;
}, 10, 3);*/

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
