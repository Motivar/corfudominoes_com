<?php
/**
 * The Template for displaying all map points
 *
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
            <div class="be-wrap">
                <div class="sbp_section twelve columns sbp_3_3 "> 
                    <div class="right sbp_2_3">
                        <?php
                        // Start the Loop.
                        $content = '';
                        while ( have_posts() ) : the_post();
                            global $wp_query, $post;
                            ?>
                            <div class="accommodation_wrap"> <?php sbp_custom_partials('partials/global/gallery.php'); ?>
                             <div class="sbp_title_container">
                                <?php  apply_filters('sbp_get_post_title_breadcrumb',$post->ID, $post->post_title);  ?>
                            </div>
                            <?php
                            sbp_custom_partials ('partials/global/description.php');  
                            sbp_custom_partials ('partials/sbp_map.php');              
                            ?>
                            </div>
                            <?php
                        endwhile;
                            ?>
                    </div>
                    <div class="left sbp_1_3">
                        <?php 
                        get_sidebar(); 
                        ?>
                    </div> 
                </div>
            </div>
                <div class="sbp_relative_title sbp_sections_margin sbp_center"><h3><?php echo __('Other Places', 'simple-bookings-plugin'); ?></h3></div>
                <div clas="sbp_accommodation_carousel">
                    <div class="sbp_accommodation_archive sbp_center sbp_carousel" data-columns="3" data-mcolumns="2" data-scolumns="1" data-display="carousel" data-mode="false" data-mmode="true" data-smode="true">
                        <?php
                            sbp_custom_partials ('archive-sbp_map_points.php');
                        ?>
                    </div>
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