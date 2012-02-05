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
<?php if ( $_SESSION['type'] == 'admin' ) { ?>

			<div id="categoriesList" class="grid_4">


                            <h2>Categories</h2>
				<?php
					$i=0;
					$links = $sql->query('SELECT * FROM '. DB_TABLE_PREFIX .'categories ORDER BY `id` ASC ');
					//while ( $row = mysql_fetch_assoc( $links ) ) {
					foreach ( $links as $row ) {
                                            if( $row['id'] == 1 || $row['id'] == 2) {
                                                echo '<p id="idCategorie'.$row['id'].'" data-id="'.$row['id'].'"><a href="' . PATH_INDEX .'categorie/'. $row['name'] . '/' . $row['id'] . '">'.$row['name'].'</a></p>'."\n";
                                            }
                                            else {
                                                echo '<p id="idCategorie'.$row['id'].'" data-id="'.$row['id'].'"><a href="' . PATH_INDEX .'categorie/'. $row['name'] . '/' . $row['id'] . '">'.$row['name'].'</a><span class="gui-item-button close" data-id="'.$row['id'].'" data-category="'.$row['name'].'" ><a href="#">x</a></p>'."\n";
                                            }
						
						$i++;
					}
				?>
                            <form id="addNewcat">
                                <label>
                                    New categorie name ?<br>
                                    <input id="inputCat" name="inputCat" type="text"><br><br>
                                    <a href="#" id="addCategory" class="myButton" onclick="return false;">Add</a>
                                    <br>&nbsp;<span id="addResponse"></span>
                                    <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
                                </label>
                            </form>
                            <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
			</div>

			<div id="newItems" class="grid_8">
			<?php } else {?>

			<div id="newItems" class="grid_12">

			<?php } ?>
                        <?php
                            $links = $sql->query('SELECT * FROM '. DB_TABLE_PREFIX .'bookmarks where category=? ORDER BY `dt` DESC', array($multiViews->args[3]));
                            $totalLinks = count( $links ) ;
                        ?>
			<h2><?php echo urldecode($multiViews->args[2]); ?><span class="totalLinks">&nbsp;<?php echo $totalLinks; ?> urls</span></h2>

                        <ul class="listUrl">
			<?php
				$links = $sql->query('SELECT * FROM '. DB_TABLE_PREFIX .'bookmarks where category=? ORDER BY `dt` DESC', array($multiViews->args[3]));
				if( count($links ) != 0 ) {
					foreach ( $links  as $row ) {

                                                

                                                // -------------------------------------- //
                                                if( $_SESSION['type'] == 'admin' ) {
                                                    echo '<li data-hash="'.$row['hash'].'">';
                                                    echo '<div class="itemLeft">';
                                                    echo '<span class="dragMeToCat" title="'.$row['hash'].'" data-display="'.stripslashes($row['title']).'">Drag me</span>';
                                                    
                                                    
                                                    echo '</div>';
                                                }
                                                else {
                                                    echo '<li>';
                                                }
                                                
                                                if ($_SESSION['type'] == 'admin') {
                                                    echo '<span class="gui-item-button close"><a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x</a></span>';
                                                    echo '<span class="gui-item-button edit itemEditSpan" data-hash="'.$row['hash'].'" data-display="'.stripslashes($row['title']).'"><a href="#" onclick="return false;"data-hash="'.$row['hash'].'" >edit</a></span>';
                                                    echo '<span class="gui-item-button save itemSaveSpan" data-hash="'.$row['hash'].'" data-display="'.stripslashes($row['title']).'"><a href="#" onclick="return false;"data-hash="'.$row['hash'].'" >save</a></span>';

                                                    echo '<div class="itemMain">';
                                                }

                                                echo'<div class="itemDisplay"><h3><a href="' . $row['url'] . '" title="'.$row['description'].'" data-hash="'.$row['hash'].'"  class="displayTitle">'. stripslashes($row['title']) . '</a></h3>';
                                                echo '<p>'. stripslashes($row['description']) . '</p>';
                                                echo '<div class="itemTags"><ul>';
                                                    //<!-- Tags -->

                                                $tags = new MyTags($row['tags']);
                                                $cloud = $tags->asArray();

                                                $k=-1;
                                                while( isset( $cloud[++$k] ) ) {
                                                    echo '<li><a class="tags" href="'.PATH_INDEX.'tags/'. $cloud[$k] .'">'. $cloud[$k] .'</a><li>';
                                                }

                                                echo '</ul></div></div>';
                                                if ($_SESSION['type'] == 'admin') {
                                                    echo '</div>';
                                                    echo '<div class="itemEdit">';
                                                    echo '<form id="id'. $row['id'] .'" name="id'. $row['id'] .'"  data-hash="'.$row['hash'].'" data-id="'.$row['id'].'" >';
                                                    echo '<input id="item-title" name="item-title" value="'. $row['title'] .'" ><br>';
                                                    echo '<textarea id="item-title" name="item-title" value="">'. $row['description'] .'</textarea><br>';
                                                    echo'</form>';
                                                    echo '</div>';
                                                }


                                                // -------------------------------------- //
                                                
                                                echo '<div class="clear"></div></li>';
					}
				}
				else {
					echo '<li>Empty</li>'."\n";
				}
			?>
			</ul>
			</div>
<!-- /categorie.php -->
