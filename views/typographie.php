<?php
    extract( $GLOBALS );
?>
<!-- Typographie -->
<div class="grid_12">
    <div id="bookmarkContainer"><h1>Add this <span><a onclick="var mynode = document.getElementById('bookmarkContainer');var parent = mynode.parentNode;parent.removeChild(mynode);return false;" title="close me" href="#">close</a></span></h1><form action="http://bookmarks.inwebo.net/js/ajax/" enctype="application/x-www-form-urlencoded" method="post" name="bookmarkForm" id="bookmarkForm"><label id="labelCategories">Categories : <br><select name="selectCategories" id="selectCategories"><option value="1">Incoming</option><option value="2">Webdesign</option><option value="3">Css</option><option value="4">Php</option><option value="7">Cheats sheet</option><option value="8">Freebies</option><option value="9">Photoshop</option><option value="10">OS</option><option value="11">My.Networks</option><option value="12">Jquery</option><option value="17">Procrastination</option><option value="14">News</option><option value="16">Misc</option><option value="18">Web showcase</option><option value="20">HTML</option><option value="21">Gfx news</option><option value="22">Javascript</option><option value="23">Security</option><option value="24">Drupal</option></select></label><label id="labelUrl">URL : <br><input type="text" value="https://www.google.fr/" name="url" disabled="disabled" id="url" style="background-image: url(empty);"></label><label id="labelTitle">Title : <br><input type="text" value="Google" name="title" id="title"></label><label id="labelTags">Tags : <br><input type="text" id="tags" name="tags" value="empty"></label><label id="labelDesc">Desc : <br><textarea id="desc" name="desc" rows="5" cols="40"></textarea></label><label id="labelPublic">Public : <input type="checkbox" id="public" name="public"></label><hr><a onclick="saveContent();return false;" class="bookmarker" title="Save it!" href="#" id="save">Save</a><hr><div class="copyright">Powered by <a title="Try me i'm free !" href="#">My.bookmarks<span><span>&nbsp;</span>Don't let your datas in the wild, you can host them with My.bookmarks which is free and open source PHP5 application, try it !</span></a>.</div></form></div>
</div>
<div class="grid_12">
    <h2>H2</h2>
    <h3>H3</h3>
    <h4>H4</h4>
    <hr>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <hr>
    <a href="#" class="myButton">MyButton</a>
    <hr>
    <form>
        <input value="input">
        <textarea>
            Textarea
        </textarea>
    </form>
    <ul>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
        <ol>1</ol>
    </ul>
    <ul>
        <li>1</li>
        <li>1</li>
        <li>1</li>
        <li>1</li>
        <li>1</li>
        <li>1</li>
        <li>1</li>
    </ul>
</div>
<div class="grid_12">
    <h2>Test</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
    <hr>
    <a onclick="return false;" class="button" name="configSave" id="configSave" href="#">Save</a>
</div>
<div class="grid_12">
    <h2>Administration</h2>
    <div id="vtab">
        <ul class="tabs-left">
            <li class="home selected"><span class="iconic wrench iconic-large"></span>Site configuration</li>
            <li class="login"><span class="iconic book iconic-large"></span>Categories</li>
            <li class="support"><span class="iconic trash_fill iconic-large"></span>Corbeille</li>
            <li class="journaux"><span class="iconic book_alt2 iconic-large"></span>Journaux</li>
            <li class="constantes"><span class="iconic left_quote_alt iconic-large"></span>Constantes</li>
        </ul>

        <div class="tabs-content">
            <div style="display: block;">

                <form enctype="application/x-www-form-urlencoded" method="post" name="setupForm" id="setupForm">
                        <h3>Site configuration</h3>

				<fieldset>
					<legend>Général</legend>
                                        <input type="hidden" value="http://localhost/my.bookmarks/index.php" name="setupRoot" id="setupRoot">
					<label class="inputGrid_1 inputGrid_1-first">Name : <input value="My.Bookmarks" name="setupSiteName" id="setupSiteName"><br><span>Titre du site est contenu dans la balise H1.</span></label><br>
					<label class="inputGrid_1">Tagline : <input value="Self hosted bookmarks" name="setupTagLine" id="setupTagLine"><br><span>Slogan du site est contenu dans la balise H1.</span></label><br>
                                        <label class="inputGrid_1">Google anlytics ? : <input value="" name="setupGa" id="setupGa"><br><span>Change UA-XXXXX-X to be your site's ID</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Debug activé ? : <select name="setupDebug" id="setupDebug"><option value="0">non</option><option selected="" value="1">oui</option></select><br></label><br>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil : <select name="setupTotalUrls" id="setupTotalUrls"><option selected="" value="10">10</option><option value="20">20</option></select></label><br>
                                        <label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? : <select name="setupFavicon" id="setupFavicon"><option value="0">non</option><option selected="" value="1">oui</option></select></label><br>
                                        <label class="inputGrid_1">Liens public par défaut ? : <select name="setupPublic" id="setupPublic"><option value="0">non</option><option selected="" value="1">oui</option></select></label><br>
				</fieldset>
				<hr>


                                                 <h3>Database</h3>

