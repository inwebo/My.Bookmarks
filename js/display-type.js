(function($) {
    $(function() {
        $('#display-small').click(function() {
            var plugin = this;
            $('.xfolkentry p, .xfolkentry ul').css('display','none');
            $('.xfolkentry h3').addClass('bookmarks-display-simple');
        });
        $('#display-full').click(function() {
            var plugin = this;
            $('.xfolkentry p, .xfolkentry ul').css('display','block');
            $('.xfolkentry h3').removeClass('bookmarks-display-simple');
        });
    });
})(jQuery);
