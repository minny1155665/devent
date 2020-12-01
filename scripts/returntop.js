$(function(){
	$('.returntop').click(function(){ 
			$('html,body').animate({scrollTop:0}, 333);
	});
	
	$(window).scroll(function() {
		if ( $(this).scrollTop() > 100 ){
			$('.returntop').fadeIn(500);
		} else {
			$('.returntop').stop().fadeOut(500);
		}
	}).scroll();
});