inwebo				<fieldset id="containerDatabase">
					<legend>Base de donnée</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input value="localhost" name="setupDbServer" id="setupDbServer"><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
                                        <label class="inputGrid_1 inputGrid_1">Database : <input value="t" name="setupDatabase" id="setupDbDatabase"><br><span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User : <input value="inwebo" name="setupDbUser" id="setupDbUser"><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password : <input value="inwebo" name="setupDbPassword" id="setupDbPassword"><br><span>Mot de passe.</span></label>
					<label class="inputGrid_1 inputGrid_1">Table prefixe : <input value="uumy_tables_" name="setupDbPrefix" id="setupDbPrefix"><br><span>Prefix d'organisation des tables.</span></label>
                                        <a class="myButton" onclick="return false;" href="#" id="databaseTest">Test de connexion</a>
				</fieldset>
				<hr>


				<a onclick="return false;" class="myButton" name="configSave" id="configSave" href="#">Save</a>
				<hr>
			</form>
<script type="text/javascript">
</script>
    <script src="http://localhost/my.bookmarks/js/configuration.js" type="text/javascript"></script>            </div>
            <div style="display: none;">
                <h3>Categories weight</h3>
                <ul id="sortable" class="ui-sortable">
                                            <li data-weight="1">Incoming</li>
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
                    <strong>PATH_INI</strong> : config/config.ini<br><strong>APP_SETUP</strong> : <br><strong>PATH_INI_BAK</strong> : config/config.ini.bak<br><strong>APP_DEBUG</strong> : 1<br><strong>DB_SERVER</strong> : localhost<br><strong>DB_DATABASE</strong> : t<br><strong>DB_TABLE_PREFIX</strong> : uumy_tables_<br><strong>DB_USER</strong> : inwebo<br><strong>DB_PASSWORD</strong> : zdSumJig<br><strong>PATH_ROOT</strong> : http://localhost/my.bookmarks/<br><strong>PATH_INDEX</strong> : http://localhost/my.bookmarks/index.php/<br><strong>PATH_CSS</strong> : http://localhost/my.bookmarks/css/<br><strong>PATH_JS</strong> : http://localhost/my.bookmarks/js/<br><strong>PATH_AJAX</strong> : http://localhost/my.bookmarks/js/ajax/<br><strong>PATH_BOOKMARK_FORM</strong> : http://localhost/my.bookmarks/js/ajax/bookmark-form.php<br><strong>PATH_IMG</strong> : http://localhost/my.bookmarks/images/<br><strong>PATH_HELPERS</strong> : helpers/<br><strong>GA_PATH_TRACKER</strong> : http://localhost/my.bookmarks/helpers/google-analytics.php<br><strong>GA_ID</strong> : <br><strong>PATH_JS_CONST</strong> : http://localhost/my.bookmarks/js/js.const.define.php<br><strong>PATH_VIEWS</strong> : views/<br><strong>PUBLIC_KEY</strong> : 673f2f24ee1da9972a298704bba60cf6<br><strong>PATH_WIDGET</strong> : helpers/widget.php<br><strong>PATH_TEMPLATE</strong> : views/tpl/<br><strong>PATH_LOGS</strong> : logs/<br><strong>APP_NAME</strong> : My.Bookmarks<br><strong>APP_FRONT_URLS</strong> : 10<br><strong>PATH_LIB</strong> : lib/<br>                </code>
            </div>
        </div>
    </div>

