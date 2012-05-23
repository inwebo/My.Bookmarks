<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
?>
<!-- Liste categories -->

<?php if ($_SESSION['type'] == 'admin') { ?>

    <div id="categoriesList" class="grid_4">

        <h2>Categories</h2>

        <!-- Liste categorie -->
        <?php
        	// La gestion des categories devrait se faire dans la partie admin
            $i = 0;
            $links = $sql->query('SELECT * FROM ' . DB_TABLE_PREFIX . 'categories ORDER BY `id` ASC ');
            foreach ($links as $row) {
                if ($row['id'] == 1 || $row['id'] == 2) {
                    echo '<p id="idCategorie' . $row['id'] . '" data-id="' . $row['id'] . '"><a href="' . PATH_INDEX . 'categorie/' . $row['name'] . '/' . $row['id'] . '">' . $row['name'] . '</a></p>' . "\n";
                } else {
                    echo '<p id="idCategorie' . $row['id'] . '" data-id="' . $row['id'] . '"><a href="' . PATH_INDEX . 'categorie/' . $row['name'] . '/' . $row['id'] . '">' . $row['name'] . '</a><span class="bookmarks-delete bookmarks-delete-small" data-id="' . $row['id'] . '" data-category="' . $row['name'] . '" ><a href="#" data-id="' . $row['id'] . '" data-category="' . $row['name'] . '">x</a></p>' . "\n";
                }

                $i++;
            }
        ?>
        <form id="addNewcat">
            <label>
                New categorie name ?<br>
                <input id="inputCat" name="inputCat" type="text"><br><br>
                <a href="#" id="addCategory" class="myButton" onclick="return false;">Add</a>
                <br>&nbsp;<span id="addResponse"></span>
                <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
            </label>
        </form>
        <input type="hidden" value="<?php echo $i; ?>" id="totalCategories" name="totalCategories">
    </div>


    <div id="newItems" class="grid_8">
    <?php } else { ?>
    <div id="newItems" class="grid_12">
    <?php } ?>
<!-- /Liste categorie -->
