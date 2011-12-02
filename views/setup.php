<?php
/**
 * My.Bookmarks
 *
 * LICENCE
 *
 * Vous êtes libre de :
 *
 * Partager : reproduire, distribuer et communiquer l'oeuvre
 * Remixer  : adapter l'oeuvre 
 *
 * Selon les conditions suivantes :
 *
 * Attribution : Vous devez attribuer l'oeuvre de la manière indiquée par 
 * l'auteur de l'oeuvre ou le titulaire des droits (mais pas d'une manière
 * qui suggérerait qu'ils vous soutiennent ou approuvent votre utilisation 
 * de l'oeuvre). 
 *
 * Pas d’Utilisation Commerciale : Vous n'avez pas le droit d'utiliser cette
 * oeuvre à des fins commerciales. 
 *
 * Partage à l'Identique : Si vous modifiez, transformez ou adaptez cette
 * oeuvre, vous n'avez le droit de distribuer votre création que sous une
 * licence identique ou similaire à celle-ci.
 *
 * Remarque : A chaque réutilisation ou distribution de cette oeuvre, vous 
 * devez faire apparaître clairement au public la licence selon laquelle elle
 * est mise à disposition. La meilleure manière de l'indiquer est un lien vers
 * cette page web. 
 *
 * @category  My.Bookmarks
 * @package   Base
 * @copyright Copyright (c) 2005-2011 Inwebo (http://www.inwebo.net)
 * @author    Julien Hannotin
 * @license   http://creativecommons.org/licenses/by-nc-sa/2.0/fr/
 * @version   $Id:$
 * @link      https://github.com/inwebo/My.Bookmarks
 * @since     File available since Beta 28-11-2011
 */
?>
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
	<a href="#" id="saveSetup" name="saveSetup">Save</a>
</form>

<p id="getIt">
	D&eacute;placer le lien suivant dans votre barre de favoris.
	<?php
		include('helpers/bouton.php');
	?>
	<br>
	<br>

</p>
<a href="#" id="continue">Continue</a>
<script>
<?php
	echo 'var hostRoot="helpers/ajax/setup.php";'  . "\n";
?>

(function($){

	$('#getIt').css('display', 'none');
	$('#continue').css('display', 'none');

	$('#continue').click(function() {
		$(location).attr('href',$('#setupRoot').val());
	});

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
						$('#setupForm').fadeOut('fast', function() {
							$('#continue').fadeIn();
						});

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
<!-- /setup.php -->
</body>
</html>

