$(window).load(function(){
	//console.log('init admin');
	window.pluginBookmarksHandler  = new $.myBookmarksHandler();
	window.pluginCategoriesHandler = new $.mySmartGridHandler();
	/* Handler modification categories */
	var listSortable = "#sortable";
	$( listSortable ).sortable({
		placeholder: "categories-sort-placeholder",
		stop:function(){
			window.pluginCategoriesHandler.upDateGrid();
			window.pluginNotifications.msgInfo('Grid updated.');
		}
	});
	$( listSortable ).disableSelection();
	
});