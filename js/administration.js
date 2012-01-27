/**
 * Administration
 */
(function($) {
    $(function() {
        
        // Delete categorie
        $('#categoriesList p.ui-droppable span').click(function() {
            var i = $(this);
            var r = confirm('Delete categorie number : ' + $(this).attr('data-category') + ' ( id='+$(this).attr('data-id')+' ) ?'+"\n");
            if(r==true) {
                $.ajax({
                    type: "POST",
                    // URL script PHP
                    url: hostRoot+"del-categorie.php",
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