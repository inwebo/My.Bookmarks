<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$from = fopen('http://aurea.es/favicon.ico','rb');
//localhost/my.bookmarks/helpers/getfavico.php
$data='';
while(!feof($from))
    $data.=fread($from,1024);
fclose($from );
var_dump($data);
chdir('..');
$to = fopen('images/test.ico','w+');
fwrite($to, $data);

?>
