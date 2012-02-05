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
<!-- list-tags.php -->
<?php

extract($GLOBALS);

?>

<?php
    $template = new MyViews( PATH_TEMPLATE );
    $template->display('categories-list');
?>
                        <?php
                        
                            $links = $sql->query('SELECT * FROM '. DB_TABLE_PREFIX .'bookmarks where tags LIKE \'%'.$multiViews->args[2].'%\' ORDER BY `dt` DESC');
                            $totalLinks = count( $links ) ;
                        ?>
                        <h2>Tags : <em><?php echo $multiViews->args[2]; ?></em><span class="totalLinks"><?php echo $totalLinks; ?></span></h2>
			<ul class="listUrl">
			<?php
				$links = $sql->query('SELECT * FROM '. DB_TABLE_PREFIX .'bookmarks where tags LIKE \'%'.$multiViews->args[2].'%\' ORDER BY `dt` DESC');
				if( count($links ) != 0 ) {
					//while ($row = mysql_fetch_assoc( $links )) {
					foreach ( $links as $row ) {
						//echo '<li title="'.$row['hash'].'">';
						/*if( $_SESSION['type'] == 'admin' ) {
							echo '<span class="dragMeToCat" title="'.$row['hash'].'">Drag me</span>';
							echo '<span class="close"><a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x</a></span>';
						}*
						echo'<a href="' . $row['url'] . '" title="'.$row['description'].'">'. stripslashes($row['title']) . '</a><span class="clear"></span></li>'."\n";*/
                                                
                                                echo '<li>';
                                                
                                                if( $_SESSION['type'] == 'admin' ) {
                                                    echo '<span class="dragMeToCat" title="'.$row['hash'].'">Drag me</span>';
                                                }
                                                echo'<a href="' . $row['url'] . '" title="'.$row['description'].'" class="displayTitle">'. stripslashes($row['title']) . '</a>';
                                                if( $_SESSION['type'] == 'admin' ) {
                                                    echo'
                                                    <span class="delete close">
                                                        <a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x
                                                        <span class="deleteTxt">
                                                           <span class="deleteTriangle"></span>
                                                           Delete
                                                        </span>
                                                        </a>
                                                    </span>';
                                                }
                                                echo '</li>';
                                                
                                                //<li>
                                                    //<span class="dragMeToCat">Drag me</span>
                                                    //<a href="">Nom du len</a>
                                                    //<span class="delete">
                                                        //<a href="#">x
                                                        //<span class="deleteTxt">
                                                            //<span class="deleteTriangle"></span>
                                                            //Delete</span>
                                                        //</a>
                                                    //</span>
                                                //</li>
					}
				}
				else {
					echo '<li>Empty</li>'."\n";
				}
			?>
			</ul>
			</div>
<!-- /categorie.php -->
