;(function($){
	
	pluginNotifications;
	
	$.getScript( JS_PATH_JS + "gui-login.js");
	$.getScript( JS_PATH_JS + "gui-nav-categories-display.js");
	$.getScript( JS_PATH_JS + "gui-bookmarks-list-switch-view.js");
	$.getScript( JS_PATH_JS + "plugin.mynotifications.js", function(xhr){
		eval(xhr);
	    pluginNotifications = new $.myNotifications();	
	});
	$.getScript( JS_PATH_JS + "plugin.tags-filter.js", function(){
		pluginTagsFilter    = new $.myTagsFilter();
	});

})(jQuery);