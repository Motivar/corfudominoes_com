<?php

if (!defined('ABSPATH')) {
    exit;
}

add_shortcode('motivar_social_icons', 'motivar_social_icons_functions');

function motivar_social_icons_functions($atts)
{
    $plugin_dir = plugin_dir_url(__FILE__);
    /*wp_enqueue_script('sbp-materialize-js', $plugin_dir . '/materialize/materialize.min.js', array(), false, true);
    wp_enqueue_style('sbp-materialize-css', $plugin_dir . '/materialize/materialize.css', true, '1.0.0');*/
    $msg = '';
    /*fix the paths*/
    $url = plugin_dir_url(__FILE__).'media/';
    $path = plugin_dir_path(__FILE__).'media/';
    extract(shortcode_atts(array(
                 'color' => '',
                 'pinterest' => '',
                 'tripadvisor' => '',
                 'facebook' => '',
                 'googleplus' => '',
                 'instagram' => '',
        ), $atts));
    $kk = 0; /*checker to have the righ margin between divs*/
    $info = get_bloginfo('description');
    foreach ($atts as $k => $v) {
        switch ($k) {
        case 'color':
            break;
        default:
        $file = $path.$k.'-'.$color.'.png';
        $file_url = $url.$k.'-'.$color.'.png';
        /*check if file exists and if url is valid*/
            if (file_exists($file) && !filter_var($v, FILTER_VALIDATE_URL) === false) {
                ++$kk;
                $msg .= '<div class="icon"><a href="'.$v.'" target="_blank"><img src="'.$file_url.'" alt=" '.$info.' '.$k.'" title="'.$info.' '.ucfirst($k).' "/></a></div>';
            }
            break;
    }
    }

    if ($kk > 0) { /*enable the wrpper with the margin*/
        $msg = '<div class="tocopy" data-to="#sb-slidebar-content .mr_copied"><div class="motivar-social-wrapper">'.$msg.'</div></div>';
    }

    return $msg;
}

add_shortcode('gftr', 'gftr_scd');

