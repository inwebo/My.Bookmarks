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
            <h1><?php echo $conf ['name']; ?></h1>
            <?php if ($_SESSION['type'] != 'admin') {?>
                <span id="boutonTop">
                    <a href="#" id="loginClick" class="loginClick">Login</a>
                </span>
                    <div id="loginContainer">
                        <form name="item-1" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo $conf['root']; ?>" id="loginFieldset">
                            <label>
                                <input type="text" id="item-4" name="login">
                            </label>
                            <label><input type="password" id="item-5" name="password"></label>
                            <input type="submit" id="item-7">
                        </form>
                    </div>
            <?php } else { ?>
                <span id="boutonTop">
                    <a href="?q" id="loginClick" class="loginClickExit">Exit</a>
                </span>
            <?php } ?>

            <!-- New login -->
            <!-- /New login -->


<?php if ($_SESSION['type'] == 'admin') { ?>
                <p class="noticeBouton">
                    Déposez le bouton dans votre barre de favoris.<br>&darr;
                </p>

                <p>
                <?php
                include(ROOT_HELPERS . 'bouton.php');
                ?>
            </p>
<?php } ?>
            <!-- /bouton -->

        </div>

    </div>
    <div class="menu_wrap">
        <nav>

            <div class="container_12 headerNav">
                <li
                <?php if ((isset($multiViews->total) && $multiViews->total === 0) || $multiViews->args[1] == 'categorie') { ?>
                    class="heaederListActif"
                <?php } ?>>
                <?php if ((isset($multiViews->total) && $multiViews->total === 0) || $multiViews->args[1] == 'categorie') { ?>
                    <div class="headerActif_wrap">
                <?php } ?>        
                    <a href="<?php echo $conf['root']; ?>index.php">Categories</a>
                <?php if ((isset($multiViews->total) && $multiViews->total === 0) || $multiViews->args[1] == 'categorie') { ?>
                    </div>
                <?php } ?>
                </li>

                    <li
                <?php
                        if (isset($multiViews->args[1]) && $multiViews->args[1] == 'tags') {
                            echo ' class="heaederListActif" ';
                        }
                ?>
                            >
                <?php if (isset($multiViews->args[1]) && $multiViews->args[1] == 'tags') { ?>
                    <div class="headerActif_wrap">
                <?php } ?>       


                            <a href="<?php echo ROOT_MAIN . 'tags/'; ?>">Tags</a>
                <?php if (isset($multiViews->args[1]) && $multiViews->args[1] == 'tags') { ?>
                    </div>
                <?php } ?>
                        </li>

                        <li
                <?php
                        if (isset($multiViews->args[1]) && $multiViews->args[1] == 'about') {
                            echo ' class="heaederListActif" ';
                        }
                ?>
                            >
                <?php  if (isset($multiViews->args[1]) && $multiViews->args[1] == 'about') { ?>
                    <div class="headerActif_wrap">
                <?php } ?> 
                            <a href="<?php echo ROOT_MAIN . 'about/'; ?>">About</a>
                <?php if (isset($multiViews->args[1]) && $multiViews->args[1] == 'about') { ?>
                    </div>
                <?php } ?>
                </li>
            </div>

        </nav>
        <div class="clear"></div>
    </div>

</header>
<!-- /header -->