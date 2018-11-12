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
global $wp_query, $post;
$obj = get_queried_object();
if (isset($obj->term_id) && !empty($obj->term_id)) {
    $title = $obj->name;
}   else {
    $title = post_type_archive_title( '', false );
}

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
                                            //apply_filters('sbp_get_post_title_breadcrumb',$post->ID, $title);  
                                            sbp_custom_partials('partials/global/breadcrumb.php');
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <div class="sbp_section sbp_3_3">
        <?php  
            $content=apply_filters('sbp_archive_divs_filter',
            array(
            'sidebar'=>'partials/global/sidebar.php',
            'content'=>'partials/global/main_content.php'
            ),$post,$object);
            foreach ($content as $file)
            {
                echo sbp_custom_partials($file);
            }
        ?>
    </div>


    <?php
    get_footer();