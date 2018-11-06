<?php
/*
 *  The template for displaying a Blog Post.
 *
 *
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
get_header(); ?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <div class="be-wrap">
                <div class="sbp_section sbp_3_3">
                    <div class="left sbp_2_3">
            <?php
                // Start the Loop.
                $content = '';
                while ( have_posts() ) : the_post();
					global $wp_query, $post;
				    ?>
					<div class="dom_hidden dom_single_title_container"><h1 class="dom_single_title"><?php echo $post->post_title; ?></h1></div>
                        <div class="accommodation_wrap">
                            <?php
                            include(ABSPATH . 'web-assets/plugins/Simple-Bookings-Plugin/custom_types/sbp_templates/partials/global/gallery.php');
                            ?>
                            <div class="sbp_title_container sbp_font_size"><?php  apply_filters('sbp_get_post_title_breadcrumb',$post->ID,$post->post_title); ?> </div> 
                            <?php
                            include(ABSPATH . 'web-assets/plugins/Simple-Bookings-Plugin/custom_types/sbp_templates/partials/global/description.php');
                            ?>
                            <div class="dom_events_button"><a href="<?php echo sbp_contact_post_url; ?>"><?php echo __('Contact for More', 'dominoes-child'); ?></a></div>
				        </div>
					</div>
                    <div class="right sbp_1_3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
                    <?php
                endwhile;
            ?>
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