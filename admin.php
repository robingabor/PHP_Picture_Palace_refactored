<?php

include 'init.php';
    
    // REDIRECT TO LOGIN PAGE IF NOT SIGNED IN    
    $answer = User::action()->is_logged_in();
    // var_dump($answer);
    // echo "<pre>";
    // print_r($_SESSION['USER']);

    
    if(!$answer){
        header("Location: login.php");
    }


?>

<!DOCTYPE html>
<html>
  <head>
    <title>ADMIN PANEL</title>
    <meta name="robots" content="noindex, nofollow">
    <link href="public/admin.css" rel="stylesheet">
    <script src="public/admin.js"></script>
  </head>
  <body>
    <!-- (B) NOW LOADING SPINNER -->
    <div id="page-loader" class="">
      <img id="page-loader-spin" src="public/cube-loader.svg">
    </div>

    <?php if ($answer) { ?>
    <!-- (C) SIDE BAR -->
    <nav id="page-sidebar">
      <a href="#">
        <span class="ico">&#9880;</span> Add Modules Here
      </a>
    </nav>
    <?php } ?>

    <!-- (D) MAIN CONTENTS -->
    <div id="page-main">
      <?php if ($answer) { ?>
      <!-- (D1) NAVIGATION BAR -->
      <nav id="page-nav">
          <!--  hamburger menu : &#9776;-->
        <div id="page-button-side" onclick="adm.side();">&#9776;</div>
         <!--  X sign : &#9747;-->
        <div id="page-button-out" onclick="adm.bye();">&#9747;</div>
      </nav>
      <?php } ?>

      <!-- (D2) PAGE CONTENTS -->
      <main id="page-contents">


      </main>
    </div>
  </body>
</html>