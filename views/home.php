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
$totalCategories = $sql->query('SELECT count(*) as total FROM `categories`');
while ($row = mysql_fetch_assoc($totalCategories)) {
    $total = $row['total'];
}

$allCategories = $sql->query('SELECT `id`, `name` FROM `categories`');
$array_result = array();
$i = 0;
$clear = 0;
$output = '';
while ($row = mysql_fetch_assoc($allCategories)) {

    $array_result[] = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $row['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . $conf['homeNomberOfUrls']);
    $totalUrl[] = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $row['id']);
    $numberLinks = mysql_num_rows($array_result[$i]);
    $totalLinks = mysql_num_rows($totalUrl[$i]);

    if ($numberLinks != "0") {
        //if ($numberLinks == 1) {
          //  $output .= '<div class="grid_12">';
        //} elseif ($numberLinks == 2) {
          //  $output .= '<div class="grid_6">';
        //} elseif ($numberLinks >= 3) {
            $output .= '<div class="grid_4">';
       // }
        $output .='<h2>
                            <a href="' . ROOT_MAIN . $row['id'] . '/' . $row['name'] . '">' . $row['name'] . '</a>
                            <span class="totalLinks">' . $totalLinks . '</span>
			</h2>
					<ul class="listUrl">' . "\n";
        while ($li = mysql_fetch_assoc($array_result[$i])) {
            $output .= '<li><a href="' . $li['url'] . '" title="' . $li['description'] . '" data-tags="' . $li['tags'] . '">' . stripslashes($li['title']) . '</a></li>' . "\n";
        }

        $output .= '</ul></div>' . "\n";
        $clear++;
    }

    $i++;
    if ($clear % 3 == 0 && $clear != 0) {
        $output .= '<div class="clear"></div>' . "\n";
    }
}
echo $output;
?>
<!-- /home.php -->
