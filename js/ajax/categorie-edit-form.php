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
include ('autoload.php');
include ('helpers/const.define.php' );

	if ( !isset( $_POST['editId'] ) ||
		!isset( $_POST['editName'] ) ) {
			exit( 'Error Post baby' );
	}
?>
<div id="categorieContainer">
	<h1><span class="iconic pen"> </span>Edit</h1>
	<form action="http://localhost/My.Bookmarks/js/ajax/" enctype="application/x-www-form-urlencoded" method="post" name="bookmarkForm" id="bookmarkForm">
		<label id="labelTitle">Name :
			<br>
			<input type="text" value="<?php echo $_POST['editName']; ?>" name="title" id="title">
		</label>
		<hr>
		<a onclick="return false;" class="button darkGreen lightGreenBackground" name="bookmark-edit-save" id="categorie-edit-save" href="#"><span class="iconic check iconsize"></span>&nbsp;Valid</a>
		<a onclick="return false;" class="button lightRed" name="bookmark-edit-reset" id="bookmark-edit-reset" href="#"><span class="iconic curved_arrow iconsize"></span>&nbsp;Reset</a>
	</form>
</div>