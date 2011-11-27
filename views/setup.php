<!-- setup.php -->
<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>


<?php
	//chdir('..');
	//include('lib/mylog/class.mylog.php');
	//$newConfig = new MyLog('config/config.ini.bak');
	//var_dump($newConfig);
?>
</head>
<body>
<h1>Install My.Bookmarks</h1>
<form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
	<fieldset>
		<legend>Site</legend>
		<label>Name : <input id="setupSiteName" name="setupSiteName" value="My.Bookmarks"/></label><br>
		<label>Tagline : <input id="setupTagLine" name="setupTagLine" value="Self hosted bookmarks"/></label>
	</fieldset>
	<fieldset id="containerPath">
		<legend>Path</legend>
		<label>Root : <input id="setupRoot" name="setupRoot" /></label>
	</fieldset>
	<fieldset id="containerDatabase">
		<legend>Database</legend>
		<label>Server : <input id="setupDbServer" name="setupDbServer" /></label><br>
		<label>User : <input id="setupDbUser" name="setupDbUser" /></label><br>
		<label>Password : <input id="setupDbPassword" name="setupPassword"/></label><br>
		<label>Database : <input id="setupDbDatabase" name="setupDatabase" /></label><br>
	</fieldset>
	<fieldset>
		<legend>Google Analytics</legend>
		<label>Id : <input id="setupGa" name="setupGa" /></label>
	</fieldset>

</form>
<a href="#" id="saveSetup" name="saveSetup">Save</a>
<!-- /setup.php -->
</body>
</html>

<script>
<?php
	echo 'var hostRoot="helpers/ajax/setup.php";'  . "\n";
?>

(function($){
	$('#saveSetup').click(function() {
		if( $('#setupRoot').val() == '' ) {
			$('#containerPath').css('border', 'groove 2px red');
		}
		else {
			$.ajax({
				type: "POST",
				// URL script PHP
				url: $('#setupRoot').val() + hostRoot,
				data: { root: $('#setupRoot').val(), user: $('#setupDbUser').val(), password: $('#setupDbPassword').val(), database: $('#setupDbDatabase').val(), sqlserver: $('#setupDbServer').val()},
				dataType: "text",
				beforeSend:function() {
					// Image loading
				},
				success:function(data) {
					//data = responseText
					if( data == 'TRUE' ) {
						alert('TRUE');
						$('#containerDatabase').css('border', 'groove 2px green');

						$(location).attr('href',$('#setupRoot').val());
					}
					else {
						alert('FALSE');
						$('#containerDatabase').css('border', 'groove 2px red');
					}
					$('#containerPath').css('border', 'groove 2px green');
				},
				error:function() {
					$('#containerPath').css('border', 'groove 2px red');
				}
			});
		}
	});
})(jQuery)

</script>