function gftr_scd($atts)
{
    $carousel_button_url = sbp_booking_post_url;
    extract(shortcode_atts(array(
                'post_id' => '',
                'post_type' => 'sbp_accommodation,sbp_package',
                'carousel_headline' => 'Explore our Rooms &amp; Packages',
                'carousel_button_url' => $carousel_button_url,
                'amenities_bg_img' => '371',
                'amenities_headline' => 'Great Facilities &amp; Services',
                'amenities_button_url' => 508,
                'exclusive_offers_headline' => 'Get Your Holiday Gift',
                'exclusive_small_line' => 'Subscribe in our guest lists and get <strong>10% discount and special travel offers</strong> for the upcoming season',
                'carousel_flag' => '0',
                'amenities_flag' => '0',
                'subscribe_flag' => '0',
        ), $atts));

    /*$amenities_button_txt =  __( 'Learn More', 'sbp_amenities_btn_txt' );*/
    $carousel_button_txt = __('Book Now', 'sbp_carousel_btn_txt');

    $msg = '';

    switch ($carousel_flag) {
                case '1':
                        $button_code = '';
                        if (sbp_booking_post_url != '') {
                            $carousel_button_url = sbp_booking_post_url;
                            $button_code = '[row row_class= "long_button"][one_col][button button_text= "'.$carousel_button_txt.'" icon_alignment= "left" url= "'.$carousel_button_url.'" new_tab= "no" type= "medium" alignment= "center" bg_color= "#fe6847" hover_bg_color= "#3d92c3" color= "#ffffff" hover_color= "#ffffff" border_width= "1" border_color= "#fe6847" hover_border_color= "#3d92c3" button_style= "none" background_animation= "bg-animation-none" animation_type= "fadeIn"][/one_col][/row]';
                        }
                        $msg .= do_shortcode('[section bg_color= "#fefcfb" bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_animation= "none" padding_top= "0" padding_bottom= "82" full_screen_header_scheme= "background--light"][row][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" padding_value= "%" animate_overlay= "none" vertical_align= "middle" animation_type= "flipInX" column_class="motivar-text-block,motivar-center"][text wrap_alignment= "center" scroll_to_animate= "1" animate= "1" animation_type= "fadeIn" ]<h1>'.$carousel_headline.'</h1>[/text][/one_col][/row][row][one_col][text wrap_alignment= "center" animation_type= "fadeIn" ][sbp_carousel post_type="sbp_accommodation" taxonomy="sbp_accommodation_type" limit="20" current_post="'.$post_id.'"][/text][/one_col][/row]'.$button_code.'[/section]');
                        break;

                default:
                        break;
        }

    switch ($amenities_flag) {
                case '1':
                /*
                        $button_code = '';
                        if(get_post_status($amenities_button_url) =='publish'){
                            $amenities_button_url=get_permalink($amenities_button_url);
                            $button_code = '[row row_class= "long_button"][one_col][button button_text= "'.$amenities_button_txt.'" icon_alignment= "left" url= "' . $amenities_button_url . '" new_tab= "no" type= "medium" alignment= "center" bg_color= "#fe6847" hover_bg_color= "#3d92c3" color= "#ffffff" hover_color= "#ffffff" border_width= "1" border_color= "#fe6847" hover_border_color= "#3d92c3" button_style= "none" background_animation= "bg-animation-none" animation_type= "fadeIn"][/one_col][/row]';
                        }
                */
                        $msg .= do_shortcode('[section bg_image= "'.$amenities_bg_img.'" bg_repeat= "no-repeat" bg_attachment= "fixed" bg_position= "center center" bg_stretch= "1" bg_animation= "be-bg-parallax" overlay_color= "#0f084b" overlay_opacity= "70" section_id= "amenities_section" full_screen_header_scheme= "background--dark"][row][one_col][text wrap_alignment= "center" animation_type= "fadeIn" ]<h2 style="text-align: center;">'.$amenities_headline.'</h2>[/text][/one_col][/row][row][one_col][text  wrap_alignment= "center" animation_type= "fadeIn" ][sbp_amenities_carousel columns="5" ids="125,66,67,68,77,65,80"][/text][/one_col][/row][/section]');
                        break;

                default:
                        break;
        }

    /* shortcode for exclussive offers
    switch ( $subscribe_flag ) {
            case '1':
                    $msg .= do_shortcode( '[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_animation= "none" padding_top= "0" padding_bottom= "0" section_id= "motivar_subscribe" full_screen_header_scheme= "background--light"][row][one_col][text wrap_alignment= "center" scroll_to_animate= "1" animate= "1" animation_type= "fadeIn" ][exclusive_offers_content header="' . $exclusive_offers_headline . '" small_line="' . $exclusive_small_line . '"][/text][/one_col][/row][/section]' );
                    break;

            default:
                    break;
    }*/

    return $msg;
}

/*shortcode to show sidebar card*/
add_shortcode('card_sidebar_content', 'card_sidebar_content_function');

function card_sidebar_content_function($atts)
{
    extract(shortcode_atts(array(
                 'menu' => '',
        ), $atts));
    $msg = '<div class="sbp_cnt_div hoverable row rooms_page_facilities_container">
                            <div class="card sbp_main_color">
                                  <div class="content sbp_content_padding">';
    if ($menu != '') {
        $menu = explode(',', $menu);
        foreach ($menu as $m) {
            $menus = wp_nav_menu(array(
                                 'menu' => $m,
                                'echo' => false,
                        ));
            $menu_name = wp_get_nav_menu_object($m);
            $msg .= '<div class="sbp-menu-wrap"><h4 class="sbp_secondary_text_color">'.$menu_name->name.'</h4><div class="sbp_secondary_text_color">'.$menus.'</div></div>';
        }
    }

    $msg .= '</div></div></div>';

    return $msg;
}

add_shortcode('accordion_scd', 'accordion_scd_func');

