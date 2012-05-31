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

	if (!isset($_POST['itemPublicKey']) ||
		!isset($_POST['itemDescription']) ||
		!isset($_POST['itemCategoryId']) ||
		!isset($_POST['itemHash']) ||
		!isset($_POST['itemTags']) ||
		!isset($_POST['itemVisibility']) ||
		!isset($_POST['itemTitle']) ) {
			exit('Error Post baby');
	}
?>
<div id="bookmarkContainer">
	<h1><span class="iconic pen"> </span>Edit</h1>
	<form action="http://localhost/My.Bookmarks/js/ajax/" enctype="application/x-www-form-urlencoded" method="post" name="bookmarkForm" id="bookmarkForm">
		<input type="hidden" id="hash" name="hash" value="<?php echo $_POST['itemHash']; ?>">
  		<label id="labelCategories">Categories :
			<br>
			<select name="selectCategories" id="selectCategories">
			<?php
				// @ todo Requete deja effectuée, optimisation
				$categories = $sql->query('SELECT * FROM `'. DB_TABLE_PREFIX .'categories`');
		
				foreach ( $categories as $row) {
					if( $_POST['itemCategoryId'] !== $row['id'] ) {
						echo '<option value="'. $row['id'] .'">' . $row['name'] . '</option>';
					}
					else {
						echo '<option value="'. $row['id'] .'" selected>' . $row['name'] . '</option>';
					}
					
				}
			?>
			</select>
		</label>
		<label id="labelPublic">Public :
			<br>
			<input type="checkbox" id="public" name="public" value="1" <?php 
				if( $_POST['itemVisibility'] == '1' ) {
					echo ' checked="yes"';
				}
			 ?> >
		</label>
		<span class="clear"></span>
		<label id="labelUrl">URL :
			<br>
			<input type="text" value="http://localhost/My.Bookmarks/index.php/typographie/#" name="url" disabled="disabled" id="url" style="background-image: url(http://localhost/My.Bookmarks/favicon.png);">
		</label>
		<label id="labelTitle">Title :
			<br>
			<input type="text" value="<?php echo $_POST['itemTitle']; ?>" name="title" id="title">
		</label>
		<label id="labelTags">Tags :
			<br>
			<input type="text" id="tags" name="tags" value="<?php echo $_POST['itemTags']; ?>">
		</label>
		<label id="labelDesc">Desc :
			<br>
			<textarea id="desc" name="desc" rows="5" cols="40"><?php echo $_POST['itemDescription']; ?></textarea>
		</label>
		<hr>
		<a onclick="return false;" class="button darkGreen lightGreenBackground" name="bookmark-edit-save" id="bookmark-edit-save" href="#"><span class="iconic check iconsize"></span>&nbsp;Valid</a>
		<a onclick="return false;" class="button lightRed" name="bookmark-edit-reset" id="bookmark-edit-reset" href="#"><span class="iconic curved_arrow iconsize"></span>&nbsp;Reset</a>
	</form>
</div>