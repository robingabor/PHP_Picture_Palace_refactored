<?php

include "init.php";

if(count($_POST) > 0){
    // a post was made
    print_r($_POST);
    // if we get errors this going to return the errors array otherwise it will return true
    $errors = User::action()->login($_POST);
    print_r($errors);
    // if the registration was succesful lets head to the login page
    if(!is_array($errors)){
        var_dump($errors);

        header("Location: index.php");
        // some hacker can add a protocoll wich prohibits  hte redirection, in that case it is good practice to using "die" after header
        die;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="wrapper">

        <div class="center">
            <h3>New member? Let's signup!</h3>
            <p><a href="signup.php" class="">Register</a></p>
        </div>

        <form method="POST" id="login-form">
            <h2>Login</h2>
            <!-- Display errors if it is any -->
            <div class="errors">
                <?php
                    if(isset($errors) && is_array($errors) ){
                        foreach ($errors as  $error) {
                            # code...
                            echo $error;
                            echo "<br>";
                        }
                    }
                ?>
            </div>
            
            <div class="form-control ">
                <input type="text" name="email" placeholder="email"  id="email" value="<?= $_POST['email'] ?? '' ?>">
                <small>Error Message</small>
            </div>            
            <div class="form-control">
                <input type="password" name="password" placeholder="password"  id="password" class="input" value="<?= $_POST['password'] ?? '' ?>" > 
                <small>Error Message</small>
            </div>
            <input type="submit" value="Login" >
            <!-- <br style="clear:both"> -->
        </form>   

    </div>   

</body>
</html>

