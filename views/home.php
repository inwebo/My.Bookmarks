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
/*$totalCategories = $sql->query('SELECT count(*) as total FROM `categories`');
while ($row = mysql_fetch_assoc($totalCategories)) {
    $total = $row['total'];
}*/

$allCategories = $sql->query('SELECT `id`, `name` FROM `categories`');
//$array_result = array();
$grid = array();
$i = 0;
$clear = 0;
$output = '';

while ( $oneCategorie = mysql_fetch_assoc( $allCategories ) ) {

    // All categories
    $listItemOneCategory = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $oneCategorie['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . $conf['homeNomberOfUrls']);

    // How many links in categorie
    $totalListItemOneCategory = mysql_num_rows( $listItemOneCategory );


    // Not empty
    if( $totalListItemOneCategory != false ) {
        $li = array();
        // Can print
        while ( $row = mysql_fetch_assoc( $listItemOneCategory ) ) {
            $li[] = array('url'=>$row['url'],'tags'=>$row['description'], 'hash'=>$row['hash'], 'title'=>$row['title']);
        }


        $grid[] = array( 'total' => $totalListItemOneCategory, 'title'=>$oneCategorie['name'], 'id'=>$oneCategorie['id'],'li'=>$li);
    }
}

$gridSize = count( $grid );
$output = '';
$iterator = 0;
echo '<pre>';
//var_dump($grid);
echo '</pre>';

$totalCategorie = count($grid);
//echo $totalCategorie;


$iterator = -1;

$modulo = 0;

while( isset( $grid[++$iterator] ) ) {

    // Un container

        if( $totalCategorie == 1 ) {
            $output .= '<div class="grid_12">';
            $modulo += 3;
        }
        elseif( $totalCategorie == 2 ) {
            $output .= '<div class="grid_6">';
            $modulo += 2;
        }
        else {
            $output .= '<div class="grid_4">';
        }

        $output .='<h2>
                       <a href="' . ROOT_MAIN . $grid[$iterator]['id'] . '/' . $grid[$iterator]['title'] . '">' . $grid[$iterator]['title'] . '</a>
                       <span class="totalLinks">' . $grid[$iterator]['total'] . '</span>
                    </h2>
			<ul class="listUrl">' . "\n";
        foreach($grid[$iterator]['li'] as $key => $value) {
            $output .= '<li><a href="' . $value['url'] . '" title="' . $value['title'] . '" data-tags="' .$value['tags'] . '">' . stripslashes($value['title']) . '</a></li>' . "\n";
        }
/*
        while ($li = mysql_fetch_assoc($array_result[$i])) {
            $output .= '<li><a href="' . $li['url'] . '" title="' . $li['description'] . '" data-tags="' . $li['tags'] . '">' . stripslashes($li['title']) . '</a></li>' . "\n";
        }
*/
        $output .= '</ul></div>' . "\n";

        //$output .= '</div>';

    //print_r( $grid[$iterator]);
    if ($modulo % 3 == 0 && $modulo != 0) {
        $output .= '<div class="clear"></div>' . "\n";
    }
}
echo $output;
//print_r($grid[0]);
//var_dump( $grid[0] );
/*
while ($row = mysql_fetch_assoc($allCategories)) {

    $array_result[] = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $row['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . $conf['homeNomberOfUrls']);
    $totalUrl[]     = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $row['id']);
    $numberLinks    = mysql_num_rows( $array_result[$i] );
    $totalLinks     = mysql_num_rows( $totalUrl[$i] );

    

    $containerGrid = array();
    echo $numberLinks ;
    //if( $numberLinks != "0" ) {
        $containerGrid[] = $array_result[$i];
    //}

    //var_dump($containerGrid);

    $totalGrid = count( $containerGrid );

    while( isset($containerGrid[$clear++]) ) {
        if( empty($totalGrid) ) {
            // Default
        }
        elseif($totalGrid == 1) {
            $output .= '<div class="grid_12">';
        }
        elseif($totalGrid == 2) {
            $output .= '<div class="grid_6">';
        }
        else {
            $output .= '<div class="grid_4">';
        }
        $output .='<h2>
                       <a href="' . ROOT_MAIN . $row['id'] . '/' . $row['name'] . '">' . $row['name'] . '</a>
                       <span class="totalLinks">' . $totalLinks . '</span>
                    </h2>
			<ul class="listUrl">' . "\n";
        while ($li = mysql_fetch_assoc($array_result[$i])) {
            $output .= '<li><a href="' . $li['url'] . '" title="' . $li['description'] . '" data-tags="' . $li['tags'] . '">' . stripslashes($li['title']) . '</a></li>' . "\n";
        }

        $output .= '</ul></div>' . "\n";
    }

    $i++;
    if ($clear % 3 == 0 && $clear != 0) {
        $output .= '<div class="clear"></div>' . "\n";
    }
}
var_dump($containerGrid);
echo $output;*/
?>
<!-- /home.php -->
