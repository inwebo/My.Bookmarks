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

$allCategories = $sql->query('SELECT `id`, `name` FROM `categories`');

$grid   = array();
$i      = 0;
$clear  = 0;
$output = '';

//while ( $oneCategorie = mysql_fetch_assoc( $allCategories ) ) {
foreach( $allCategories as $oneCategorie ){
    // All categories
    if($_SESSION['type'] == 'admin') {
        $listItemOneCategory = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $oneCategorie['id'] . ' ORDER BY `dt` DESC LIMIT 0,' . $conf['homeNomberOfUrls']);
    }
    else {
        $listItemOneCategory = $sql->query('SELECT * FROM `bookmarks` WHERE `category`=' . $oneCategorie['id'] . ' AND `public`="1" ORDER BY `dt` DESC LIMIT 0,' . $conf['homeNomberOfUrls']);
        //echo $sql->query;
    }
    

    // How many links in categorie
    //$totalListItemOneCategory = mysql_num_rows( $listItemOneCategory );
    $totalListItemOneCategory = count( $listItemOneCategory );


    // Not empty
    //if( $totalListItemOneCategory != false ) {
    if( $totalListItemOneCategory != false || $totalListItemOneCategory != 0 ) {
        $li = array();
        // Can print
        //while ( $row = mysql_fetch_assoc( $listItemOneCategory ) ) {
        foreach( $listItemOneCategory as $row ) {
            $li[] = array('url'=>$row['url'],'tags'=>$row['description'], 'hash'=>$row['hash'], 'title'=>$row['title']);
        }

        $grid[] = array( 'total' => $totalListItemOneCategory, 'title'=>$oneCategorie['name'], 'id'=>$oneCategorie['id'],'li'=>$li);
    }
}

$gridSize = count( $grid );
$output = '';
$iterator = 0;

$totalCategorie = count($grid);



$iterator = -1;

$modulo = 0;

while( isset( $grid[++$iterator] ) ) {

    // Un container

        if( $totalCategorie == 1 ) {
            $output .= '<div class="grid_12 gridHome">';
            $modulo += 3;
        }
        elseif( $totalCategorie == 2 ) {
            $output .= '<div class="grid_6 gridHome">';
            $modulo += 3;
        }
        else {
            $output .= '<div class="grid_4 gridHome">';
        }

        $output .='<h2>
                       <a href="' . ROOT_MAIN . 'categorie/' . $grid[$iterator]['title'] . '/' . $grid[$iterator]['id'] . '">' . $grid[$iterator]['title'] . '</a>
                       <span class="totalLinks">' . $grid[$iterator]['total'] . '</span>
                    </h2>
			<ul class="listUrl">' . "\n";
        foreach($grid[$iterator]['li'] as $key => $value) {
            $output .= '<li><a href="' . $value['url'] . '" title="' . $value['title'] . '" data-tags="' .$value['tags'] . '">' . stripslashes($value['title']) . '</a></li>' . "\n";
        }
        $output .= '</ul></div>' . "\n";

    $modulo++;
    //print_r( $grid[$iterator]);
    if ($modulo % 3 == 0 && $modulo != 0) {
        $output .= '<div class="clear"></div>' . "\n";
    }
    
}
echo $output;
?>
<!-- /home.php -->
