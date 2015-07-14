<?php
/* Additional classes originally built for WP_Core, uses _s base code. Addons noted above code.
 * since: wc_core 1.1
 */
 
/* ***** Add Category names to Pages and Posts ***** */
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');

/* ***** Add Classes to Posts with Thumbnails ***** */
function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }
		return $classes;
}
add_filter('post_class', 'has_thumb_class');