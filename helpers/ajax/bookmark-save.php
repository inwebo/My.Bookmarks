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
include('autoload.php');
include( 'helpers/const.define.php');
?><?php

function sanitize($str)
{
	if(ini_get('magic_quotes_gpc'))
		$str = stripslashes($str);

	$str = strip_tags($str);
	$str = trim($str);
	$str = htmlspecialchars($str);
	$str = mysql_real_escape_string($str);

	return $str;
}

// Validating the input data

//var_dump($_GET);
// Sanitizing the variables
$_GET['url']   = sanitize( $_GET['url'] );
$_GET['title'] = sanitize( $_GET['title'] );
$_GET['tags'] = sanitize( $_GET['tags'] );
$_GET['desc'] = sanitize( $_GET['desc'] );

$new =$sql->query("	INSERT INTO `bookmarks` (hash,url,title,tags,description, category)
				VALUES (
					\":?\",
					\":?\",
					\":?\",
					\":?\",
					\":?\",
					\":?\"
				)", array( md5($_GET['url']), $_GET['url'], $_GET['title'], $_GET['tags'], $_GET['desc'], $_GET['id'] ) );

if( $new ) {
	$message = 'The URL was shared!';
}
else {
	$message = 'The URL already Exists';
}

?>

/* JavaScript Code */

	var hideUrlForm = document.getElementById('bookmarkContainer');
	document.body.removeChild(hideUrlForm);

function displayMessage(str)
{
	// Using pure JavaScript to create and style a div element

	var d = document.createElement('div');

	with(d.style)
	{
    	// Applying styles:
		position='fixed';
		width = '350px';
		height = '20px';
		top = '50%';
		left = '50%';
		margin = '-30px 0 0 -195px';
		backgroundColor = '#f7f7f7';
		border = '1px solid #ccc';
		color = '#777';
		padding = '20px';
		fontSize = '18px';
		fontFamily = '"Myriad Pro",Arial,Helvetica,sans-serif';
		textAlign = 'center';
		zIndex = 100000;

		textShadow = '1px 1px 0 white';

		MozBorderRadius = "12px";
		webkitBorderRadius = "12px";
		borderRadius = "12px";

		MozBoxShadow = '0 0 6px #ccc';
		webkitBoxShadow = '0 0 6px #ccc';
		boxShadow = '0 0 6px #ccc';
	}

	d.setAttribute('onclick','document.body.removeChild(this)');

    // Adding the message passed to the function as text:
	d.appendChild(document.createTextNode(str));

    // Appending the div to document
	document.body.appendChild(d);

    // The message will auto-hide in 3 seconds:

	setTimeout(function(){
		try{
			document.body.removeChild(d);
		}	catch(error){}
	},3000);
}

<?php

// Adding a line that will call the JavaScript function:
echo 'displayMessage("'.$message.'");';

?>