</div>

<div class="grid_12">
<div id="tabs">
                   <ul>
                     <li class="active"><a href="#tab-1">Requirements</a></li>
                     <li><a href="#tab-2">Site configuration</a></li>
                     <li><a href="#tab-3">Database</a></li>
                     <li><a href="#tab-4">Users</a></li>
                     <li><a href="#tab-5">Well done</a></li>
                   </ul>
                   <form enctype="application/x-www-form-urlencoded" method="post" name="setupForm" id="setupForm">
                       <div id="tab-1" style="display: block;">
                         <h3>Requirements</h3>
                         <ul>
                             <li>PDO</li>
                             <li>RecursiveFiles</li>
                             <li>PHP 5.2</li>
                         </ul>
                       </div>
                       <div id="tab-2" style="display: none;">
                         <h3>Site configuration</h3>

				<fieldset>
					<legend>Général</legend>
                                        <input type="hidden" value="http://localhost/my.bookmarks" name="setupRoot" id="setupRoot">
					<label class="inputGrid_1 inputGrid_1-first">Name : <input value="My.Bookmarks" name="setupSiteName" id="setupSiteName"><br><span>Titre du site est contenu dans la balise H1.</span></label><br>
					<label class="inputGrid_1">Tagline : <input value="Self hosted bookmarks" name="setupTagLine" id="setupTagLine"><br><span>Slogan du site est contenu dans la balise H1.</span></label><br>
                                        <label class="inputGrid_1">Google anlytics ? : <input value="" name="setupGa" id="setupGa"><br><span>Change UA-XXXXX-X to be your site's ID</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Debug activé ? : <select name="setupDebug" id="setupDebug"><option value="0">non</option><option selected="" value="1">oui</option></select><br></label><br>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil : <select name="setupTotalUrls" id="setupTotalUrls"><option selected="" value="10">10</option><option value="20">20</option></select></label><br>
                                        <label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? : <select name="setupFavicon" id="setupFavicon"><option selected="" value="0">non</option><option value="1">oui</option></select></label><br>
                                        <label class="inputGrid_1">Liens public par défaut ? : <select name="setupPublic" id="setupPublic"><option value="0">non</option><option selected="" value="1">oui</option></select></label><br>
				</fieldset>
				<hr>


                       </div>
                       <div id="tab-3" style="display: none;">
                         <h3>Database</h3>

				<fieldset id="containerDatabase">
					<legend>Base de donnée</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input value="" name="setupDbServer" id="setupDbServer"><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
                                        <label class="inputGrid_1 inputGrid_1">Database : <input value="" name="setupDatabase" id="setupDbDatabase"><br><span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User : <input value="" name="setupDbUser" id="setupDbUser"><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password : <input value="" name="setupDbPassword" id="setupDbPassword"><br><span>Mot de passe.</span></label>
					<label class="inputGrid_1 inputGrid_1">Table prefixe : <input value="my_tables_" name="setupDbPrefix" id="setupDbPrefix"><br><span>Prefix d'organisation des tables.</span></label>
                                        <a class="myButton" onclick="return false;" href="#" id="databaseTest">Test de connexion</a>
				</fieldset>
				<hr>

                       </div>
                       <div id="tab-4" style="display: none;">
                         <h3>User</h3>

				<fieldset id="containerUser">
					<legend>User</legend>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input value="inwebo" name="setupUserName" id="setupUserName"><br><span>Votre nom d'utilisateur.</span></label>
					<label class="inputGrid_1">Password : <input name="setupUserPassword" id="setupUserPassword"><br><span>Mot de passe.</span></label>
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

<div class="grid_12 gridHome">


    <h2>
        <a href="http://localhost/my.bookmarks/index.php/categorie/Incoming/1">Incoming</a>
    </h2>
    <ul class="listUrl">
    <!-- One bookmark -->
