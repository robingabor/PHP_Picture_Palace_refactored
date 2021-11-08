<?php


/*
* PHP 5.1.2 introduced the spl_autoload_register() function that automatically loads 
* a class file whenever you use a class that has not been loaded yet.
*/

spl_autoload_register(function($class_name){

    $path_to_file = "classes/". strtolower($class_name) . ".class.php";

    if(file_exists($path_to_file)){
        require $path_to_file;
    }
    

});

// Current URL
function current_url($arr){
    
    $current_url =  $_SERVER['PHP_SELF'];

        foreach($arr as $key=>$value){
            
            if(strpos($current_url,$key)){
                echo $value;
            }
        }
}


/*
* DB Details 
* constans like global varible they are available everywhere and they wont change throughout the website
*/

define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("DBNAME","php_picture_palace");
define("DBPORT",3307);


?>