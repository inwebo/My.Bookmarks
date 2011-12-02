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
<!-- categorie.php -->
<div class="grid_12">
<h2>Tags</h2>
<pre>
<?php
$array_tags=array();
$filter = array(0=>'');
$tags = $sql->query('SELECT tags FROM bookmarks');
					$buffer =array();
					while ($row = mysql_fetch_assoc( $tags )) {
						//echo '<p id="idCategorie'.$row['tags'].'" data-id="'.$row['id'].'">'.$row['name'].'<span data-id="'.$row['id'].'" class="delCat">del</span></p>'."\n";
						if( $row['tags'] != '' ) {
							$row['tags'] = str_replace(',',' ', $row['tags'] );
							$row['tags'] = str_replace('-','', $row['tags'] );
							$row['tags'] = str_replace('.','', $row['tags'] );
							$explode = explode(' ', trim($row['tags']));
							//var_dump(count($explode));
							if( count($explode) === 1 ) {
								$array_tags[] = trim($row['tags']);
							}
							else {
								foreach( $explode as $key => $value ) {
									array_push($array_tags, strtolower($value));
									$value = ltrim($value);
								}
							}

							//echo $row['tags']  . '<br>';
						}

					}
					$display_tags = array_unique($array_tags);
					$array_tags = array_filter($array_tags);

?></pre>
<ul id="tags">
	<?php
		foreach( $display_tags as $key => $value ) {
			echo '<li><a href="">'. $value .' <span>(x)</span></a></li>';
		}
	?>
	<li><a href="">Tags <span>(28)</span></a></li>
</ul>
</div>
<!-- /categorie.php -->
