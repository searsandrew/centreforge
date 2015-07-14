<?php

/* Setup theme defaults and register support for WordPress services.
 * since: wc_core 1.0
 */
if (!function_exists('cf_setup')):
function cf_setup() {
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	// add_theme_support('custom-header');
}
endif;
add_action('after_setup_theme', 'cf_setup');

/* Add functionality to WordPress via addons
 * since: centreforge 2.0, except where noted.
 */
require_once(TEMPLATEPATH.'/inc/cf-customize.php');
require_once(TEMPLATEPATH.'/inc/wp_bootstrap_navwalker.php');
require_once(TEMPLATEPATH.'/inc/additional-classes.php');
require_once(TEMPLATEPATH.'/inc/template-tags.php');
require_once(TEMPLATEPATH.'/inc/aq_resizer.php'); /* Replaced Image Resizer Centreforge 2.1.3 */
require_once(TEMPLATEPATH.'/inc/image-resize.php'); /* Replaced by AQ Resize Centreforge 2.1.3, drop support in CF 3, WP drop support WP 4 */
require_once(TEMPLATEPATH.'/inc/shortcode.php');
require_once(TEMPLATEPATH.'/inc/Tax-meta-class/Tax-meta-class.php'); /* Added Centreforge 2.1.1 */
require_once(TEMPLATEPATH.'/inc/cf-rotators.php'); /* Added Centreforge 2.1.1 */
//require_once(TEMPLATEPATH.'/inc/theme-customizer.php'); /* ** since: centreforge 2.0.2 ** */

/* Activate Nav Walker
 * since: centreforge 2.0
 */
register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'centreforge' ),
) );

/* Options Framework v. 1.6.1 - http://wptheming.com/options-framework-theme/
 * since: wc_core 1.0
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
}

/* Post Meta Boxes v. 4.3.8 - http://www.deluxeblogtips.com/meta-box/
 * since: wc_core 1.0
 */
 // Re-define meta box path and URL
 define( 'RWMB_URL', trailingslashit( TEMPLATEPATH.'/inc/meta-box' ) );
 define( 'RWMB_DIR', trailingslashit( TEMPLATEPATH.'/inc/meta-box' ) );
 // Include the meta box script
 require_once RWMB_DIR . 'meta-box.php';
 // Include the meta box definition (the file where you define meta boxes, see `demo/demo.php`)
 include (STYLESHEETPATH.'/config-meta-boxes.php');

/* Bootstrap CDN v. 0.0.2 - http://wordpress.org/plugins/bootstrapcdn/
 * since: wc_core 1.2
 * Removed while exploring Respond.js & IE8 issues
 */
// add_action('after_setup_theme', 'cf_load_bootstrap_cdn');
// function cf_load_bootstrap_cdn() {
//	if (!class_exists('bootstrapcdn')) {
// 		include_once(TEMPLATEPATH.'/plugins/bootstrapcdn/bootstrapcdn.php');
//	}
// }

