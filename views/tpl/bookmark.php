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
                <span class="dragMeToCat ui-draggable" title="Drag me into another categorie">Drag and drop me</span>
            </div>
            
<?php } else { ?>
<li class="xfolkentry" >
<?php } ?>
    <?php if ($_SESSION['type'] == 'admin') { ?>
        <div class="bookmarks-main">
    <?php } else { ?>
        <div class="bookmarks-main" style="width:99%;border-left-color: transparent;">
    <?php } ?>

<?php if ($_SESSION['type'] == 'admin') { ?>
            
             <a class="bookmarks-delete" title="Delete" href="#"  onclick="return false;">x</a>
            
             <a class="bookmarks-edit" title="edit" onclick="return false;" href="#">edit</a>
            
             <a class="bookmarks-save" title="Save" href="#"  onclick="return false;">save</a>
<?php } ?>
        <h3><img src="<?php echo PATH_ROOT; ?>images/favicon/<?php echo $row['hash']; ?>"/>&nbsp;<a class="taggedlink displayTitle" title="<?php echo $row['description'];?>" href="<?php echo $row['url'];?>"><?php echo $row['title'];?></a></h3>
        <p>
            <?php
                $buffer = explode(' ', $row['dt']);
                $buffer[0] = implode('-',array_reverse( explode( '-', $buffer[0] ) ));
                $buffer = implode( ' à ', $buffer );
            ?>
            Ajouté le <?php echo $buffer;?>
        </p>
        <p class="description">
            <?php echo $row['description'];?>
        </p>
        <ul class="meta">
            <li>Tags : </li>
            <?php
                $k = -1;
                while (isset($cloud[++$k])) { ?>
                    <li><a href="<?php echo PATH_INDEX . 'tags/' . $cloud[$k]; ?>" class="tags"><?php  echo $cloud[$k]; ?></a><li>
                <?php } ?>
        </ul>
        <?php if ($_SESSION['type'] == 'admin') { ?>
    <form id="bookmarks-edit-<?php echo $row['id'];?>" name="bookmarks-edit-<?php echo $row['id'];?>">
        <input value="<?php echo $row['title'];?>" name="bookmarks-item-title-<?php echo $row['id'];?>" id="bookmarks-item-<?php echo $row['id'];?>"><br>
        <textarea value="" name="bookmarks-item-title-<?php echo $row['id'];?>" id="bookmarks-description-<?php echo $row['id'];?>"><?php echo $row['description'];?></textarea><br>
        <label><input id="bookmarks-tags-<?php echo $row['id'];?>" name="bookmarks-item-tags-<?php echo $row['id'];?>" id="bookmarks-title-<?php echo $row['id'];?>" value="<?php echo $row['tags'];?>">Tags séparés par un espace</label><br>
    </form>
<?php } ?>
    </div>

<?php if ($_SESSION['type'] == 'admin') { ?>

<?php } ?>

<div class="clear"></div>
</li>
<!-- /One bookmark -->
