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
    <?php $_root = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']); ?>
    <link rel="stylesheet" href="<?php echo $_root;?>/css/my-style.css">
<?php include('autoload.php'); ?>
    <?php include( 'helpers/const.define.php'); ?>
        <script type="text/javascript" src="<?php echo PATH_JS_CONST; ?>"></script>
</head>
<body>
<div id="container">
    <header>
		<div class="container_12">
			<div class="grid_12" id="breadCrumbs">
			<h1>My.Bookmarks</h1>
			</div>
		</div>
    </header>
    <div id="main" role="main">
        <div class="container_12">
            <div class="grid_12">
                <div id="tabs">
                   <ul>
                     <li><a href="#tab-1">Requirements</a></li>
                     <li><a href="#tab-2">Site configuration</a></li>
                     <li><a href="#tab-3">Database</a></li>
                     <li><a href="#tab-4">Users</a></li>
                     <li><a href="#tab-5">Well done</a></li>
                   </ul>
                   <form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
                       <div id="tab-1">
                         <h3>Requirements</h3>
                         <ul>
                             <li>PDO</li>
                             <li>RecursiveFiles</li>
                             <li>PHP 5.2</li>
                         </ul>
                       </div>
                       <div id="tab-2">
                         <h3>Site configuration</h3>
                         <?php
                            include('views/tpl/configuration-site.php');
                         ?>
                       </div>
                       <div id="tab-3">
                         <h3>Database</h3>
                         <?php
                            include('views/tpl/configuration-database.php');
                         ?>
                       </div>
                       <div id="tab-4">
                         <h3>User</h3>
                         <?php
                            include('views/tpl/configuration-user.php');
                         ?>
                       </div>
                       <div id="tab-5">
                           <h3>Well done</h3>
                           <p>
                               installed !
                           </p>
                       </div>
                        <hr>
                        <a href="#" id="<?php if(APP_SETUP) { echo 'setupSave'; } else { echo 'configSave'; } ?>" name="<?php if(!isset($conf)) { echo 'setupSave'; } else { echo 'configSave'; } ?>" class="myButton"  onclick="return false;">Save</a>
                    </form>
                </div>

            </div>
            
        </div>        
    </div>
    <?php
    include('views/footer.php');
?>
</div>

<!-- Display debug -->
<div id="debugOutPut">
	<ul id="displayMssg">

	</ul>
</div>
<!-- /Display debug -->
<!-- /setup.php -->

<script type="text/javascript" src="js/gui-infos-bulles.js"></script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/configuration.js"></script>
</body>
</html>

