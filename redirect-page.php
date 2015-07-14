<?php
/*
Template Name: Redirect To Page
*/
while(have_posts()):the_post();
	$theurl = get_post_custom_values('url',$post->ID);
	wp_redirect($theurl[0]);
endwhile; ?>