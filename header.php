<?php
    // array for our pages
    $arr = array(
        "index.php" => "Home",
        "selection.php"  => "All Movie",
        "logout.php" => "Logout",
        "login.php" => "Login"
    );
    // array for using the right script
    $scriptsArr = array(
        "index.php" => "script.js",
        "selection.php"  => "selection.js",
        "logout.php" => "logout.js",
        "login.php" => "login.js",
        "signup.php" => "signup.js"
    );
        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            current_url($arr);                 
        ?>  
    </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- main Content -->
    <main>
        <center>
            <?php
                current_url($arr);                 
            ?>
        </center>

        <!-- Navbar -->
        <nav class="nav" >
            <div class="logo">
                <!-- image for an avatar -->
                <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="user">
            </div>
            <!-- menu -->
            <ul>
                <?php
                    foreach($arr as $key=>$value){            
                    
                        echo "<li><a href='$key'>$value</a></li>";

                    }
                ?>    
            </ul>

        </nav>        
        <!-- ! Navbar -->

        <!-- Header -->
        <header>
            <button id="toggle" class="toggle">
                <i class="fas fa-bars fa-2x" ></i>
            </button>
            <h1>
                My Landing Page
            </h1>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, quis.</p>

            <!-- button to shop our signup modal -->
            <button class="cta-btn" id="open">Sign up / Login</button>
        </header>    
        <!-- !Header -->

        <div class="container">

            <h2>What is this landing page about</h2>

            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nisi, velit. Consectetur, eum aliquam ipsam in maiores expedita fugiat aut aliquid deleniti quis autem tempore iure. Earum vitae voluptatem delectus libero!</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi voluptatem, omnis maxime consequatur molestias quisquam exercitationem earum quasi. Recusandae, sapiente?</p>

            <h2>Tell Me More</h2>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet sapiente quidem ratione maiores? Maxime totam consectetur optio, cum quisquam ex tempora minus obcaecati praesentium pariatur sit quae non perferendis necessitatibus consequuntur doloremque mollitia quas a et quos, labore autem? Corrupti.</p>

            <h2>Benefits</h2>

            <ul>
                <li>Lifetime Access</li>
                <li>30 Day Money Back</li>
                <li>Tailored Customer Support</li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur placeat officiis reprehenderit praesentium quis sit officia harum. Omnis tempore neque soluta. Totam minus velit aut amet, blanditiis, officiis rerum deserunt, ducimus minima nam autem inventore ipsam modi accusantium quasi magni aliquam recusandae maxime qui dolores accusamus. Distinctio, maxime! Ad quae qui officia quaerat quam expedita tempore laboriosam nulla totam, similique at harum voluptatibus omnis earum corporis nihil dignissimos unde vel?</p>
        
        </div>

        <!-- Modal  -->
        <!-- our modal container going to be basically a faded out background wich covers the entire page -->
        <div class="modal-container" id="modal-container">
            <div class="modal" id="modal">
                <button class="close-btn" id="close">
                    <i class="fas fa-times fa-2x"></i>
                </button>
                <div class="modal-header">
                    <form action="" method="GET">
                        <div>
                            <input type="submit" name="signup" value="Sign Up">
                        </div>
                        <div>
                            <input type="submit" name="login" value="Login">
                        </div>
                    </form>                    
                    
                </div>
                <div class="modal-content">

                    <p>Register with us to get offers, support and more</p>

                    <form action="" class="modal-form" method="">
                        <div>
                            <label for="username">User Name</label>
                            <input type="text" id="username" class="form-input" placeholder="Enter username">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-input" placeholder="Enter Email">
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-input" placeholder="Enter password">
                        </div>
                        <div>
                            <label for="conf_password">Confirm Password</label>
                            <input type="password" id="conf_password" class="form-input" placeholder="Confirm Password">
                        </div>
                        <input type="submit" value="Submit" class="submit-btn">
                    </form>

                </div>
            </div>
        </div>
        <!-- !Modal  -->
    

    


    