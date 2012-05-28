;(function($){
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
		if( $(this).closest('div[class*=grid_]').children( '.bookmarks-list' ).hasClass( 'bookmarks-simple' ) ) {
			$(this).closest('div[class*=grid_]').children( '.bookmarks-list' ).removeClass( 'bookmarks-simple' );
		}
		return false;
	});

	$( '.categorie-menu-display-compact' ).click( function(){
		// #1 : N'est pas une vue compacte ?
		if( !$(this).closest('div[class*=grid_]').children( '.bookmarks-list' ).hasClass( 'bookmarks-simple' ) ) {
			$(this).closest('div[class*=grid_]').children( '.bookmarks-list' ).addClass( 'bookmarks-simple' );
		}
		return false;
	});
})(jQuery)