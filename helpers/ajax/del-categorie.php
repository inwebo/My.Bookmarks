<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');
$updateIdCategory = $sql->query('UPDATE `bookmarks` SET `category`=:? WHERE `id`=:?', array( $conf['idDefaultCategory'] ,$_POST['delCat']) );


$newCat = $sql->query( 'DELETE FROM `categories` WHERE id=:?', array( $_POST['delCat'] ) ) ;
if( $newCat === FALSE ) {
	echo 'FALSE';
}
else {
	echo 'Del';
}
