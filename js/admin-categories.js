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
					pluginNotifications.msg( 'Added', data );
					
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
					//pluginNotifications.msg('warning','Categorie already exists');
				}
				$('#inputCat').val('');
			},
			error:function() {
			}
		});

    }
    });


        // Delete categorie handler
        $('.categorie-delete').die('click').live('click',			
			// #2 : deleteCat()
	        function() {
	        	var $current = $(this).closest('.oneBookmark');
	        	var action = new $.myCategorie({'currentNode':$current});
	        	action.deleteCat();
	        }
        
        );
        
        // Delete categorie handler
        $('.categorie-edit').die('click').live('click',			
			// #2 : deleteCat()
	        function() {
	        	var $current = $(this).closest('.oneBookmark');
	        	var action = new $.myCategorie({'currentNode':$current});
	        	action.editCat();
	        }
        
        );

    });
})(jQuery);