function accordion_scd_func($atts)
{
    extract(shortcode_atts(array(
                 'post_type' => 'sbp_review',
        ), $atts));
    $accordion_args = array(
                 'post_type' => $post_type,
                'posts_per_page' => '-1',
                'post_status' => 'publish',
        );
    $accordion_posts = get_posts($accordion_args);
    $msg = '';
    $element = '';
    switch ($post_type) {
                case 'sbp_review':
                        foreach ($accordion_posts as $p) {
                            $id = $p->ID;
                            $title = $p->post_title;
                            $description = get_post_meta($id, 'sbp_review_text', true);
                            $grade = get_post_meta($id, 'sbp_grade', true);
                            $review_link = get_post_meta($id, 'sbp_review_link', true);
                            $ota = get_the_terms($id, 'sbp_review_ota', true);
                            $related_ota = $ota[0]->name;
                            $element .= do_shortcode('[toggle title= "'.$title.'" title_color= "#2b313e" title_bg_color= "#fafbfd" ]'.$description.'<p class="review_link"><a href="'.$review_link.'" target="_blank">'.$related_ota.': '.$grade.'</a></p>[/toggle]');
                        }

                        break;

                case 'sbp_careers':
                        if (!empty($accordion_posts)) {
                            foreach ($accordion_posts as $p) {
                                $id = $p->ID;
                                $title = $p->post_title;
                                $description = get_post_meta($id, 'job_desc', true);
                                $location = get_post_meta($id, 'job_loc', true);
                                $reqs_number = get_post_meta($id, 'job_reqs', true);
                                $benefits_number = get_post_meta($id, 'job_bens', true);

                                for ($i = 0; $i < $reqs_number; ++$i) {
                                    $job_req = get_post_meta($id, 'job_reqs_'.$i.'_job_req', true);
                                    $req_content .= $job_req.'<br/>';
                                }

                                for ($i = 0; $i < $benefits_number; ++$i) {
                                    $job_ben = get_post_meta($id, 'job_bens_'.$i.'_job_ben', true);
                                    $ben_content .= $job_ben.'<br/>';
                                }
                                $description_text = __('Description:', 'sbp_career_description_txt');
                                $location_text = __('Location:', 'sbp_career_location_txt');
                                $job_reqs_text = __('Job Requirements:', 'sbp_career_job_reqs_txt');
                                $job_bens_text = __('Job Benefits:', 'sbp_career_job_bens_txt');

                                $element .= do_shortcode('[toggle title= "'.$title.'" title_color= "#2b313e" title_bg_color= "#fafbfd" ]<div class="career_div"><div class="career_desc"><h6>'.$description_text.'</h6><p>'.$description.'</p></div><div class="career_loc"><h6>'.$location_text.'</h6><p>'.$location.'</p></div><div class="career_reqs"><h6>'.$job_reqs_text.'</h6><p>'.$req_content.'</p></div><div class="career_bens"><h6>'.$job_bens_text.'</h6><p>'.$ben_content.'</p></div></div>[/toggle]');
                            }
                        } else {
                            $empty_jobs_msg = __('<h4>There are no job openings right now.</h4>', 'sbp_no_jobs_msg');
                            $msg .= $empty_jobs_msg;
                        }

                        break;

                default:

                        // code...

                        break;
        }

    if (!empty($element)) {
        $msg .= do_shortcode('[accordion collapsed= "0"]'.$element.'[/accordion]');
    }

    return $msg;
}

add_shortcode('no_builder_page_scd', 'no_builder_page');

