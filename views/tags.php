<!-- categorie.php -->
<div class="grid_12">
<h2>Tags</h2>
<pre>
<?php
$array_tags=array();
$filter = array(0=>'');
$tags = $sql->query('SELECT tags FROM bookmarks');
					$buffer =array();
					while ($row = mysql_fetch_assoc( $tags )) {
						//echo '<p id="idCategorie'.$row['tags'].'" data-id="'.$row['id'].'">'.$row['name'].'<span data-id="'.$row['id'].'" class="delCat">del</span></p>'."\n";
						if( $row['tags'] != '' ) {
							$row['tags'] = str_replace(',',' ', $row['tags'] );
							$row['tags'] = str_replace('-','', $row['tags'] );
							$row['tags'] = str_replace('.','', $row['tags'] );
							$explode = explode(' ', trim($row['tags']));
							//var_dump(count($explode));
							if( count($explode) === 1 ) {
								$array_tags[] = trim($row['tags']);
							}
							else {
								foreach( $explode as $key => $value ) {
									array_push($array_tags, strtolower($value));
									$value = ltrim($value);
								}
							}

							//echo $row['tags']  . '<br>';
						}

					}
					$display_tags = array_unique($array_tags);
					$array_tags = array_filter($array_tags);

?></pre>
<ul id="tags">
	<?php
		foreach( $display_tags as $key => $value ) {
			echo '<li><a href="">'. $value .' <span>(x)</span></a></li>';
		}
	?>
	<li><a href="">Tags <span>(28)</span></a></li>
</ul>
</div>
<!-- /categorie.php -->
