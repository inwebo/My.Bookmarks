$(window).load(function(){
    pluginNotifications = new $.myNotifications();	
	pluginTagsFilter    = new $.myTagsFilter();
	
	
	// Black background
	$( '.gui-display-shaddy' ).click( function() {
		$( this ).toggle();
		$( '#loginFieldset' ).filter(':visible').toggle();
		$( '#bookmarkContainer' ).remove();
		$( '#categorieContainer' ).remove(); 
	});
	
	$('.oneBookmark h3 a').each(
		
		function() {
			
			var mySlidingText = new $.mySlidingText( {parent:this,child:$(this).children('span')});
			$(this).mouseleave(function(){mySlidingText.stopSliding();});
			$(this).mouseenter(function(){mySlidingText.startSliding();});

		}
		
	);
	
});