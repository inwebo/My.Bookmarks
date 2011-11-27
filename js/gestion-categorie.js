$('#addCategory').click( function() {

    if( $('#inputCat').val() == '' ) {
		$('#addResponse').html('added');
    }
    else {
		$.ajax({
			type: "POST",
			url: hostRoot+"add-categorie.php",
			data: "inputCat="+$('#inputCat').val(),
			dataType: "text",
			success:function(data) {
				if(data != "FALSE") {
					$('#addResponse').html('added');
					$('#addNewcat').before('<p id="idCategorie'+$.trim(data)+'" data-id="'+$.trim(data)+'" class="ui-droppable">'+$('#inputCat').val()+'<span data-id="'+$.trim(data)+'" class="delCat">del</span></p>');
					$.ajaxSetup({async: false});
					$.getScript(hostJS+'computeitem.php');
					$.getScript(hostJS+'cat-del.js');
					$.ajaxSetup({async: true});
				}
				else {
					$('#addResponse').html('Already exists');
				}
				$('#inputCat').val('');
			},
			error:function() {
				alert('Une erreur est survenue essayer plus tard');
			}
		});

    }
	$('#addResponse').delay(2500).slideUp(300);

});
