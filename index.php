<?php

    include 'init.php';
    
    // REDIRECT TO LOGIN PAGE IF NOT SIGNED IN    
    $answer = User::action()->is_logged_in();
    var_dump($answer);
    // echo "<pre>";
    print_r($_SESSION['USER']);

    
    if(!$answer){
        header("Location: login.php");
    }

    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['delete'])){
            Movie::action()->delete_by_id($_POST['delete']);
        }
    }


?>

<?php

    include "header.php";

?>

<?php

    include "footer.php";

?>