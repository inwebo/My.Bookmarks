(function($) {
    $(function() {
        // Active le JS_DEBUG, sortie dans la console JS
        JS_DEBUG = true;
        isDragging = 0;

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