function no_builder_page($atts)
{
    extract(shortcode_atts(array(
                 'post_type' => '',
                'post_id' => '',
                'type' => '',
                'target_id' => '',
                'category_id' => '',
                'show_near_places' => '0',
                'categories' => '',
                'limit' => '',
                'sbp_marker_from' => '',
                'sbp_marker_to' => '',
                'sbp_custom_from' => __('Directions from', 'sbp_custom_from'),
                'sbp_custom_to' => __(' to', 'sbp_custom_to'),
        ), $atts));
    $description = get_post_meta($post_id, 'sbp_description', true);
    $msg = '';
    $images = get_post_meta($post_id, 'sbp_gallery', true);
    if ($type == 'map') {
        wp_enqueue_script('sbp-gmap-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBCX2L33Ptp0khSyU0wOJmRLG2GhnYKwTw');
        $center_title = get_the_title($target_id);
        $gmap_array = get_post_meta($target_id, 'sbp_google_map', true);
        $address = $gmap_array['address'];
        $latitude = $gmap_array['lat'];
        $longtitude = $gmap_array['lng'];
        $icon = '';

        $args = array(
                    'post_type' => 'sbp_ownership',
                    'numberposts' => '-1',
                    'post_status' => 'publish',
                    'fields' => 'ids',
                    'meta_query' => array(
                        array(
                            'key' => 'mp_id',
                            'value' => $target_id,
                            'compare' => '=',
                        ),
                    ),
                    );
        $connected_ownership = get_posts($args);
        $icon_id = get_post_meta($connected_ownership[0], 'map_point_icon', true);
        $icon = wp_get_attachment_url($icon_id);
        /*Map Card Start*/
        $msg .= '<div class="corfu sbp_cnt_div sbp_hoverable sbp_page_img_container right_sidebar">
                              <div class="sbp_style_card">';
        $sbp_marker_to_i = $sbp_marker_to != '' ? wp_get_attachment_url($sbp_marker_to) : '';
        $sbp_marker_from_i = $sbp_marker_from != '' ? wp_get_attachment_url($sbp_marker_from) : '';
        $msg .= '<div class="sbp_map_container dmn_map" data-direction="0" data-lat="" data-lon="" data-target_lon="'.$longtitude.'" data-target_lat="'.$latitude.'" id="sbp_map" data-icon="'.$icon.'" data-rest=""></div>';
        $msg .= '</div></div>';

    /*Map Card End*/
    } else {
        /*Image Card Start*/
        $msg .= '<div class="corfu sbp_cnt_div sbp_hoverable sbp_img_carousel sbp_page_img_container right_sidebar" data-columns="1">';
        foreach ($images as $img_id) {
            $alt_text = motivar_img_alt_text($img_id);
            $img = wp_get_attachment_image_src($img_id, 'medium_large');
            $msg .= '<div class="sbp_view_card_style">
                              <div class="sbp_style_card">
                                <div class="sbp_card-image">
                                      <img src="'.$img[0].'" alt="'.$alt_text.'">
                                </div>
                              </div>
                </div>';
        }

        $msg .= '</div>';
    }

    /*Image Card End*/
    /*Description Card Start*/
    if (!empty($description)) {
        $msg .= '<div class="sbp_cnt_div sbp_hoverable right_sidebar">
                <div class="sbp_style_card">
                    <div class="sbp_content sbp_content_padding"><h4>'.__('Description', 'sbp_description_title').'</h4>
                        <p>'.$description.'</p></div>
                </div>
            </div>';
    }

    /*Description Card End*/
    /*Nearest Places Card Start*/
    if ($show_near_places == '1') {
        $distance_array = get_post_meta($target_id, 'sbp_distances_array', true);
        $msg .= '<div class="sbp_cnt_div sbp_hoverable sbp_page_description_container right_sidebar">
                    <div class="sbp_style_card">
                        <div class="sbp_content sbp_content_padding"><h4>'.__('Nearest Places', 'sbp_description_title').'</h4><p>';
        $categories = explode('-', $categories);
        $counter = 0;
        foreach ($distance_array as $key => $value) {
            $visibility_flag = get_post_meta($key, 'visible_in_front', true);
            if ($visibility_flag == 1 && $counter < $limit) {
                $element_categories = $value['categories'];
                $element_categories = explode('-', $element_categories);
                $array = array_intersect($categories, $element_categories);
                if (!empty($array)) {
                    $msg .= '<div class="sbp_area_desc">';
                    $title = get_the_title($key);
                    $distance = $value['distance'];
                    $est_time = $value['time'];
                    $latitude_to = $value['latitude'];
                    $longtitude_to = $value['longtitude'];
                    $description = get_post_meta($key, 'sbp_description', true);
                    $msg .= '<a class="map_link" data-point_lat="'.$latitude.'" data-point_lng="'.$longtitude.'" data-lat="'.$latitude_to.'" data-lng="'.$longtitude_to.'" data-from_title="'.$center_title.'" data-to_title="'.$title.'"><h5>'.$title.'</h5></a>';
                    if (!empty($description)) {
                        $msg .= $description;
                    }

                    $msg .= '<div class="directions"><span>'.__('Distance', 'sbp_distance_title').':</span> '.round($distance, 2).' Km | <span>'.__('Est. Driving Time', 'sbp_driving_time').':</span> '.$est_time.'<br/><a class="map_link" data-point_lat="'.$latitude.'" data-point_lng="'.$longtitude.'" data-lat="'.$latitude_to.'" data-lng="'.$longtitude_to.'"  data-from_title="'.$center_title.'" data-to_title="'.$title.'" >'.__('Show in Map', 'sbp_show_in_map').'</a></div>';
                    $counter = $counter + 1;
                    $msg .= '</div>';
                }
            }
        }

        $msg .= '</div></div></div>';
    }

    /*Nearest Places Card End*/
    return $msg;
}

add_shortcode('optgroup_fetch', 'optgroup_fetch_func');

