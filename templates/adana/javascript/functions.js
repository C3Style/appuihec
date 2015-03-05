// JavaScript Document
$.noConflict();
  jQuery(document).ready(function($) {
    // Code that uses jQuery's $ can follow here.
	jQuery('#topmenue ul.menu li, #bottom-menu ul.menu li').each(function(index){
		var subtitle = $(this).find('a').attr('title');
		$(this).find('a').append(' <span>'+subtitle+'</span>');
	});
  });