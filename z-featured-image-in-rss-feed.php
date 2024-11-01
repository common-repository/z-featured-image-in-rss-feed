<?php
/*
Plugin Name: z-Featured Image In Rss Feed
Plugin URI: http://wordpress.org/extend/plugins/z-featured-image-in-rss-feed/
Description: Add Featured Image to your RSS Feed w/ CSS set to display:none.
Author: Frank Pinto, Dinesh Karki
Version: 0.3
*/

/*  Copyright 2012  Frank Pinto (email : frank@onswipe.com) */

function zFeaturedtoRSS($content) {
	$fir_rss_image_size = get_option('fir_rss_image_size');
	global $post;
	if ( has_post_thumbnail( $post->ID ) ){
    $start = strpos($content, '<img');
    if ($start === 0)
    {
      $end = strpos($content, '>');
      $content = substr($content, $end + 1);
    }
		$content = '' . get_the_post_thumbnail( $post->ID, $fir_rss_image_size, array( 'style' => 'display: none' ) ) . '' . $content;
	}
	return $content;
}

add_filter('the_excerpt_rss', 'zFeaturedtoRSS', 1000, 1);
add_filter('the_content_feed', 'zFeaturedtoRSS', 1000, 1);
include('plugin_interface.php');
?>
