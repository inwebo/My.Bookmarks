<!-- About -->
<div class="grid_12 about">

    <div id="gui-url-wrapper" class="gui-url-wrapper">
        <p>
            <a href="#">Login</a>
        </p>

                <form name="item-1" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo $conf['root']; ?>" id="loginFieldset">
                            <label>Login <input type="text" id="item-4" name="login"></label>
                            <label>Password<input type="password" id="item-5" name="password"></label>
                            
                            <input type="submit" id="item-7">
                </form>

    </div>
    <script>

$("#boutonTop a").mouseenter(function() {
//    $(this).find("a").text("mouse on");
    $(this).animate({ backgroundColor: "orange" }, 'fast');

}).mouseleave(function() {
  //$(this).find("a").text("mouse leave");
 $(this).animate({ backgroundColor: "green" }, 'fast');
});
    </script>
</div>
<!-- About -->