/**
	/etc/js/ajax.js
	(C) Giovanni Capuano 2011
*/
jQuery(document).ready(function(){
	jQuery('.buttonSpoiler').click(function(){
		jQuery(this).parents('').children('.spoiler').animate({'height':'toggle'}, {duration:600});
	});
});
