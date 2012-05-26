/**
 * Administration
 */
(function($) {
    $(function() {
        var $items = $('#vtab>ul>li');
        $items.click(function() {
            $items.removeClass('selected');
            $(this).addClass('selected');

            var index = $items.index($(this));
            $('#vtab .tabs-content div').hide().eq(index).show();
        }).eq(0).mouseover();

    });
})(jQuery);