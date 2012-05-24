<?php
/**
 * My.Bookmarks
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
	extract($GLOBALS);
	if( isset( $_SESSION['splObjectStorage'] ) ) {
		$categorie = $_SESSION['splObjectStorage'];
	}
	else {
		$categorie = $factoryCategories->getBookmarksByCategorie($multiViews->args[3]);
	}
	
	(isset($_SESSION['grid_class'])) ? $grid_class      = $_SESSION['grid_class'] : $grid_class = 'grid_12';
	(isset($_SESSION['from_front'])) ? $bookmarks_class = 'bookmarks-front' : $bookmarks_class = 'bookmarks-simple';
?>
<!-- categorie <?php echo $categorie->name; ?> -->
<div class="<?php echo $grid_class; ?>">
		<h2>
			<a href="<?php echo PATH_INDEX .'categorie/'. $categorie->name .'/'. $categorie->id; ?>"><?php echo $categorie->name; ?></a>
			<?php if( !isset( $_SESSION['from_front'] ) ) { ?>
			<div class="categorie-menu">
				<a href="#" title="Vue compléte" class="categorie-menu-display-full"><span class="iconic list"></span></a>
				<a href="#" title="Vue compacte" class="categorie-menu-display-compact"><span class="iconic list_nested"></span></a>
			</div>
			<?php } ?>
		</h2>
		<ul class="bookmarks-list <?php echo $bookmarks_class; ?>">
			<?php
				$categorie->splObjectStorage->rewind();
				while( $categorie->splObjectStorage->valid() ) {
					$_SESSION['bookmark'] = $categorie->splObjectStorage->current();
				    $template->display('bookmark');
					$_SESSION['bookmark'] = NULL;
				    $categorie->splObjectStorage->next();
				}
			?>
		</ul>
</div>
<!-- categorie <?php echo $categorie->name; ?> -->
