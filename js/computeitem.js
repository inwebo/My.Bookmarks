(function($) {
    $(function() {
        // Active le debug, sortie dans la console JS
        debug = true;

        function totalItem() {
            var total = parseInt($('.totalLinks').html());
            total--;
            $('.totalLinks').html(total + ' links');
            //addMssg('informations', 'it exists ' + total + ' links in ' + $('.totalLinks').parent('h2').html() );
        }

        $( "#newItems ul li span.dragMeToCat" ).draggable({
            opacity: 0.7,
            helper: "clone",
            cursorAt: {
                cursor: "crosshair", 
                top: 20, 
                left: 90
            },
            start: function(event, ui) {
            },
            stop: function(event, ui) {
            },
            revert:'invalid'
        });

        $( "#categoriesList p" ).droppable({
            over: function(event, ui) {
                $( this ).css('border', 'solid 1px green');
            },
            out: function(event, ui) {
                $( this ).css('border', 'solid 1px transparent');
            },
            drop: function( event, ui ) {
                if( debug == true ) {
                    console.log('drop!');
                }
                var $element = ui.draggable;
                var containerIdData = this;
                $( this ).effect( "highlight" );
                $( this ).css('border', 'solid 1px transparent');
                $.ajax({
                    type: "POST",
                    url: hostRoot + "update-url.php",
                    data: "id="+ $(containerIdData).attr("data-id") +"&hash="+ $element.attr("title"),
                    success:function(data) {
                        addMssg( 'Moved', $element.attr("data-display") + ' moved.' );
                        totalItem() ;
                    },
                    error:function() {
                        addMssg( 'error', 'Can\'t moved ' +$element.attr("title") + ' !' );
                    }
                });

                $element.parent().parent().slideUp(300);
            },
            accept: '#newItems ul li span.dragMeToCat',
            greedy: false
        });

        $('span.close a').click(function() {
            var actualLiItem = this;
            var r = confirm('Delete url (id='+$(this).attr('data-id')+') : '+"\n"+'✗' + $(this).attr('data-title') +' ?'+"\n");
            if( r == true ) {
                $.ajax({
                    type: "POST",
                    url: hostRoot + "del-url.php",
                    data: {
                        delUrl:$(this).attr('data-id')
                        },
                    success:function(data) {
                        //alert('ok');
                        $(actualLiItem).parent().parent().parent('li').slideUp(300);
                        addMssg('okay', 'Element <em>'+ $(actualLiItem).attr('data-title') + '</em> deleted.' );
                    },
                    error:function() {
                        addMssg('error', 'Cannot delete <em>' + $(actualLiItem).attr('data-title') + '</em>, please try later.' );
                    }
                });
            }
        });

    });
})(jQuery);
