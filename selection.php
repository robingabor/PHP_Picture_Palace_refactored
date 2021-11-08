<?php
    include 'init.php';
    
    
    $answer = User::action()->is_logged_in();
    var_dump($answer);
    echo "<pre>";
    print_r($_SESSION);

    // if we are not logged in lets redirect the user the the login page
    if(!$answer){
        header("Location: login.php");
    }


?>

<?php

    include "header.php";

?>

<?php

    include "footer.php";

?>