(function($){

    $('#tagsFilter').keyup( function() { 

        listTags   = $('.tags');
        filterTags = $('#tagsFilter').val();

        hasNotTags = $('.tags:not([data-tags^="'+filterTags+'"])');
        hasTags    = $('.tags:[data-tags^="'+filterTags+'"]');


        if(filterTags.length == 0) {
            $(listTags).animate({opacity:1});
        }
        else {
            if( hasTags.length == 0 ) {
                $.each( hasTags,function() {
                    $(this).animate({
                        opacity:1
                    });
                });
            }
            else {
                $.each( hasTags,function() {
                    $(this).animate({
                        opacity:1
                    });
                });
                $.each( hasNotTags,function() {
                    $(this).animate({
                        opacity:0.25
                    });
                });
            }
        }
        

    });

})(jQuery)
