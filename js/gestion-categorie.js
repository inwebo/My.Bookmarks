$('#addCategory').click( function() {

    if( $('#inputCat').val() == '' ) {
		addMssg('warning','Empty input field');
    }
    else {
		$.ajax({
			type: "POST",
			url: hostRoot+"categorie-add.php",
			data: "inputCat="+$('#inputCat').val(),
			dataType: "text",
			success:function(data) {
				if(data != "FALSE") {
					$('#addResponse').html('added');
					$('#addNewcat').before('<p id="idCategorie'+$.trim(data)+'" data-id="'+$.trim(data)+'"><a href="'+rootMain+'categorie/'+$('#inputCat').val()+'/'+data+'">'+$('#inputCat').val()+'</a><span class="delete" data-id="'+$.trim(data)+'" data-category="'+$.trim(data)+'" ><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></p>');
                                        addMssg('Okay', 'News category ' + $('#inputCat').val() + ' added');
                                        $.ajaxSetup({async: false});
					$.getScript(hostJS+'computeitem.js');
					$.getScript(hostJS+'cat-del.js');
					$.ajaxSetup({async: true});
				}
				else {
                                        addMssg('warning','Categorie already exists');
				}
				$('#inputCat').val('');
			},
			error:function() {
                                addMssg('error','Une erreur est survenue essayer plus tard');
			}
		});

    }
	$('#addResponse').delay(2500).slideUp(300);
});
