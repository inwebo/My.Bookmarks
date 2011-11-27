<?php
//chdir('..');
if( is_file( 'config/config.ini' ) ) {
	define('INI', 'config/config.ini');
	$conf = Config::get(INI);
}
else {
	include('views/setup.php');
	exit();
}

$mainRoot = $conf['root'] . 'index.php/';
define('ROOT_MAIN', $mainRoot);

$publicRoot = $conf['root'] . $conf['public'];
define('ROOT_PUBLIC', $publicRoot);

$publicCSS = $conf['root'] . $conf['css'];
define('ROOT_CSS', $publicCSS);

$publicJS = $conf['root'] . $conf['js'];
define('ROOT_JS', $publicJS);

$publicHelpers = $conf['helpers'];
define('ROOT_HELPERS', $publicHelpers);

$scan = $conf['root'] . $conf['scandir'] . '/' . $conf['public'];
define('ROOT_SCANDIR', $scan);

$infos = $conf['root'] . $conf['fileInfos'] . '/' . $conf['public'];
define('ROOT_INFOS', $infos);

$google =  $conf['root'] . ROOT_HELPERS . $conf['googleAnalytics'];
define('GOOGLE', $google);

$ajax = $conf['root'] . ROOT_HELPERS . 'ajax/';
define('ROOT_AJAX', $ajax);

try {
	$sql = new MySql($conf['server'],$conf['user'], $conf['password'],$conf['database']);
}
catch(Exception $e) {
	if( $conf['debug'] == 1 ) {
		echo $e->getMessage();
	}
	else {
		try {
			$myLog = new MyLog($conf['logs'].'exceptions.log');
			$myLog->line( $e->getMessage() );
			$myLog->save();
		}
		catch(Exception $e) {
			if( $conf['debug'] == 1 ) {
				echo $e->getMessage();
			}
		}
	}
}
