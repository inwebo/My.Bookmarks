/**
 * Administration
 */
(function($) {
    $(function() {

// Add categorie
$('#categories-new-save').unbind('click').click( function() {
	console.log('Edit');
    if( $('#newCat').val() == '' ) {
    	pluginNotifications.msg('Nope','empty string!');
    }
    else {
		$.ajax({
			type: "POST",
			url: JS_PATH_AJAX_CATEGORIE_ADD,
			data: "inputCat="+$('#newCat').val(),
			dataType: "text",
			success:function(data) {
				if(data != "FALSE") {
					pluginNotifications.msg('Added',data);
					
					// #1 : copy first li
					$pattern = $('#sortable li').filter(':first').clone();
					$patternLeftMenu = $pattern.children('span').filter(':first').clone();
					$patternRighttMenu = $pattern.children('span').filter(':last').clone();
					
					// #2 : Change attributs
					$pattern.attr('data-id',data);
					$pattern.attr('data-name',$('#newCat').val());

					
					var text = ' ';
					text +=  $('#newCat').val();
					$pattern.text(text);
					
					$pattern.prepend($patternLeftMenu);
					$pattern.append($patternRighttMenu);
					
					// #3 : Add to DOM
					$('#sortable').append($pattern);

					// #4 : Message
					console.log('added');
					window.pluginCategoriesHandler.Query();

				}
				else {
					addMssg('warning','Categorie already exists');
				}
				$('#inputCat').val('');
			},
			error:function() {
			}
		});

    }
    });


        // Delete categorie
        $('.categorie-delete').unbind('click').live('click',
        
        function() {
        	var temp = $(this).closest('li');
            var i = $(this);
            var r = confirm('Delete categorie number : ' + $(temp).attr('data-id').trim() + ' ( id='+$(temp).attr('data-id').trim()+' ) ?'+"\n");
            if(r==true) {
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX_CATEGORIE_DEL,
                    data: {
                        delCat: $(temp).attr('data-id').trim()
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                    	$(temp).effect('blind',function(){
                    		$(this).remove();
                    	});
                    	//
                    },
                    error:function() {

                    }
                })
            }

        }
        
        );
        // Edit categorie
        $('.categorie-edit').unbind('click').live('click',
        
        function() {
        	var temp = $(this).closest('li');
            var i = $(this);
            var r = confirm('Delete categorie number : ' + $(temp).attr('data-id').trim() + ' ( id='+$(temp).attr('data-id').trim()+' ) ?'+"\n");
            if(r==true) {
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX_CATEGORIE_EDIT_FORM,
                    data: {
                        delCat: $(temp).attr('data-id').trim()
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                    	$(temp).effect('blind',function(){
                    		$(this).remove();
                    	});
                    	//
                    },
                    error:function() {

                    }
                })
            }

        }
        
        );
    });
})(jQuery);