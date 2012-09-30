<?php
extract( $GLOBALS );
?>
<?php
    $allCategories = $sql->query('SELECT `id`, `name` FROM `' . DB_TABLE_PREFIX . 'categories`');
?>
<!-- About -->

<div class="grid_12">
    <h2>Admin</h2>
    <?php
		$i = get_headers(PATH_ROOT . PATH_INI);
		$ok = strpos($i[0], "200");	
		if( $i[0] == "HTTP/1.1 200 OK"  ) { 	
    ?>
    <div class="securityError">
    	<h6><strong>Problème majeur de sécurité</strong></h6>
    	<p>
    		<a href="<?php echo PATH_ROOT . PATH_INI; ?>">Config.ini</a> est accessible depuis le ouaib de l'internet de l'an 2000. L'ensemble de vos paramètres sont dans la nature.
    	</p>
    </div>
    <?php } ?>
	<p class="bookmarkletContainer acenter">
		Déposez le bookmarklet dans votre barre de favoris.<br>&darr;<br>
		&rarr;<?php include('helpers/widget.php'); ?>&larr;<br>&uarr;
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
			<li class="export">
				<span class="iconic cloud_download iconic-large"></span>Export
			</li>
		</ul>
        
        <div class="tabs-content">
            <div>
                <?php
                    $template->display('configuration');
                ?>
            </div>
            <div>
            	<h3>Add catégorie</h3>
				<input id="newCat" name="newCat" value="" />&nbsp;<a href="#" id="categories-new-save" name="categories-new-save" class="button darkGreen lightGreenBackground" onclick="return false;"><span class="iconic plus iconsize"></span></a>
                <br>
                <br>
                <h3>Categories weight</h3>
                <p>Détermine l'ordre d'affichage des catégories sur la page d'accueil.</p>
                <hr>
                <ul id="sortable" class="bookmarks-list">
                	<?php
						$gridPattern  = $sql->query('SELECT * FROM `' . DB_TABLE_PREFIX . 'categories_weight`');
						$gridPattern  = explode('|', $gridPattern[0]['data'] );
                	?>
                    <?php  foreach( $gridPattern as $value ) { ?>
                    	<?php  foreach( $allCategories as $oneCat ) { ?>
                    		<?php if( $oneCat['id'] == $value ) { ?>
								<li data-id="<?php echo $oneCat['id']; ?>" data-name="<?php echo $oneCat['name']; ?>"  class="oneBookmark"><span class="iconic move"></span>&nbsp;<span class="oneCatName"><?php echo $oneCat['name']; ?></span>
									<span class="oneBookmark-menu oneBookmark-menu-right"> <a href="#" title="Edit" class="bookmark-icon categorie-edit"><span class="iconic pen iconSize"></span></a> <a href="#" title="Delete" class="bookmark-icon categorie-delete"><span class="iconic x_alt iconSize"></span></a> </span>
                    			</li>
                    		<?php } ?>
                    	<?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div>
                <h3>Corbeille</h3>
                <tt><strong>@todo : next realease</strong></tt>
            </div>
            <div>
                <h3>Journaux</h3>
                <code>
                	<pre>&nbsp;
                		<?php
                			include( PATH_LOGS . 'exceptions.log' );
						?>
                	</pre>
                </code>
            </div>
            <div>
                <h3>Constantes</h3>
                <p>
                	Ensemble des constantes <tt>php</tt> définies par l'application. A noter ce sont également des "constantes" javascript disponibles.
                	Elles sont préfixées par <tt>JS_</tt>. Exemple <tt>PATH_ROOT</tt> donne <tt>JS_PATH_ROOT</tt>. 
                </p>
                <hr>
                <code>
                	
                    <?php
                        $constantes = get_defined_constants(true);
                        $constantes = $constantes['user'];
						
                        foreach ($constantes as $key => $value) {
                            echo '<strong><tt title="Javascript : JS_'. $key .'">'.$key . '</tt></strong> : ' . $value . '<br>' . "\n";
                        }
                    ?>
                   
                </code>
            </div>
            <div>
            	<h3>Typographie</h3>
            	<p>
            		Page pour jeter un coup d'oeil rapide à l'ensemble des styles CSS.<a href="<?php echo PATH_INDEX; ?>typographie/" target="_blank">Page de démonstration</a>
            	</p>
            </div>
            <div>
            	<h3>About</h3>
            	<p>
            		Version <?php include(PATH_HELPERS . 'version.php'); ?>, dernière version : <?php
            		$code_html=file_get_contents(APP_UPDATE_SERVER); 
					echo $code_html;
            		?>
            	</p>
            </div>
            <div>
            	<h3>Export</h3>
            	<p>
					Export all bookmarks as Netscape bookmark file (html).
            	</p>
            	<hr>
            	<p>
            		<a id="bookmark-export" href="#" class="button">Export</a> please wait, can process for a while. It depends database size.
            	</p>
            </div>
        </div>
    </div>

</div>
<!-- About -->