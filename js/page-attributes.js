jQuery(document).ready(function($){
	$('.wp-color-picker').wpColorPicker();
	$('#page_template').on('change',function(){
		var pagename = $(this).val();
		console.log('Template Name: '+pagename);
		if(pagename == 'page-parent.php'){
			$('#page-options').removeClass('hidden');
		} else {
			$('#page-options').addClass('hidden');
		}
	})
	$('#parent_id').on('change',function(){
		var parentval = $(this).val();
		if(parentval == ''){
			$('#page-order').addClass('hidden');
		} else {
			$('#page-order').removeClass('hidden');
		}
	})
})