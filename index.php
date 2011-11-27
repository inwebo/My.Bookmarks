<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php'); ?>
<?php
// Controleur Init
try {

	// Session
	$sessions = new MySessions();
	$sessions->addParams('type', 'guest');

	$multiViews   = new MyMultiviews( 'index.php' );

	// Cache
	if( $_SESSION['type'] === 'guest' ) {
		$optionsCache = array('life' => $conf['lifetime']);
		$cache        = new MyCache($optionsCache);
	}

	// Scandir
	if(is_dir($conf['public']. urldecode($multiViews->getArgsAsString(TRUE) ) )) {
		$scandir      = new scandir('public/'. urldecode( $multiViews->getArgsAsString(TRUE) ) );
		$all          = $scandir->getTree();
	}

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
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<script type="text/javascript" src="<?php echo ROOT_JS; ?>libs/modernizr-2.0.6.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>



	<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo ROOT_CSS; ?>my-style.css">

</head>
<body>
<div id="container">
	<?php include('views/header.php'); ?>
	<!-- Grid System 12 -->
	<div id="main" role="main" class="container_12">
		<!-- breadcrumbs.php -->
		<div class="grid_12" id="breadCrumbs">
		<?php
			include('views/breadcrumbs.php');
			BreadCrumbs::display();
		?>
		</div>
		<!-- breadcrumbs.php -->
		<div class="clear"></div>
		<?php
			if( !is_file('config/config.ini') ) {
				include('views/setup.php');
			}
			if( $multiViews->args == NULL ) {
				include('views/home.php');
			}
			elseif( $multiViews->args[1] == "tags" ) {
				include('views/tags.php');
			}
			else {
				include('views/categorie.php');
			}
		?>
		<div class="clear"></div>

	</div>
	<!-- end of Grid System 12 -->
	<?php include('views/footer.php'); ?>
</div> <!--! end of #container -->

<!-- Custom JS -->
<script type="text/javascript" src="<?php echo ROOT_JS; ?>init.php"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>login.js"></script>
<?php if( $_SESSION['type'] == "admin") {?>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>computeitem.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>gestion-categorie.js"></script>
<script type="text/javascript" src="<?php echo ROOT_JS; ?>cat-del.js"></script>
<script type="text/javascript" src="<?php echo GOOGLE; ?>"></script>
<!-- /Custom JS -->


<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
