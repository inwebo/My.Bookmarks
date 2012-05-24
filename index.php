<?php
	if (!is_file('config/config.ini')) {
		include ('views/setup.php');
		exit();
	}
?>
<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php'); ?>
<?php
ini_set('display_errors', APP_DEBUG);
// Controleur Init
try {

	// Session
	$sessions = new MySessions();
	$sessions->addParams('type', 'guest');

	$multiViews = new MyMultiviews( 'index.php' );
        //var_dump($multiViews);
}
catch( Exception $e ) {

	// Display Error ?
	if( APP_DEBUG == 1 ) {
		echo $e->getMessage();
	}
	else {
		// Try to log in exceptions.log
		try {
			$myLog = new MyLog( PATH_LOGS . 'exceptions.log' );
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		// Display it
		catch(Exception $e) {
			if( APP_DEBUG == 1 ) {
				echo $e->getMessage();
			}
		}
	}

}

if( isset( $_POST['login'] ) && isset( $_POST['password'] ) ) {
	$userExists = $sql->query( 'SELECT *  from `'. DB_TABLE_PREFIX .'users` WHERE login=? AND password=?', array( $_POST['login'], md5( $_POST['password'] ) ) );
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
	<?php
	if( $_SESSION['type'] == 'admin' ) {
	?>
    <div class="gui-display-shaddy">
        &nbsp;
    </div>
    <div id="categories-landing">
		<h2>Drop bookmarks into categorie</h2>
		<ul>
		<?php
			$_SESSION['list-categories'] = $listCategories;
			$views->display( 'list-categories' );
			$_SESSION['list-categories'] = NULL;
		?>
		</ul>
	</div>
	<?php
	}
	?>
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
                                $views->display( 'home' );
			}
			elseif( $multiViews->args[1] == "categorie" ) {
                                $views->display( 'categorie' );
                        }
			elseif( $multiViews->args[1] == "tags" ) {
                                if( isset( $multiViews->args[2] ) ) {
                                    $views->display( 'list-tags' );
                                }
                                else {
                                    $views->display('tags');
                                }
			}
			elseif( $multiViews->args[1] == "admin" && $_SESSION['type'] == 'admin') {
                                    $views->display('admin');
			}
			elseif( $multiViews->args[1] == "about" ) {
                                    $views->display('about');
			}
			elseif( $multiViews->args[1] == "typographie" ) {
                                    $views->display('typographie');
			}
                        else {
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
<script type="text/javascript" src="<?php echo PATH_JS; ?>js.const.define.php"></script>
<script type="text/javascript" src="<?php echo PATH_JS; ?>admin-init.js"></script>
<?php if( $_SESSION['type'] == "admin") { ?>
	<script src="http://localhost/My.Bookmarks/js/plugin.bookmarks.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo PATH_JS_CONST; ?>"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-bookmarks.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-categories.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-categories-sort.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>admin-tabs.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>gui-infos-bulles.js"></script>
    <script type="text/javascript" src="<?php echo PATH_JS; ?>gui-help.js"></script>
    <link rel="stylesheet" href="<?php echo PATH_CSS; ?>style-public.css">
<?php } ?>
<script type="text/javascript" src="<?php echo GA_PATH_TRACKER; ?>?id=<?php echo GA_ID; ?>"></script>
<!-- /Custom JS -->


  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
