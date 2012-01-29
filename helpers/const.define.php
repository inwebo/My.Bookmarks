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

$enigma = new MyCrypt( md5( $conf['user'] ) );

$root = $conf['root'];
define('ROOT', $root);

$mainRoot = $conf['root'] . 'index.php/';
define('ROOT_MAIN', $mainRoot);

$publicRoot = $conf['root'] . $conf['public'];
define('ROOT_PUBLIC', $publicRoot);

$publicCSS = $conf['root'] . $conf['css'];
define('ROOT_CSS', $publicCSS);

$publicJS = $conf['root'] . $conf['js'];
define('ROOT_JS', $publicJS);

$publicImg = $conf['root'] . $conf['images'];
define('ROOT_IMG', $publicImg);

$publicHelpers = $conf['helpers'];
define('ROOT_HELPERS', $publicHelpers);

$scan = $conf['root'] . $conf['scandir'] . '/' . $conf['public'];
define('ROOT_SCANDIR', $scan);

$infos = $conf['root'] . $conf['fileInfos'] . '/' . $conf['public'];
define('ROOT_INFOS', $infos);

$google =  $conf['root'] . ROOT_HELPERS . $conf['googleAnalytics'];
define('GOOGLE', $google);

$ajax = $conf['root'] . ROOT_HELPERS . 'ajax/';
define('ROOT_AJAX', $ajax);

define('MY_ERROR', $conf['debug']);

try {
	//$sql = new MySql($conf['server'],$conf['user'], $enigma->decode( $conf['password'] ),$conf['database']);
	$sql = new MyPdo( $conf['server'], $conf['database'], $conf['user'], $enigma->decode( $conf['password'] ) );
}
catch(Exception $e) {
	if( $conf['debug'] == 1 ) {
		echo $e->getMessage();
	}
	else {
		try {
			$myLog = new MyLog($conf['logs'].'exceptions.log');
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		catch(Exception $e) {
			if( $conf['debug'] == 1 ) {
				echo $e->getMessage();
			}
		}
	}
}
