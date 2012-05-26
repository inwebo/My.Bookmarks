<?php
extract( $GLOBALS );
?>
<?php
    $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories` WHERE `id` !=2 ');
?>
<!-- About -->

<div class="grid_12">
    <h2>Admin</h2>
    <div id="vtab">
		<ul class="tabs-left">
			<li class="home selected">
				<span class="iconic wrench iconic-large"></span>Site configuration
			</li>
			<li class="login">
				<span class="iconic book iconic-large"></span>Categories
			</li>
			<li class="support">
				<span class="iconic trash_fill iconic-large"></span>Corbeille
			</li>
			<li class="journaux">
				<span class="iconic book_alt2 iconic-large"></span>Journaux
			</li>
			<li class="constantes">
				<span class="iconic beaker_alt iconic-large"></span>Constantes
			</li>
			<li class="typographie">
				<span class="iconic left_quote_alt iconic-large"></span>Typographie
			</li>
			<li class="about">
				<span class="iconic info iconic-large"></span>About
			</li>
		</ul>
        
        <div class="tabs-content">
            <div>

                <?php
                    $template->display('configuration');
                ?>
            </div>
            <div>
                <h3>Categories weight</h3>
                <ul id="sortable">
                    <?php  foreach( $allCategories as $value ) { ?>
                        <li data-weight="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></li>
                    <?php } ?>
                </ul>
                <a id="categories-weigth-save" href="#">Save</a>
            </div>
            <div>
                <h3>Corbeille</h3>
                SUPPORT CONTENT
            </div>
            <div>
                <h3>Journaux</h3>
                SUPPORT CONTENT
            </div>
            <div>
                <h3>Constantes</h3>
                <code>
                    <?php
                        $constantes = get_defined_constants(true);
                        $constantes = $constantes['user'];
                        foreach ($constantes as $key => $value) {
                            echo '<strong>'.$key . '</strong> : ' . $value . '<br>';
                        }
                    ?>
                </code>
            </div>
            <div>
            	<h3>Typographie</h3>
            	<p>
            		<a href="<?php echo PATH_INDEX; ?>typographie/"><span class="iconic beaker_alt iconsize"></span> Page de démonstration</a>
            	</p>
            </div>
            <div>
            	<h3>About</h3>
            	<p>
            		
            	</p>
            </div>
        </div>
    </div>

</div>
<!-- About -->