<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
$key = $_SESSION['key'];
$value = $_SESSION['value'];
?>
<!-- One bookmark -->
<li>
    <?php if ( file_exists( 'images/favicon/' . md5( $value['url'] ) ) ) {?>
        <img src="images/favicon/<?php echo md5($value['url']); ?>"/>&nbsp;<a href="<?php echo $value['url']; ?>" title="<?php echo $value['title']; ?>" data-tags="<?php echo $value['tags']; ?>"><?php echo stripslashes($value['title']); ?></a>
    <?php } else { ?>
        <a href="<?php echo $value['url']; ?>" title="<?php echo $value['title']; ?>" data-tags="<?php echo $value['tags']; ?>"><?php echo stripslashes($value['title']); ?></a><!--<span class="gui-item-button close">x</span>-->
    <?php } ?>
</li>
<!-- /One bookmark -->
