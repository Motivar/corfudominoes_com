<?php
/**
 * The Template for displaying all accommodation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); 

                while ( have_posts() ) : the_post();
                    global $wp_query, $post;
                    ?>
                    <div class="accommodation_wrap filox_section_container">
                    <?php
                    sbp_custom_partials('partials/global/gallery.php');
                    sbp_custom_partials ('partials/global/min_price.php'); 
                    ?>
                    <div class="sbp_title_container sbp_font_size"><?php sbp_custom_partials('partials/global/breadcrumb.php'); ?> </div> 
                    <?php
                    sbp_custom_partials ('partials/global/facilities.php');
                    sbp_custom_partials ('partials/global/description.php'); 
                    ?>
                    </div>
                    <?php

                       $carousel = do_shortcode('[sbp_carousel post_type="'.$post->post_type.'" current_post="'.$post->ID.'" filter="0"]');
                       if (!empty($carousel)) {
                           ?>
                            <div class="sbp_relative_title sbp_sections_margin sbp_center"><h3><?php echo sbp_travel_services_others; ?></h3></div>
                           <?php
                           echo $carousel;
                       }

                    sbp_custom_partials('partials/global/book_now_button.php');

                endwhile;

get_footer();