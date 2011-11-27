$(document).ready(function() {
	$('#categoriesList p.ui-droppable span').click(function() {
	var i = $(this);
    var r = confirm('Delete categorie number : ' + $(this).attr('data-category') + ' ( id='+$(this).attr('data-id')+' ) ?'+"\n");
    if(r==true) {
		$.ajax({
			type: "POST",
			// URL script PHP
			url: hostRoot+"del-categorie.php",
			data: { delCat: $(this).attr('data-id') },
			dataType: "text",
			beforeSend:function() {
				// Image loading
			},
			success:function(data) {
				//data = responseText
				i.parent().slideUp(300);

				//i.parent().remove();
			},
			error:function() {
				alert('Une erreur est survenue essayer plus tard');
			}
		})
    }
});
});
