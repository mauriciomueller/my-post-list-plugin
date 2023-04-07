<?php
/*
  Plugin Name: My Post List Plugin
  Description: This plugin adds a shortcode to display a list of posts filtered by a specific category.
  Version: 1.0
  Author: Mauricio Mueller
  Author URI: http://devheroes.com.br
*/

// Register the shortcode

function my_post_list_shortcode($atts) {
	$atts = shortcode_atts(array(
		'category' => ''
	), $atts);

	$posts = get_posts(array(
		'category_name' => $atts['category'],
		'post_type' => 'post',
		'post_status' => 'publish',
		'post_per_page' => -1
	));

	if (empty($posts)) {
		return '<p>No posts found.</p>';
	}

	$output = '<ul>';
	foreach ($posts as $post) {
		$output .= '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
	}
	$output .= '</ul>';

	return $output;
}

add_shortcode('my_post_list', 'my_post_list_shortcode');