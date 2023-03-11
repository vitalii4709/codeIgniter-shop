$(function(){
	'use strict';	
	// инициализация плагина
	$.jqCart({
			buttons: '.button',
			handler: './php/handler.php',
			cartLabel: '.label-place',
			visibleLabel: true,
			openByAdding: false,
			currency: '<span class="rubznak">a</span>;'
			});	
	// Пример с дополнительными методами (currency: '&euro;')&rub;
	$('#open').click(function(){
		$.jqCart('openCart'); // открыть корзину
	});
	$('#clear').click(function(){
		$.jqCart('clearCart'); // очистить корзину
	});	
});
/*
$(function(){
	$('.carousel').carousel({
		interval: false
	});

	$('.search').on('click', function(){
		$('.main-menu .navbar-form').slideToggle();
	});

	$('#elastislide').elastislide();
});
*/
$(window).load(function(){
	var carouselCaptionWidth = $('#carousel-sidebar .active img').width();
	$('#carousel-sidebar img').each(function(){
		$(this).attr('width', carouselCaptionWidth);
	});
	$('#carousel-sidebar .sidebar-carousel-caption').css('max-width', carouselCaptionWidth + 'px');
	$('#carousel-sidebar .carousel-indicators').css('max-width', carouselCaptionWidth + 'px');
	$('.sidebar .banner').css('max-width', carouselCaptionWidth + 'px');
});

$(function() {
  $('.dropdown a.dropdown-toggle').click(function() {
    location.href = $(this).attr('href');
  });
});

$(function() {
	$('.dropdown-toggle').dropdown();
});