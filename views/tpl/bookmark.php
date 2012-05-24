<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
$row = $_SESSION['bookmark'];
?>
<!-- One bookmark -->
<li class="oneBookmark" data-hash="<?php echo $row->hash; ?>" data-id="<?php echo $row -> id; ?>" data-dt="<?php echo $row -> dt; ?>" data-tags="<?php echo $row -> tagsAsString; ?>" data-category="<?php echo $row -> category; ?>" data-visibility="<?php echo $row -> public; ?>">
	<?php if ($_SESSION['type'] == 'admin') { ?>
	<span class="oneBookmark-menu oneBookmark-menu-left bookmark-draggable"> <a href="#" class="bookmark-icon"><span class="iconic move iconSize"></span></a> </span>
	<?php } ?>
	<h3><img src="<?php echo $row->favicon; ?>" title="favicon">&nbsp;<a href="<?php echo $row -> url; ?>"><span class="data-title"><?php echo $row -> title; ?></span></a></h3>
	<p class="data-desc">
		<?php echo $row -> description; ?>
	</p>
	<ul class="meta">
		<li title="<?php echo $row->tagsAsString ?>">
			<span class="iconic tag_fill"></span>
		</li>
		<?php
		foreach ($row->tags as $key => $value) {
		?>
			<li class="tags"><a href="<?php echo PATH_TAGS . $value ?>"><?php echo $value ?></a></li>
		<?php
		}
		?>
	</ul>
	<?php if ($_SESSION['type'] == 'admin') { ?>
	<span class="oneBookmark-menu oneBookmark-menu-right"> <a href="#" title="Edit" class="bookmark-icon bookmark-edit"><span class="iconic pen iconSize"></span></a> <a href="#" title="Delete" class="bookmark-icon bookmark-delete"><span class="iconic x_alt iconSize"></span></a> </span>
	<?php } ?>
</li>
<!-- /One bookmark -->
