<?
define (DB_DRIVER,  "mysql");
define (DB_CHARSET, "UTF8");
define (DB_HOST,    "127.0.0.1");
define (DB_USER,    "root");
define (DB_PASS,    "");
define (DB_NAME,    "Service");      

 $db = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
 
 ?>
