
(function($) {
    $(function() {

        var listSortable = "#sortable";

        $( listSortable ).sortable();
	$( listSortable ).disableSelection();

        var buttonSave = '#categories-weigth-save';
        var listItem = listSortable + ' li';
        var dataWeight = '';

        $(buttonSave).click(function(){
            $(listItem).each(function(index) {
                dataWeight += $(this).attr('data-weight') + "\n";
                console.log($(this).attr('data-weight'));
            });

                console.log( dataWeight );


                $.ajax({
                    type: "POST",
                    // URL script PHP
                    url: JS_PATH_AJAX+"categorie-sort.php",
                    data: {
                        weight: dataWeight
                    },
                    dataType: "text",
                    beforeSend:function() {
                    },
                    success:function(data) {
                        addMssg( 'okay', 'Categories sorted.' );
                    },
                    error:function() {
                        addMssg( 'error', 'Cannot sort categories.' );
                    }
                });
                dataWeight = '';
        });



    });
})(jQuery);
