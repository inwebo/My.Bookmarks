<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
?>

<?php
$conf_default = Config::get('config/config.ini.bak');
if(!isset($conf)) {
    $conf = array(
        'path_root'=> $_root
    );
}
$current = array_merge($conf_default, $conf);
?>
				<fieldset>
					<legend>Général</legend>
                                        <input type="hidden" id="setupRoot" name="setupRoot" value="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']); ?>"/>
					<label class="inputGrid_1 inputGrid_1-first">Name : <input id="setupSiteName" name="setupSiteName" value="<?php echo $current['app_name']; ?>"/><br><span>Titre du site est contenu dans la balise H1.</span></label><br>
					<label class="inputGrid_1">Tagline : <input id="setupTagLine" name="setupTagLine" value="<?php echo $current['app_tagline']; ?>"/><br><span>Slogan du site est contenu dans la balise H1.</span></label><br>
                                        <label class="inputGrid_1">Google anlytics ? : <input id="setupGa" name="setupGa" value="<?php echo $current['ga_id']; ?>"/><br><span>Change UA-XXXXX-X to be your site's ID</span></label>
                                        <label class="inputGrid_1 inputGrid_1-first">Debug activé ? : <select id="setupDebug" name="setupDebug"><option value="0" <?php if($current['app_debug']== '0'){ echo 'selected';} ?>>non</option><option value="1" <?php if($current['app_debug']== '1'){ echo 'selected';} ?>>oui</option></select><br></label><br>
					<label class="inputGrid_1">Nombre de lien par catégorie sur la page d'accueil : <select id="setupTotalUrls" name="setupTotalUrls"><option value="10" <?php if($current['app_front_urls']== '10'){ echo 'selected';} ?>>10</option><option value="20" <?php if($current['app_front_urls']== '20'){ echo 'selected';} ?>>20</option></select></label><br>
                                        <label class="inputGrid_1 inputGrid_1-first">Sauvegarde des favicons ? : <select id="setupFavicon" name="setupFavicon"><option value="0" <?php if($current['app_save_favicon']== '0'){ echo 'selected';} ?>>non</option><option value="1"<?php if($current['app_save_favicon']== '1'){ echo 'selected';} ?>>oui</option></select></label><br>
                                        <label class="inputGrid_1">Liens public par défaut ? : <select id="setupPublic" name="setupPublic"><option value="0" <?php if($current['app_bookmarks_public']== '0'){ echo 'selected';} ?>>non</option><option value="1" <?php if($current['app_bookmarks_public']== '1'){ echo 'selected';} ?>>oui</option></select></label><br>
				</fieldset>
