(function($) {
    $(function() {
        // Active le JS_DEBUG, sortie dans la console JS
        JS_DEBUG = true;

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
                if( JS_DEBUG == true ) {
                    //console.log('drop!');
                }
                var $element = ui.draggable;
                var containerIdData = this;
                $( this ).effect( "highlight" );
                $( this ).css('border', 'solid 1px transparent');
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "url-update.php",
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
                    url: JS_PATH_AJAX + "url-del.php",
                    data: {
                        delUrl:$(this).attr('data-id')
                        },
                    success:function(data) {
                        //alert('ok');
                        $(actualLiItem).closest('li').slideUp(300);
                        addMssg('okay', 'Element <em>'+ $(actualLiItem).attr('data-title') + '</em> deleted.' );
                    },
                    error:function() {
                        addMssg('error', 'Cannot delete <em>' + $(actualLiItem).attr('data-title') + '</em>, please try later.' );
                    }
                });
            }
        });
/* Médiocre  
        function toggleButton( _obj ) {
            $(_obj).children('span.itemSaveSpan').toggle();
        }

        $('.itemEditSpan a').click(function(){
            //Retourne un objet jQuery
            container = $( this ).parents('li').eq(0);

  if( $(this).html() == 'edit' ) { $(this).html('save') } else { $(this).html('edit')  };

            display = $(container).children('div.itemMain');
            form = $(container).children('div.itemMain+div');

toggleButton( this );

            display.toggle();
            form.toggle();

            if( $(this).html('save') ) {

                var _itemHash = $(this).attr('data-hash');
                var _itemTitle = $('form[data-hash*='+ _itemHash + '] input').val();
                var _itemDescription = $('form[data-hash*='+ _itemHash + '] textarea').val();

                // Ajax
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "bookmark-edit.php",
                    data: {
                            itemHash:_itemHash,
                            itemTitle:_itemTitle,
                            itemDescription:_itemDescription,
                            itemPublicKey:JS_PUBLIC_KEY
                        },
                    success:function(data) {
                        addMssg('okay', 'Element <em>edited</em> deleted.' );
                    },
                    error:function() {
                        addMssg('error', 'Cannot delete <em>edited</em>, please try later.' );
                    }

                });

            console.log(  'save' );
        }
        else {
                    console.log(  'edit' );
        }
            console.log(  $(this).html() );
            //if( $(this).html() == 'edit' ) { $(this).html('save') } else { $(this).html('edit')  };
          
 
        });
 Médiocre  */



        function toggleDisplay( _obj ) {
            t = _obj.children('.edit, .save');
            r = _obj.children('div.itemMain, div.itemMain+div');
            t.toggle();
            r.toggle();
        }

        $( '.save a' ).click( function () {

        container = $( this ).parents('li').eq(0);
        var _itemHash = $(this).attr('data-hash');
        var _itemTitle = $('form[data-hash*='+ _itemHash + '] input').val();
        var _itemDescription = $('form[data-hash*='+ _itemHash + '] textarea').val();
        
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "bookmark-edit.php",
                    data: {
                            itemHash:_itemHash,
                            itemTitle:_itemTitle,
                            itemDescription:_itemDescription,
                            itemPublicKey:JS_PUBLIC_KEY
                        },
                    dataType: "text",
                    success:function(data) {
                        addMssg('okay', 'Element <em>'+ _itemTitle +'</em> edited.' );
                        $('li[data-hash*= ' + _itemHash +  '] div.itemDisplay h3 a ').html(_itemTitle);
                        $('li[data-hash*= ' + _itemHash +  '] div.itemDisplay p ').html(_itemDescription);
                    },
                    error:function() {
                        addMssg('error', 'Cannot edit, please try later.' );
                    }

                });
        });



        $('.edit a, .save a').click(function() {
            container = $( this ).parents('li').eq(0);
            toggleDisplay( $(container) );
        });


    });
})(jQuery);
