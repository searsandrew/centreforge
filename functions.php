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
//require_once(TEMPLATEPATH.'/inc/theme-customizer.php'); /* ** since: centreforge 2..2 ** */

require_once(TEMPLATEPATH.'/inc/extended-page-attributes.php'); /* Added Centreforge 2.2.0 */
require_once(TEMPLATEPATH.'/inc/extended-media-uploader.php'); /* Added Centreforge 2.2.0 */

/* Admin Script & Style Enqueue
 * since: centreforge 2.2.0
 */
function cf_enqueue_admin_scripts($hook_suffix){
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('cf-page-attributes',get_template_directory_uri().'/js/page-attributes.js',array('jquery','wp-color-picker'),false,true);
}
add_action('admin_enqueue_scripts','cf_enqueue_admin_scripts');

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
  wp_register_script('bootstrapjs', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'),'3.3.5', true );  
  wp_register_script('bootstrapgf', get_template_directory_uri().'/js/bootstrap-gravity-forms.min.js', array('jquery'),'1.0.0', true );  
  
  wp_enqueue_script('bootstrapjs');
  wp_enqueue_script('bootstrapgf'); 
  
  // Styles
  wp_register_style('bootstrapcss', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',false,'3.3.5','all');
  wp_register_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',false,'4.3.0','all');
  wp_register_style('stylesheet',get_stylesheet_uri(),array('bootstrapcss'),'1.0.0','all');
    
  wp_enqueue_style('bootstrapcss');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('stylesheet');
}
add_action('wp_enqueue_scripts', 'cwd_wp_bootstrap_scripts_styles', 0);

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
    /* Add MCE css file to the admin section.  This is used mainly for using dashicons as the MCE buttons, but you can also include your own custom buttons here. */
    wp_enqueue_style( 'custom_tinymce_plugin', get_template_directory_uri() . '/css/custom-tinymce-plugin.css', __FILE__ );
}
add_action('admin_head', 'tinymce_buttons');

function action_admin_init() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_buttons', 'filter_mce_button' );
		add_filter( 'mce_external_plugins', 'filter_mce_plugin' );
	}
}

function filter_mce_button( $buttons ) {
	array_push( $buttons, '|', 'cfmce_button','shortcodes');
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
	add_settings_field('ems_twitterLink','Twitter Profile','ems_twitter_text','general','ems_menu');
	add_settings_field('ems_linkedinLink','Linked In Profile','ems_linkedin_text','general','ems_menu');
	register_setting('general','ems_fbText','esc_html');
	register_setting('general','ems_twText','esc_html');
	register_setting('general','ems_linText','esc_html');
}
function ems_main_text(){
	echo "<p>Include the complete URL to your Social Networks profiles.</p>";
}
function ems_facebook_text(){
	echo "<input type=\"text\" name=\"ems_fbText\" class=\"regular-text\" value=\"".get_option('ems_fbText')."\"/>";
}
function ems_twitter_text(){
	echo "<input type=\"text\" name=\"ems_twText\" class=\"regular-text\" value=\"".get_option('ems_twText')."\"/>";
}
function ems_linkedin_text(){
	echo "<input type=\"text\" name=\"ems_linText\" class=\"regular-text\" value=\"".get_option('ems_linText')."\"/>";
}
//add_action('admin_init','ems_general_options');

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

/* Returns options array for Theme Customizer.
* since: centreforge 2.1.8
*/
function cf_options($name, $default = false) {
	$options = (get_option('cf_options'))?get_option('cf_options'):null;
	if(isset($options[$name])){
		return apply_filters('cf_options_$name', $options[$name]);
	}
	return apply_filters('cf_options_$name',$default);
}

