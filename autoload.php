<?php
function __autoload($class_name) {
    include_once 'lib/'.strtolower($class_name).'/class.'.strtolower($class_name) . '.php';
}
?>
