<?php extract( $GLOBALS ); ?>
<?php Header("content-type: application/xml"); ?>
<?php include('autoload.php'); ?>
<?php include( dirname( __FILE__ ) . DIRECTORY_SEPARATOR .'helpers/const.define.php' ); ?>
<?php

	$multiViews = new MyMultiviews( 'rss.php' );
	
	if( isset( $multiViews->args[1] ) ) {
		$category = $multiViews->args[1];
		$items = $sql->query( 'SELECT *, UNIX_TIMESTAMP( `dt` ) AS  "formated" FROM `' . DB_TABLE_PREFIX . 'bookmarks` WHERE `category`=? ORDER BY  `' . DB_TABLE_PREFIX . 'bookmarks`.`dt` DESC  LIMIT 0,30', array($multiViews->args[2]) );	
	}
	else {
		$category = 'Incoming';
		$items = $sql->query( 'SELECT *, UNIX_TIMESTAMP( `dt` ) AS  "formated" FROM `' . DB_TABLE_PREFIX . 'bookmarks` ORDER BY  `' . DB_TABLE_PREFIX . 'bookmarks`.`dt` DESC  LIMIT 0,30' );
	}
	
	
	
	$rss = new MyRss( array(	'title'=>'My.Bookmarks',
								'description'=>'Latest saved links',
								'generator'=> 'My.Syndicate API',
								'language'=> 'fr-fr',
								'copyright'=>'inwebo veritas 2012',
								'lastBuildDate'=> date( DATE_RSS, $items[0]['formated'] ),
								'ttl' => 60,
							  	'link' => PATH_ROOT
							  ) );
	
	foreach ($items as $key => $value) {
		$rss->appendItem( array( 'title' => $value['title'], 'description' => $value['description'], 'link' => $value['url'], 'category' => $category ) );
	}
	echo( $rss );

