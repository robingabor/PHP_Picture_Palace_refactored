<?php 

include 'init.php';

$ses = new Session();
    
// Checking if the user is logged in
$is_logged_in = User::action()->is_logged_in();
var_dump($is_logged_in);
// echo "<pre>";
print_r($_SESSION['USER']);

switch($_POST['req']){
    // INVALID
    default:
        echo "INVALID RQUEST";
        break;

    // LOGIN
    case 'in':
        // ALREADY SIGNED IN
        if($is_logged_in){ die("OK"); }

        // VERIFY - get the user based on their email
        else{
            // Otherwise lets login
            echo User::action()->login($_POST) ? "OK" : "NOT OK";
        }
    break;
    
    // LOGOUT
    case 'out':
        $ses->remove('USER');
        header("Location: login.php");
        // some hacker can add a protocoll wich prohibits  the redirection, in that case it is good practice to use "die" after header
        die;    
    break;

}


?>