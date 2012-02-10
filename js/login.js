        (function($){

        state = 0;

        $('#loginContainer a').click(function(){
            if( state == 0) {
                $(this).closest('div').animate({ top: "0" }, 300, 'easeOutExpo');
                state = 1;
            }
            else {
                $(this).closest('div').animate({ top: "-35px" }, 300, 'easeInExpo');
                state = 0;
            }
        });

$('#loginContainer input[type*=text]').focus(function(){
        if( $(this).val() == "Login") {
            $(this).val('');
            $(this).text('');
        }
});

$('#loginContainer input[type*=text]').blur(function(){
        if( $(this).val() == "") {
            $(this).val('Login');
            $(this).text('Login');
        }
});

$('#loginContainer input[type*=password]').focus(function(){
        if( $(this).val() == "Password") {
            $(this).val('');
            $(this).text('');
        }
});

$('#loginContainer input[type*=password]').blur(function(){
        if( $(this).val() == "") {
            $(this).val('Password');
            $(this).text('Password');
        }
});

        })(jQuery);

