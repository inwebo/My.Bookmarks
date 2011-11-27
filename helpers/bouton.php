<a href="
javascript:(function(){

	var description;
	var keywords;

	var metas = document.getElementsByTagName('meta');
	for (var x=0,y=metas.length; x<y; x++) {
	  if (metas[x].name.toLowerCase() == 'description') {
		description = metas[x];
	  }
	  if (metas[x].name.toLowerCase() == 'keywords') {
		keywords = metas[x];
	  }
	}

	if( typeof(description) == 'undefined' ) {
		var description = document.createElement('p');
		description.content = 'empty';
	}

	if( typeof(keywords) == 'undefined' ) {
		var keywords = document.createElement('p');
		keywords.content = 'empty';
	}

	var jsScript=document.createElement('script');
	jsScript.setAttribute('type','text/javascript');
	jsScript.setAttribute('src', '<?php echo ROOT_AJAX; ?>bookmark.php?url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title) +'&amp;tags=' + keywords.content +'&amp;desc=' + description.content);
	document.getElementsByTagName('head')[0].appendChild(jsScript);



})();


" class="">Bookmark this!</a>
