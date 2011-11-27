<!-- home.php -->
<?php

$totalCategories = $sql->query('SELECT count(*) as total FROM `categories`');
while ($row = mysql_fetch_assoc( $totalCategories )) {
	$total = $row['total'];
}

$allCategories = $sql->query('SELECT `id`, `name` FROM `categories`');
$array_result = array();
$i=0;
$clear =0;
$output = '';
while ( $row = mysql_fetch_assoc( $allCategories ) ) {

	$array_result[] = $sql->query('SELECT * FROM `bookmarks` WHERE `category`='.$row['id'] . ' ORDER BY `dt` DESC LIMIT 0,'.$conf['homeNomberOfUrls'] );

	$numberLinks = mysql_num_rows( $array_result[$i] ) ;

	if( $numberLinks != "0" ) {
	$output .= '<div class="grid_4 displayListUrl">
					<h2>
						<a href="' . ROOT_MAIN . $row['id'] . '/' . $row['name'] . '">'.$row['name'].'</a>
					</h2>
					<ul>' ."\n";
					while ($li = mysql_fetch_assoc( $array_result[$i] )) {
						$output .= '<li><a href="' . $li['url'] . '" title="' . $li['description'] . '" data-tags="' . $li['tags'] . '">'. stripslashes($li['title']) . '</a></li>'."\n";
					}

		$output  .= '</ul></div>'."\n";
		$clear++;
	}

	$i++;
	if( $clear%3 == 0 && $clear!=0) {
		$output .= '<div class="clear"></div>'."\n";
	}

}
echo $output;
?>
<!-- /home.php -->
