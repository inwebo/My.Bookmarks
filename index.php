<?php
/**
 * My Bookmarks
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

<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php'); ?>
<?php
// Controleur Init
try {

	// Session
	$sessions = new MySessions();
	$sessions->addParams('type', 'guest');

	$multiViews   = new MyMultiviews( 'index.php' );

}
catch( Exception $e ) {

	// Display Error ?
	if( $conf['debug'] == 1 ) {
		echo $e->getMessage();
	}
	else {
		// Try to log in exceptions.log
		try {
			$myLog = new MyLog($conf['logs'].'exceptions.log');
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		// Display it
		catch(Exception $e) {
			if( $conf['debug'] == 1 ) {
				echo $e->getMessage();
			}
		}
	}

}

if( isset($_POST['login']) && isset($_POST['password']) ) {
	$userExists = $sql->query('SELECT *  from `users` WHERE login=":?" AND password=":?"', array( $_POST['login'], md5($_POST['password']) ));
	//echo $sql->query;
	//print_r(mysql_num_rows($userExists));
	if( is_resource( $userExists ) && ( @mysql_result( $userExists, 0 ) ) !== FALSE ) {
		$sessions->setParams('type','admin');
		//echo "<meta http-equiv='refresh' content='0';URL=". $conf['root'] ."'>";
	}
}

if( isset($_GET['q'] ) && $_SESSION['type'] == 'admin') {
	$sessions->destroy();
	$sessions->setParams('type','guest');
	echo "<meta http-equiv='refresh' content='0';URL=". $conf['root'] ."'>";
}
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $conf['name']; ?></title>
  <meta name="description" content="Self hosted bookmarklet service.">
  <meta name="author" content="inwebo">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
	<link rel="stylesheet" href="<?php echo ROOT_CSS; ?>my-style.css">
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
	<script type="text/javascript" src="<?php echo ROOT_JS; ?>libs/modernizr-2.0.6.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>


  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container">
	  <?php include('views/header.php'); ?>


    <div id="main" role="main">

	<!-- Setup -->
	<div class="container_12">
		<div class="grid_12">
			<h2>Installation</h2>
			<div class="debugOkay">
			<h3>Félicitation</h3>
			<p class="">
				My.Bookmarks est correctement installé, veuillez maintenant déposé dans votre barre de favoris le bouton ci-après.<br><br>
				<a href="" class="myButton"><link rel="shortcut icon" href="img/logo.png" />Bookmark this</a>
			</p>
			</div>
			<form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
				<fieldset>
					<legend>Site</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupSiteName" name="setupSiteName" value="My.Bookmarks"/><br><span>Titre du site est contenu dans la balise H1.</span></label>
					<label class="inputGrid_1">Tagline : <input id="setupTagLine" name="setupTagLine" value="Self hosted bookmarks"/><br><span>Slogan du site est contenu dans la balise H1.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerUser">
					<legend>User</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupRoot" name="setupRoot" /><br><span>Votre nom d'utilisateur.</span></label>
					<label class="inputGrid_1">Password : <input id="setupRoot" name="setupRoot" /><br><span>Mot de passe.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerPath">
					<legend>Path</legend>
					<label>Root : <input id="setupRoot" name="setupRoot" value="http://"/><br><span>Chemin d'accès de l'application, typiquement copier / coller l'adresse actuelle.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerDatabase">
					<legend>Database</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input id="setupDbServer" name="setupDbServer" /><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
					<label class="inputGrid_1 inputGrid_1">User : <input id="setupDbUser" name="setupDbUser" /><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">Password : <input id="setupDbPassword" name="setupPassword"/><br><span>Mot de passe.</span></label>
					<label class="inputGrid_1 inputGrid_1">Database : <input id="setupDbDatabase" name="setupDatabase" /><br><span>Base de donnée.</span></label>
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
		</div>
	</div>
	<!-- /Setup -->

	<!-- Container -->
	<div class="container_12">

	<!-- Breadcrumbs -->
	<div id="breadCrumbs" class="grid_12">
		<ul>
			<li><a href="http://my.bookmarks.free.fr/index.php">Home</a>&nbsp;»&nbsp;</li>
			<li>1&nbsp;»&nbsp;</li><li>&nbsp;Incoming</li>
		</ul>
	</div>
	<!-- /Breadcrumbs -->

	<div class="clear"></div>

	<!-- Unlogged categorie list -->
	<div class="grid_12">
		<h2>Incoming <span class="totalLinks">125</span></h2>
		<ul class="listUrl">
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
		</ul>
	</div>
	<!-- /Unlogged categorie list -->

	<div class="clear"></div>

	<!-- Tags -->
	<div class="grid_12">
		<h2>Tags <span class="totalLinks">125</span></h2>
		<p>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
			<a href="#" class="tags">Nom&nbsp;du&nbsp;tags<span>12</span></a>
		</p>
	</div>
	<!-- /Tags -->

	<div class="clear"></div>

	<!-- Home urls list -->
	<div class="grid_4">
	<h2>Incoming <span class="totalLinks">125</span></h2>
		<ul class="listUrl">
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
		</ul>
	</div>
	<!-- /Home urls list -->

	<!-- Home urls list -->
	<div class="grid_4">
		<h2>Incoming <span class="totalLinks">125</span></h2>
		<ul class="listUrl">
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
		</ul>
	</div>
	<!-- /Home urls list -->

	<!-- Home urls list -->
    <div class="grid_4">
		<h2>Incoming <span class="totalLinks">125</span></h2>
		<ul class="listUrl">
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
		</ul>
	</div>
	<!-- /Home urls list -->

	<div class="clear"></div>

	<!-- Logged categories list -->
    <div class="grid_4" id="categoriesList">
	<h2>Categories <span class="totalLinks">125</span></h2>
	<p data-id="1" id="idCategorie1">Incoming<span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></p>
		<form>
			<label>
				New categorie name ?<br>
				<input type="text"/><br><br>
				<a href="#" class="myButton">ok</a>
			</label>
		</form>
	</div>
	<!-- /Logged categories list -->

	<!-- Logged categorie -->
	<div class="grid_8">
		<h2>Incoming <span class="totalLinks">125</span></h2>
		<ul class="listUrl">
			<li><span class="dragMeToCat">Drag me</span><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
			<li><a href="">280</a><span class="delete"><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></li>
		</ul>
	</div>
	<!-- /Logged categorie -->

    <div class="clear"></div>

	</div>

    </div>
	<!-- /Container -->

	<!-- Footer -->
    <footer>
		<div class="container_12">
			<div class="grid_12">
				<p>
					My.Bookmarks version Beta 28-11-2011 <a href="" class="myButton">update now</a> - par www.inwebo.net - cc2 - Github Repository
				</p>
			</div>
		</div>
	</footer>
	<!-- /Footer -->

  </div>
<!--! end of #container -->

<!-- Display debug -->
<div id="debugOutPut">
	<ul>
		<li class="debugError">
			<h6>Erreur<span class="delete"><span class="delete"><a href="#">x</a></span></h6>
			<p>
				Lorem ipsum
			</p>
		</li>
		<li class="debugOkay">
			<h6>M'okay<span class="delete"><span class="delete"><a href="#">x</a></span></h6>
			<p>
				Lorem ipsum
			</p>
		</li>
		<li class="debugInformation">
			<h6>Informations<span class="delete"><span class="delete"><a href="#">x</a></span></h6>
			<p>
				Lorem ipsum
			</p>
		</li>
		<li class="debugWarning">
			<h6>Warning<span class="delete"><span class="delete"><a href="#">x</a></span></h6>
			<p>
				Lorem ipsum
			</p>
		</li>
	</ul>
<div>
<!-- /Display debug -->

  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <!-- end scripts-->


  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
