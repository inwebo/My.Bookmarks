<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
$row = $_SESSION['row'];
?>
<!-- One bookmark -->
<?php if ($_SESSION['type'] == 'admin') { ?>
<li data-hash="<?php echo $row['hash'];?>">
    <div class="itemLeft">
        <span class="dragMeToCat" title="<?php echo $row['hash']; ?>" data-display="<?php echo stripslashes($row['title']); ?>">Drag me</span>
    </div>
<?php } else { ?>
<li>
<?php } ?>

<?php if ($_SESSION['type'] == 'admin') { ?>
    
<?php } ?>



<?php
if ($_SESSION['type'] == 'admin') {
    echo '<span class="gui-item-button close"><a href="#" title="DELETE" data-id="' . $row['id'] . '" data-title="' . $row['title'] . '">x</a></span>';
    echo '<span class="gui-item-button edit itemEditSpan" data-hash="' . $row['hash'] . '" data-display="' . stripslashes($row['title']) . '"><a href="#" onclick="return false;"data-hash="' . $row['hash'] . '" >edit</a></span>';
    echo '<span class="gui-item-button save itemSaveSpan" data-hash="' . $row['hash'] . '" data-display="' . stripslashes($row['title']) . '"><a href="#" onclick="return false;"data-hash="' . $row['hash'] . '" >save</a></span>';

    echo '<div class="itemMain">';
}

echo'<div class="itemDisplay"><h3><a href="' . $row['url'] . '" title="' . $row['description'] . '" data-hash="' . $row['hash'] . '"  class="displayTitle">' . stripslashes($row['title']) . '</a></h3>';
echo '<p>' . stripslashes($row['description']) . '</p>';
echo '<div class="itemTags"><ul>';
//<!-- Tags -->

$tags  = new MyTags($row['tags']);
$cloud = $tags->asArray();

$k = -1;
while (isset($cloud[++$k])) {
    echo '<li><a class="tags" href="' . PATH_INDEX . 'tags/' . $cloud[$k] . '">' . $cloud[$k] . '</a><li>';
}

echo '</ul></div></div>';
if ($_SESSION['type'] == 'admin') {
    echo '</div>';
    echo '<div class="itemEdit">';
    echo '<form id="id' . $row['id'] . '" name="id' . $row['id'] . '"  data-hash="' . $row['hash'] . '" data-id="' . $row['id'] . '" >';
    echo '<input id="item-title" name="item-title" value="' . $row['title'] . '" ><br>';
    echo '<textarea id="item-title" name="item-title" value="">' . $row['description'] . '</textarea><br>';
    echo'</form>';
    echo '</div>';
}
// -------------------------------------- //
?>
<div class="clear"></div></li>
<!-- /One bookmark -->
