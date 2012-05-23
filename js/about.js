(function($){

$('.grid-github').hover(
	
	function() {
		$(this).find('p').animate({'margin-top' : '0', 'opacity' : '1'}, 'slow', 'easeInOutQuart');
	},
	function() {
		$(this).find('p').animate({'margin-top' : '50px', 'opacity' : '0'}, 'slow', 'easeInOutQuart');
	}
	
);

})(jQuery)
