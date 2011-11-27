<!-- categorie.php -->
<?php if ( $_SESSION['type'] == 'admin' ) { ?>
			<div id="categoriesList" class="grid_3">
				<h3>Categories</h3>
				<?php
					$i=0;
					$links = $sql->query('SELECT * FROM categories ORDER BY `name` ASC ');
					while ($row = mysql_fetch_assoc( $links )) {
						echo '<p id="idCategorie'.$row['id'].'" data-id="'.$row['id'].'">'.$row['name'].'<span data-id="'.$row['id'].'" data-category="'.$row['name'].'" class="delCat">del</span></p>'."\n";
						$i++;
					}
				?>
			<p id="addNewcat" class="containerCat">
				<label>Nom de la nouvelle catégorie :
				<input type="text" id="inputCat" name="inputCat"></label><br><br>
				<a href="#" id="addCategory" class="button" onclick="return false;">Add</a>
				<br><span id="addResponse">&nbsp;</span>
			</p>
			<input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
			</div>
			<div id="newItems" class="grid_9">
			<?php } else {?>

			<div id="newItems" class="grid_12">

			<?php } ?>
			<h3><?php echo $multiViews->args[2]; ?></h3>
			<ul>
			<?php
				$links = $sql->query('SELECT * FROM bookmarks where category=":?" ORDER BY `dt` DESC', array($multiViews->args[1]));
				if( !is_bool($links ) ) {
					while ($row = mysql_fetch_assoc( $links )) {
						echo '<li title="'.$row['hash'].'">';
						if( $_SESSION['type'] == 'admin' ) {
							echo '<span class="dragMeToCat" title="'.$row['hash'].'">Drag me</span>';
							echo '<span class="close"><a href="#" title="DELETE" data-id="'. $row['id'] .'" data-title="'. $row['title'] .'">x</a></span>';
						}
						echo'<a href="' . $row['url'] . '" title="'.$row['description'].'">'. stripslashes($row['title']) . '</a><span class="clear"></span></li>'."\n";
					}
				}
				else {
					echo '<li>Empty</li>'."\n";
				}
			?>
			</ul>
			</div>
<!-- /categorie.php -->
