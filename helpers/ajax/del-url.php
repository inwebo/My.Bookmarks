<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');
$newCat = $sql->query( 'DELETE FROM `bookmarks` WHERE id=:?', array( $_POST['delUrl'] ) ) ;
if( $newCat === FALSE ) {
	echo 'FALSE';
}
else {
	echo 'Del';
}
