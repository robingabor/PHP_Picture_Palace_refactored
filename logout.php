<?php

include 'init.php';

$ses = new Session();


if( $ses->exists('USER') ){    
    $ses->remove('USER');
}

// ez mindent kipucul
// session_destroy();

header("Location: login.php");
// some hacker can add a protocoll wich prohibits  the redirection, in that case it is good practice to use "die" after header
die;



?>