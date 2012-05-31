$(window).load(function(){
    pluginNotifications = new $.myNotifications();	
	pluginTagsFilter    = new $.myTagsFilter();
	
	
	// Black background
	$( '.gui-display-shaddy' ).click( function() {
		$( this ).toggle();
		$( '#loginFieldset' ).filter(':visible').toggle();
		$( '#bookmarkContainer' ).remove();
	});
	
});