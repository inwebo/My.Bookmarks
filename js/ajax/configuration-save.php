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
include('lib/config/class.config.php');
include('lib/mypdo/class.mypdo.php');
include('lib/mylog/class.mylog.php');
include('lib/mycrypt/class.mycrypt.php');

$enigma = new MyCrypt( md5( $_POST['setupDbUser'] ) );
$dbPassword = $enigma->code( $_POST['setupDbPassword'] );
$return = '';
$version = file_get_contents('helpers/version.php');
try {
        $tempConf                                        = config::get('config/config.ini', TRUE);
        $tempConf['Data Base']['db_server']              = $_POST['setupDbServer'];
        $tempConf['Data Base']['db_database']            = $_POST['setupDbDatabase'];
        $tempConf['Data Base']['db_user']                = $_POST['setupDbUser'];
        $tempConf['Data Base']['db_password']            = $dbPassword;
        $tempConf['Data Base']['db_table_prefix']        = $_POST['setupDbPrefix'];
        $tempConf['Application']['app_debug']            = $_POST['setupDebug'];
        $tempConf['Application']['app_name']             = $_POST['setupSiteName'];
        $tempConf['Application']['app_front_urls']       = $_POST['setupTotalUrls'];
        $tempConf['Application']['app_save_favicon']     = $_POST['setupFavicon'];
        $tempConf['Application']['app_bookmarks_public'] = $_POST['setupPublic'];
        $tempConf['Application']['app_version']          = $version;
        $tempConf['Google analytics id']['id']           = $_POST['setupGa'];

        config::save( $tempConf, "config/config.ini");
        
	$return = 'TRUE';

}
catch(Exception $e) {
	$return = 'FALSE';
}
echo $return;
