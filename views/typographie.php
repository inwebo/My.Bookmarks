<?php
extract($GLOBALS);
?>
<!-- Typographie -->
	<div class="grid_12 grid_front">
		<!-- /Liste categorie -->

		<h2>
			Incoming
			<div class="categorie-menu">
				<a href="#" title="Vue compléte" class="categorie-menu-display-full"><span class="iconic list"></span></a>
				<a href="#" title="Vue compacte" class="categorie-menu-display-compact"><span class="iconic list_nested"></span></a>
			</div>
		</h2>
		<ul class="bookmarks-list bookmarks-simple">

			<!-- One bookmark -->
			<li class="oneBookmark" data-hash="qsqsdqqssdq" data-id="1" data-dt="" data-tags="tags1" data-category="2" data-visibility="1">
				<span class="oneBookmark-menu oneBookmark-menu-left bookmark-draggable">
					<a href="#" class="bookmark-icon"><span class="iconic move iconSize"></span></a>
				</span>
				<h3><img src="../images/system/favicon-default.png" title="favicon"><span class="data-title">Titre</span></h3>
				<p class="data-desc">Description du lien</p>
				<ul class="meta">
					<li title="tags1 tags2 tags3"><span class="iconic tag_fill"></span></li>
					<li>
						<a href="" class="tags">tags 1</a>
					</li>
					<li>
						<a href="" class="tags">tags 1</a>
					</li>
				</ul>
				<span class="oneBookmark-menu oneBookmark-menu-right">
					<a href="#" title="Edit" class="bookmark-icon bookmark-edit"><span class="iconic pen iconSize"></span></a>
					<a href="#" title="Delete" class="bookmark-icon bookmark-delete"><span class="iconic x_alt iconSize"></span></a>
				</span>
			</li>
			<!-- /One bookmark -->
			
		</ul>
	</div>
<div class="grid_12">
	<h2>H2</h2>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
	<h3>H3</h3>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
	<h4>H4</h4>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
	<hr>
	<ol>
		<li>
			Liste ordonnée
		</li>
		<li>
			Liste ordonnée
		</li>
		<li>
			Liste ordonnée
		</li>
		<li>
			Liste ordonnée
		</li>
	</ol>
	<hr>
	<ul>
		<li>
			Liste non ordonnée
		</li>
		<li>
			Liste non ordonnée
		</li>
		<li>
			Liste non ordonnée
		</li>
		<li>
			Liste non ordonnée
		</li>
	</ul>
	<hr>
	<blockquote>
		Ceci est une citation
	</blockquote>
	<hr>
	<pre>
       	<code>
       		Ceci est mon code
       	</code>
       </pre>
	<hr>
	<a onclick="return false;" class="button" name="configSave" id="configSave" href="#">Save</a>
	<a onclick="return false;" class="button" name="configSave" id="configSave" href="#">Next</a>
	<a onclick="return false;" class="button darkGreen lightGreenBackground" name="configSave" id="configSave" href="#"><span class="iconic check iconsize"></span>&nbsp;Valid</a>
	<a onclick="return false;" class="button iconSize lightRed" name="configSave" id="configSave" href="#"><span class="iconic x"></span></a>
