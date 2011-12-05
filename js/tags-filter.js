(function($){

$('#tagsFilter').keyup(function() {

    if($('#tagsFilter').val() == '' ) {
        $('.tags').fadeIn('fast');
    }
    else {
        $.each( $('.tags:not([data-tags^="'+$('#tagsFilter').val()+'"])'), function(index, value){
            console.log(this);
            $(this).fadeOut('fast');
        });
}

});

})(jQuery)