function cwd_wp_bootstrap_scripts_styles() {
  // Loads Bootstrap minified JavaScript file.
  wp_enqueue_script('bootstrapjs', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'),'3.0.0', true );
  // Loads Bootstrap minified CSS file.
  // wp_enqueue_style('bootstrapwp', '/css/bootstrap.min.css', false ,'3.0.0');
  // Loads our main stylesheet.
  // wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array('bootstrapwp') ,'1.0');
  wp_enqueue_script('bootstrapgf', get_template_directory_uri().'/js/bootstrap-gravity-forms.min.js', array('jquery'),'1.0.0', true );
  
  wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',false,'4.3.0',all);
}
add_action('wp_enqueue_scripts', 'cwd_wp_bootstrap_scripts_styles');

/* Add Centreforge Options to Reading Settings
 * since: centreforge 2.0.2
 */
function cf_general_options() {
	add_settings_section('cf_menu','Centreforge Options','cf_main_text','reading');
	add_settings_field('cf_navSetting','Navigation','cf_nav_text','reading','cf_menu');
	add_settings_field('cf_colourSetting','Navigation Colour','cf_nav_colour','reading','cf_menu');
	add_settings_field('cf_footSetting','Footer','cf_footer_text','reading','cf_menu');
	register_setting('reading','cf_navText','esc_html');
	register_setting('reading','cf_navColour','esc_html');
	register_setting('reading','cf_footerText','esc_html');
}
function cf_main_text(){
	echo "<p>You can use these options to set the core layout of your theme.<br/>Centreforge offers a number of prebuilt options, however you can easily use Template Parts in your Child Theme.<br/>Centreforge will automatically append the slug, please see the Centreforge documentation for complete instructions.</p>";
}
function cf_nav_text(){
	echo "<input type=\"text\" name=\"cf_navText\" class=\"regular-text\" value=\"".get_option('cf_navText')."\"/>
	<p class=\"description\">Default options: default, description, bootstrap, bootstrap-inverse and bootstrap-top (Uses the slug 'nav')</p>";
}
function cf_footer_text(){
	echo "<input type=\"text\" name=\"cf_footerText\" class=\"regular-text\" value=\"".get_option('cf_footerText')."\"/>
	<p class=\"description\">Default options: default, navigation, widgets (Uses the slug 'foot')</p>";
}
add_action('admin_init','cf_general_options');

/* Remove Welcome Panel, and add Centreforge Welcome Panel
 * since: centreforge 2.0.2
 */
function remove_welcome_panel(){
    remove_action( 'welcome_panel', 'wp_welcome_panel' );
    add_action( 'welcome_panel', 'cf_welcome_panel' );
}
function cf_welcome_panel(){
	file_exists(STYLESHEETPATH.'/welcome-panel.xml')?
		$welcome = simplexml_load_file(STYLESHEETPATH.'/welcome-panel.xml'):
		$welcome = simplexml_load_file(TEMPLATEPATH.'/welcome-panel.xml');
	
	echo '<div class="welcome-panel-content"><h3>'.$welcome->greeting.'</h3>
	<p class="about-description">'.$welcome->subgreeting.'</p>
	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
	<h4><img src="'.$welcome->image.'" /></h4>
	<p>'.$welcome->address->line1.'<br/>
	'.$welcome->address->line2.'<br/>
	'.$welcome->address->line3.'<br/>
	<a href="'.$welcome->address->url.'" traget="_new">'.$welcome->address->url.'</a>		
	</p>
	</div><div class="welcome-panel-column">
	<h4>Get Started</h4>
	<ul><li><a href="http://dev.erparts.com/wp-admin/post-new.php?post_type=page" class="welcome-icon welcome-add-page">Add additional pages</a></li>
	<li><a href="'.network_site_url('/').'" class="welcome-icon welcome-view-site" target="_new">View your site</a></li>
	<li><a href="http://codex.wordpress.org/First_Steps_With_WordPress" class="welcome-icon welcome-learn-more" target="_new">Learn more about getting started</a></li></ul>
	</div><div class="welcome-panel-column welcome-panel-last">
	<h4>More Information</h4>
	<p>'.$welcome->info.'</p>
	</div></div></div>';
}
add_action( 'load-index.php', 'remove_welcome_panel' );

/* TinyMCE Shortcode Button Integration
 * since: centreforge 2.1.1
 */
function tinymce_buttons() {
	echo '<style type="text/css">.bxbutton span.mceIcon:before { content: "\f181"; }</style>';
}
add_action('admin_head', 'tinymce_buttons');

function action_admin_init() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_buttons', 'filter_mce_button' );
		add_filter( 'mce_external_plugins', 'filter_mce_plugin' );
	}
}

function filter_mce_button( $buttons ) {
	array_push( $buttons, '|', 'cfmce_button','pdflink_button','button_eek' );
	return $buttons;
}

function filter_mce_plugin( $plugins ) {
	$plugins['cfmcebutton'] = get_template_directory_uri() . '/js/cf_mce_integration.js';
	return $plugins;
}
add_action( 'admin_init', 'action_admin_init' );

