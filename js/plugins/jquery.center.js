function Midway(){
	var $centerHorizontal = jQuery('.midway-horizontal'),
		$centerVertical = jQuery('.midway-vertical');

	$centerHorizontal.each(function(){
		jQuery(this).css('marginLeft', -jQuery(this).outerWidth()/2);
	});
	$centerVertical.each(function(){
		jQuery(this).css('marginTop', -jQuery(this).outerHeight()/2);
	});
	$centerHorizontal.css({
		'display' : 'inline',
		'position' : 'absolute',
		'left' : '50%'
	});
	$centerVertical.css({
		'display' : 'inline',
		'position' : 'absolute',
		'top' : '50%',
	});
}
jQuery(window).on('load', Midway);
jQuery(window).on('resize', Midway);