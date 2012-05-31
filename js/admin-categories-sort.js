
(function($) {
    $(function() {

        var listSortable = "#sortable";

        $( listSortable ).sortable();
		$( listSortable ).disableSelection();

        var buttonSave = '#categories-weigth-save';
        var listItem = listSortable + ' li';
        var dataWeight = '';

        $(buttonSave).unbind('click').click(function(){
        	var totalLi = $(listItem).length;
            $(listItem).each(function(index) {
            	totalLi--;
            	if(totalLi != 0 ) {
            		dataWeight += $(this).attr('data-weight') + "|";
            	}
            	else {
            		dataWeight += $(this).attr('data-weight');
            	}
                
                console.log($(this).attr('data-weight'));
            });

                console.log( dataWeight );


                $.ajax({
                    type: "POST",
                    // URL script PHP
                    url: JS_PATH_AJAX_CATEGORIE_SORT,
                    data: {
                        weight: dataWeight
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {

                    },
                    error:function() {

                    }
                });
                dataWeight = '';
        });



    });
})(jQuery);
