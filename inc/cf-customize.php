<?php

add_action('wp_dashboard_setup', 'cf_dashboard_branding_widget');

function cf_dashboard_branding_widget(){
	wp_add_dashboard_widget('cf_widget_id', 'Powered by Centreforge', 'cf_brand_widget');
}

function cf_brand_widget() {
	echo '<img src="'. get_template_directory_uri() .'/images/centreforge.png" style="float:right;width:83px;height:83px;"/><p><strong>Centreforge Core</strong><br/>
	Developed by <a href="mailto:support@mayfifteenth.com">Andrew Sears</a><br/>
	Chicago, IL<br/>
	<a href="http://www.twitter.com/searsandrew/">@searsandrew</a><br/>
	</p>';
}

function cf_modify_footer_admin () {
  echo 'Designed and Developed by <a href="http://www.mayfifteenth.com">Andrew Sears</a>.';
  echo '&nbsp;Powered by <a href="http://WordPress.org">WordPress</a>.';
  echo '&nbsp;&nbsp;&nbsp;&nbsp;<a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/deed.en_GB"><img alt="Creative Commons Licence" style="border-width:0" src="http://i.creativecommons.org/l/by-sa/3.0/80x15.png" /></a>';
}
add_filter('admin_footer_text', 'cf_modify_footer_admin');

add_action('admin_init', 'rw_remove_dashboard_widgets');
function rw_remove_dashboard_widgets() {
//	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // I like Right Now, but this removes Right Now
//	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins

	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');  // Quick Press
//	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'normal');  // Recent Drafts
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');   // Wordpress Blog
	remove_meta_box('dashboard_secondary', 'dashboard', 'normal');   // Other Wordpress News
}

add_action('admin_menu', 'wc_remove_boxes');
function wc_remove_boxes(){
//	remove_meta_box('postexcerpt', 'post', 'normal');
	remove_meta_box('postcustom', 'post', 'normal');
//	remove_meta_box('trackbacksdiv', 'post', 'normal');
	remove_meta_box('slugdiv', 'post', 'normal');
//	remove_meta_box('authordiv', 'post', 'normal');
//	remove_meta_box('commentstatusdiv', 'post', 'normal');
//	remove_meta_box('tagsdiv-post_tag', 'post', 'normal');
//	remove_meta_box('commentsdiv', 'post', 'normal');
}

function remove_editor_menu() {
	remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'remove_editor_menu', 1);

function remove_submenus() {
  global $submenu;
  unset($submenu['index.php'][10]);
}
add_action('admin_menu', 'remove_submenus');