function optgroup_fetch_func($atts)
{
    $plugin_dir = plugin_dir_url(__FILE__);

    wp_enqueue_script('sbp-materialize-js', $plugin_dir.'/materialize/materialize.min.js', array(), false, true);
    wp_enqueue_style('sbp-materialize-css', $plugin_dir.'/materialize/materialize.css', true, '1.0.0');
    wp_enqueue_style('mtv-tel-input-css', $plugin_dir.'../../motivar_functions/libraries/tel-input/intlTelInput.css', true, '1.0.0');
    wp_enqueue_script('mtv-tel-input-js', $plugin_dir.'../../motivar_functions/libraries/tel-input/intlTelInput.min.js', array(), false, true);

    sbp_dynamic_scripts(array('tel-input'), 'guest');
    /* Import files for countries*/

    extract(shortcode_atts(array(
                 'post_type' => 'sbp_accommodation, sbp_package',
                'categories' => '',
        ), $atts));
    $post_type = str_replace(' ', '', $post_type);
    $post_type = explode(',', $post_type);
    $msg = '';
    if (isset($_GET['from_post'])) {
        $from_post = $_GET['from_post'];
        $msg .= '<div class="from_post">'.$from_post.'</div>';
    }

    switch ($post_type[0]) {
                case 'sbp_services':
                        $args = array();
                        if ($categories != '') {
                            $args['include'] = $categories;
                        }
                        $services = get_terms('sbp_service_category', $args);
                        foreach ($services as $s) {
                            $id = $s->term_id;
                            $taxonomy_name = $s->name;
                            $posts = get_posts(array(
                                         'post_type' => 'sbp_services',
                                        'numberposts' => -1,
                                        'meta_query' => array(
                                                 array(
                                                         'key' => 'sbp_ext_button',
                                                        'value' => '2',
                                                        'compare' => '=',
                                                ),
                                        ),
                                        'tax_query' => array(
                                                 array(
                                                         'taxonomy' => 'sbp_service_category',
                                                        'field' => 'id',
                                                        'terms' => $s->term_id,
                                                ),
                                        ),
                                ));
                            if (!empty($posts)) {
                                if ($id == 29) {
                                    $events .= '<optgroup label="'.$taxonomy_name.'">';
                                    foreach ($posts as $p) {
                                        $post_title = $p->post_title;
                                        $post_id = $p->ID;
                                        $image = get_post_meta($post_id, 'sbp_gallery', true);
                                        $featured_img_id = $image[0];
                                        $img_url = wp_get_attachment_image_src($featured_img_id, 'thumbnail');
                                        $img = $img_url[0];
                                        $events .= '<option data-icon="'.$img.'" class="circle '.$post_id.'">'.$post_title.'</option>';
                                    }
                                    $events .= '</optgroup>';
                                } else {
                                    $services .= '<optgroup label="'.$taxonomy_name.'">';
                                    foreach ($posts as $p) {
                                        $post_title = $p->post_title;
                                        $post_id = $p->ID;
                                        $image = get_post_meta($post_id, 'sbp_gallery', true);
                                        $featured_img_id = $image[0];
                                        $img_url = wp_get_attachment_image_src($featured_img_id, 'thumbnail');
                                        $img = $img_url[0];
                                        $services .= '<option data-icon="'.$img.'" class="circle '.$post_id.'">'.$post_title.'</option>';
                                    }
                                    $services .= '</optgroup>';
                                }
                            }
                        }
                        if (!empty($services)) {
                            $msg .= '<div class="opt_hidden2">'.$services.'</div>';
                        }
                        if (!empty($events)) {
                            $msg .= '<div class="opt_hidden3">'.$events.'</div>';
                        }

                        break;

                default:
                        $msg .= '<div class="opt_hidden">';
                        foreach ($post_type as $p) {
                            $post_name_array = sbp_get_my_custom_posts($p);
                            $post_name = $post_name_array['pl'];
                            $msg .= '<optgroup label="'.$post_name.'">';
                            $args = array(
                                         'post_type' => $p,
                                        'posts_per_page' => '-1',
                                        'post_status' => 'publish',
                                );
                            $posts = get_posts($args);
                            if (!empty($posts)) {
                                foreach ($posts as $c) {
                                    $post_id = $c->ID;
                                    $post_type = $c->post_type;
                                    $post_title = $c->post_title;
                                    $image = get_post_meta($post_id, 'sbp_gallery', true);
                                    if (!empty($image)) {
                                        $featured_img_id = $image[0];
                                        $img_url = wp_get_attachment_image_src($featured_img_id, 'thumbnail');
                                        $img = $img_url[0];
                                    } else {
                                        $featured_img_id = '';
                                        $img = '';
                                    }

                                    $msg .= '<option data-icon="'.$img.'" class="circle '.$post_id.'">'.$post_title.'</option>';
                                }

                                $msg .= '</optgroup>';
                            }
                        }

                        $msg .= '</div>';
                        break;
        }

    $msg .= '</div>';

    return $msg;
}
add_shortcode('services_page_layout', 'services_page');

