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

// Code extrement moche à refaire
extract($GLOBALS);
    if ($_SESSION['type'] == 'admin') {
        $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories`');
    } else {
        $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id` NOT IN (SELECT `id` FROM  `' . DB_TABLE_PREFIX . 'categories` WHERE `id`=\'2\')');
    }

$grid   = array();
$i      = 0;
$clear  = 0;
$output = '';

foreach ($allCategories as $oneCategorie) {
    // All categories
    if ($_SESSION['type'] == 'admin') {
        $listItemOneCategory = $sql->query('SELECT * FROM `' . DB_TABLE_PREFIX . 'bookmarks` WHERE `category`=' . $oneCategorie['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . APP_FRONT_URLS);
    } else {
        $listItemOneCategory = $sql->query('SELECT * FROM `' . DB_TABLE_PREFIX . 'bookmarks` WHERE `category`=' . $oneCategorie['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . APP_FRONT_URLS);
    }
    $isEmpty = $sql->countRows;


    // How many links in categorie
    $totalListItemOneCategory = count($listItemOneCategory);


    // Not empty
    if ($totalListItemOneCategory != false && $totalListItemOneCategory != 0 ) {
        $li = array();
        // Can print
        foreach ($listItemOneCategory as $row) {
            $li[] = array('url' => $row['url'], 'tags' => $row['description'], 'hash' => $row['hash'], 'title' => $row['title']);
        }

        $grid[] = array('total' => $totalListItemOneCategory, 'title' => $oneCategorie['name'], 'id' => $oneCategorie['id'], 'li' => $li);
    }


}

$gridSize = count($grid);
$output = '';
$iterator = 0;

$totalCategorie = count($grid);

$iterator = -1;

$modulo = 0;


if( $totalCategorie == 0 ) {

?>
<div class="grid_12 gridHome">
    <h2>No bookmarks saved yet</h2>
    <ul>
        <ul class="listUrl">
            <li>
                Empty
            </li>
        </ul>
    </ul>
</div>

<?php
}

while (isset($grid[++$iterator])) {

    if ($totalCategorie == 1) { ?>
       <div class="grid_12 gridHome">
        <?php $modulo += 3;
    } elseif ($totalCategorie == 2) { ?>
        <div class="grid_6 gridHome">
        <?php $modulo += 3;
    } else { ?>
        <div class="grid_4 gridHome">
    <?php } ?>

	<?php
	// Devrait provenir d'un template
	?>
    <h2>
        <a href="<?php echo PATH_INDEX; ?>categorie/<?php echo $grid[$iterator]['title']; ?>/<?php echo $grid[$iterator]['id']; ?>"><?php echo $grid[$iterator]['title']; ?></a>
    </h2>
    <ul class="listUrl">
    <?php
        // Un container

        foreach ( $grid[$iterator]['li'] as $key => $value) {
            $_SESSION['key'] = $key;
            $_SESSION['value'] = $value;
            $template->display('bookmark-simple');
        }
            $_SESSION['key'] = null;
            $_SESSION['value'] = null;
    ?>
    </ul>
        </div>
    <?php
    $modulo++;
    if ($modulo % 3 == 0 && $modulo != 0) { ?>
        <div class="clear"></div>
    <?php }

}
?>

<!-- /home.php -->
