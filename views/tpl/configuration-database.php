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
$enigma = new MyCrypt( md5( $current['db_user'] ) );
$current['db_password'] = $enigma->decode($current['db_password']);
echo $current['db_password'];
?>
				<fieldset id="containerDatabase">
					<legend>Base de donnée</legend>
					<label class="inputGrid_1 inputGrid_1-first">Server : <input id="setupDbServer" name="setupDbServer" value="<?php echo $current['db_server']; ?>"/><br><span>Adresse du serveur sql ex : <em>sql.free.fr</em>.</span></label>
                                        <label class="inputGrid_1 inputGrid_1">Database : <input id="setupDbDatabase" name="setupDatabase" value="<?php echo $current['db_database']; ?>" /><br><span>Base de donnée.</span></label>
					<label class="inputGrid_1 inputGrid_1-first">User : <input id="setupDbUser" name="setupDbUser" value="<?php echo $current['db_user']; ?>"/><br><span>Nom de l'utilisateur.</span></label>
					<label class="inputGrid_1 inputGrid_1">Password : <input id="setupDbPassword" name="setupDbPassword" value="<?php echo $current['db_password']; ?>"/><br><span>Mot de passe.</span></label>
					<label class="inputGrid_1 inputGrid_1">Table prefixe : <input id="setupDbPrefix" name="setupDbPrefix" value="<?php echo $current['db_table_prefix']; ?>"/><br><span>Prefix d'organisation des tables.</span></label>
                                        <a id="databaseTest" href="#" onclick="return false;" class="myButton">Test de connexion</a>
				</fieldset>
				<hr>
				