<li>
            <a data-tags="On va manger des chips" title="Hello world" href="http://www.youtube.com/watch?v=f7SNMXRZIlM">Hello world</a><!--<span class="gui-item-button close">x</span>-->
    </li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li>
            <a data-tags="Social coding" title="inwebo's Profile - GitHub" href="https://github.com/inwebo">inwebo's Profile - GitHub</a><!--<span class="gui-item-button close">x</span>-->
    </li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li>
            <a data-tags="Julien Hannotin artisan du ouaib" title="Jool : Curriculum vitæ en ligne" href="http://hannotin.julien.is.free.fr/">Jool : Curriculum vitæ en ligne</a><!--<span class="gui-item-button close">x</span>-->
    </li>
<!-- /One bookmark -->
    </ul>
        </div>
<!-- Typographie -->

<div class="container_12">

	<!-- Breadcrumbs -->
	<div class="grid_12" id="breadCrumbs">
	<ul><li><a href="http://localhost/my.bookmarks/index.php">Home</a>&nbsp;</li><li>&nbsp;categorie&nbsp;</li><li>&nbsp;Incoming&nbsp;</li><li class="breadcrumbs-last-item">&nbsp;1</li></ul>	</div>
	<!-- /Breadcrumbs -->

                <!-- Include -->
		<div class="clear"></div>


<!-- categorie.php -->
<!-- Liste categories -->


    <div class="grid_4" id="categoriesList">

        <h2>Categories</h2>

        <!-- Liste categorie -->
        <p data-id="1" id="idCategorie1" class="ui-droppable"><a href="http://localhost/my.bookmarks/index.php/categorie/Incoming/1">Incoming</a></p>
<p data-id="2" id="idCategorie2" class="ui-droppable"><a href="http://localhost/my.bookmarks/index.php/categorie/Poubelle/2">Poubelle</a></p>
        <form id="addNewcat">
            <label>
                New categorie name ?<br>
                <input type="text" name="inputCat" id="inputCat"><br><br>
                <a onclick="return false;" class="myButton" id="addCategory" href="#">Add</a>
                <br>&nbsp;<span id="addResponse"></span>
                <input type="hidden" name="totalCategories" id="totalCategories" value="2">
            </label>
        </form>
        <input type="hidden" name="totalCategories" id="totalCategories" value="2">
    </div>


    <div class="grid_8" id="newItems">
    <!-- /Liste categorie -->



<h2>Incoming<span class="totalLinks">&nbsp;3 ♥&nbsp;</span><a onclick="return false;" class="totalLinks" href="#" id="display-small">Simple</a><a onclick="return false;" class="totalLinks" href="#" id="display-full">Full</a></h2>

<ul class="bookmarks-list">
<!-- One bookmark -->
<li data-title="Hello world" data-hash="bd0f04b8a19e3535d3a4b089e390e75b" data-id="3" class="xfolkentry">
            <div class="bookmarks-container-bouton">
                <span title="Drag me into another categorie" class="dragMeToCat ui-draggable">Drag and drop me</span>
            </div>

            <div class="bookmarks-main">


             <a onclick="return false;" href="#" title="Delete" class="bookmarks-delete">x</a>

             <a href="#" onclick="return false;" title="edit" class="bookmarks-edit">edit</a>

             <a onclick="return false;" href="#" title="Save" class="bookmarks-save">save</a>
        <h3><img src="http://localhost/my.bookmarks/images/favicon/bd0f04b8a19e3535d3a4b089e390e75b">&nbsp;<a href="http://www.youtube.com/watch?v=f7SNMXRZIlM" title="On va manger des chips" class="taggedlink displayTitle">Hello world</a></h3>
        <p>
                        Ajouté le 11-02-2012 à 15:36:12        </p>
        <p class="description">
            On va manger des chips        </p>
        <ul class="meta">
            <li>Tags : </li>
                                <li><a class="tags" href="http://localhost/my.bookmarks/index.php/tags/hello-world">hello-world</a></li><li>
                        </li></ul>
            <form name="bookmarks-edit-3" id="bookmarks-edit-3">
        <input id="bookmarks-item-3" name="bookmarks-item-title-3" value="Hello world"><br>
        <textarea id="bookmarks-description-3" name="bookmarks-item-title-3" value="">On va manger des chips</textarea><br>
        <label><input value="hello-world" name="bookmarks-item-tags-3" id="bookmarks-tags-3">Tags séparés par un espace</label><br>
    </form>
    </div>



