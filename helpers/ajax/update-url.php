<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');
$sql->query( 'UPDATE `bookmarks` SET `category` = ":?" WHERE `hash`=":?" ', array( $_POST['id'], $_POST['hash'] ) ) ;
echo trim($sql->query);
