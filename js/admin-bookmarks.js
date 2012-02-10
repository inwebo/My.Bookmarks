(function($) {
    $(function() {
        // Active le JS_DEBUG, sortie dans la console JS
        JS_DEBUG = true;
        isDragging = 0;
        /* Edition Bookmark */

        $('.xfolkentry').hover(
            function() {
                if( isDragging == 0 ) {
                    $(this).children('.bookmarks-boutons').animate({top : '60%',opacity:1}, 'slow', 'easeInOutQuart' );
                    
                }

            },
            function() {
                if( isDragging == 0 ) {
                    $(this).children('.bookmarks-boutons').animate({top : '100%',opacity:0}, 'slow', 'easeInOutQuart');

                }
                    $(this).animate({'min-height' : 'auto'}, 'slow', 'easeInOutQuart' );
            }
        );
        /* Edition Bookmark */


        function totalItem() {
            var total = parseInt($('.totalLinks').html());
            total--;
            $('.totalLinks').html(total + ' links');
            //addMssg('informations', 'it exists ' + total + ' links in ' + $('.totalLinks').parent('h2').html() );
        }

        $( "span.dragMeToCat" ).draggable({
            opacity: 0.7,
            helper: "clone",
            cursorAt: {
                cursor: "crosshair", 
                top: 20, 
                left: 90
            },
            start: function(event, ui) {
                isDragging = 1;
                data_id = $(this).closest('li').attr('data-id');
                data_hash = $(this).closest('li').attr('data-hash');
                data_title = $(this).closest('li').attr('data-title');
                //$(this).closest('li').css('overflow', 'auto');
                console.log(data_id);
                console.log(data_hash);
                console.log(data_title);
                //console.log(values);
            },
            stop: function(event, ui) {
                isDragging = 0;
                //$(this).closest('li').css('overflow', 'hidden');
            },
            revert:'invalid'
        });

        $( "#categoriesList p" ).droppable({
            over: function(event, ui) {
                $( this ).css('border', 'dotted 1px green');
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
                cat_data_id = $(this).attr('data-id');
                $( this ).effect( "highlight" );
                $( this ).css('border', 'solid 1px transparent');
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "url-update.php",
                    data: "id="+ cat_data_id +"&hash="+ data_hash,
                    success:function(data) {
                        addMssg( 'Moved', data_title + ' moved.' );
                        totalItem() ;
                    },
                    error:function() {
                        addMssg( 'error', 'Can\'t moved ' + data_title + ' !' );
                    }
                });

                $element.closest('li').slideUp(300);
            },
            accept: '#newItems ul li span.dragMeToCat',
            greedy: false
        });

        $('.bookmarks-delete').click(function() {
            var actualLiItem = this;
            var r = confirm('Delete url (id='+$(this).attr('data-id')+') : '+"\n"+'✗' + $(this).attr('data-title') +' ?'+"\n");
            if( r == true ) {
                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "url-del.php",
                    data: {
                        delUrl:$(this).closest('li').attr('data-id')
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
        /*$('.bookmarks-edit').click(function() {
                var plugin = this;
                $(plugin).closest('li').find('.bookmarks-main').fadeOut('slow', function(){$(plugin).find('form').fadeIn('slow')} );
        });
        $('.bookmarks-save').click(function() {
                    var plugin = this;
                    $(this).closest('li').find('form').fadeOut('slow', function(){$(plugin).find('.bookmarks-main').fadeIn('slow')} );
        });*/

        $( '.bookmarks-edit' ).click( function () {
                var plugin = this;
                $(this).fadeOut('slow', function() {
                    $(this).closest('li').find('.bookmarks-save').fadeIn('slow');
                });
                //$(plugin).closest('li').animate({'min-height' : '260px'}, 'slow', 'easeInOutQuart' );
                $(plugin).closest('li').find('h3,p,ul').fadeOut('slow', function(){$(plugin).closest('li').find('form').fadeIn('slow')} );
                //$(plugin).closest('li').find('.bookmarks-boutons').fadeOut();
        });
        $( '.bookmarks-save' ).click( function () {
                var plugin = this;
                $(this).fadeOut('slow', function() {
                    $(this).closest('li').find('.bookmarks-edit').fadeIn('slow');
                });
                $(plugin).closest('li').animate({'min-height' : '150px'}, 'slow', 'easeInOutQuart' );

                $(plugin).closest('li').find('form').fadeOut('slow', function(){$(plugin).closest('li').find('h3,p,ul').fadeIn('slow')} );

                container = $( this ).parents('li').eq(0);

                var _itemHash = $(this).closest('li').attr('data-hash');
               console.log(_itemHash);
                var _itemId = $(this).closest('li').attr('data-id');
               console.log(_itemId);
                var _itemTitle = $(container).find('form input').val();
                console.log(_itemTitle);

                var _itemDescription = $(container).find('textarea').val();
                console.log(_itemDescription);

                var _itemTags = $(container).find('label input').val();
                console.log(_itemTags);

                $.ajax({
                    type: "POST",
                    url: JS_PATH_AJAX + "bookmark-edit.php",
                    data: {
                            itemHash:_itemHash,
                            itemTitle:_itemTitle,
                            itemDescription:_itemDescription,
                            itemTags:_itemTags,
                            itemPublicKey:JS_PUBLIC_KEY
                        },
                    dataType: "text",
                    success:function(data) {
                        addMssg('okay', 'Element <em>'+ _itemTitle +'</em> edited.' );
                        $(container).find('h3 a').html(_itemTitle);
                        $(container).find('p.description').html(_itemDescription);
                        $(container).animate({'min-height' : 'auto'}, 'slow', 'easeInOutQuart' );
                    },
                    error:function() {
                        addMssg('error', 'Cannot edit, please try later.' );
                    }

                });
$(plugin).closest('li').find('h3,p,ul').fadeIn();
        });



    });
})(jQuery);
