(function($){
		$.ajax({
			type: "POST",
			// URL script PHP
			url: hostRoot+"add-categorie.php",
			data: { postVar:'theValue1', postVar2:'theValue2' },
			dataType: "text",
			beforeSend:function() {
				// Image loading
			},
			success:function(data) {
				//data = responseText
			},
			error:function() {
				alert('Une erreur est survenue essayer plus tard');
			}
		});
})(jQuery)
