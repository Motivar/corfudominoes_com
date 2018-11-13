<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if (is_admin())
    {
    if (function_exists('acf_add_options_page'))
        {
        $option_page1 = acf_add_options_page(array(
            'page_title' => 'General Options',
            'menu_title' => 'General Options',
            'menu_slug' => 'mtv_general_options',
            'capability' => 'read',
            'redirect' => false
        ));

        }
    }