jQuery(document).ready(function(){
	jQuery('.slider .rght .colrs a').click(function(){
		var $bgcol = jQuery(this).attr('href');
		var $id = jQuery(this).parent().attr('id').replace('_colrs', '');
		
		jQuery('.slider .rght .colrs a').removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('#'+$id).val($bgcol);
		jQuery('#'+$id+'_colorpicker').css({backgroundColor:'#'+$bgcol});
		
		return false;
	});
});

jQuery(document).ready(function(){
	jQuery('.slider .rght .select_bgs a').click(function(){
		var $bgimg = jQuery(this).attr('href');
		var $id = jQuery(this).parent().attr('id').replace('_patterns_bgs', '').replace('_transparents_bgs', '').replace('_images_bgs', '');
		
		jQuery('.slider .rght .select_bgs a').removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery('#'+$id).val($bgimg);
		
		return false;
	});
});