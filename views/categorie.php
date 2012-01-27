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
					$links = $sql->query('SELECT * FROM categories ORDER BY `name` ASC ');
					//while ( $row = mysql_fetch_assoc( $links ) ) {
					foreach ( $links as $row ) {
						echo '<p id="idCategorie'.$row['id'].'" data-id="'.$row['id'].'"><a href="' . ROOT_MAIN .'categorie/'. $row['name'] . '/' . $row['id'] . '">'.$row['name'].'</a><span class="delete" data-id="'.$row['id'].'" data-category="'.$row['name'].'" ><a href="#">x<span class="deleteTxt"><span class="deleteTriangle"></span>Delete</span></a></span></p>'."\n";
						$i++;
					}
				?>
                            <form id="addNewcat">
                                <label>
                                    New categorie name ?<br>
                                    <input id="inputCat" name="inputCat" type="text"><br><br>
                                    <a href="#" id="addCategory" class="myButton" onclick="return false;">Add</a>
                                    <br><span id="addResponse">&nbsp;</span>
                                    <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
                                </label>
                            </form>
                           <!-- <p id="addNewcat" class="containerCat">
				<label>Nom de la nouvelle catégorie :
				<input type="text" id="inputCat" name="inputCat"></label><br><br>
				<a href="#" id="addCategory" class="button" onclick="return false;">Add</a>
				<br><span id="addResponse">&nbsp;</span>
                            </p>-->
                            <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
			</div>

			<div id="newItems" class="grid_8">
			<?php } else {?>

			<div id="newItems" class="grid_12">

			<?php } ?>
                        <?php
                            $links = $sql->query('SELECT * FROM bookmarks where category=? ORDER BY `dt` DESC', array($multiViews->args[3]));
                            $totalLinks = count( $links ) ;
                        ?>
			<h2><?php echo urldecode($multiViews->args[2]); ?><span class="totalLinks"><?php echo $totalLinks; ?> links</span></h2>

                        <ul class="listUrl">
			<?php
				$links = $sql->query('SELECT * FROM bookmarks where category=? ORDER BY `dt` DESC', array($multiViews->args[3]));
				//if( !is_bool($links ) ) {
				if( count($links ) != 0 ) {
					//while ($row = mysql_fetch_assoc( $links )) {
					foreach ( $links  as $row ) {

                                                echo '<li>';

                                                if( $_SESSION['type'] == 'admin' ) {
                                                   // echo '<span class="dragMeToCat" title="'.$row['hash'].'" data-display="'.stripslashes($row['title']).'">Drag me</span>';
                                                }
                                               // echo'<a href="' . $row['url'] . '" title="'.$row['description'].'" class="displayTitle">'. stripslashes($row['title']) . '</a>';
                                                if( $_SESSION['type'] == 'admin' ) {
                                                    /*echo'
                                                    <span class="delete close">
                                                        <a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x
                                                        <span class="deleteTxt">
                                                           <span class="deleteTriangle"></span>
                                                           Delete
                                                        </span>
                                                        </a>
                                                    </span>';*/
                                                }

                                                // -------------------------------------- //
                                                if( $_SESSION['type'] == 'admin' ) {
                                                    echo '<div class="itemLeft">';
                                                    echo '<span class="dragMeToCat" title="'.$row['hash'].'" data-display="'.stripslashes($row['title']).'">Drag me</span>';
                                                    echo '</div>';
                                                }
                                                
                                                if ($_SESSION['type'] == 'admin') {
                                                    echo '<div class="itemMain">';
                                                    echo '<span class="delete close">
<a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x
                                                        <span class="deleteTxt">
                                                           <span class="deleteTriangle"></span>
                                                           Delete
                                                        </span>
                                                        </a>
                                                        </span>';
                                                }
                                                echo'<h3><a href="' . $row['url'] . '" title="'.$row['description'].'" class="displayTitle">'. stripslashes($row['title']) . '</a></h3>';
                                                echo '<p>'. stripslashes($row['title']) . '</p>';
                                                echo '<div class="itemTags"><ul>';

                                                


                                                echo '</ul></div>';
                                                if ($_SESSION['type'] == 'admin') {
                                                    echo '</div>';
                                                }


                                                // -------------------------------------- //
                                                
                                                echo '<div class="clear"></div></li>';
					}
				}
				else {
					echo '<li>Empty</li>'."\n";
				}
			?><!--
                            <li>
                                <div class="itemLeft"><span data-display="Git Tag Mini Cheat Sheet Revisited - Ariejan.net" title="cfd6fd9538079584acc9eca7168ff33e" class="dragMeToCat ui-draggable">Drag me</span></div>
                                <div class="itemMain">
                                    <span class="delete close">
                                    <a data-title="Test" data-id="37" title="DELETE" href="#">x
                                        <span class="deleteTxt">
                                            <span class="deleteTriangle"></span>
                                            Delete
                                        </span>
                                    </a>
                                </span>
                                    <h3><a class="displayTitle" title="About Software Engineering, Ruby on Rails, Java, Git and the Cloud - by Ariejan" href="http://ariejan.net/2009/09/05/git-tag-mini-cheat-sheet-revisited/">Test</a></h3>
                                    
                                    <p>item description</p>
                                    <div class="itemTags">
                                        <ul>
                                            <li><a href="">Tags 1</a></li>
                                            <li><a href="">Tags 1</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clear"></div>

                                
                                <span data-display="Git Tag Mini Cheat Sheet Revisited - Ariejan.net" title="cfd6fd9538079584acc9eca7168ff33e" class="dragMeToCat ui-draggable">Drag me</span><a class="displayTitle" title="About Software Engineering, Ruby on Rails, Java, Git and the Cloud - by Ariejan" href="http://ariejan.net/2009/09/05/git-tag-mini-cheat-sheet-revisited/">Test</a>
                                <span class="delete close">
                                    <a data-title="Test" data-id="37" title="DELETE" href="#">x
                                        <span class="deleteTxt">
                                            <span class="deleteTriangle"></span>
                                            Delete
                                        </span>
                                    </a>
                                </span>
                            </li>-->
			</ul>
			</div>
<!-- /categorie.php -->
