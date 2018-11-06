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
 * @version     0.0.1a
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$obj = get_queried_object();
if (isset($obj->term_id) && !empty($obj->term_id)) {
    $term_id = $obj->term_id;
    $title = $obj->name;
    $taxonomy = 'sbp_travel_services_type';
}   else {
    $term_id = '';
    $title = post_type_archive_title( '', false );
    $taxonomy = '';
}

if (is_post_type_archive('sbp_travel_services') || is_tax()) {
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
                    <?php
                        echo do_shortcode('[services_scd post_type="sbp_travel_services" termm_id="'.$term_id.'" taxonomy="'.$taxonomy.'"]');
                    ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->

    <?php
    get_footer();
}



