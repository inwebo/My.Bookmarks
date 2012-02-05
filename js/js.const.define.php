<?php
header('Content-type: application/javascript');
chdir('../');
include('autoload.php');
include('helpers/const.define.php');

$output  = 'JS_PATH_AJAX="'  . PATH_AJAX   . '";' ."\n";
$output .= 'JS_PATH_INDEX="' . PATH_INDEX  . '";' ."\n";
$output .= 'JS_PATH_JS="'    . PATH_JS     . '";' ."\n";
$output .= 'JS_PUBLIC_KEY="' . PUBLIC_KEY  . '";' ."\n";
$output .= 'JS_DEBUG='       . DEBUG       . ';'  ."\n";

echo $output;
