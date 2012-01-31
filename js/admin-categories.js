/**
 * Administration
 */
(function($) {
    $(function() {

// Add categorie
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
					$.getScript(hostJS+'admin-items.js');
					$.getScript(hostJS+'admin-categories.js');
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


        // Delete categorie
        $('#categoriesList p.ui-droppable span').click(function() {
            var i = $(this);
            var r = confirm('Delete categorie number : ' + $(this).attr('data-category') + ' ( id='+$(this).attr('data-id')+' ) ?'+"\n");
            if(r==true) {
                $.ajax({
                    type: "POST",
                    // URL script PHP
                    url: hostRoot+"categorie-del.php",
                    data: {
                        delCat: $(this).attr('data-id')
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                        var categorieName = i.attr('data-category');
                        i.parent('p').slideUp(300);
                        addMssg( 'okay', 'Categorie ' + categorieName + ' deleted.' );
                    },
                    error:function() {
                        addMssg( 'error', 'Cannot delete element.' );
                    }
                })
            }
        });

    });
})(jQuery);