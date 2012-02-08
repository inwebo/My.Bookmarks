<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
$row = $_SESSION['row'];


$tags  = new MyTags($row['tags']);
$cloud = $tags->asArray();

?>
<!-- One bookmark -->
<?php if ($_SESSION['type'] == 'admin') { ?>
<li class="xfolkentry"  data-id="<?php echo $row['id'];?>" data-hash="<?php echo $row['hash'];?>" data-title="<?php echo $row['title'];?>">
            <div class="bookmarks-container-bouton">
                <span class="dragMeToCat ui-draggable" title="Drag me into another categorie">Drag me</span>
                <a class="bookmarks-edit" title="Edit" onclick="return false;" href="#"><div class="bookmarks-edit-wrapper">edit</div></a>
            <a class="bookmarks-delete" title="Delete" href="#"  onclick="return false;"><div class="bookmarks-delete-wrapper">x</div></a>
            <a class="bookmarks-save" title="Save" href="#"  onclick="return false;"><div class="bookmarks-save-wrapper">save</div></a>
            
            </div>
            <div class="clear"></div>
            <hr>
<?php } else { ?>
<li class="xfolkentry" >
<?php } ?>
<div class="bookmarks-main">
<?php if ($_SESSION['type'] == 'admin') { ?>

<?php } ?>
        <h3><img src="<?php echo PATH_ROOT; ?>images/favicon/<?php echo $row['hash']; ?>"/>&nbsp;<a class="taggedlink displayTitle" title="<?php echo $row['title'];?>" href="<?php echo $row['url'];?>"><?php echo $row['title'];?></a></h3>
        <p>
            Ajouté le <?php echo $row['dt'];?> par Anon. <span><!-- ★★★&bull;&bull; --></span>
        </p>
        <p class="description">
            <?php echo $row['description'];?>
        </p>
        <ul class="meta">
            <li>Tags : </li>
            <?php
                $k = -1;
                while (isset($cloud[++$k])) { ?>
                    <li><a href="<?php echo PATH_INDEX . 'tags/' . $cloud[$k]; ?>"><?php  echo $cloud[$k]; ?></a><li>
                <?php } ?>
        </ul>
    </div>

<?php if ($_SESSION['type'] == 'admin') { ?>
        <form id="bookmarks-edit-<?php echo $row['id'];?>" name="bookmarks-edit-<?php echo $row['id'];?>">
        <input value="<?php echo $row['title'];?>" name="bookmarks-item-title-<?php echo $row['id'];?>" id="bookmarks-item-<?php echo $row['id'];?>"><br>
        <textarea value="" name="bookmarks-item-title-<?php echo $row['id'];?>" id="bookmarks-description-<?php echo $row['id'];?>"><?php echo $row['description'];?></textarea><br>
        <label><input id="bookmarks-tags-<?php echo $row['id'];?>" name="bookmarks-item-tags-<?php echo $row['id'];?>" id="bookmarks-title-<?php echo $row['id'];?>" value="<?php echo $row['tags'];?>">Tags séparés par un espace</label><br>
    </form>

<?php } ?>

<div class="clear"></div>
</li>
<!-- /One bookmark -->
