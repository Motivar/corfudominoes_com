<?php
if ( ! defined( 'ABSPATH' ) ) exit;


add_action( 'acf/save_post', 'motivar_functions_save_acf', 20 );
function motivar_functions_save_acf( $post_id ) {
 if ((!wp_is_post_revision($post_id) && 'auto-draft' != get_post_status($post_id) && 'trash' != get_post_status($post_id)))
	 {
	 	$post_typee=get_post_type($post_id);
	 	$tttile = isset($_POST['post_title']) ? $_POST['post_title'] : '';
        $flag = 1;
	 	$changes=$types=array();
	 	/*for changes in slug motivar_functions_slugify */
	 	switch ($post_typee) {
	 		case 'sbp_accommodation':
	 			$desc       = get_post_meta($post_id, 'sbp_description', true);
                $images     = get_post_meta($post_id, 'sbp_gallery', true);
                $hero_image = $images[0];
                /*Hero Image*/
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '1');
                update_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', '#3d92c3');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
	 			break;
	 		case 'sbp_package':
	 			$desc       = get_post_meta($post_id, 'sbp_description', true);
                $images     = get_post_meta($post_id, 'sbp_gallery', true);
                $hero_image = $images[0];
                /*Hero Image*/
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '1');
                update_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', '#3d92c3');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
                update_post_meta($post_id, 'be_themes_page_layout', 'no');
                update_post_meta($post_id, 'be_themes_sidebar', '');
                 break;
            case 'sbp_map_points':
                $hero_image = get_post_meta($post_id, '_thumbnail_id', true) ?: '';
                /*Hero Image*/
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '1');
                update_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', '#3d92c3');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
                update_post_meta($post_id, 'be_themes_page_layout', 'no');
                update_post_meta($post_id, 'be_themes_sidebar', '');
                break;
	 		case 'sbp_services':
	 			/*Get hero image*/
                $args       = array(
                    'post_type' => 'attachment',
                    'post_mime_type' => 'image',
                    'posts_per_page' => '-1',
                    'meta_query' => array(
                        array(
                            'key' => 'service_img',
                            'value' => 'true',
                            'compare' => '='
                        )
                    )
                );
                /*It should return only one*/
                $posts      = get_posts($args);
                $hero_image = $posts[0]->ID;
                /*check season*/
                //check_meta($post_id, 'sbp_seasons', '', 1, $tttile);
               // packages_relations(5, $post_id);
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '0');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                 break;
            case 'sbp_travel_services':
	 			$desc       = get_post_meta($post_id, 'sbp_description', true);
                $images     = get_post_meta($post_id, 'sbp_gallery', true);
                $hero_image = $images[0];
                /*Hero Image*/
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '1');
                update_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', '#3d92c3');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
                update_post_meta($post_id, 'be_themes_page_layout', 'no');
                update_post_meta($post_id, 'be_themes_sidebar', '');
                break;
            case 'post':
                $hero_image = get_post_meta($post_id, '_thumbnail_id', true) ?: '';
                update_post_meta($post_id, 'sbp_gallery', array($hero_image));
                /*Hero Image*/
                update_post_meta($post_id, 'be_themes_header_transparent', 'transparent');
                update_post_meta($post_id, 'be_themes_header_transparent_color_scheme', 'light');
                update_post_meta($post_id, 'be_themes_sticky_header', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section', 'custom');
                update_post_meta($post_id, 'be_themes_hero_section_position', 'after');
                update_post_meta($post_id, 'be_themes_hero_section_with_header', 'no');
                update_post_meta($post_id, 'be_themes_hero_section_bg_repeat', 'no-repeat');
                update_post_meta($post_id, 'be_themes_hero_section_bg_attachment', 'fixed');
                update_post_meta($post_id, 'be_themes_hero_section_bg_position', 'center center');
                update_post_meta($post_id, 'be_themes_hero_section_bg_scale', '0');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation', 'be-bg-parallax');
                update_post_meta($post_id, 'be_themes_hero_section_bg_animation_canvas', 'none');
                update_post_meta($post_id, 'be_themes_hero_section_bg_video', '0');
                update_post_meta($post_id, 'be_themes_hero_section_overlay', '1');
                update_post_meta($post_id, 'be_themes_hero_section_bg_overlay_color', '#3d92c3');
                update_post_meta($post_id, 'be_themes_hero_section_content', '<h1 style="text-align: center;">' . $tttile . '</h1>');
                update_post_meta($post_id, 'be_themes_hero_section_container_wrap', 'yes');
                update_post_meta($post_id, 'be_themes_hero_section_bg_image', $hero_image);
                update_post_meta($post_id, 'be_themes_page_layout', 'no');
                update_post_meta($post_id, 'be_themes_sidebar', '');
                break;
            case 'page':
                $description = get_post_meta($post_id, 'sbp_description', true);
                $images = get_post_meta($post_id, 'sbp_gallery', true);
                $gmap = get_post_meta($post_id, 'sbp_google_map', true);
                $target_point = get_post_meta($post_id, 'sbp_select_map_point', true);
                $show_near_places = get_post_meta($post_id, 'sbp_show_nearest_places', true);
                $categories_to_show = get_post_meta($post_id, 'sbp_select_map_points_category', true) ? : '';
                if ($categories_to_show != '')
                {
                    $categories_to_show = implode("-", $categories_to_show);
                }

                $near_places_limit = get_post_meta($post_id, 'sbp_nearest_places_limit', true);
                $ext = '';
                $marks = array(
                'sbp_marker_from',
                'sbp_marker_to'
                );
                foreach($marks as $m)
                {
                    $v = get_field($m);
                    $ext.= $v != '' ? ' ' . $m . '="' . $v . '"' : ' ';
                }

                if ($gmap == '1')
                {
                    $map = 'map';
                    $target_id = $target_point;
                }
                else
                {
                    $map = '';
                    $target_id = '';
                }

                echo $ext;
                if ((!empty($images) || !empty($gmap)))
                {
                    $msg = '[no_builder_page_scd post_id="' . $post_id . '" type="' . $map . '" target_id="' . $target_id . '" show_near_places="' . $show_near_places . '" categories="' . $categories_to_show . '" limit="' . $near_places_limit . '" ' . $ext . ']';
                    /*update post only if the following exist*/
                    $changes['post_content'] = $msg;
                    $changes['post_title'] = ucfirst($tttile);
                    $types = array(
                    '%s',
                    '%s'
                    );
                }
                break;
	 		default:
	 			break;
	 	}
	 	/*update post only if the following exist*/
	 	if (!empty($changes) && !empty($types) && count($changes)==count($types))
	 	{
	 		motivar_functions_update_post($post_id,$changes,$types, $flag);
	 	}

	 }
}


add_action('save_post', 'motivar_functions_save',10,3);

function motivar_functions_save($post_id,$post,$out)
{
 if ((!wp_is_post_revision($post_id) && 'auto-draft' != get_post_status($post_id) && 'trash' != get_post_status($post_id)))
	 {
	 	$post_typee=get_post_type($post_id);
	 	if ($post_typee=='post')
	 		{
	 		$title=get_the_title($post_id);
	 		//update_post_meta($post_id,'be_themes_hero_section_content','<h1>'.$title.'</h1>');
			if ($post_typee=='post')
				{

				}
	 		}
	}

}


/*on delete posts*/
/*
add_action('wp_trash_post', 'delete_post_function');

function delete_post_function($post_id)
{
$typ=get_post_type($post_id) ;
if ($typ== 'partner')
 {

 }
else if ($typ=='career')
 {

 }
}
*/
/*on restore hook*/
/*
add_action('untrash_post', 'custom_posts_restore');


function custom_posts_restore($post_id)
{
remove_action( 'save_post', 'custom_posts_gnnpls' );
$typ=get_post_type($post_id);
	$title=get_the_title( $post_id);
	$post=get_post($post_id);

}
*/
/*
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );*/