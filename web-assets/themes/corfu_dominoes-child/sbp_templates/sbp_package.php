<?php
/**
 * The Template for displaying all services
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

get_header(); ?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
                    <?php
                        // Start the Loop.
                        $content = '';
                        while ( have_posts() ) : the_post();
                            global $wp_query, $post;
                            ?>
                            <div class="accommodation_wrap sbp_package_wrap">
                            <?php
                            sbp_custom_partials('partials/global/gallery.php');
                            sbp_custom_partials ('partials/sbp_accommodation/min_price.php');
                            ?>
                            <div class="sbp_title_container sbp_font_size"><?php  apply_filters('sbp_get_post_title_breadcrumb',$post->ID,$post->post_title); ?> </div> 
                            <?php  
                            sbp_custom_partials('partials/sbp_accommodation/facilities.php');
                            sbp_custom_partials('partials/global/description.php'); 
                            sbp_custom_partials('partials/global/services_amenities.php');
                            ?>
                            </div>
                            <?php
                        endwhile;


                       $carousel = do_shortcode('[sbp_carousel post_type="'.$post->post_type.'" current_post="'.$post->ID.'" filter="0"]');
                       if (!empty($carousel)) {
                           ?>
                            <div class="sbp_relative_title sbp_sections_margin sbp_center"><h3><?php echo __('Other Packages', 'simple-bookings-plugin'); ?></h3></div>
                           <?php
                           echo $carousel;
                       }
                ?>
            </div>
                    <div class="dom_bottom_sections">
                    <?php
                    echo do_shortcode('[gftr amenities_flag="1" subscribe_flag="1"]');
                    ?>
                    </div>
        </div><!-- #content -->
    </div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_footer();