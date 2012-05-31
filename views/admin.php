<?php
extract( $GLOBALS );
?>
<?php
    $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories`');
?>
<!-- About -->

<div class="grid_12">
    <h2>Admin</h2>
    <p>
    	<?php
			include('helpers/widget.php');
		?>
    </p>
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
                <ul id="sortable" class="bookmarks-list">
                	<?php
						$gridPattern  = $sql->query('SELECT * FROM `' . DB_TABLE_PREFIX . 'categories_weight`');
						$gridPattern  = explode('|', $gridPattern[0]['data'] );
                	?>
                	
                    <?php  foreach( $gridPattern as $value ) { ?>
                    	<?php  foreach( $allCategories as $oneCat ) { ?>
                    		<?php if( $oneCat['id'] == $value ) { ?>
								<li data-weight="<?php echo $oneCat['id']; ?>" class="oneBookmark"><?php echo $oneCat['name']; ?></li>
                    		<?php } ?>
                    	<?php } ?>
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
                <code>
                	<pre>
                		<?php
                			include(PATH_LOGS.'exceptions.log');
						?>
                	</pre>
                </code>
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