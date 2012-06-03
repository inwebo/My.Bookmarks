<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
?>

<?php
$conf_default = Config::get('config/config.ini.bak');
if (!isset($conf)) {
	$conf = array('path_root' => $_root);
}
$current = array_merge($conf_default, $conf);
?>
<fieldset id="containerUser">
	<label class="inputGrid_1 inputGrid_1-first">Name :
		<input id="setupUserName" name="setupUserName" value="inwebo"/>
		<br>
		<span>Votre nom d'utilisateur.</span></label>
	<label class="inputGrid_1">Password :
		<input id="setupUserPassword" name="setupUserPassword" />
		<br>
		<span>Mot de passe.</span></label>
</fieldset>