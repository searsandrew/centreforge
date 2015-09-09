<?php add_action('wp_enqueue_media',function(){
	if(!remove_action('admin_footer','wp_print_media_templates')){
		error_log("remove_action Fail");
	}
	add_action('admin_footer','cf_print_media_templates');
});
function cf_print_media_templates(){
	$replaces = array(
		'/<option value="center"/' => '<option value="pull-left">'.esc_attr('Bootstrap Left').'</option>$0',
		'/<option value="none"/' => '<option value="pull-right">'.esc_attr('Bootstrap Right').'</option>$0',
		'/<button class="button" value="center">/' => '<button class="button" value="pull-left">'.esc_attr('Bootstrap Left').'</button>$0',
		'/<button class="button active" value="none">/' => '<button class="button" value="pull-right">'.esc_attr('Bootstrap Right').'</button>$0',
	);
	ob_start();
	wp_print_media_templates();
	echo preg_replace(array_keys($replaces),array_values($replaces),ob_get_clean());
}