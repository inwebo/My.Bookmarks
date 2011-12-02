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
chdir('../../');
include('lib/mysql/class.mysql.php');
include('lib/mylog/class.mylog.php');

$create = file('config/structure.sql');
$create = implode($create);

//echo $create;

$return = '';
try {
	$tempSql = new MySql($_POST['sqlserver'] ,$_POST['user'],$_POST['password'],$_POST['database']);
	$newConfig = new MyLog('config/config.ini.bak');
	$newConfig->setLine(2, $newConfig->getLine(2) . $_POST['sqlserver'] );
	$newConfig->setLine(3, $newConfig->getLine(3) . $_POST['user'] );
	$newConfig->setLine(4, $newConfig->getLine(4) . $_POST['password'] );
	$newConfig->setLine(5, $newConfig->getLine(5) . $_POST['database'] );
	$newConfig->setLine(8, $newConfig->getLine(8) . $_POST['root'] );
	$newConfig->file='config/config.ini';
	$newConfig->save();
	$return = 'TRUE';

}
catch(Exception $e) {
	$return = 'FALSE';
}
echo $return;
