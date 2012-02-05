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
<?php
//chdir('..');
if( is_file( 'config/config.ini' ) ) {
	define('INI', 'config/config.ini');
	$conf = Config::get(INI);
}
else {
	include('views/setup.php');
	exit();
}

//@todo renommer les varibles du config.ini correctement
//@todo construire à la volée, les constantes avec les données du .ini

/**
 * The short description
 *
 */
define( 'DEBUG', $conf['debug'] );

define( 'DB_SERVER', $conf['db_server'] );
define( 'DB_DATABASE', $conf['db_database'] );
define( 'DB_TABLE_PREFIX', $conf['db_table_prefix'] );
define( 'DB_USER', $conf['db_user'] );
define( 'DB_PASSWORD', $conf['db_password'] );
$enigma = new MyCrypt( md5( DB_USER ) );

$root = $conf['root'];
define('PATH_ROOT', $root);

$mainRoot = PATH_ROOT . 'index.php/';
define('PATH_INDEX', $mainRoot);

$publicCSS = PATH_ROOT . $conf['css'];
define('PATH_CSS', $publicCSS);

$publicJS = PATH_ROOT . $conf['js'];
define('PATH_JS', $publicJS);

$ajax = PATH_JS . 'ajax/';
define( 'PATH_AJAX', $ajax );

$publicImg = PATH_ROOT . $conf['images'];
define('PATH_IMG', $publicImg );

$publicHelpers = $conf['helpers'];
define('PATH_HELPERS', $publicHelpers );

$google =  PATH_ROOT . PATH_HELPERS . $conf['googleAnalytics'];
define( 'PATH_GOOGLE_ANALYTICS', $google );

$googleId =  $conf['id'];
define( 'GA_ID', $googleId );

$pathJsConst =  PATH_JS . $conf['path_js_const'];
define( 'PATH_JS_CONST', $pathJsConst );

$pathViews =  $conf['path_views'];
define( 'PATH_VIEWS', $pathViews );

define( 'PUBLIC_KEY', $conf['publicKey'] );

$pathWidget =  PATH_HELPERS.$conf['path_widget'];
define( 'PATH_WIDGET', $pathWidget );

$pathTemplate =  PATH_VIEWS . $conf['template'];
define( 'PATH_TEMPLATE', $pathTemplate );

try {
	$sql = new MyPdo( DB_SERVER, DB_DATABASE, DB_USER, $enigma->decode( DB_PASSWORD ) );
        $views = new MyViews( PATH_VIEWS );
        $template = new MyViews( PATH_TEMPLATE );
}
catch(Exception $e) {
    
	if( DEBUG == 1 ) {
		echo $e->getMessage();
	}
	else {
		try {
			$myLog = new MyLog( $conf['logs']. 'exceptions.log' );
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		catch( Exception $e ) {
			if( DEBUG == 1 ) {
				echo $e->getMessage();
			}
		}
	}
}
