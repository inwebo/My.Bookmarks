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
	define('PATH_INI', 'config/config.ini');
	$conf = Config::get(PATH_INI);
        define('APP_SETUP', FALSE);
}
else {
	define('PATH_INI', 'config/config.ini.bak');
	$conf = Config::get(PATH_INI);
        define('APP_SETUP', TRUE);
	/*include('views/setup.php');
	exit();*/
}
define('PATH_INI_BAK', 'config/config.ini.bak');
// @todo renommer les variables du config.ini correctement
// @todo construire à la volée, les constantes avec les données du .ini

//var_dump($conf);



define( 'APP_DEBUG', $conf['app_debug'] );

define( 'DB_SERVER', $conf['db_server'] );
define( 'DB_DATABASE', $conf['db_database'] );
define( 'DB_TABLE_PREFIX', $conf['db_table_prefix'] );
define( 'DB_USER', $conf['db_user'] );
define( 'DB_PASSWORD', $conf['db_password'] );
$enigma = new MyCrypt( md5( DB_USER ) );

$root = $conf['path_root'];
define('PATH_ROOT', $root);

$mainRoot = PATH_ROOT . 'index.php/';
define('PATH_INDEX', $mainRoot);

$publicCSS = PATH_ROOT . $conf['path_css'];
define('PATH_CSS', $publicCSS);

$publicJS = PATH_ROOT . $conf['path_js'];
define('PATH_JS', $publicJS);

$ajax = PATH_JS . $conf['path_ajax'];
define( 'PATH_AJAX', $ajax );



$path_bookmark_form = PATH_AJAX . $conf['path_bookmark_form'];
define( 'PATH_BOOKMARK_FORM', $path_bookmark_form);

$publicImg = PATH_ROOT . $conf['path_images'];
define('PATH_IMG', $publicImg );

$defaultFavicon = PATH_IMG . $conf['path_default_favicon'];
define( 'PATH_DEFAULT_FAVICON', $defaultFavicon );

$publicHelpers = $conf['path_helpers'];
define('PATH_HELPERS', $publicHelpers );

$tags = PATH_INDEX . $conf['path_tags'];
define('PATH_TAGS', $tags );

$google =  PATH_ROOT . PATH_HELPERS . $conf['ga_path_tracker'];
define( 'GA_PATH_TRACKER', $google );

$googleId =  $conf['ga_id'];
define( 'GA_ID', $googleId );

$pathJsConst =  PATH_JS . $conf['path_js_const'];
define( 'PATH_JS_CONST', $pathJsConst );

$pathViews =  $conf['path_views'];
define( 'PATH_VIEWS', $pathViews );

define( 'PUBLIC_KEY', $conf['app_public_key'] );

$pathWidget =  PATH_HELPERS.$conf['path_widget'];
define( 'PATH_WIDGET', $pathWidget );

$pathTemplate =  PATH_VIEWS . $conf['path_template'];
define( 'PATH_TEMPLATE', $pathTemplate );

define( 'PATH_LOGS', $conf['path_logs'] );

define( 'APP_NAME', $conf['app_name']);
define( 'APP_FRONT_URLS', $conf['app_front_urls']);

define( 'PATH_LIB', $conf['path_lib']);


try {
        if(!APP_SETUP) {
			$sql = new MyPdo( DB_SERVER, DB_DATABASE, DB_USER, $enigma->decode( DB_PASSWORD ) );
        }

        $views    = new MyViews( PATH_VIEWS );
        $template = new MyViews( PATH_TEMPLATE );
		
		$factoryCategories = new FactoryCategories($sql);
		
		$listCategories    = $factoryCategories->getCategories();

}
catch(Exception $e) {
    
	if( APP_DEBUG == 1 ) {
		echo $e->getMessage();
	}
	else {
		try {
			$myLog = new MyLog( PATH_LOGS . 'exceptions.log' );
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		catch( Exception $e ) {
			if( APP_DEBUG == 1 ) {
				echo $e->getMessage();
			}
		}
	}
}


