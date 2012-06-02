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
        !isset($_POST['itemPublicKey']) ||
        !isset($_POST['itemDescription']) ||
		!isset($_POST['itemPublic']) ||
        !isset($_POST['itemHash']) ||
        !isset($_POST['itemTags']) ||
        !isset($_POST['itemTitle']) 
  ){
    exit('Error Post baby');
}

if( $_POST['itemPublicKey'] != PUBLIC_KEY ) {
    exit('Error');
}

$a ="UPDATE  `". DB_TABLE_PREFIX ."bookmarks` SET  `title` =  ?,`description` =  ?, `tags`=? WHERE  `hash` = ?";

$b = array( $_POST['itemTitle'], $_POST['itemDescription'], $_POST['itemTags'] , $_POST['itemHash'] );


$new = $sql->query( $a, $b );
if( $sql->countRows == "1" ) {
        //echo 'TRUE';
		$a ="SELECT * FROM `". DB_TABLE_PREFIX ."bookmarks` WHERE  `hash` = ?";
		$b = array( $_POST['itemHash'] );
		$q = $sql->query($a, $b);
		
                ( is_file( PATH_ROOT . 'images/favicon/'.$q[0]['hash'] ) ) ?
              		$favicon = PATH_ROOT . 'images/favicon/'.$q[0]['hash'] :
                		$favicon = PATH_DEFAULT_FAVICON ;
		
		//var_dump($newBookmarkQuery);
		$toSend = new Bookmark(array(
			'id' => $q[0]['id'],
			'hash' => $q[0]['hash'],
			'url' => $q[0]['url'],
			'title' => $q[0]['title'],
			'tags' => $q[0]['tags'],
			'description' => $q[0]['description'],
			'dt' => $q[0]['dt'],
			'category' => $q[0]['category'],
			'public' => $q[0]['public'],
			'favicon'=>$favicon
		));
		$_SESSION['bookmark'] = $toSend;
		$_SESSION['type'] = 'admin';
		$template->display('bookmark');
		$_SESSION['bookmark'] = null;
}
else {
	echo 'FALSE';
}
