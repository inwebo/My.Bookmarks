<?php include ('autoload.php'); ?>
<form name="item-1" method="post" enctype="application/x-www-form-urlencoded" action="" id="loginFieldset">
	<h2>Database</h2>
	<span class="iconic key_fill iconsize"></span>
	<input id="item-5" name="user" value="">
	<input id="item-6" name="password" value="">
	<br>
	<hr>
	<input type="submit" id="item-7">
</form>
<code>
	<?php
		$enigma = new MyCrypt( md5( $_POST['user'] ) );
		$dbPassword = $enigma->code( $_POST['password'] );
		echo $dbPassword;
	?>
</code>
<hr>
<form name="item-12" method="post" enctype="application/x-www-form-urlencoded" action="" id="loginFieldset">
	<h2>App</h2>
	<span class="iconic key_fill iconsize"></span>
	<input id="item-9" name="app_password" value="">
	<br>
	<hr>
	<input type="submit" id="item-10">
</form>
<code>
	<?php
		echo md5($_POST['app_password']);
	?>
</code>