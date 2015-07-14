<?php if ( ! function_exists('cf_rotator') ) {
	function cf_rotator() {
		$labels = array(
			'name'                => _x( 'Rotators', 'Post Type General Name', 'cf' ),
			'singular_name'       => _x( 'Rotator', 'Post Type Singular Name', 'cf' ),
			'menu_name'           => __( 'Rotators', 'cf' ),
			'parent_item_colon'   => __( 'Parent Rotator:', 'cf' ),
			'all_items'           => __( 'All Rotators', 'cf' ),
			'view_item'           => __( 'View Rotator', 'cf' ),
			'add_new_item'        => __( 'Add New Rotator', 'cf' ),
			'add_new'             => __( 'Add New', 'cf' ),
			'edit_item'           => __( 'Edit Rotator', 'cf' ),
			'update_item'         => __( 'Update Rotator', 'cf' ),
			'search_items'        => __( 'Search Rotators', 'cf' ),
			'not_found'           => __( 'Not found', 'cf' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'cf' ),
		);
		$args = array(
			'label'               => __( 'rotator', 'cf' ),
			'description'         => __( 'Content Rotators', 'cf' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail', ),
			'taxonomies'          => array( 'group' ),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 22,
			'menu_icon'           => 'dashicons-slides',
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'rotator', $args );
	}
	add_action( 'init', 'cf_rotator', 0 );
} 

if ( ! function_exists( 'cf_rotator_groups' ) ) {
	function cf_rotator_groups() {
		$labels = array(
			'name'                       => _x( 'Groups', 'Taxonomy General Name', 'cf' ),
			'singular_name'              => _x( 'Group', 'Taxonomy Singular Name', 'cf' ),
			'menu_name'                  => __( 'Group', 'cf' ),
			'all_items'                  => __( 'All Groups', 'cf' ),
			'parent_item'                => __( 'Parent Group', 'cf' ),
			'parent_item_colon'          => __( 'Parent Group:', 'cf' ),
			'new_item_name'              => __( 'New Group Name', 'cf' ),
			'add_new_item'               => __( 'Add New Group', 'cf' ),
			'edit_item'                  => __( 'Edit Group', 'cf' ),
			'update_item'                => __( 'Update Group', 'cf' ),
			'separate_items_with_commas' => __( 'Separate groups with commas', 'cf' ),
			'search_items'               => __( 'Search Groups', 'cf' ),
			'add_or_remove_items'        => __( 'Add or remove groups', 'cf' ),
			'choose_from_most_used'      => __( 'Choose from the most used groups', 'cf' ),
			'not_found'                  => __( 'Not Found', 'cf' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
		);
		register_taxonomy( 'group', array( 'rotator' ), $args );
	}
	add_action( 'init', 'cf_rotator_groups', 0 );
} 

$config = array(
	'id' => 'cf_rotator_meta',
	'title' => 'Rotator Meta Box',
	'pages' => array('group'),
	'context' => 'normal',
	'fields' => array(),
	'local_images' => false,
	'use_with_theme' => true
);
$cf_rotator = new Tax_Meta_Class($config);
$cf_rotator->addSelect('mode',array('horizontal'=>'Horizontal','vertical'=>'Vertical','fade'=>'Fade'),array('name'=> 'Transition Mode', 'std'=> array('horizontal')));
$cf_rotator->addText('speed',array('name'=>'Transition Speed', 'std'=>'500', 'desc'=>'Type of transition between slides.'));
$cf_rotator->addRadio('loop',array('true'=>'True','false'=>'False'),array('name'=> 'Infinite Loop', 'std'=> array('true')));
$cf_rotator->addRadio('captions',array('true'=>'True','false'=>'False'),array('name'=> 'Include Captions', 'std'=> array('false')));
$cf_rotator->addRadio('ticker',array('true'=>'True','false'=>'False'),array('name'=> 'Ticker Style', 'std'=> array('false')));
$cf_rotator->addRadio('video',array('true'=>'True','false'=>'False'),array('name'=> 'Include Video', 'std'=> array('false')));
$cf_rotator->Finish();
?>