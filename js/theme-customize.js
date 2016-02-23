( function( $ ) {
    /* Colors
     * NOTE: These put inline styles for previewing purposes
     * The compiler script will generate the CSS after you save
    */
    wp.customize('cf_colors[body-bg]',function(value){
		value.bind(function(to){
			$('body').css('background-color', to);
		});
	});
    wp.customize('cf_colors[text-color]',function(value){
		value.bind(function(to){
			$('body').css('color', to);
		});
	});
    wp.customize('cf_colors[link-color]',function(value){
		value.bind(function(to){
			$('a').css('color', to);
		});
	});
    wp.customize('cf_colors[brand-primary]',function(value){
		value.bind(function(to){
			$('[class*=-primary]').css('background-color', to);
		});
	});
    wp.customize('cf_colors[brand-success]',function(value){
		value.bind(function(to){
			$('[class*=-success]').css('background-color', to);
		});
	});
    wp.customize('cf_colors[brand-info]',function(value){
		value.bind(function(to){
			$('[class*=-info]').css('background-color', to);
		});
	});
    wp.customize('cf_colors[brand-warning]',function(value){
		value.bind(function(to){
			$('[class*=-warning]').css('background-color', to);
		});
	});
    wp.customize('cf_colors[brand-danger]',function(value){
		value.bind(function(to){
			$('[class*=-danger]').css('background-color', to);
		});
	});
    
    // Social Profiles
	wp.customize('cf_options[facebook]',function(value){
		value.bind(function(to){
			$('#facebook').attr("href",to);
			$('#facebook').removeClass('hide');
		});
	});
	wp.customize('cf_options[twitter]',function(value){
		value.bind(function(to){
			$('#twitter').attr("href",to);
			$('#twitter').removeClass('hide');
		});
	});
	wp.customize('cf_options[googleplus]',function(value){
		value.bind(function(to){
			$('#googleplus').attr("href",to);
			$('#googleplus').removeClass('hide');
		});
	});
	wp.customize('cf_options[linkedin]',function(value){
		value.bind(function(to){
			$('#linkedin').attr("href",to);
			$('#linkedin').removeClass('hide');
		});
	});
	wp.customize('cf_options[youtube]',function(value){
		value.bind(function(to){
			$('#youtube').attr("href",to);
			$('#youtube').removeClass('hide');
		});
	});
})(jQuery);