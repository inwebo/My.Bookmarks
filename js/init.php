<?php
header('Content-type: application/javascript');
chdir('../');
include('autoload.php');
include('helpers/const.define.php');

$output = 'hostRoot="'.$conf['root'].$conf['ajax'].'";' ."\n";
$output .= 'hostJS="'.ROOT_JS.'";' ."\n";
$output .= 'publicKey="'.$conf['publicKey'].'";' ."\n";
$output .= 'debug='.$conf['debug'].';' ."\n";

echo $output;
