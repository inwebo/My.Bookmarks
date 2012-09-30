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
include('autoload.php');
include( 'helpers/const.define.php');
$wholeBookmarks = $factoryCategories->getBookmarks();
$wholeBookmarks->rewind();

$output = '<!DOCTYPE NETSCAPE-Bookmark-file-1>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<!--This is an automatically generated file.
It will be read and overwritten.
Do Not Edit! -->
<TITLE>Signets</TITLE>
<H1>Signets</H1>
<DL><P>';

while( $wholeBookmarks->valid() ) {

	//echo($wholeBookmarks->current()->dt);
	
	//echo $date->format('U');
	//echo( date("Y-s", $wholeBookmarks->current()->dt) );
	$output .= $wholeBookmarks->current()->asNetscapeBookmark();

	$wholeBookmarks->next();	
}

$output .= "</DL><P>";

//$tempFile = tempnam( sys_get_temp_dir(), 'bookmarks' );
$tempFile = tempnam('tmp/', 'bookmarks' );
$file     = fwrite( fopen( $tempFile . '.html' , 'w+'), $output );
  /*  header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$tempFile .'/' );
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . $file);*/
	
echo basename( $tempFile );
//echo $output;