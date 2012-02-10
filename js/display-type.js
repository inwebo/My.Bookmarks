(function($) {
    $(function() {
        $('#display-small').click(function() {
            var plugin = this;
            $('.xfolkentry p, .xfolkentry ul').css('display','none');
        });
        $('#display-full').click(function() {
            var plugin = this;
            $('.xfolkentry p, .xfolkentry ul').css('display','block');
        });
    });
})(jQuery);