</div>
<div class="grid_12">
	<h2>Administration</h2>
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
				<span class="iconic left_quote_alt iconic-large"></span>Constantes
			</li>
		</ul>

		<div class="tabs-content">
			<div style="display: block;">

				<form enctype="application/x-www-form-urlencoded" method="post" name="setupForm" id="setupForm">
					<h3>Site configuration</h3>

					<fieldset>
						<legend>
							Général
						</legend>
						<input type="hidden" value="http://localhost/my.bookmarks/index.php" name="setupRoot" id="setupRoot">
						<label class="inputGrid_1 inputGrid_1-first">Name :
							<input value="My.Bookmarks" name="setupSiteName" id="setupSiteName">
							<br>
							<span>Titre du site est contenu dans la balise H1.</span></label>
						<br>
						<label class="inputGrid_1">Tagline :
							<input value="Self hosted bookmarks" name="setupTagLine" id="setupTagLine">
							<br>
							<span>Slogan du site est contenu dans la balise H1.</span></label>
						<br>
						<label class="inputGrid_1">Google anlytics ? :
							<input value="" name="setupGa" id="setupGa">
							<br>
							<span>Change UA-XXXXX-X to be your site's ID</span></label>
						<label class="inputGrid_1 inputGrid_1-first">Debug activé ? :
							<select name="setupDebug" id="setupDebug">
								<option value="0">non</option><option selected="" value="1">oui</option>
							</select>
							<br>
						</label>
						<br>
						<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil :
							<select name="setupTotalUrls" id="setupTotalUrls">
								<option selected="" value="10">10</option><option value="20">20</option>
							</select></label>
						<br>
						<label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? :
							<select name="setupFavicon" id="setupFavicon">
								<option value="0">non</option><option selected="" value="1">oui</option>
							</select></label>
						<br>
						<label class="inputGrid_1">Liens public par défaut ? :
							<select name="setupPublic" id="setupPublic">
								<option value="0">non</option><option selected="" value="1">oui</option>
							</select></label>
						<br>
					</fieldset>
					<hr>

					<h3>Database</h3>

					inwebo
					<fieldset id="containerDatabase">
						<legend>
							Base de donnée
						</legend>
						<label class="inputGrid_1 inputGrid_1-first">Server :
							<input value="localhost" name="setupDbServer" id="setupDbServer">
							<br>
							<span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
						<label class="inputGrid_1 inputGrid_1">Database :
							<input value="t" name="setupDatabase" id="setupDbDatabase">
							<br>
							<span>Base de donnée.</span></label>
						<label class="inputGrid_1 inputGrid_1-first">User :
							<input value="inwebo" name="setupDbUser" id="setupDbUser">
							<br>
							<span>Nom de l'utilisateur.</span></label>
						<label class="inputGrid_1 inputGrid_1">Password :
							<input value="inwebo" name="setupDbPassword" id="setupDbPassword">
							<br>
							<span>Mot de passe.</span></label>
						<label class="inputGrid_1 inputGrid_1">Table prefixe :
							<input value="uumy_tables_" name="setupDbPrefix" id="setupDbPrefix">
							<br>
							<span>Prefix d'organisation des tables.</span></label>
						<a class="myButton" onclick="return false;" href="#" id="databaseTest">Test de connexion</a>
					</fieldset>
					<hr>

					<a onclick="return false;" class="myButton" name="configSave" id="configSave" href="#">Save</a>
					<hr>
				</form>

			</div>
			<div style="display: none;">
				<h3>Categories weight</h3>
				<ul id="sortable" class="ui-sortable">
					<li data-weight="1">
						Incoming
					</li>
				</ul>
				<a href="#" id="categories-weigth-save">Save</a>
			</div>
			<div style="display: none;">
				<h3>Corbeille</h3>
				SUPPORT CONTENT
			</div>
			<div style="display: none;">
				<h3>Journaux</h3>
				SUPPORT CONTENT
			</div>
			<div style="display: none;">
				<h3>Constantes</h3>
				<code>
					<strong>PATH_INI</strong> : config/config.ini
					<br>
					<strong>APP_SETUP</strong> :
					<br>
					<strong>PATH_INI_BAK</strong> : config/config.ini.bak
					<br>
					<strong>APP_DEBUG</strong> : 1
					<br>
					<strong>DB_SERVER</strong> : localhost
					<br>
					<strong>DB_DATABASE</strong> : t
					<br>
					<strong>DB_TABLE_PREFIX</strong> : uumy_tables_
					<br>
					<strong>DB_USER</strong> : inwebo
					<br>
					<strong>DB_PASSWORD</strong> : zdSumJig
					<br>
					<strong>PATH_ROOT</strong> : http://localhost/my.bookmarks/
					<br>
					<strong>PATH_INDEX</strong> : http://localhost/my.bookmarks/index.php/
					<br>
					<strong>PATH_CSS</strong> : http://localhost/my.bookmarks/css/
					<br>
					<strong>PATH_JS</strong> : http://localhost/my.bookmarks/js/
					<br>
					<strong>PATH_AJAX</strong> : http://localhost/my.bookmarks/js/ajax/
					<br>
					<strong>PATH_BOOKMARK_FORM</strong> : http://localhost/my.bookmarks/js/ajax/bookmark-form.php
					<br>
					<strong>PATH_IMG</strong> : http://localhost/my.bookmarks/images/
					<br>
					<strong>PATH_HELPERS</strong> : helpers/
					<br>
					<strong>GA_PATH_TRACKER</strong> : http://localhost/my.bookmarks/helpers/google-analytics.php
					<br>
					<strong>GA_ID</strong> :
					<br>
					<strong>PATH_JS_CONST</strong> : http://localhost/my.bookmarks/js/js.const.define.php
					<br>
					<strong>PATH_VIEWS</strong> : views/
					<br>
					<strong>PUBLIC_KEY</strong> : 673f2f24ee1da9972a298704bba60cf6
					<br>
					<strong>PATH_WIDGET</strong> : helpers/widget.php
					<br>
					<strong>PATH_TEMPLATE</strong> : views/tpl/
					<br>
					<strong>PATH_LOGS</strong> : logs/
					<br>
					<strong>APP_NAME</strong> : My.Bookmarks
					<br>
					<strong>APP_FRONT_URLS</strong> : 10
					<br>
					<strong>PATH_LIB</strong> : lib/
					<br>
				</code>
			</div>
		</div>
	</div>

