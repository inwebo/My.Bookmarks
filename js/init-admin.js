$(window).load(function(){
	console.log('init admin');
	window.pluginBookmarksHandler  = new $.myBookmarksHandler();
	window.pluginCategoriesHandler = new $.myCategoriesHandler();
	
	/* Handler modification categories */
	var listSortable = "#sortable";
	$( listSortable ).sortable({
		placeholder: "categories-sort-placeholder",
		stop:function(){ window.pluginCategoriesHandler.Query() }
	});
	$( listSortable ).disableSelection();
	
});