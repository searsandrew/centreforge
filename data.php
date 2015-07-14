
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
			'menu_position'       => 20,
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

function cf_rotator_meta(){ ?>
	<div class="form-field">
		<label for="term_meta[mode]">Mode</label>
		<select id="term_meta[mode]" name="term_meta[mode]">
			<option value="horizontal">Horizontal</option>
			<option value="vertical">Vertical</option>
			<option value="fade">Fade</option>
		</select>
		<p class="description">Type of transition between slides.</p>
	</div>
	<div class="form-field">
		<label for="term_meta[speed]">Speed</label>
		<input type="text" id="term_meta[speed]" name="term_meta[speed]" value="500" />
		<p class="description">Slide transition duration (in ms).</p>
	</div>
<?php }
add_action('group_add_form_fields','cf_rotator_meta',10,2);

function cf_rotator_meta_edit($term){
	$t_id = $term->term_id;
	$term_meta = get_option("taxonomy_$t_id"); ?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[mode]">Mode</label></th>
		<td>
			<select id="term_meta[mode]" name="term_meta[mode]">
				<option value="horizontal" <?php echo ($term_meta['mode'] == 'horizontal' ? 'selected="selected"':''); ?>>Horizontal</option>
				<option value="vertical" <?php echo ($term_meta['mode'] == 'vertical' ? 'selected="selected"':''); ?>>Vertical</option>
				<option value="fade" <?php echo ($term_meta['mode'] == 'fade' ? 'selected="selected"':''); ?>>Fade</option>
			</select>
			<p class="description">Type of transition between slides.</p>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="term_meta[speed]">Speed</label></th>
		<td>
			<input type="text" name="term_meta[speed]" id="term_meta[speed]" value="<?php echo esc_attr($term_meta['speed']) ? esc_attr($term_meta['speed']):''; ?>">
			<p class="description">Slide transition duration (in ms).</p>
		</td>
	</tr>
<?php }
add_action('group_edit_form_fields','cf_rotator_meta_edit',10,2); 

function cf_rotator_meta_save($term_id){
	if(isset($_POST['term_meta'])){
		$t_id = $term_id;
		$term_meta = get_option("taxonomy_$t_id");
		$cat_keys = array_keys($_POST['term-meta']);
		foreach($cat_keys as $key){
			if(isset($_POST['term_meta'][$key])){
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		update_option("taxonomy_$t_id", $term_meta);
	}
}
add_action('edited_group','cf_rotator_meta_save',10,2);
add_action('create_group','cf_rotator_meta_save',10,2); ?>