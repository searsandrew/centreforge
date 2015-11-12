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
    
    $wp_customize->add_section('menu_layout', array(
		'title' => 'Menu Layout',
		'capability' => 'edit_theme_options',
        'panel'       => 'nav_menus',
        'priority'    => 5,
		'description' => 'Allows you to edit your theme\'s layout.')
	);
    
    $cf_nav_types = array();
    $cfchild_nav_types = array();
    
    // Find all files in the centreforge theme with nav-
    $cfcore_nav_types = glob(TEMPLATEPATH."/nav-*.php");
    
    // If there is a child theme preset, get the child theme navs
    if(TEMPLATEPATH != STYLESHEETPATH){
        //Find all Child Theme nav-
        $cfchild_nav_types = glob(STYLESHEETPATH."/nav-*.php");
    }
    
    $cf_nav_types = array_merge($cfcore_nav_types, $cfchild_nav_types);
    
    if(count($cf_nav_types) > 0) {
        $menuTypes = array();
        foreach($cf_nav_types as $cf_nav_type) {
            $info = pathinfo($cf_nav_type);
            $filenameNoNav = str_replace('nav-', '', $info['filename']);
            $filename = str_replace('-', ' ', $filenameNoNav);
            $menuTypes[$filenameNoNav] = ucwords($filename);
        }
        
        $wp_customize->add_setting('cf_menu_options[menu_type]', array(
            'default' => 'bootstrap',
            'type' => 'option',
            'capability' => 'edit_theme_options'
        ));
        $wp_customize->add_control('cf_menu_options[menu_type]', array(
            'label'    => 'Primary Menu Style',
            'section'    => 'menu_layout',
            'settings' => 'cf_menu_options[menu_type]',
            'type' => 'select',
            'choices' => $menuTypes
        ));
    }
    
    $wp_customize->add_setting('cf_menu_options[show_menu]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'default' => '1'
	));
	$wp_customize->add_control('cf_menu_options[show_menu]', array(
	 	'label'    => 'Show Main Menu',
        'section' => 'menu_layout',
        'settings' => 'cf_menu_options[show_menu]',
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
        'transport' => 'postMessage'
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
        'transport' => 'postMessage'
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
        'transport' => 'postMessage'
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
        'transport' => 'postMessage'
	));
	$wp_customize->add_control('cf_options[youtube]', array(
		'settings' => 'cf_options[youtube]',
		'label' => 'YouTube URL',
		'section' => 'social_section',
		'type' => 'text'
	));
    
    // Custom Colors
    
    // Remove these two controls and re-add them using our colors array
    $wp_customize->remove_control('header_textcolor');
    $wp_customize->remove_control('background_color');
    
    $colors = array();
    $colors[] = array(
        'slug'      =>'cf_colors[body-bg]', 
        'default'   => '#fff',
        'label'     => 'Background Color',
        'description' => __( 'The main body background color.', 'centreforge' ),
    );
    
    $colors[] = array(
        'slug'      =>'cf_colors[text-color]', 
        'default'   => '#333',
        'label'     => 'Content Text Color',
        'description' => __( 'The main text color for your content.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[link-color]', 
        'default'   => '#337ab7',
        'label'     => 'Content Link Color',
        'description' => __( 'The text color for all your links.  This is typically the same color as Brand Primary.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[brand-primary]', 
        'default'   => '#337ab7',
        'label'     => 'Brand Primary Color',
        'description' => __( 'Primary color for any buttons, labels, and headings you may have.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[brand-success]', 
        'default'   => '#5cb85c',
        'label'     => 'Success Color',
        'description' => __( 'The color for any success labels, buttons or alerts.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[brand-info]', 
        'default'   => '#46b8da',
        'label'     => 'Info Button Color',
        'description' => __( 'The color for any info labels, buttons or alerts.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[brand-warning]', 
        'default'   => '#f0ad4e',
        'label'     => 'Warning Button Color',
        'description' => __( 'The color for any warning labels, buttons or alerts.', 'centreforge' ),
    );
    $colors[] = array(
        'slug'      =>'cf_colors[brand-danger]', 
        'default'   => '#d9534f',
        'label'     => 'Danger Button Color',
        'description' => __( 'The color for any danger labels, buttons or alerts.', 'centreforge' ),
    );
    foreach( $colors as $color ) {
        // SETTINGS
        $wp_customize->add_setting(
            $color['slug'], array(
                'default' => $color['default'],
                'type' => 'option', 
                'capability' => 'edit_theme_options',
                'transport' => 'postMessage',
                'sanitize_callback' => 'compileBootstrapCss',
            )
        );
        // CONTROLS
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                $color['slug'], 
                array(
                    'label' => $color['label'], 
                    'section' => 'colors',
                    'settings' => $color['slug'],
                    'description' => $color['description']
                )
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

/* Added Centreforge 2.2.1, A PHP Sass compiler 
 * Compile bootstrap Sass when colors are saved.
*/
function compileBootstrapCss($data) {
    // Include the compiler class
    require_once(TEMPLATEPATH.'/inc/scssphp/scss.inc.php');
    // Start new SCSS class
    $scss = new scssc();
    // Set the path where our SCSS files are located
    $scss->setImportPaths(TEMPLATEPATH."/css/scss/");
    $scss->setFormatter( 'scss_formatter' );

    // Get all colors from the customizer
    $cfColors = get_option('cf_colors');
    
    if(isset($data->cf_colors)) {
    
        // Overwrite any SASS variable we want!
        $scss->setVariables($cfColors);

        // Run the compiler with the new variables
        $newCss = $scss->compile('
            @import "bootstrap.scss";
        ');

        //Find our current bootstrap file
        $cssFile = TEMPLATEPATH.'/css/bootstrap.min.css';
        $currentCss = file_get_contents($cssFile);

        // Overwrite default bootstrap css with the newly compiled CSS
        file_put_contents($cssFile, $newCss);
    }
    
    return $data;
    //return $data->cf_colors[0];
}


/* CF Customizer JS for live preview
* since: centreforge 2.1.8
*/
function cf_customize_preview_js() {
	wp_enqueue_script('cf_customizer',get_template_directory_uri().'/js/theme-customize.js',array('customize-preview'),'1.0.0',true);
	wp_enqueue_script('fontawesome');
}
add_action('customize_preview_init','cf_customize_preview_js');

?>