function services_page()
{
    $section = do_shortcode('<div class="layout_wrap">[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_animation= "none" section_id= "services_page_layout" full_screen_header_scheme= "background--light"][row][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" padding_value= "%" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX" column_class= "left_page_layout"][flex_slider auto_slide= "yes" slide_interval= "7000"][flex_slide image= "273"][flex_slide image= "272" ][/flex_slider]<div class="description_container"></div>[/one_col][/row][/section]</div>');

    return $section;
}

add_shortcode('services_scd', 'activities_events');

function activities_events($atts)
{
    extract(shortcode_atts(array(
        'post_type' => '',
        'termm_id' => '',
        'more_btn' => 'yes',
        'taxonomy' => 'sbp_travel_services_type',
        /*use 'activities' and 'events'*/
    ), $atts));

    $post_type = str_replace(' ', '', $post_type);
    $post_type = explode(',', $post_type);
    if (!empty($taxonomy) && !empty($termm_id)) {
        $query_posts = apply_filters('sbp_get_some_posts', $post_type, '', array('tax_query' => array(
                array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => absint($termm_id),
                ), )));
    } else {
        $query_posts = apply_filters('sbp_get_some_posts', $post_type, '', '');
    }

    $path = site_url();
    $count = 0;
    $show = '';

    foreach ($query_posts as $p) {
        $title = $p['main']->post_title;
        $id = $p['main']->ID;
        //$description  = preg_replace("/<h([1-6]{1})>.*?<\/h\\1>/si", '', $p['metas']['sbp_description']);
        $description = sbp_limit_text(strip_tags($p['main']->post_content), 30);
        $images_array = get_post_meta($id, 'sbp_gallery', true) ?: array();
        $permalink = $p['permalink'];
        if ($more_btn == 'yes') {
            $right_window_btn = '[button button_text= "LEARN MORE" icon_alignment= "left" url= "'.$permalink.'" new_tab= "no" type= "medium" alignment= "center" hover_bg_color= "#3d92c3" color= "#3d92c3" hover_color= "#ffffff" border_width= "2" border_color= "#3d92c3" hover_border_color= "#3d92c3" button_style= "none" background_animation= "bg-animation-slide-left" animation_type= "fadeIn"]';

            $left_window_btn = '[button button_text= "LEARN MORE" icon_alignment= "left" url= "'.$permalink.'" new_tab= "no" type= "medium" alignment= "center" hover_bg_color= "#3d92c3" color= "#3d92c3" hover_color= "#ffffff" border_width= "2" border_color= "#3d92c3" hover_border_color= "#3d92c3" button_style= "none" background_animation= "bg-animation-slide-left" animation_type= "fadeIn"]';
        } else {
            $right_window_btn = '';
            $left_window_btn = '';
        }

        if ($count % 2 == 0) {
            /*right window*/
            $show .= do_shortcode('[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" bg_animation= "none" padding_top= "0" padding_bottom= "0" section_id= "mosaic_sect" section_class= "right_arrow_hide" full_screen_header_scheme= "background--light"][row no_wrapper= "1" no_margin_bottom= "1" no_space_columns= "1" row_class= "full_slider"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" padding_value= "%" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"][flex_slider auto_slide= "yes" slide_interval= "3000"]'.load_images($images_array).'[/flex_slider][/one_col][/row][row  row_class= "text_window_right"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top right" padding_value= "%" center_pad= "1" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"]<h3 style="text-align: center;">'.$title.'</h3>'.$description.$right_window_btn.'[/one_col][/row][/section]');

            $count = $count + 1;
        } else {
            /*left window*/

            $show .= do_shortcode('[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" bg_animation= "none" padding_top= "0" padding_bottom= "0" section_id= "mosaic_sect" section_class= "left_arrow_hide" full_screen_header_scheme= "background--light"][row no_wrapper= "1" no_margin_bottom= "1" no_space_columns= "1" row_class= "full_slider"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" padding_value= "%" animate_overlay= "none" link_overlay= "" vertical_align= "none" animation_type= "flipInX"][flex_slider auto_slide= "yes" slide_interval= "3000"]'.load_images($images_array).'[/flex_slider][/one_col][/row][row row_class= "text_window_left"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top right" padding_value= "%" center_pad= "1" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"]<h3 style="text-align: center;">'.$title.'</h3>'.$description.$left_window_btn.'[/one_col][/row][/section]');
            $count = $count + 1;
        }
    }

    return $show;
}

