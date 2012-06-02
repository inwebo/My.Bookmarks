/**
 * Administration
 */
(function($) {
    $(function() {

	// Add categorie
	$('#categories-new-save').unbind('click').click( function() {
		console.log('Edit');
	    if( $('#newCat').val() == '' ) {
	    	pluginNotifications.msg('Nope','empty string!');
	    }
	    else {
	    	var action = new $.myCategorie();
			action.createCat();
	    }
	    });
	
	// Delete categorie handler
	$('.categorie-delete').die('click').live('click',			
		// #2 : deleteCat()
		function() {
			var $current = $(this).closest('.oneBookmark');
			var action = new $.myCategorie({'currentNode':$current});
			action.deleteCat();
		});
	        
	// Edit categorie handler
	$('.categorie-edit').die('click').live('click',			
		// #2 : deleteCat()
		function() {
			var $current = $(this).closest('.oneBookmark');
			var action = new $.myCategorie({'currentNode':$current});
			action.editCat();
	});

	});
})(jQuery);