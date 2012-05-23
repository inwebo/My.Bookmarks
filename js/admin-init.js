/**
 * @author inwebo
 */
;(function($) {
	
	//Déclaration variables nécessaires application
	
	
	/*
	 * Bookmarks switch full/compact view
	 * 
	 * click on : .categorie-menu
	 * target   : .bookmarks-list
	 * class    : .bookmarks-simple
	 * 
	 */
	$( '.categorie-menu-display-full' ).click( function(){
		// #1 : Est une vue compacte ?
		if( $( '.bookmarks-list' ).hasClass( 'bookmarks-simple' ) ) {
			$( '.bookmarks-list' ).removeClass( 'bookmarks-simple' );
		}
		return false;
	});

	$( '.categorie-menu-display-compact' ).click( function(){
		// #1 : N'est pas une vue compacte ?
		if( !$( '.bookmarks-list' ).hasClass( 'bookmarks-simple' ) ) {
			$( '.bookmarks-list' ).addClass( 'bookmarks-simple' );
		}
		return false;
	});
	
	/*
	 * Cache le formulaire d'edition d'un bookmark ainsi que
	 * le fond noir transparent
	 */
	$('.bookmark-close').live('click',function(){
		if( $('#bookmarkContainer') ) {
			$('#bookmarkContainer').remove();
			$('.gui-display-shaddy').toggle();
		}
	});
	
})(jQuery);