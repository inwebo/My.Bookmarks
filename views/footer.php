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
    $a = file_get_contents($conf['serverVersion']);
    $update = false;
    ( $conf['version'] != $a ) ? $update = true : $update = false ;
?>
	<!-- Footer -->
    <footer>
		<div class="container_12">
			<div class="grid_12">
				<p>
					My.Bookmarks version <?php echo $conf['version']; ?>
                                        <?php if( $update ) { ?>
                                        <a href="https://github.com/inwebo/My.Bookmarks" target="_blank"  class="myButton">New version update now</a>
                                        <?php } ?>
                                        - par <a href="http://www.inwebo.net" title="Julien Hannotin portfolio">www.inwebo.net</a> - <a title="Creative Commons 2" href="http://creativecommons.org/licenses/by-nc-sa/2.0/fr/">cc2</a> - <a href="https://github.com/inwebo/My.Bookmarks" target="_blank" title="Latsest release repository">Github Repository</a>
				</p>
			</div>
		</div>
	</footer>
	<!-- /Footer -->

