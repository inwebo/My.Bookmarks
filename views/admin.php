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
            <li class="home">Site configuration</li>
            <li class="login">Categories</li>
            <li class="support">Corbeille</li>
            <li class="journaux">Journaux</li>
            <li class="Constantes">Constantes</li>
        </ul>
        
        <div class="tabs-content">
            <div>
                <h3>Site configuration</h3>
                			<form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">

				<fieldset>
					<legend>Site</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupSiteName" name="setupSiteName" value="My.Bookmarks"/><br><span>Titre du site est contenu dans la balise H1.</span></label>
					<label class="inputGrid_1">Tagline : <input id="setupTagLine" name="setupTagLine" value="Self hosted bookmarks"/><br><span>Slogan du site est contenu dans la balise H1.</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Debug activé ? : <select id="setupDebug" name="setupDebug"><option value="0">non</option><option value="1">oui</option></select><br><span>Conseillé non.</span></label>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil : <select id="setupTotalUrls" name="setupTotalUrls"><option value="10">10</option><option value="20">20</option></select><br><span>Conseillé 10.</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? : <select id="setupFavicon" name="setupFavicon"><option value="0">non</option><option value="1">oui</option></select><br><span>Dégrade les performances.</span></label>
                                        <label class="inputGrid_1">Liens public par défaut ? : <select id="setupPublic" name="setupPublic"><option value="0">non</option><option value="1">oui</option></select><br><span>Conseillé Oui.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerUser">
					<legend>User</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupUserName" name="setupUserName" value="inwebo"/><br><span>Votre nom d'utilisateur.</span></label>
					<label class="inputGrid_1">Password : <input id="setupUserPassword" name="setupUserPassword" /><br><span>Mot de passe.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerPath">
					<legend>Path</legend>
                                        <label>Root : <input id="setupRoot" name="setupRoot" value="http://<?php echo $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);?>/"/><br><span>Chemin d'accès de l'application, typiquement copier / coller l'adresse actuelle.</span></label>
				</fieldset>
				<hr>
				<fieldset id="containerDatabase">
					<legend>Database</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input id="setupDbServer" name="setupDbServer" value=""/><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
                                        <label class="inputGrid_1 inputGrid_1">Database : <input id="setupDbDatabase" name="setupDatabase" value="" /><br><span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User : <input id="setupDbUser" name="setupDbUser" value=""/><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password : <input id="setupDbPassword" name="setupPassword" value=""/><br><span>Mot de passe.</span></label>

					<label>Table prefixe : <input id="setupDbPrefix" name="setupDbPrefix" value="my_tables_"/><br><span>Prefix d'organisation des tables.</span></label>
                                        <a id="databaseTest" href="#" onclick="return false;" class="myButton">Test de connexion</a>
				</fieldset>
				<hr>
				<fieldset>
					<legend>Google Analytics</legend>
					<label>Id : <input id="setupGa" name="setupGa" value="UA-XXXXX-X"/><br><span>Change UA-XXXXX-X to be your site's ID</span></label>
				</fieldset>
				<hr>
				<a href="#" id="saveSetup" name="saveSetup" class="myButton">Save</a>
				<hr>
			</form>
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
        </div>
    </div>

</div>
<div class="grid_12">
    <h2>SPL collection</h2>
    <code>
        <pre>
            <?php
                $factory = new FactoryCategories( $sql );
                $a= $factory->getCategorieById( '2' );
                //var_dump($a);
            ?>
        </pre>
    </code>
    <hr>
    <code>
        <pre>
            <?php
                //var_dump($factory);
            ?>
        </pre>
    </code>
    <a id="categories-weigth-save" href="#">Save</a>
</div>
<!-- About -->