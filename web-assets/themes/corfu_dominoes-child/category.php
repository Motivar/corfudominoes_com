<?php

$obj = get_queried_object();
if (isset($obj->term_id) && !empty($obj->term_id)) {
    $term_id = $obj->term_id;
    $title = $obj->name;
    $taxonomy = 'category';
}   else {
    $term_id = '';
    $title = post_type_archive_title( '', false );
    $taxonomy = '';
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
																																											<h1><?php echo $title; ?></h1>
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
                        echo do_shortcode('[services_scd post_type="post" termm_id="'.$term_id.'" taxonomy="'.$taxonomy.'"]');
                    ?>
            </div><!-- #content -->
        </div><!-- #primary -->
    </div><!-- #main-content -->

    <?php
    get_footer();




