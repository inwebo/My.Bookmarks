<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php'); ?>
<?php

// Controleur Init
try {

	// Session
	$sessions = new MySessions();
	$sessions->addParams('type', 'guest');

	$multiViews   = new MyMultiviews( 'index.php' );
        //var_dump($multiViews);
}
catch( Exception $e ) {

	// Display Error ?
	if( $conf['debug'] == 1 ) {
		echo $e->getMessage();
	}
	else {
		// Try to log in exceptions.log
		try {
			$myLog = new MyLog( $conf['logs'] . 'exceptions.log' );
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo ROOT_JS; ?>libs/modernizr-2.0.6.min.js"></script>

    <link rel="shortcut icon" href="images/favicon.png">
</head>

<body>

  <div id="container" >
    <?php include('views/header.php'); ?>
    <div id="main" role="main">
	<!-- Container -->
	<div class="container_12">

	<!-- Breadcrumbs -->
	<div id="breadCrumbs" class="grid_12">
	<?php
		include('views/breadcrumbs.php');
		BreadCrumbs::display();
	?>
	</div>
	<!-- /Breadcrumbs -->



                <!-- Include -->
		<div class="clear"></div>
                <div class="">
		<?php
			if( !is_file('config/config.ini') ) {
				include('views/setup.php');
			}
			if( $multiViews->args == NULL ) {
				include('views/home.php');
			}
			elseif( $multiViews->args[1] == "tags" ) {
                                if( isset($multiViews->args[2]) ) {
                                    include('views/list-tags.php');
                                }
                                else {
                                    include('views/tags.php');
                                }
			}
			else {
				include('views/categorie.php');
			}
		?>
                </div>
                <!-- Breadcrumbs -->
                
	

        <div class="clear"></div>

	</div>

    </div>
	<!-- /Container -->

       
	<!-- Footer -->
        <?php include('views/footer.php'); ?>
	<!-- /Footer -->

  </div>
<!--! end of #container -->

<!-- Display debug -->
<div id="debugOutPut">
	<ul id="displayMssg">

	</ul>
<div>
<!-- /Display debug -->

<!-- Custom JS -->

<script type="text/javascript" src="<?php echo ROOT_JS; ?>login.js"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>tags-filter.js"></script>
<?php if( $_SESSION['type'] == "admin") {?>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>init.php"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>computeitem.js"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>handler-gui-message.js"></script>

<script type="text/javascript" src="<?php echo ROOT_JS; ?>gestion-categorie.js"></script>
<!--<script type="text/javascript" src="<?php //echo ROOT_JS; ?>cat-del.js"></script>-->
<script type="text/javascript" src="<?php echo ROOT_JS; ?>administration.js"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>handler-help.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo GOOGLE; ?>?id=<?php echo $conf ['id']; ?>"></script>
<!-- /Custom JS -->


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
