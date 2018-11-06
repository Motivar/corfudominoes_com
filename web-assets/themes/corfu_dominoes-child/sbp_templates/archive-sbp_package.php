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

$obj = get_queried_object();
if (isset($obj->term_id) && !empty($obj->term_id)) {
    $terms = array();
    $terms[] = $obj->term_id;
    if ($obj->parent == 0){
        $children = get_term_children($obj->term_id, $obj->taxonomy) ?: array();
        if (!empty($children)){
            foreach ($children as $id) {
                $terms[] = $id;
            }
        }
    }
    $the_query = new WP_Query( array(
                    'posts_per_page'=>6,
                    'post_type'=>'sbp_package',
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'tax_query' => array(
                                    array (
                                        'taxonomy' => $obj->taxonomy,
                                        'field' => 'term_id',
                                        'terms' => $terms,
                                        'operator' => 'IN'
                                        ),
                                    )
                                )); 
    $title = $obj->name;
}   else {
    $the_query = new WP_Query( array(
                    'posts_per_page'=>6,
                    'post_type'=>'sbp_package',
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    )); 
    $title = post_type_archive_title( '', false );
}


if (is_post_type_archive('sbp_package') || is_tax()) {
    get_header(); 
    $default_img = get_field('archives_default_img', 'options') ?: '';
    ?>
                <div class="header-hero-section" id="hero-section" style="opacity: 1;">
                    <div class="header-hero-custom-section">
                        <div class="hero-section-wrap be-section full-screen-height  be-bg-cover be-bg-parallax   clearfix parallaxed" style="background: url(&quot;<?php echo $default_img; ?>&quot;) 50% 16px no-repeat fixed; opacity: 1; padding: 0px;">
                            <div class="be-row be-wrap">
                                <div class="hero-section-inner-wrap">
                                    <div class="hero-section-inner">
                                        <div class="sbp_title_container sbp_font_size">
                                            <?php
                                            apply_filters('sbp_get_post_title_breadcrumb',$post->ID, $title);  
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    <div id="main-content" class="main-content">
        <div id="primary" class="content-area">
            <div id="content" class="site-content" role="main">
                <div class="be-wrap">
                    <div class="sbp_section sbp_3_3">
                        <div class="right sbp_2_3">

                            <?php
                                // Start the Loop.
                                $content = '';
                            ?>
                            <div class="sbp_accommodation_archive sbp_center sbp_flex_wrap">
                            <?php
                                while ($the_query-> have_posts()) :$the_query->the_post(); 
                                    global $wp_query, $post;
                                sbp_custom_partials ('partials/sbp_accommodation/card.php');
                                endwhile;
                            ?>                    
                            </div>
                            <?php sbp_custom_partials('partials/global/pagination.php'); ?>
                        </div>
                        <div class="left sbp_1_3">
                            <?php 
                                get_sidebar(); 
                                //dynamic_sidebar("accommodation-archive-widget");
                            ?>
                        </div>  
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
}
else {

    $current_accommodation_id = get_the_ID();
    while ( $the_query -> have_posts()) : $the_query -> the_post(); 
        global $wp_query, $post;
        if ($post->ID !== $current_accommodation_id) {
            sbp_custom_partials ('partials/sbp_accommodation/card.php');
        }
    endwhile;

}
