<?php

include "init.php";

if(count($_POST) > 0){
    // a post was made
    print_r($_POST);
    // if we get errors this going to return the errors array otherwise it will return true
    $errors = User::action()->create($_POST);
    print_r($errors);
    
    // if the registration was succesful lets head to the login page
    if(!is_array($errors)){
        var_dump($errors);

        header("Location: login.php");
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
            <h3>Already have an account?</h3>
            <p><a href="login.php" class="">Login</a></p>
        </div>

        <!-- Sign up form -->
        <form method="POST" id="signup-form">
            <h2>Register With Us</h2>
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
                <input type="text" name="username" placeholder="username" id="username" value="<?php echo $_POST['username'] ?? '' ?>" >
                <small>Error Message</small>
            </div>
            <div class="form-control ">
                <input type="text" name="email" placeholder="email"  id="email" value="<?= $_POST['email'] ?? '' ?>">
                <small>Error Message</small>
            </div>
            <div class="form-control ">
                <input type="text" name="mobile" placeholder="mobile number"  id="mobile" value="<?= $_POST['mobile'] ?? '' ?>">
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <input type="password" name="password" placeholder="password"  id="password" class="input" value="<?= $_POST['password'] ?? '' ?>" > 
                <small>Error Message</small>
            </div>
            <div class="form-control">
                <input type="password" name="conf_psw" placeholder="Enter password again"  id="conf_psw" class="input" value="<?= $_POST['conf_psw'] ?? '' ?>" > 
                <small>Error Message</small>
            </div> 
                        
            <input type="submit" value="Submit" >
            
        </form>
        <!-- !Sign up form -->    
    </div>    

    <script src="signup.js"></script>
</body>

</html>

