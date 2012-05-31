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
<!-- home.php -->
<?php

// Le container des categories doit être trié.

// Selon le nombre de catégories prévoir les class grid_ associée

// Boucle sur ce tableau pour récupérer les bookmarks / catégorie

extract($GLOBALS);

$grid         = $factoryCategories->getBookmarksFront( $listCategories );
$gridPattern  = $sql->query('SELECT * FROM `' . DB_TABLE_PREFIX . 'categories_weight`');
$gridPattern  = explode('|', $gridPattern[0]['data'] );
$smartGrid    = new MyGrid( $grid, $gridPattern );
$currentGrid  = $smartGrid->smartGrid();
$iterator     = 1;

$currentGrid->rewind();

while( $currentGrid->valid() ) {

	$currentCategorie = $currentGrid->current() ;
	$currentCategorie = $currentCategorie->splObjectStorage ;
	$currentCategorie->rewind() ;
	$currentCategorie =  $currentCategorie->current() ;
	
	$_SESSION['splObjectStorage'] = $currentCategorie;
	$_SESSION['grid_class']       = $smartGrid->grid[ $iterator ];
	$_SESSION['from_front']       = 1;
	$views->display('categorie');
	$_SESSION['from_front']       = NULL;
	$_SESSION['grid_class']       = NULL;
	$_SESSION['splObjectStorage'] = NULL;
	
	 if( $iterator%3 == 0 && $iterator != 0 ) {
	 	echo '<div class="clear"></div>';
	 }
	$iterator++;
	$currentGrid->next();
}

?>
<!-- /home.php -->