/* Add Homepage Panel Integration - supported in Child Theme
* since: centreforge 2.1.1
*/
function cf_admin_menu_page() {
	require_once(STYLESHEETPATH.'/inc/homepage-editor-content.php');
}
function cf_register_admin_interface() {
	add_menu_page('Homepage','Homepage','manage_options','homepage','cf_admin_menu_page','dashicons-welcome-widgets-menus',21);
}
//add_action('admin_menu','cf_register_admin_interface');

/* Add Bootstrap style Pagination.
* since: centreforge 2.1.3
*/
// function cf_pagination($pages = '', $range = 2){
//     $showitems = ($range * 2)+1;  
//     global $paged;
//     if(empty($paged)) $paged = 1;
//         if($pages == ''){
//             global $wp_query;
//             $pages = $wp_query->max_num_pages;
//             if(!$pages){
//                 $pages = 1;
//             }
//         }   
//     if(1 != $pages){
//         echo "<ul class='pagination pagination-sm'>";
//         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
//         if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
//         for ($i=1; $i <= $pages; $i++){
//             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
//                 echo ($paged == $i)? "<li class='active'><span>".$i."<span class='sr-only'>(current)</span></span><li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
//             }
//         }
//         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
//         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
//         echo "</li>\n";
//     }
// }

/* Add Bootstrap style Breadcrumb.
* since: centreforge 2.1.3
*/
function the_breadcrumb() {
	global $post;
	echo '<ol class="breadcrumb">';
	if (!is_home()) {
		echo '<li><a href="';
		echo get_option('home');
		echo '">';
		echo 'Home';
		echo '</a></li>';
		if (is_category() || is_single()) {
			echo '<li>';
			the_category(' </li><li> ');
			if (is_single()) {
				echo '</li><li>';
				the_title();
				echo '</li>';
			}
		} elseif (is_page()) {
			if($post->post_parent){
				$anc = get_post_ancestors( $post->ID );
				$title = get_the_title();
				foreach ( $anc as $ancestor ) {
					$output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
				}
				echo $output;
				echo '<li class="active">'.$title.'</li>';
			} else {
				echo '<li class="active">'.get_the_title().'</li>';
			}
		}
	}
	elseif (is_tag()) {single_tag_title();}
	elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
	elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
	elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
	elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
	elseif (is_search()) {echo"<li>Search Results"; echo'</li>';}
	else {echo '<li class="active">Home</li>';}
	echo '</ol>';
}

/* Social links for WordPress admin screen.
* since: centreforge 2.1.4
*/
function ems_general_options() {
	add_settings_section('ems_menu','Social Networks','ems_main_text','general');
	add_settings_field('ems_facebookLink','Facebook Profile','ems_facebook_text','general','ems_menu');
	add_settings_field('ems_linkedinLink','Linked In Profile','ems_linkedin_text','general','ems_menu');
	register_setting('general','ems_fbText','esc_html');
	register_setting('general','ems_linText','esc_html');
}
function ems_main_text(){
	echo "<p>Include the complete URL to your Social Networks profiles.</p>";
}
function ems_facebook_text(){
	echo "<input type=\"text\" name=\"ems_fbText\" class=\"regular-text\" value=\"".get_option('ems_fbText')."\"/>";
}
function ems_linkedin_text(){
	echo "<input type=\"text\" name=\"ems_linText\" class=\"regular-text\" value=\"".get_option('ems_linText')."\"/>";
}
add_action('admin_init','ems_general_options');

/* Activate widget sections.
* since: centreforge 2.1.4
*/
function cf_wp_widgets_init() {
	register_sidebar( array(
		'name' => 'Page Sidebar',
		'id' => 'sidebar-page',
		'description' => 'Used on all pages that are not full-width.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="panel panel-default"><div class="panel-body">',
		'after_widget' => '</div></div></aside>',
		'before_title' => '<h3 class="widget-title drop-margin">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'cf_wp_widgets_init' );

/* WP Updates Hosted Updates - http://www.wp-updates.com/
 * since: centreforge 2.0
 */
//require_once('wp-updates-theme.php');
//new WPUpdatesThemeUpdater_408( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()));

?>