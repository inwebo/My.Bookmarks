<?php header('Content-type: application/javascript'); ?>
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
chdir('..');
chdir('..');
include( 'autoload.php' );
include( 'helpers/const.define.php' );
include( 'lib/sanitize/class.sanitize.php' );

if(
        !isset($_POST['editId']) ||
        !isset($_POST['publicKey']) ||
        !isset($_POST['editName'])
  ){
    exit('Error Post baby');
}


// Todo 
if( $_POST['publicKey'] != PUBLIC_KEY ) {
    exit('Error');
}

$a ="UPDATE  `". DB_TABLE_PREFIX ."categories` SET  `name` =  ? WHERE  `id` = ?";

$b = array( $_POST['editName'], $_POST['editId'] );


$new = $sql->query( $a, $b );
if( $sql->countRows == "1" ) {
	echo 'TRUE';
}
else {
	echo 'FALSE';
}
