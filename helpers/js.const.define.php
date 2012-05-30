<?php
header('Content-type: application/javascript');
chdir('../');
include('autoload.php');
include('helpers/const.define.php');
$constantes = get_defined_constants( true );
$constantes = $constantes['user'];

foreach( $constantes as $key => $value ) {
    $prefix = 'JS_';
    echo $prefix . $key . '="' . $value  . '";' ."\n";
}

$ajax_files = new MyDirectory( 'js/ajax/' );

foreach($ajax_files->ret['Files'] as $key => $value ) {
    $toConst = str_replace('-', '_', $value->nameLessExtension);
    $toConst = strtoupper($toConst);
    echo 'JS_PATH_AJAX_'.$toConst. '="'.PATH_AJAX.$value->name.'";'. "\n";
}
