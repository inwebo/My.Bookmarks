<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
extract($GLOBALS);
?>
<form id="setupForm" name="setupForm" method="post" enctype="application/x-www-form-urlencoded">
<?php
$conf_default = Config::get('config/config.ini.bak');
if(!isset($conf)) {
    $conf = array(
        'path_root'=> $_root
    );
}
$current = array_merge($conf_default, $conf);
?>
                        <h3>Site configuration</h3>
                         <?php
                            include('views/tpl/configuration-site.php');
                         ?>
                                                 <h3>Database</h3>
                         <?php
                            include('views/tpl/configuration-database.php');
                         ?>
                                
				<a href="#" id="<?php if(!isset($conf)) { echo 'setupSave'; } else { echo 'configSave'; } ?>" name="<?php if(!isset($conf)) { echo 'setupSave'; } else { echo 'configSave'; } ?>" class="myButton"  onclick="return false;">Save</a>
				<hr>
			</form>
<script type="text/javascript" >
<?php
        // @todo buffer config

?>
</script>
    <script type="text/javascript" src="<?php echo PATH_JS;?>configuration.js"></script>