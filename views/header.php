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
 extract( $GLOBALS );
?>


<!-- header -->
<header>
	<div class="container_12">
		<h1><?php echo APP_NAME;?><span><!--triangle--></span></h1>
		<!-- Navigation bar -->
		<nav>
			<?php if ($_SESSION['type'] == 'admin') { ?>
			<li id="menu-admin-tab">
				<a href="<?php echo PATH_INDEX; ?>admin/"><span class="iconic cog iconsize"></span> Administration</a>
			</li>
			<?php } ?>
			<li id="menu-categories-tab">
				<a href="<?php echo PATH_ROOT; ?>index.php" title="Categories"><span class="iconic book iconsize"></span> <?php echo _('Categories'); ?> </a>
				<a href="#" id="menu-display-categories" ><span class="iconic arrow_down_alt1 x-small"></span></a>
			</li>
			<li>
				<a href="<?php echo PATH_INDEX . 'tags/'; ?>"><span class="iconic tag_fill iconsize"></span> Tags</a>
			</li>
		</nav>
	</div>
	<div class="clear"></div>
</header>
<!-- /header -->