<div class="clear"></div>
</li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li data-title="inwebo's Profile - GitHub" data-hash="f82ed97c8bbd79399529ab4b421bc1e4" data-id="2" class="xfolkentry">
            <div class="bookmarks-container-bouton">
                <span title="Drag me into another categorie" class="dragMeToCat ui-draggable">Drag and drop me</span>
            </div>

            <div class="bookmarks-main">


             <a onclick="return false;" href="#" title="Delete" class="bookmarks-delete">x</a>

             <a href="#" onclick="return false;" title="edit" class="bookmarks-edit">edit</a>

             <a onclick="return false;" href="#" title="Save" class="bookmarks-save">save</a>
        <h3><img src="http://localhost/my.bookmarks/images/favicon/f82ed97c8bbd79399529ab4b421bc1e4">&nbsp;<a href="https://github.com/inwebo" title="Social coding" class="taggedlink displayTitle">inwebo's Profile - GitHub</a></h3>
        <p>
                        Ajouté le 11-02-2012 à 15:36:07        </p>
        <p class="description">
            Social coding        </p>
        <ul class="meta">
            <li>Tags : </li>
                                <li><a class="tags" href="http://localhost/my.bookmarks/index.php/tags/network">network</a></li><li>
                                    </li><li><a class="tags" href="http://localhost/my.bookmarks/index.php/tags/social-coding">social-coding</a></li><li>
                        </li></ul>
            <form name="bookmarks-edit-2" id="bookmarks-edit-2">
        <input id="bookmarks-item-2" name="bookmarks-item-title-2" value="inwebo's Profile - GitHub"><br>
        <textarea id="bookmarks-description-2" name="bookmarks-item-title-2" value="">Social coding</textarea><br>
        <label><input value="network social-coding" name="bookmarks-item-tags-2" id="bookmarks-tags-2">Tags séparés par un espace</label><br>
    </form>
    </div>



<div class="clear"></div>
</li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li data-title="Jool : Curriculum vitæ en ligne" data-hash="05465b06396eaa76c3a68979a4f1cb11" data-id="1" class="xfolkentry">
            <div class="bookmarks-container-bouton">
                <span title="Drag me into another categorie" class="dragMeToCat ui-draggable">Drag and drop me</span>
            </div>

            <div class="bookmarks-main">


             <a onclick="return false;" href="#" title="Delete" class="bookmarks-delete">x</a>

             <a href="#" onclick="return false;" title="edit" class="bookmarks-edit">edit</a>

             <a onclick="return false;" href="#" title="Save" class="bookmarks-save">save</a>
        <h3><img src="http://localhost/my.bookmarks/images/favicon/05465b06396eaa76c3a68979a4f1cb11">&nbsp;<a href="http://hannotin.julien.is.free.fr/" title="Julien Hannotin artisan du ouaib" class="taggedlink displayTitle">Jool : Curriculum vitæ en ligne</a></h3>
        <p>
                        Ajouté le 11-02-2012 à 15:35:58        </p>
        <p class="description">
            Julien Hannotin artisan du ouaib        </p>
        <ul class="meta">
            <li>Tags : </li>
                                <li><a class="tags" href="http://localhost/my.bookmarks/index.php/tags/cv">cv</a></li><li>
                        </li></ul>
            <form name="bookmarks-edit-1" id="bookmarks-edit-1">
        <input id="bookmarks-item-1" name="bookmarks-item-title-1" value="Jool : Curriculum vitæ en ligne"><br>
        <textarea id="bookmarks-description-1" name="bookmarks-item-title-1" value="">Julien Hannotin artisan du ouaib</textarea><br>
        <label><input value="cv" name="bookmarks-item-tags-1" id="bookmarks-tags-1">Tags séparés par un espace</label><br>
    </form>
    </div>



<div class="clear"></div>
</li>
<!-- /One bookmark -->
</ul>
</div>
<!-- /categorie.php -->
                <!-- Include -->



        <div class="clear"></div>

	</div>









