<?php
//  PHP Error Reporting : 
//  Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE); 


// DB Setting
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","php_picture_palace");
define("DBPORT",3307);

// Define File paths
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);

?>