add_shortcode('sbp_activities_children', 'sbp_activities_children_func');

function sbp_activities_children_func($atts)
{
    extract(shortcode_atts(array(
        'more_btn' => 'yes',
        'termm_id' => '',
    ), $atts));
    $path = site_url();
    $count = 0;

    $parent_term = get_term_by('id', absint($termm_id), 'sbp_travel_services_type');
    $parent_id = $parent_term->term_id;
    /*check if exist*/
    $children_ids_array = get_term_children($parent_id, 'sbp_travel_services_type');

    /*CHECK IF EMPTY*/
    $show = '';

    foreach ($children_ids_array as $child_id) {
        $term = get_term($child_id, 'sbp_travel_services_type');
        $title = $term->name;
        $description = $term->description;
        $images_array = array();
        $related_posts = apply_filters('sbp_get_some_posts', 'sbp_travel_services', '', array('tax_query' => array(
            array(
                'taxonomy' => 'sbp_travel_services_type',
                'field' => 'term_id',
                'terms' => absint($child_id),
            ), )));

        /*get the first post id from the array to get a random image*/
        foreach ($related_posts as $p) {
            $random_gallery = $p['metas']['sbp_gallery'];
            $random_img_id = $random_gallery[0];
            $images_array[] = $random_img_id;
        }

        if ($more_btn == 'yes') {
            $url_id = get_term_meta($child_id, 'select_page_url', true);
            /*$url_id = get_option('sbp_service_category_' . $child_id . '_select_page_url');*/
            $url = get_the_guid($url_id); /*this to replace*/
            if (!empty($url)) {
                $right_window_btn = '[button button_text= "LEARN MORE" icon_alignment= "left" url= "'.$url.'" new_tab= "no" type= "medium" alignment= "center" hover_bg_color= "#3d92c3" color= "#3d92c3" hover_color= "#ffffff" border_width= "2" border_color= "#3d92c3" hover_border_color= "#3d92c3" button_style= "none" background_animation= "bg-animation-slide-left" animation_type= "fadeIn"]';

                $left_window_btn = '[button button_text= "LEARN MORE" icon_alignment= "left" url= "'.$url.'" new_tab= "no" type= "medium" alignment= "left" hover_bg_color= "#ffffff" color= "#ffffff" hover_color= "#3d92c3" border_width= "2" border_color= "#ffffff" hover_border_color= "#ffffff" button_style= "none" background_animation= "bg-animation-slide-left" animation_type= "fadeIn"]';
            } else {
                $right_window_btn = '';
                $left_window_btn = '';
            }
        } else {
            $right_window_btn = '';
            $left_window_btn = '';
        }

        if ($count % 2 == 0) {
            /*right window*/
            $show .= do_shortcode('[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" bg_animation= "none" padding_top= "0" padding_bottom= "0" section_id= "mosaic_section" section_class= "full_slider, right_arrow_hide" full_screen_header_scheme= "background--light"][row no_wrapper= "1" no_margin_bottom= "1" no_space_columns= "1" row_class= "slider_img"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" padding_value= "%" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"][flex_slider auto_slide= "yes" slide_interval= "3000"]'.load_images($images_array).'[/flex_slider][/one_col][/row][row  row_class= "text_window_right"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top right" padding_value= "%" center_pad= "1" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"][text wrap_alignment= "center" animation_type= "fadeIn" ]<h3 style="text-align: center;">'.$title.'</h3><p style="text-align: left;">'.sbp_limit_text($description, 30).'</p>[/text]'.$right_window_btn.'[/one_col][/row][/section]');

            $count = $count + 1;
        } else {
            /*left window*/

            $show .= do_shortcode('[section bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" bg_animation= "none" padding_top= "0" padding_bottom= "0" section_id= "mosaic_section" section_class= "full_slider, left_arrow_hide" full_screen_header_scheme= "background--light"][row no_wrapper= "1" no_margin_bottom= "1" no_space_columns= "1" row_class= "slider_img"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top left" bg_stretch= "1" padding_value= "%" animate_overlay= "none" link_overlay= "" vertical_align= "none" animation_type= "flipInX"][flex_slider auto_slide= "yes" slide_interval= "3000"]'.load_images($images_array).'[/flex_slider][/one_col][/row][row row_class= "text_window_left"][one_col bg_repeat= "repeat" bg_attachment= "scroll" bg_position= "top right" padding_value= "%" center_pad= "1" animate_overlay= "none" vertical_align= "none" animation_type= "flipInX"][text max_width= "" wrap_alignment= "center" animation_type= "fadeIn" ]<h3 style="text-align: center;">'.$title.'</h3><p style="text-align: left;">'.strip_tags(sbp_limit_text($description, 30)).'</p>[/text]'.$left_window_btn.'[/one_col][/row][/section]');
            $count = $count + 1;
        }
    }

    return $show;
}

