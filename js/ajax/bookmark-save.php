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



//$_GET['JS_PUBLIC_KEY'] = $sanitize->sanitize_paranoid_string($_GET['JS_PUBLIC_KEY']);

if(
        ( count( $_GET ) == 0 ) ||
        !isset($_GET['JS_PUBLIC_KEY']) ||
        !isset($_GET['url']) ||
        !isset($_GET['title']) ||
        !isset($_GET['tags']) ||
        !isset($_GET['favicon']) ||
        !isset($_GET['id']) ||
        !isset($_GET['desc'])
  ){
    exit('Error GET');
}

if( $_GET['JS_PUBLIC_KEY'] != PUBLIC_KEY ) {
    exit('Error');
}

$new = $sql->query("INSERT INTO `".DB_TABLE_PREFIX."bookmarks` (
                                        `hash`,
                                        `url`,
                                        `title`,
                                        `tags`,
                                        `description`,
                                        `category`,
                                        `public`
                                )
				VALUES (
					?,
					?,
					?,
					?,
					?,
					?,
					?
				)", array( md5($_GET['url']), $_GET['url'], $_GET['title'], $_GET['tags'], $_GET['desc'], $_GET['id'], $_GET['public'] ) );

if( $sql->countRows === 1 ) {
        $totalLinks = $sql->query('SELECT COUNT(*) FROM `'. DB_TABLE_PREFIX .'bookmarks`');
	$message = 'Url saved. You\'ve got ' . $totalLinks[0]['COUNT(*)'] . ' bookmarks in database';

        $from = fopen( 'http://www.google.com/s2/favicons?domain='.$_GET['favicon'],'rb');
        
        if( $from != FALSE ) {
             $data='';
            while(!feof($from))
                $data.=fread($from,1024);
            fclose($from );
            $to = fopen('images/favicon/' .  md5($_GET['url']) . '.png','w+');
            fwrite($to, $data);
        }
        
}
else {
	$message = 'Already in the database !';
}

?>

/* JavaScript Code */

	var hideUrlForm = document.getElementById('bookmarkContainer');
	document.body.removeChild(hideUrlForm);

function displayMessage(str)
{
	// Using pure JavaScript to create and style a div element

	var d = document.createElement('div');
        d.setAttribute("id", "bookmarkContainerReponse");

	d.setAttribute('onclick','document.body.removeChild(this)');

    // Adding the message passed to the function as text:
	d.appendChild(document.createTextNode(str));

    // Appending the div to document
	document.body.appendChild(d);

    // The message will auto-hide in 3 seconds:

	setTimeout( function(){
		try{
			document.body.removeChild(d);
		}	catch(error){}
	}, 3000 );
}

<?php

// Adding a line that will call the JavaScript function:
echo 'displayMessage("' . $message . '");';

?>
