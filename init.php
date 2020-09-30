
<?php

ini_set('display_errors', '1');
ini_set('html_errors', '1');

function my_autoloader($classe) {
  include 'DAO/' . $classe . '.php';
}

spl_autoload_register('my_autoloader');


header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");


 define('DB_USER','root');
 define('DB_PASSWORD','');
 define('DB_HOST','localhost');
 define('DB_NAME', 'fredi');

 ?>