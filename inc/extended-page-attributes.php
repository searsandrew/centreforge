<?php add_action('admin_menu','cf_extend_page_attributes');

function cf_extend_page_attributes($post_type){
	remove_meta_box('pageparentdiv','page','slide');
	add_meta_box(
		'cf-extended-page-attributes',
		'page' == $post_type?'Page Attributes':'Attributes',
		'cf_attribute_box_cb',
		'page',
		'side',
		'low'
	);
}
function cf_attribute_box_cb($post){
	$post_type_object = get_post_type_object($post->post_type);
	if ( $post_type_object->hierarchical ) {
		$dropdown_args = array(
			'post_type'        => $post->post_type,
			'exclude_tree'     => $post->ID,
			'selected'         => $post->post_parent,
			'name'             => 'parent_id',
			'show_option_none' => __('(no parent)'),
			'sort_column'      => 'menu_order, post_title',
			'echo'             => 0,
		);

		/**
		 * Filter the arguments used to generate a Pages drop-down element.
		 *
		 * @since 3.3.0
		 *
		 * @see wp_dropdown_pages()
		 *
		 * @param array   $dropdown_args Array of arguments used to generate the pages drop-down.
		 * @param WP_Post $post          The current WP_Post object.
		 */
		$dropdown_args = apply_filters( 'page_attributes_dropdown_pages_args', $dropdown_args, $post );
		$pages = wp_dropdown_pages( $dropdown_args );
		if ( ! empty($pages) ) {
?>
<p><strong><?php _e('Parent') ?></strong></p>
<label class="screen-reader-text" for="parent_id"><?php _e('Parent') ?></label>
<?php echo $pages; ?>
<?php
		} // end empty pages check
	} // end hierarchical check.
	if ( 'page' == $post->post_type && 0 != count( get_page_templates( $post ) ) && get_option( 'page_for_posts' ) != $post->ID ) {
		$template = !empty($post->page_template) ? $post->page_template : false;
		?>
<p><strong><?php _e('Template') ?></strong></p>
<label class="screen-reader-text" for="page_template"><?php _e('Page Template') ?></label><select name="page_template" id="page_template">
<?php
/**
 * Filter the title of the default page template displayed in the drop-down.
 *
 * @since 4.1.0
 *
 * @param string $label   The display value for the default page template title.
 * @param string $context Where the option label is displayed. Possible values
 *                        include 'meta-box' or 'quick-edit'.
 */
$default_title = apply_filters( 'default_page_template_title',  __( 'Default Template' ), 'meta-box' );
?>
<option value="default"><?php echo esc_html( $default_title ); ?></option>
<?php page_template_dropdown($template); ?>
</select>
<?php
	} 
/** * Add custom page attribute options. * **/
$values = get_post_custom($post->ID);
$background = isset($values['page_background'])?esc_attr($values['page_background'][0]):'';
$title = isset($values['show_title'])?esc_attr($values['show_title'][0]):'';
wp_nonce_field('cf_meta_box_nonce','meta_box_nonce');
?>
<span id="page-options" class="hidden">
	<p><strong>Background Color</strong></p>
	<p><label class="screen-reader-text" for="page_background">Background Color</label><input name="page_background" type="text" id="page_background" value="<?php echo $background; ?>" class="wp-color-picker" data-default-color="#bada55" /></p>
	<p><strong>Layout Options</strong></p>
	<p><input type="checkbox" id="show_title" name="show_title" <?php checked($title,'on'); ?> />
	<label for="show_title"> Show Title</label></p>
</span>
<span id="page-order" <?php if($dropdown_args['selected'] == 0){ echo 'class="hidden"';} ?>>
	<p><strong><?php _e('Order') ?></strong></p>
	<p><label class="screen-reader-text" for="menu_order"><?php _e('Order') ?></label><input name="menu_order" type="text" size="4" id="menu_order" value="<?php echo esc_attr($post->menu_order) ?>" /></p>
</span>
<?php 
}

add_action('save_post','cf_meta_box_save');
function cf_meta_box_save($post_id){
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'],'cf_meta_box_nonce')) return;
	if(!current_user_can('edit_post')) return;
	$allowed = array(
		'a' => array(
			'href' => array()
		)
	);
	if(isset($_POST['page_background'])){
		update_post_meta($post_id,'page_background',esc_attr($_POST['page_background'])); }
	$chktitle = isset($_POST['show_title']) && $_POST['show_title']?'on':'off';
		update_post_meta($post_id,'show_title',$chktitle);
}