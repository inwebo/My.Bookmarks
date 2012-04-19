<?php
			if( !is_file('config/config.ini') ) {
				include('views/setup.php');
                                exit();
			}
?>
<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php'); ?>
<?php
ini_set('display_errors', DEBUG);
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
	if( DEBUG == 1 ) {
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
			if( DEBUG == 1 ) {
				echo $e->getMessage();
			}
		}
	}

}

if( isset( $_POST['login'] ) && isset( $_POST['password'] ) ) {
	$userExists = $sql->query( 'SELECT *  from `'. DB_TABLE_PREFIX .'users` WHERE login=? AND password=?', array( $_POST['login'], md5( $_POST['password'] ) ) );
        //var_dump( isset ( $userExists[0] ) );
        if( isset ( $userExists[0] ) ) {
		$sessions->setParams('type','admin');
	}
}

if( isset($_GET['q'] ) && $_SESSION['type'] == 'admin') {
	$sessions->destroy();
	$sessions->setParams('type','guest');
	echo "<meta http-equiv='refresh' content='0';URL=". PATH_ROOT ."'>";
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

  <title><?php echo APP_NAME; ?></title>
  <meta name="description" content="Self hosted bookmarklet service.">
  <meta name="author" content="inwebo">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="<?php echo PATH_ROOT; ?>favicon.png" type="image/png" />
  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>my-style.css">
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>libs/modernizr-2.0.6.min.js"></script>

   
</head>

<body>
    <div class="gui-display-shaddy">
        &nbsp;dd
    </div>
    <a name="top"></a>
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
		<?php
			if( $multiViews->args == NULL ) {
				//include('views/home.php');
                                $views->display( 'home' );
			}
			elseif( $multiViews->args[1] == "categorie" ) {
                               //include('views/categorie.php');
                                $views->display( 'categorie' );
                        }
			elseif( $multiViews->args[1] == "tags" ) {
                                if( isset( $multiViews->args[2] ) ) {
                                    //include('views/list-tags.php');
                                    $views->display( 'list-tags' );
                                }
                                else {
                                    //include('views/tags.php');
                                    $views->display('tags');
                                }
			}
			elseif( $multiViews->args[1] == "about" ) {
                                    //include( 'views/about.php' );
                                    $views->display('about');
			}
			elseif( $multiViews->args[1] == "test" ) {
                                    //include( 'views/test.php' );
                                    $views->display('test');
			}
                        else {
                            //include('views/home.php');
                            $views->display( 'home' );
                        }
		?>
                <!-- Include -->
                
	

        <div class="clear"></div>

	</div>

    </div>
	<!-- /Container -->

       
	<!-- Footer -->
        <?php include('views/footer.php'); ?>
	<!-- /Footer -->

  </div>
<!--! end of #container -->

<!-- Display JS_DEBUG -->
<div id="debugOutPut">
	<ul id="displayMssg">

	</ul>
</div>
<!-- /Display JS_DEBUG -->

<!-- Custom JS -->
<script type="text/javascript" src="<?php echo PATH_JS; ?>login.js"></script>
<script type="text/javascript" src="<?php echo PATH_JS; ?>tags-filter.js"></script>
<script type="text/javascript" src="<?php echo PATH_JS; ?>display-type.js"></script>
<script type="text/javascript" src="<?php echo PATH_JS; ?>about.js"></script>
<?php if( $_SESSION['type'] == "admin") { ?>
    <script type="text/javascript" src="<?php echo PATH_JS_CONST; ?>"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-bookmarks.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-categories.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>gui-infos-bulles.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>gui-help.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo PATH_GOOGLE_ANALYTICS; ?>?id=<?php echo $conf ['id']; ?>"></script>
<!-- /Custom JS -->


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
