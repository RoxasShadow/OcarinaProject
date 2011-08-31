/**
	/etc/js/ajax.js
	(C) Giovanni Capuano 2011
*/
$(document).ready(function(){
	$('.buttonSpoiler').click(function(){
		$(this).parents('').children('.spoiler').animate({'height':'toggle'}, {duration:600});
	});
});
