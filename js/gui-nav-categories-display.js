(function($){
var droppableContainer = '#categories-landing';
$('#menu-display-categories').click(function(){
		$(droppableContainer).animate({
			'top' : 30
		}, 800, 'easeOutQuint');
		
		$('h1 span').animate({
			'margin-top' : -10
		}, 800, 'easeOutQuint');
});

})(jQuery)
