<?php  

/* Centreforge Customizer Functionality
 *  
 * Since centreforge 2.2.0
*/

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
	
    // Menu Options
    $wp_customize->add_setting('cf_menu_options[show_menu]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'default' => '1'
	));
	$wp_customize->add_control('cf_menu_options[show_menu]', array(
	 	'settings' => 'cf_menu_options[show_menu]',
        'label'    => 'Show Menu',
	 	'section' => 'nav',
		'type' => 'checkbox',
 	));
    
    // Social Profiles
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
    
    // Custom Colors
    $colors = array();
    $colors[] = array(
        'slug'=>'cf_colors[content_text_color]', 
        'default' => '#333',
        'label' => 'Content Text Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[content_link_color]', 
        'default' => '#337ab7',
        'label' => 'Content Link Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[bs_primary_color]', 
        'default' => '#337ab7',
        'label' => 'Primary Button Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[bs_success_color]', 
        'default' => '#5cb85c',
        'label' => 'Success Button Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[bs_info_color]', 
        'default' => '#46b8da',
        'label' => 'Info Button Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[bs_warning_color]', 
        'default' => '#f0ad4e',
        'label' => 'Warning Button Color'
    );
    $colors[] = array(
        'slug'=>'cf_colors[bs_danger_color]', 
        'default' => '#d9534f',
        'label' => 'Danger Button Color'
    );
    foreach( $colors as $color ) {
        // SETTINGS
        $wp_customize->add_setting(
            $color['slug'], array(
                'default' => $color['default'],
                'type' => 'option', 
                'capability' => 'edit_theme_options'
            )
        );
        // CONTROLS
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $color['slug'], 
                array('label' => $color['label'], 
                'section' => 'colors',
                'settings' => $color['slug'])
            )
        );
    }
}
add_action('customize_register','centreforge_customize_register');

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

/* CF Customizer JS for live preview
* since: centreforge 2.1.8
*/
function cf_customize_preview_js() {
	wp_enqueue_script('cf_customizer',get_template_directory_uri().'/js/theme-customize.js',array('customize-preview'),'2.1.8',true);
	wp_enqueue_script('fontawesome');
}
add_action('customize_preview_init','cf_customize_preview_js');

?>