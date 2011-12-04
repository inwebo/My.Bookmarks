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
<!-- header -->
<header>
    <div class="container_12">
        <div id="headerGrid_12" class="grid_12">
	<h1><?php echo $conf ['name']; ?><!--<img src="img/logo.png"><span id="headerTotalLinks">125</span>--></h1>
                            	<!-- Bouton -->
        <?php if ( $_SESSION['type'] == 'admin' ) { ?>

            <?php if ( $_SESSION['type'] == 'admin' ) { ?>
            <span id="displayHelp">
            <a href="#" id="#loginClick">Login</a>
						<div id="loginContainer">
							<form name="item-1" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo $conf['root']; ?>" id="loginFieldset">
								<label>Login <br>
									<input type="text" id="item-4" name="login">
								</label>
									<br><label>Password <br><input type="password" id="item-5" name="password"><br></label>
									<br>
									<input type="submit" id="item-7">
									<?php	if( $_SESSION['type'] == "admin" ) { echo '<a href="?q"  class="myButton logmeout" id="unLog">Exit</a>'; } ?>
									<!--<a class="myButton logme" href="?q">Logme</a>
									<a class="myButton logmeout" href="?q">Exit</a>-->
							</form>
						</div>
            </span>
            <?php } ?>
            <p>
            <?php
                include(ROOT_HELPERS.'bouton.php');
            ?>
            </p>
        <?php } ?>
	<!-- /bouton -->
            <nav>
		<li
                <?php
                    if( isset( $multiViews->total ) && $multiViews->total === 0 ) {
                        echo ' class="heaederListActif" ';
                    }
                ?>
                >
		<?php echo '<a href="'.$conf['root'].'index.php">Home</a>'; ?>
		</li>
					<li
                                            <?php
                                                if( isset($multiViews->args[1]) && $multiViews->args[1] == 'tags' ) {
                                                    echo ' class="heaederListActif" ';
                                                }
                                            ?>
                                        >
						<a href="<?php echo ROOT_MAIN . 'tags/'; ?>">Tags</a>
					</li>
				</nav>
			</div>
		</div>
    </header>
<!-- /header -->