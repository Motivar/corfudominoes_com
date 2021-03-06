<?php
	global $be_themes_data;
	$post_id = be_get_page_id();
	$show_bottom_widgets = get_post_meta($post_id, 'be_themes_bottom_widgets', true);
	$show_footer_area = get_post_meta($post_id, 'be_themes_footer_area', true);
	if($show_bottom_widgets != 'no') {
		$show_widgets = true;
	} else {
		$show_widgets = false;
	}
	if((is_home() || is_search() || is_tag() || is_archive() || is_category())){
		if(isset( $be_themes_data['show_bottom_widgets'] ) && 'yes' == $be_themes_data['show_bottom_widgets']) {
			$show_widgets = true;
		} else {
			$show_widgets = false;
		}
	}
	$col_class = "one-third";
	$i = 3;
	$active_sidebar = false;
	if($be_themes_data['bottom_widgets_layout'] == 'four-col') {
		$col_class = "one-fourth";
		$i = 4;
	}
	for($j = 1; $j <= $i; $j++) {
		if ( is_active_sidebar( 'footer-widget-'.$j ) ) {
			$active_sidebar = true;
			break;
		}
	}


	/*Custom Bottom Content*/
	if (is_archive() && (!is_post_type_archive('sbp_accommodation')) &&(!is_post_type_archive('sbp_travel_services')) && (!is_post_type_archive('sbp_map_points')) && (!is_tax('sbp_accommodation_type')) && (!is_tax('sbp_map_point_category')) && (!is_tax('sbp_travel_services_type')) && (!is_category())) {
					echo do_shortcode('[gftr carousel_flag="1" amenities_flag="1" subscribe_flag="1"]');
	}
	else {
					if (is_front_page()) {
									echo do_shortcode('[gftr carousel_flag="0" amenities_flag="0" subscribe_flag="1"]');
					}
					else {
						if ((!(is_singular('sbp_accommodation'))) || (!(is_singular('sbp_map_points')))) {

						}
						else{
										$id = $post_id;
										$bottom_widgets = get_post_meta( $id, 'sbp_select_bottom_widgets', true);
										$carousel_headline = get_post_meta( $id , 'sbp_carousel_headline', true);
										$amenities_headline = get_post_meta( $id , 'sbp_amenities_headline', true);
										$subscribe_headline = get_post_meta( $id , 'sbp_exclusive_offers_headline', true);
										$widgets = '';
										if (!empty( $bottom_widgets )){
											foreach ($bottom_widgets as $b) {
												$widgets .= $b.'="1" ';
											}
										$headlines = '';
										if (!empty($carousel_headline)) {
											$headlines .= 'carousel_headline="'.$carousel_headline.'" ';
										}
										if (!empty($amenities_headline)) {
											$headlines .= 'amenities_headline="'.$amenities_headline.'" ';
										}
										if (!empty($subscribe_headline)) {
											$headlines .= 'exclusive_offers_headline="'.$subscribe_headline.'" ';
										}
											$scd = 'gftr post_id="'.$id.' " '.$widgets.' '.$headlines;
											$msg = do_shortcode('['.$scd.']');
											echo $msg;
										}
								}
					}
	}


	if( $show_widgets && $active_sidebar ) { ?>
		<footer id="bottom-widgets">
			<div id="bottom-widgets-wrap" class="be-wrap be-row clearfix">
				<?php for($j = 1; $j <= $i; $j++) : ?>
					<div class="<?php echo $col_class; ?> column-block clearfix">
						<?php
							if ( is_active_sidebar( 'footer-widget-'.$j ) ) {
								dynamic_sidebar( 'footer-widget-'.$j );
							}
						?>
					</div>
				<?php endfor; ?>
			</div>

<div id="hc-ratingRatingHotel">
				<div id="hc-ratingRatingHotel__inner"> <img id="hc-ratingRatingHotel__ribbon" src="https://media.datahc.com/ratinghotel/stellar2/ribbon.png"/>
								<span id="hc-ratingRatingHotel__year">2020</span>
								<span id="hc-ratingRatingHotel__award">RECOGNITION OF EXCELLENCE</span>
								<div id="hc-ratingRatingHotel__hotelink"> <a id="hc-ratingRatingHotel__hotelname" target="_blank" href="javascript:void(0)">Dominoes Aparthotel</a> </div>
								<a id="hc-ratingRatingHotel__hclink" target="_blank" href="http://www.hotelscombined.com">HotelsCombined</a> 
					</div>
					<div id="hc-ratingRatingHotel__rating"> 
									<span id="hc-ratingRatingHotel__number" style="text-transform:uppercase"><center><font size="1">Greece</font></center></span>
									<div id="hc-data__hotellink" style="display: none;">Dominoes_Aparthotel</div>
									<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"> </script>
									<script>(function(){var rand = Math.floor((Math.random() * 99999999) + 1); function loadjscssfile(a,b){if("js"==b){var
									c=document.createElement("script");c.setAttribute("type","text/javascript"),c.setAttribute("src",a)}else if("css"==b){var
									c=document.createElement("link");c.setAttribute("rel","stylesheet"),c.setAttribute("type","text/css"),c.setAttribute("href",a)}"undefined"!=typeof
									c&&document.getElementsByTagName("head")[0].appendChild(c)} loadjscssfile('https://media.datahc.com/ratinghotel/stellar2/styles.css?v' + rand, 'css');
									loadjscssfile('https://media.datahc.com/ratinghotel/stellar2/script.js?v' + rand, 'js'); })(); </script>
					</div>
</div>


					<?php 
		dynamic_sidebar("custom-footer-cards");
		?>
		</footer>
	<?php } ?>
	<?php if(('no' != $show_footer_area) && !(($be_themes_data['footer-content-pos-center'] == 'none' ) && ($be_themes_data['footer-content-pos-left'] == 'none' ) && ($be_themes_data['footer-content-pos-right'] == 'none' ))) { ?>
		<footer id="footer" class="<?php echo esc_attr( $be_themes_data['layout'] );?>">
			<span class="footer-border <?php echo (($be_themes_data['footer-border-wrap']) ? 'be-wrap ' : '' );?>"></span>
			<div id="footer-wrap" class=" <?php echo esc_attr( $be_themes_data['footer-style'] ); if(true == $be_themes_data['opt-footer-wrap']){?> be-wrap<?php } ?> clearfix">
				<div class="footer-left-area"><?php  if($be_themes_data['footer-content-pos-left'] != 'none' ){ ?>
					<div class="footer-content-inner-left"><?php
							be_themes_get_footer_widget($be_themes_data['footer-content-pos-left']);
						?>
					</div><?php
					}?>
				</div>
				<div class="footer-center-area"><?php
					if ($be_themes_data['footer-content-pos-center'] != 'none' ){ ?>
					<div class="footer-content-inner-center"><?php
							be_themes_get_footer_widget($be_themes_data['footer-content-pos-center']);
						?>
					</div><?php
					}?>
				</div>
				<div class="footer-right-area"><?php
					if($be_themes_data['footer-content-pos-right'] != 'none' ){ ?>
					<div class="footer-content-inner-right"><?php
							be_themes_get_footer_widget($be_themes_data['footer-content-pos-right']);
						?>
					</div>	<?php
					}?>
				</div>
			</div>
		</footer> <?php
	}
	?>
	<?php do_action('be_themes_after_footer'); ?>
	</div>
	<?php get_template_part( 'page', 'loader' ); ?>

	<?php
		if(!(isset($be_themes_data['disable_back_top_btn']) && !empty($be_themes_data['disable_back_top_btn']) && $be_themes_data['disable_back_top_btn'] == 1)) {
			echo '<a href="#" id="back-to-top" class="'.$be_themes_data['layout'].'"><i class="font-icon icon-arrow_carrot-up"></i></a>';
		}
	?>
	<?php if('layout-border' == $be_themes_data['layout'] || 'layout-border-header-top' == $be_themes_data['layout']) { ?>
	<div class="layout-box-container">
		<?php if('layout-border' == $be_themes_data['layout'] || 'left' == $be_themes_data['opt-header-type']) { ?>
			<div class="layout-box-top"></div>
		<?php } ?>
		<div class="layout-box-right"></div>
		<div class="layout-box-bottom"></div>
		<div class="layout-box-left"></div>
	</div>
	<?php
	}?>
</div>

<?php if( !empty($be_themes_data['google_analytics_code']) ) : ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', '<?php echo esc_js( $be_themes_data['google_analytics_code'] ); ?>', 'auto');
	  ga('send', 'pageview');
	</script>
<?php endif; ?>

<input type="hidden" id="ajax_url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>" />
<?php if( array_key_exists('all_ajax_exclude_links', $be_themes_data) ) : ?>
	<input type="hidden" id="all_ajax_exclude_links" value="<?php echo esc_attr( $be_themes_data['all_ajax_exclude_links'] ); ?>" />
<?php endif; ?>
<?php wp_footer(); ?>
<!-- Option Panel Custom JavaScript -->
<script>
	//jQuery(document).ready(function(){
		<?php echo stripslashes_deep(htmlspecialchars_decode($be_themes_data['custom_js'],ENT_QUOTES));   ?>
	// });
</script>
</body>
</html>