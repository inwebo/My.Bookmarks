(function($){

    $('#tagsFilter').keyup( function() {
        tagsSearch = $('#tagsFilter').val();
        console.log(tagsSearch);
        console.log($('.tags:not([data-tags^="'+$('#tagsFilter').val()+'"])'));

    $.each( $('.tags'),function() {

        if($('.tags:not([data-tags^="'+$('#tagsFilter').val()+'"])')) {
            $(this).animate({
                opacity: 0.25
            });
        }
        if($( '[data-tags^="' + $('#tagsFilter').val() + '"]')) {
            $(this).animate({
                opacity:1
            });
        }

    });


    if( $(this).val().length === 0 ) {
        $('.tags').fadeIn('fast');
    }
});

})(jQuery)
