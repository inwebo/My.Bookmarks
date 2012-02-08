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
<!doctype html>
<!-- setup.php -->
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Welcome</title>
  <meta name="description" content="Self hosted bookmarklet service.">
  <meta name="author" content="inwebo">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="css/my-style.css">

<?php
	//chdir('..');
	include('lib/mylog/class.mylog.php');
	$newConfig = new MyLog('config/config.ini.bak');
	//var_dump($newConfig);
?>
</head>
<body>
<div id="container">
    <header>
		<div class="container_12">
			<div class="grid_12" id="breadCrumbs">
			<h1>My.Bookmarks<!--<img src="img/logo.png">--></h1>
			</div>
		</div>
    </header>
    <div id="main" role="main">
        <div class="container_12">
            <div class="grid_12">
                <!-- New -->
                <?php
                /* @todo : Check version
                    if ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) {
                        echo 'il faut au moins php 5.3.0!';
                        }
                 
                 */
                ?>
                    <h2>Installation</h2>
			<div class="debugOkay" id="continue">
			<h3>Yeah!</h3>
			<p class="">
				My.Bookmarks est installé, veuillez rejoindre votre <a href="#">page d'accueil</a>.
			</p>
			</div>
			<form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
				<fieldset>
					<legend>Site</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupSiteName" name="setupSiteName" value="My.Bookmarks"/><br><span>Titre du site est contenu dans la balise H1.</span></label>
					<label class="inputGrid_1">Tagline : <input id="setupTagLine" name="setupTagLine" value="Self hosted bookmarks"/><br><span>Slogan du site est contenu dans la balise H1.</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Debug activé ? : <select id="setupDebug" name="setupDebug"><option value="0">non</option><option value="1">oui</option></select><br><span>Conseillé non.</span></label>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil : <select id="setupTotalUrls" name="setupTotalUrls"><option value="10">10</option><option value="20">20</option></select><br><span>Conseillé 10.</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? : <select id="setupFavicon" name="setupFavicon"><option value="0">non</option><option value="1">oui</option></select><br><span>Dégrade les performances.</span></label>
                                        <label class="inputGrid_1">Liens public par défaut ? : <select id="setupPublic" name="setupPublic"><option value="0">non</option><option value="1">oui</option></select><br><span>Conseillé Oui.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerUser">
					<legend>User</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupUserName" name="setupUserName" value="inwebo"/><br><span>Votre nom d'utilisateur.</span></label>
					<label class="inputGrid_1">Password : <input id="setupUserPassword" name="setupUserPassword" /><br><span>Mot de passe.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerPath">
					<legend>Path</legend>
                                        <label>Root : <input id="setupRoot" name="setupRoot" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>"/><br><span>Chemin d'accès de l'application, typiquement copier / coller l'adresse actuelle.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerDatabase">
					<legend>Database</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input id="setupDbServer" name="setupDbServer" value=""/><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
                                        <label class="inputGrid_1 inputGrid_1">Database : <input id="setupDbDatabase" name="setupDatabase" value="" /><br><span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User : <input id="setupDbUser" name="setupDbUser" value=""/><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password : <input id="setupDbPassword" name="setupPassword" value=""/><br><span>Mot de passe.</span></label>
                                        
					<label>Table prefixe : <input id="setupDbPrefix" name="setupDbPrefix" value="my_tables_"/><br><span>Prefix d'organisation des tables.</span></label>
                                        <a id="databaseTest" href="#" onclick="return false;" class="myButton">Test de connexion</a>
				</fieldset>
				<hr>
				<fieldset>
					<legend>Google Analytics</legend>
					<label>Id : <input id="setupGa" name="setupGa" value="UA-XXXXX-X"/><br><span>Change UA-XXXXX-X to be your site's ID</span></label>
				</fieldset>
				<hr>
				<a href="#" id="saveSetup" name="saveSetup" class="myButton">Save</a>
				<hr>
			</form>
                <!-- /New -->

         <script type="text/javascript" src="js/gui-infos-bulles.js"></script>
<script type="text/javascript" >
<?php
        // @todo buffer config
	echo 'var JS_PATH_AJAX="js/ajax/setup-save.php";'  . "\n";
	echo 'var databaseTest="js/ajax/database-test.php";'  . "\n";
?>

( function($){

        $('#databaseTest').click(function(){

$.ajax({
				type: "POST",
				// URL script PHP
				url: $('#setupRoot').val()+'js/ajax/database-test.php',
				data: {
                                        setupRoot: $('#setupRoot').val(),
                                        setupDbUser: $('#setupDbUser').val(),
                                        setupDbPassword: $('#setupDbPassword').val(),
                                        setupDbDatabase: $('#setupDbDatabase').val(),
                                        setupDbServer: $('#setupDbServer').val(),
                                        },
				dataType: "text",
				beforeSend:function() {
					// Image loading
				},
				success:function(data) {
					//data = responseText
					if( data == 'TRUE' ) {
						addMssg('okay','Connexion ok.');
					}
					else {
						addMssg('error','Connexion error');
					}
				},
				error:function() {
                                        addMssg('error','Error 404<br>Please chek path input.');
				}
			});

        });

	$( '#getIt' ).css( 'display', 'none' );
	$( '#continue' ).css( 'display', 'none' );

	$( '#continue' ).click(function() {
		$( location).attr( 'href', $( '#setupRoot' ).val() );
	});

	$( '#saveSetup' ).click(function() {
                //console.log( $( '#setupRoot' ).val() );
		if( $( '#setupRoot' ).val() == '' ) {
			//$('#containerPath').css('border', 'groove 2px red');
		}
		else {
			$.ajax({
				type: "POST",
				// URL script PHP
				url: $('#setupRoot').val() + JS_PATH_AJAX,
				data: {
                                        setupRoot: $('#setupRoot').val(),
                                        setupUserName: $('#setupUserName').val(),
                                        setupUserPassword: $('#setupUserPassword').val(),
                                        setupDbUser: $('#setupDbUser').val(),
                                        setupDbPassword: $('#setupDbPassword').val(),
                                        setupDbDatabase: $('#setupDbDatabase').val(),
                                        setupDbServer: $('#setupDbServer').val(),
                                        setupDbPrefix: $('#setupDbPrefix').val(),
                                        setupFavicon: $('#setupFavicon option:selected').val(),
                                        setupPublic: $('#setupPublic option:selected').val(),
                                        setupDebug: $('#setupDebug option:selected').val(),
                                        setupTotalUrls: $('#setupTotalUrls option:selected').val(),
                                        setupGa: $('#setupGa').val(),
                                        },
				dataType: "text",
				beforeSend:function() {
					// Image loading
				},
				success:function(data) {
					//data = responseText
                                        //console.log(data);
					if( data == 'TRUE' ) {
						addMssg('okay','Bravo, l\'application s\'est instalée correctement.');
						$('#setupForm').fadeOut('fast', function() {
							$('#continue').fadeIn();
						});
					}
					else {
						addMssg('error','Database connection failed');
					}
				},
				error:function(data) {
                                        //console.log(data);
                                        addMssg('error','Error 404<br>Please chek path input.');
				}
			});
		}
	});
})(jQuery)

</script>

            </div>
            
        </div>        
    </div>
</div>
<?php
    include('views/footer.php');
?>
  <!-- Display debug -->
<div id="debugOutPut">
	<ul id="displayMssg">

	</ul>
</div>
<!-- /Display debug -->
<!-- /setup.php -->
</body>
</html>

