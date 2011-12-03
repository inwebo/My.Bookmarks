$('#addCategory').click( function() {

    if( $('#inputCat').val() == '' ) {
		addMssg('warning','Empty input field');
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
					//$('#addNewcat').before('<p id="idCategorie'+$.trim(data)+'" data-id="'+$.trim(data)+'" class="ui-droppable">'+$('#inputCat').val()+'<span data-id="'+$.trim(data)+'" class="delCat">del</span></p>');
					  $('#addNewcat').before('<p id="idCategorie'+$.trim(data)+'" data-id="'+$.trim(data)+'">'+$('#inputCat').val()+'<span class="delete" data-id="'+$.trim(data)+'" data-category="'+$.trim(data)+'" ><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></p>');
                                          addMssg('warning', 'host ' + hostRoot);
                                        $.ajaxSetup({async: false});
					$.getScript(hostJS+'computeitem.js');
					$.getScript(hostJS+'cat-del.js');
					$.ajaxSetup({async: true});
				}
				else {
					//$('#addResponse').html('Already exists');
                                        addMssg('warning','Categorie already exists');
				}
				$('#inputCat').val('');
			},
			error:function() {
				//alert('Une erreur est survenue essayer plus tard');
                                addMssg('error','Une erreur est survenue essayer plus tard');
			}
		});

    }
	$('#addResponse').delay(2500).slideUp(300);

});
