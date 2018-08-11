// JavaScript Document
jQuery(document).ready(function() {

$('.panel').hide();

$('.jobinfounit').click(function() {
	$(this).parent().find('div.panel').slideToggle("slow");
});


/*
$('.panel').hide();

$('.jobinfounit').collapser({
	target: 'next',
	effect: 'slide',
	changeText: 0,
	expandClass: 'expIco',
	collapseClass: 'collIco'
}, function(){
	$('.panel').slideUp();
});*/


});