</div>

<div class="grid_12">
	<div id="tabs">
		<ul>
			<li class="active">
				<a href="#tab-1">Requirements</a>
			</li>
			<li>
				<a href="#tab-2">Site configuration</a>
			</li>
			<li>
				<a href="#tab-3">Database</a>
			</li>
			<li>
				<a href="#tab-4">Users</a>
			</li>
			<li>
				<a href="#tab-5">Well done</a>
			</li>
		</ul>
		<form enctype="application/x-www-form-urlencoded" method="post" name="setupForm" id="setupForm">
			<div id="tab-1" style="display: block;">
				<h3>Requirements</h3>
				<ul>
					<li>
						PDO
					</li>
					<li>
						RecursiveFiles
					</li>
					<li>
						PHP 5.2
					</li>
				</ul>
			</div>
			<div id="tab-2" style="display: none;">
				<h3>Site configuration</h3>

				<fieldset>
					<legend>
						Général
					</legend>
					<input type="hidden" value="http://localhost/my.bookmarks" name="setupRoot" id="setupRoot">
					<label class="inputGrid_1 inputGrid_1-first">Name :
						<input value="My.Bookmarks" name="setupSiteName" id="setupSiteName">
						<br>
						<span>Titre du site est contenu dans la balise H1.</span></label>
					<br>
					<label class="inputGrid_1">Tagline :
						<input value="Self hosted bookmarks" name="setupTagLine" id="setupTagLine">
						<br>
						<span>Slogan du site est contenu dans la balise H1.</span></label>
					<br>
					<label class="inputGrid_1">Google anlytics ? :
						<input value="" name="setupGa" id="setupGa">
						<br>
						<span>Change UA-XXXXX-X to be your site's ID</span></label>
					<label class="inputGrid_1 inputGrid_1-first">Debug activé ? :
						<select name="setupDebug" id="setupDebug">
							<option value="0">non</option><option selected="" value="1">oui</option>
						</select>
						<br>
					</label>
					<br>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil :
						<select name="setupTotalUrls" id="setupTotalUrls">
							<option selected="" value="10">10</option><option value="20">20</option>
						</select></label>
					<br>
					<label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? :
						<select name="setupFavicon" id="setupFavicon">
							<option selected="" value="0">non</option><option value="1">oui</option>
						</select></label>
					<br>
					<label class="inputGrid_1">Liens public par défaut ? :
						<select name="setupPublic" id="setupPublic">
							<option value="0">non</option><option selected="" value="1">oui</option>
						</select></label>
					<br>
				</fieldset>
				<hr>

			</div>
			<div id="tab-3" style="display: none;">
				<h3>Database</h3>

				<fieldset id="containerDatabase">
					<legend>
						Base de donnée
					</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server :
						<input value="" name="setupDbServer" id="setupDbServer">
						<br>
						<span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
					<label class="inputGrid_1 inputGrid_1">Database :
						<input value="" name="setupDatabase" id="setupDbDatabase">
						<br>
						<span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User :
						<input value="" name="setupDbUser" id="setupDbUser">
						<br>
						<span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password :
						<input value="" name="setupDbPassword" id="setupDbPassword">
						<br>
						<span>Mot de passe.</span></label>
					<label class="inputGrid_1 inputGrid_1">Table prefixe :
						<input value="my_tables_" name="setupDbPrefix" id="setupDbPrefix">
						<br>
						<span>Prefix d'organisation des tables.</span></label>
					<a class="myButton" onclick="return false;" href="#" id="databaseTest">Test de connexion</a>
				</fieldset>
				<hr>

			</div>
			<div id="tab-4" style="display: none;">
				<h3>User</h3>

				<fieldset id="containerUser">
					<legend>
						User
					</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name :
						<input value="inwebo" name="setupUserName" id="setupUserName">
						<br>
						<span>Votre nom d'utilisateur.</span></label>
					<label class="inputGrid_1">Password :
						<input name="setupUserPassword" id="setupUserPassword">
						<br>
						<span>Mot de passe.</span></label>
				</fieldset>
				<hr>

			</div>
			<div id="tab-5" style="display: none;">
				<h3>Well done</h3>
				<p>
					installed !
				</p>
			</div>
			<hr>
			<a onclick="return false;" class="myButton" name="configSave" id="setupSave" href="#">Save</a>

		</form>
	</div>
