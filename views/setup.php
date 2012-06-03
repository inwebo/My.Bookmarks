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
    <?php //include( 'helpers/const.define.php'); ?>
        <!--<script type="text/javascript" src="<?php //echo PATH_JS_CONST; ?>"></script>-->
</head>
<body>
<div id="container">
    <header>
		<div class="container_12">
			<div>
			<h1>My.Bookmarks</h1>
			</div>
		</div>
    </header>
    <div id="main" role="main">
        <div class="container_12">
            <div class="grid_12">
            	<h2>Installation</h2>
                <div id="tabs">
                   <ul>
                     <li><span class="iconic check iconsize darkGreen"></span> <?php echo _('Exiges'); ?></li>
                     <li><span class="iconic x iconsize"></span> <?php echo _('Base de donnée'); ?></li>
                     <li><span class="iconic x iconsize"></span> <?php echo _('Site'); ?></li>
                     <li><span class="iconic x iconsize"></span> <?php echo _('Administrateur'); ?></li>
                     <li><span class="iconic x iconsize"></span> <?php echo _('Bravo'); ?></li>
                   </ul>
                   <form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
                       <div id="tab-1">
                       	<?php
	                       	$file         = $_root . '/autoload.php/test/';
							$file_headers = @get_headers($file);
							if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
							    $multiviews = 'No';
								$js_var = "0";
							}
							else {
							    $multiviews = 'Yes';
								$js_var = "1";
							}
						?>
                         <h3><?php echo _('Exige'); ?></h3>
                         <ul>
                             <li>PHP 5.2+ : <?php echo (PHP_VERSION_ID > 50200) ? "Yes" : "No"; ?></li>
                             <li>PDO : <?php echo (class_exists("PDO")) ? "Yes" : "No"; ?></li>
                             <li>SplFileInfo : <?php echo (class_exists("SplFileInfo")) ? "Yes" : "No"; ?></li>
                             <li>DirectoryIterator : <?php echo (class_exists("DirectoryIterator")) ? "Yes" : "No"; ?></li>
                             <li>Multiviews : <?php echo $multiviews; ?></li>
                             <noscript><li>Disabled !</li></noscript>
                         </ul>
                       </div>
                       <div id="tab-2">
                         <h3><?php echo _('Base de donnée'); ?></h3>
                         <?php
                            include('views/tpl/configuration-database.php');
                         ?>
                       </div>
                       <div id="tab-3">
                         <h3><?php echo _('Site'); ?></h3>
                         <?php
                            include('views/tpl/configuration-site.php');
                         ?>
                       </div>
                       <div id="tab-4">
                         <h3><?php echo _('Administrateur'); ?></h3>
                         <?php
                            include('views/tpl/configuration-user.php');
                         ?>
                       </div>
                       <div id="tab-5">
                           <h3><?php echo _('Bravo'); ?></h3>
                           <p class="bookmarkletContainer acenter">
                           	 Déposez le bookmarklet dans votre barre de favoris.<br>&darr;<br>
                           	<?php include('helpers/widget.php'); ?>
                           </p>
                           <p>
                               L'application est maintenant installée, ajouter le bookmarklet à votre navigateur pour
                               commencer à ajouté des marques-pages.
                           </p>
                       </div>
                        <!--<hr>
                        <a href="#" id="<?php if(APP_SETUP) { echo 'setupSave'; } else { echo 'configSave'; } ?>" name="<?php if(!isset($conf)) { echo 'setupSave'; } else { echo 'configSave'; } ?>" class="myButton"  onclick="return false;">Save</a>
                        -->
                        <hr>
                        <p class="acenter">
						<a class="button darkGreen lightGreenBackground" name="configSave" id="configSave" href="#"><span class="iconic check iconsize"></span>&nbsp;Save and continue</a>
						</p>
                    </form>
                </div>

            </div>
            
        </div>        
    </div>
    <?php
    include('views/footer.php');
?>
</div>
<!-- /setup.php -->
<script type="text/javascript">
		JS_ROOT="<?php echo $_root; ?>";
		JS_CONFIG_PHP_VERSION =<?php echo (PHP_VERSION_ID > 50200) ? "true" : "false"; ?>;
		JS_CONFIG_PHP_PDO = <?php echo (class_exists("PDO")) ? "true" : "false"; ?>;
		JS_CONFIG_PHP_SplFileInfo = <?php echo (class_exists("SplFileInfo")) ? "true" : "false"; ?>;
		JS_CONFIG_PHP_DIRECTORY_ITERATOR = <?php echo (class_exists("DirectoryIterator")) ? "true" : "false"; ?>;
		JS_CONFIG_APACHE_MULTIVIEWS = <?php echo $js_var; ?>;
</script>
<script type="text/javascript" src="js/tabs.js"></script>
<script type="text/javascript" src="js/setup-configuration-handler.js"></script>
</body>
</html>

