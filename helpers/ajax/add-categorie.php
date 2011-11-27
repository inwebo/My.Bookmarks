<?php
chdir('..');
chdir('..');
include('autoload.php');
include( 'helpers/const.define.php');
$newCat = $sql->query( 'INSERT INTO `categories` (`name`) VALUES (":?")', array( $_POST['inputCat'] ) ) ;
if( $newCat === FALSE ) {
	echo 'FALSE';
}
else {
	$newIdCat = $sql->query( 'SELECT `id` FROM `categories` WHERE `name`=":?"', array( $_POST['inputCat'] ) ) ;
	while ($row = mysql_fetch_assoc( $newIdCat )) {
		echo $row['id']."\n";
	}
}