</div>
<!-- Typographie -->

<div class="container_12">
	<!-- Include -->
	<div class="clear"></div>

	<!-- categorie.php -->

	<div id="categories-landing">
		<h2>Drop bookmarks into categorie</h2>
		<ul>
			<li data-id="1" class="categorie-droppable">Categorie 1</li>
		</ul>
	</div>


	<!-- /categorie.php -->
	<!-- Include -->

	<div class="clear"></div>

</div>

<div class="grid_12">

	<h2>Tags
		<label id="tagsFilterContainer">
			<span class="iconic magnifying_glass"></span>
		<input value="" id="tagsFilter">
	</label></h2>

	<p>
		<a data-tags="cv" class="tags" href="http://localhost/my.bookmarks/index.php/tags/cv">cv<span>(1)</span></a><a data-tags="network" class="tags" href="http://localhost/my.bookmarks/index.php/tags/network">network<span>(1)</span></a><a data-tags="socialcoding" class="tags" href="http://localhost/my.bookmarks/index.php/tags/socialcoding">socialcoding<span>(1)</span></a><a data-tags="helloworld" class="tags" href="http://localhost/my.bookmarks/index.php/tags/helloworld">helloworld<span>(1)</span></a>
	</p>

</div>
<link rel="stylesheet" href="<?php echo PATH_CSS; ?>style-public.css">
<script src="http://localhost/My.Bookmarks/js/js.const.define.php" type="text/javascript"></script>
<script src="http://localhost/My.Bookmarks/js/plugin.bookmarks.js" type="text/javascript"></script>
<script src="http://localhost/My.Bookmarks/js/admin-bookmarks.js" type="text/javascript"></script>
<script src="http://localhost/My.Bookmarks/js/admin-init.js" type="text/javascript"></script>
<script src="http://localhost/My.Bookmarks/js/configuration.js" type="text/javascript"></script>