(function($){
		$.ajax({
			type: "GET",
			// URL script PHP
			url: "http://my.bookmarks.free.fr/helpers/version.php",
			data: {  },
			dataType: "text",
			beforeSend:function() {
				// Image loading
			},
			success:function(data) {
				//data = responseText
                                addMssg('okay','version ' + data + '.');
			},
			error:function() {
				alert(data);
			}
		});
})(jQuery)