<div class="grid_12">

    <h2>Tags<span class="totalLinks">4</span><label id="tagsFilterContainer">Tags filter : <input value="" id="tagsFilter"></label></h2>

<p>
<a data-tags="cv" class="tags" href="http://localhost/my.bookmarks/index.php/tags/cv">cv<span>(1)</span></a> <a data-tags="network" class="tags" href="http://localhost/my.bookmarks/index.php/tags/network">network<span>(1)</span></a> <a data-tags="socialcoding" class="tags" href="http://localhost/my.bookmarks/index.php/tags/socialcoding">socialcoding<span>(1)</span></a> <a data-tags="helloworld" class="tags" href="http://localhost/my.bookmarks/index.php/tags/helloworld">helloworld<span>(1)</span></a>
</p>

</div>


<div id="newItems" class="grid_12">
    <!-- /Liste categorie -->



<h2>Incoming<span class="totalLinks">&nbsp;3 ♥&nbsp;</span><a id="display-small" href="#" class="totalLinks" onclick="return false;">Simple</a><a id="display-full" href="#" class="totalLinks" onclick="return false;">Full</a></h2>

<ul class="bookmarks-list">
<!-- One bookmark -->
<li class="xfolkentry">
            <div class="bookmarks-main" style="width:99%;border-left-color: transparent;">

        <h3 class=""><img src="http://localhost/my.bookmarks/images/favicon/bd0f04b8a19e3535d3a4b089e390e75b">&nbsp;<a class="taggedlink displayTitle" title="On va manger des chips" href="http://www.youtube.com/watch?v=f7SNMXRZIlM">Hello world</a></h3>
        <p style="display: block; ">
                        Ajouté le 11-02-2012 à 15:36:12        </p>
        <p class="description" style="display: block; ">
            On va manger des chips        </p>
        <ul class="meta" style="display: block; ">
            <li>Tags : </li>
                                <li><a href="http://localhost/my.bookmarks/index.php/tags/hello-world" class="tags">hello-world</a></li><li>
                        </li></ul>
            </div>


<div class="clear"></div>
</li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li class="xfolkentry">
            <div class="bookmarks-main" style="width:99%;border-left-color: transparent;">

        <h3 class=""><img src="http://localhost/my.bookmarks/images/favicon/f82ed97c8bbd79399529ab4b421bc1e4">&nbsp;<a class="taggedlink displayTitle" title="Social coding" href="https://github.com/inwebo">inwebo's Profile - GitHub</a></h3>
        <p style="display: block; ">
                        Ajouté le 11-02-2012 à 15:36:07        </p>
        <p class="description" style="display: block; ">
            Social coding        </p>
        <ul class="meta" style="display: block; ">
            <li>Tags : </li>
                                <li><a href="http://localhost/my.bookmarks/index.php/tags/network" class="tags">network</a></li><li>
                                    </li><li><a href="http://localhost/my.bookmarks/index.php/tags/social-coding" class="tags">social-coding</a></li><li>
                        </li></ul>
            </div>


<div class="clear"></div>
</li>
<!-- /One bookmark -->
<!-- One bookmark -->
<li class="xfolkentry">
            <div class="bookmarks-main" style="width:99%;border-left-color: transparent;">

        <h3 class=""><img src="http://localhost/my.bookmarks/images/favicon/05465b06396eaa76c3a68979a4f1cb11">&nbsp;<a class="taggedlink displayTitle" title="Julien Hannotin artisan du ouaib" href="http://hannotin.julien.is.free.fr/">Jool : Curriculum vitæ en ligne</a></h3>
        <p style="display: block; ">
                        Ajouté le 11-02-2012 à 15:35:58        </p>
        <p class="description" style="display: block; ">
            Julien Hannotin artisan du ouaib        </p>
        <ul class="meta" style="display: block; ">
            <li>Tags : </li>
                                <li><a href="http://localhost/my.bookmarks/index.php/tags/cv" class="tags">cv</a></li><li>
                        </li></ul>
            </div>


<div class="clear"></div>
</li>
<!-- /One bookmark -->
</ul>
</div>
  <link rel="stylesheet" href="<?php echo PATH_CSS; ?>style-public.css">