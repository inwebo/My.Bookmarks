;(function($) {

var droppableContainer = '#categories-landing';
var dropdown           = 0;

$('#menu-display-categories').click(function(){
	
	if( dropdown == 0 ) {
		$(droppableContainer).animate({
			'top' : 30
		}, 800, 'easeOutQuint');
		
		$('h1 span').animate({
			'margin-top' : -10
		}, 800, 'easeOutQuint');
		
		$(this).removeClass('');
		
		dropdown = 1;
	}
	else {
		$(droppableContainer).animate({
			'top' : -100
		}, 800, 'easeOutQuint');
		
		$('h1 span').animate({
			'margin-top' : 0
		}, 800, 'easeOutQuint');
		
		dropdown = 0;
	}

});

})(jQuery)
