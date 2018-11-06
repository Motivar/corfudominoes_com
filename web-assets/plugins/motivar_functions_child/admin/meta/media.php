<?php
if ( !defined( 'ABSPATH' ) )
	exit;





function service_hero_img($form_fields, $post){
	$check = get_post_meta( $post->ID, 'service_img', true );
	if ( $check == 'true'){ $active = 'checked';}
	else { $active = '';}
	$form_fields['service_img'] = array(
		'label' => 'Set as services hero image',
		'input' => 'html',
		'html'  => '<input type="checkbox" id="hero_img" name="hero_img" '.$active.'/>',
		'value' =>  'false',
		);
	return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'service_hero_img', 10, 2 );

function service_hero_img_save($post, $attachment){
	if (isset($_POST['hero_img'])){
        $cur_post_array = array($post['ID']);
		$args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
        'posts_per_page'    => '-1',
		'post__not_in' => $cur_post_array,
        'meta_query' => array(
        	array(
            'key'   => 'service_img',
            'value' =>  'true',
            'compare' => '=',
            ),
        ));
    	$query_posts = get_posts( $args );
    	/*Deactivate hero image feature for all the other images*/
    	foreach( $query_posts as $p){
    		$id = $p->ID;
    		update_post_meta( $id, 'service_img', 'false');
    	}
    	/*Activate the current as hero image */
		update_post_meta($post['ID'],'service_img', 'true');
		/* Get all services*/
		$service_args = array(
		'post_type' => 'sbp_services',
        'posts_per_page'    => '-1',
		);
		$service_posts = get_posts( $service_args );
		/*Set current as hero images to all services*/
		foreach ($service_posts as $s) {
			$service_id = $s->ID;
			update_post_meta( $service_id, 'be_themes_hero_section_bg_image', $post['ID']);
		}
	}
	else {
		update_post_meta($post['ID'], 'service_img', 'false');
	}
	return $post;
}
add_filter('attachment_fields_to_save', 'service_hero_img_save', 10, 2);