/* Theme Customizer.
* since: centreforge 2.1.8
*/
function centreforge_customize_register($wp_customize){
	$wp_customize->add_section('layout_section', array(
		'title' => 'Layout',
		'capability' => 'edit_theme_options',
		'description' => 'Allows you to edit your theme\'s layout.')
	);
	$wp_customize->add_setting('cf_options[use_custom_text]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'default' => '1'
	));
	$wp_customize->add_control('cf_options[use_custom_text]', array(
		'settings' => 'cf_options[use_custom_text]',
		'label' => 'Display Custom Text',
		'section' => 'layout_section',
		'type' => 'checkbox',
	));
	
	$wp_customize->add_setting('cf_options[logo_upload]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_upload', array(
	 	'label'    => 'Logo Upload',
	 	'section'  => 'title_tagline',
	 	'settings' => 'cf_options[logo_upload]',
 	)));
	
	$wp_customize->add_section('social_section', array(
		'title' => 'Social Profiles',
		'capability' => 'edit_theme_options',
		'description' => 'Allows you to add your social profiles.')
	);
	$wp_customize->add_setting('cf_options[facebook]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'transport' => 'postMessage'
	));
	$wp_customize->add_control('cf_options[facebook]', array(
		'settings' => 'cf_options[facebook]',
		'label' => 'Facebook URL',
		'section' => 'social_section',
		'type' => 'text'
	));
	$wp_customize->add_setting('cf_options[twitter]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control('cf_options[twitter]', array(
		'settings' => 'cf_options[twitter]',
		'label' => 'Twitter URL',
		'section' => 'social_section',
		'type' => 'text'
	));
	$wp_customize->add_setting('cf_options[googleplus]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control('cf_options[googleplus]', array(
		'settings' => 'cf_options[googleplus]',
		'label' => 'Google+ URL',
		'section' => 'social_section',
		'type' => 'text'
	));
	$wp_customize->add_setting('cf_options[linkedin]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control('cf_options[linkedin]', array(
		'settings' => 'cf_options[linkedin]',
		'label' => 'LinkedIn URL',
		'section' => 'social_section',
		'type' => 'text'
	));
	$wp_customize->add_setting('cf_options[youtube]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
	));
	$wp_customize->add_control('cf_options[youtube]', array(
		'settings' => 'cf_options[youtube]',
		'label' => 'YouTube URL',
		'section' => 'social_section',
		'type' => 'text'
	));
}
add_action('customize_register','centreforge_customize_register');

/* Functions specific to the Customizer 
 * Since centreforge 2.2.0
*/

// Get all the social profiles in the customizer.  Also has the option to grab just one of the social media profiles
function cfcustomizer_get_social_profiles($which = 'all'){
    $cfOptions = get_option( 'cf_options', 'default' );
    $socialTypes = array('facebook','twitter','googleplus','linkedin','youtube');
    
    $socialProfiles = array();
    if($which = 'all'){
        $i = 0;
        foreach($socialTypes as $socialType){
            if(array_key_exists($socialType, $cfOptions)){
                if($cfOptions[$socialType] != '') {
                    $socialProfiles[$socialType] = $cfOptions[$socialType];
                }
                $i++;
            }
        }
    } else {
        $socialProfiles[$which] = $cfOptions[$which];
    }
    
    return $socialProfiles;
}

/* Modify the comments form fields
 * Since centreforge 2.2.0
 * SOURCE: http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
*/

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' .                     $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>' 
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . _x( 'Comment', 'noun' ) . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    $args['class_submit'] = 'btn btn-default'; // since WP 4.1
    
    return $args;
}

/* CF Customizer JS for live preview
* since: centreforge 2.1.8
*/
function cf_customize_preview_js() {
	wp_enqueue_script('cf_customizer',get_template_directory_uri().'/js/theme-customize.js',array('customize-preview'),'2.1.8',true);
	wp_enqueue_script('fontawesome');
}
add_action('customize_preview_init','cf_customize_preview_js');

/* WP Updates Hosted Updates - http://www.wp-updates.com/
 * since: centreforge 2.0
 * disabled: centreforge 2.1.5
 * reactivated: centreforge 2.1.8
 */
require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_408( 'http://wp-updates.com/api/2/theme', basename(get_template_directory()));

?>