$(document).ready(function() {
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
                    i.parent('li').slideUp(300);
                    addMssg( 'okay', 'Element deleted.' );
                },
                error:function() {
                    addMssg( 'error', 'Can\'t delete element.' );
                }
            })
        }
    });
});