add_shortcode('exclusive_offers_content', 'exclusive_offers');

function exclusive_offers($atts)
{
    extract(shortcode_atts(array(
                 'header' => 'Exclusive Offers',
                'small_line' => 'Subscribe in our guest lists and unlock coupons and special travel offer for the upcoming season!',
        ), $atts));
    $msg = '';
    $msg .= '<div id="exclusive_offers">
              <h2>'.$header.'</h2>
              <p class="sml_line">'.$small_line.'</p>'.do_shortcode('[mc4wp_form id="571"]').'</div>';

    return $msg;
}

function load_images($img_array)
{
    if (!empty($img_array)) {
        $msg = '';
        foreach ($img_array as $img) {
            $msg .= '[flex_slide image= "'.$img.'" video= ""]';
        }
    }

    return $msg;
}

function motivar_img_alt_text($img_id)
{
    $alt_text = get_post_meta($img_id, '_wp_attachment_image_alt', true);
    if (empty($alt_text)) {
        $alt_text = $GLOBALS['sbp_globals']['sbp_default_alt'];
    }

    return $alt_text;
}

add_shortcode('card_sidebar_price', 'min_price_card');
/*function to create card for the sidebar and room*/

function min_price_card()
{
    /*
    this need to be change in view.php of this folder
    */
    $post_id = $button = $header = $extra_link = $small_header = $extra = $fixed = '';
    if ($post_id != '') {
        $extra = '?from_post='.$post_id;
        $org_id = get_post_meta($post_id, 'sbp_calendar_id', true);
        $min_price = get_post_meta($org_id, '_sbp_min_price', true) ?: '';
        $data = '.sbp_flexx';
    } else {
        $min_price = get_option('sbp_global_min_price') ?: '';

        $data = '.right-sidebar-page';
    }

    $ratess = apply_filters('sbp_show_rates', $min_price);
    // $ratess2    = apply_filters('sbp_show_rates' , $min_price);

    $rates = $ratess != '' ? $ratess : '';

    $button_final = $button != '' ? $button : __('Book Now', 'simple-bookings-plugin');
    $headerr = $header != '' ? $header : __('Best Price Online', 'simple-bookings-plugin');
    $extra_link = $extra_link != '' ? $extra_link : 0;
    $small_header = $small_header != '' ? $small_header : __('Group or Event Request', 'simple-bookings-plugin');
    $msg = '<div class="sbp_cnt_div sbp_hoverable row dom_page_price_container">
                            <div class="sbp_style_card sbp_third_bg_color">
                            <div class="sbp_content sbp_content_padding">
                            <h4 class="sbp_secondary_text_color">'.$headerr.'</h4>';
    if (!empty($rates)) {
        $msg .= '<p class="sbp_secondary_text_color">'.$rates.'</p>';
    }

    if (!empty(sbp_booking_post_url)) {
        $book_url = sbp_booking_post_url;
        $book_url .= $extra;
        $msg .= '<a class="sbp_mediumbtn sbp_book_now sbp_button_color" href="'.$book_url.'">'.$button_final.'</a>';
        //$fixed = '<div class="sbp_fixed_div" data-class="' . $data . '"><a class="sbp_mediumbtn sbp_book_now sbp_button_color" href="' . $book_url . '">' . $ratess2 . '</a></div>';
    }

    if ($extra_link == 1) {
        $contact_url = sbp_contact_post_url;
        $msg .= '<p><a href="'.$contact_url.'?from_post='.$GLOBALS['post']->ID.'"><small>'.$small_header.'</a></small></p>';
    }

    $msg .= '</div></div></div>';

    return $msg;
}
