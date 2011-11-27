<?php
chdir('../../');
include('lib/mysql/class.mysql.php');
include('lib/mylog/class.mylog.php');

$create = file('config/structure.sql');
$create = implode($create);

//echo $create;

$return = '';
try {
	$tempSql = new MySql($_POST['sqlserver'] ,$_POST['user'],$_POST['password'],$_POST['database']);
	$newConfig = new MyLog('config/config.ini.bak');
	$newConfig->setLine(2, $newConfig->getLine(2) . $_POST['sqlserver'] );
	$newConfig->setLine(3, $newConfig->getLine(3) . $_POST['user'] );
	$newConfig->setLine(4, $newConfig->getLine(4) . $_POST['password'] );
	$newConfig->setLine(5, $newConfig->getLine(5) . $_POST['database'] );
	$newConfig->setLine(8, $newConfig->getLine(8) . $_POST['root'] );
	$newConfig->file='config/config.ini';
	$newConfig->save();
	$return = 'TRUE';

}
catch(Exception $e) {
	$return = 'FALSE';
}
echo $return;
