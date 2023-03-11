

$(function(){
	$('.carousel').carousel({
		interval: false
	});

	$('.search').on('click', function(){
		$('.main-menu .navbar-form').slideToggle();
	});

	$('#elastislide').elastislide();
});

$(function() {
  $('.dropdown a.dropdown-toggle').click(function() {
    location.href = $(this).attr('href');
  });
});

$(function() {
	$('.dropdown-toggle').dropdown();
});
