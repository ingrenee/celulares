
function cpColorClear(ch_class){
	if(ch_class != '') 
	{ 
		jQuery('body').removeClass('yellow blue red emerald violet pink').addClass(ch_class.split("cp_")[1]);
		jQuery.cookie('cp_color', ch_class.split("cp_")[1]);
		
	}
	else jQuery('body').removeClass('yellow blue red emerald violet pink').addClass('blue');
}

function cpPatternClear(ch_class){
	if(ch_class != '') 
	{ 
		jQuery('body').removeClass('dots mosaic ribs waves mram pixels').addClass(ch_class.split("cp_")[1]);
		jQuery.cookie('cp_pattern', ch_class.split("cp_")[1]);
	}
	else jQuery('body').removeClass('dots mosaic ribs waves mram pixels');
}

jQuery(function(){
	
	var opened = false; 
	
	if (jQuery.cookie('cp_state') == 1) opened = true;
	
	
	jQuery('body').append('\
	<div id="cpanel">\
			<div id="cp_holder">\
				<div id="cp_icon"></div>\
				<div class="cp_heading">Style Switcher</div>\
				<div id="cp_container">\
					<div class="cp_title">Switch Colors</div>\
					<div id="cp_colors">\
						<div id="cp_yellow" class="bbox"></div>\
						<div id="cp_blue" class="bbox"></div>\
						<div id="cp_red" class="bbox"></div>\
						<div id="cp_emerald" class="bbox"></div>\
						<div id="cp_violet" class="bbox"></div>\
						<div id="cp_pink" class="bbox"></div>\
						\
					</div>\
					<div class="cp_title">Switch Textures</div>\
					<div id="cp_patterns">\
						<div id="cp_dots" class="bbox"></div>\
						<div id="cp_mosaic" class="bbox"></div>\
						<div id="cp_ribs" class="bbox"></div>\
						<div id="cp_waves" class="bbox"></div>\
						<div id="cp_mram" class="bbox"></div>\
						<div id="cp_pixels" class="bbox"></div>\
					</div>\
					<div id="cp_reset"></div>\
				</div>\
			</div>\
			\
	</div>');
	
	jQuery('#cp_icon').bind('click', function(){
	
		if (opened) { to = '-156px'; opened = false; 
			jQuery.cookie('cp_state', 0);
		}
		else { 
			to = '0'; opened = true;
			jQuery.cookie('cp_state', 1);
		}
		
		jQuery('#cpanel').animate({
			right: to
		});
	});
	
	
	
	jQuery('#cp_colors .bbox').click(function(){
		cpColorClear(jQuery(this).attr('id'));
	});
	
	jQuery('#cp_patterns .bbox').click(function(){
		cpPatternClear(jQuery(this).attr('id'));
	});
	
	jQuery('#cp_reset').click(function(){
		cpColorClear('');
		cpPatternClear('');
	});
	
	if (opened) {
		jQuery('#cpanel').css({right: '0px'});	
	}
	
	
});

