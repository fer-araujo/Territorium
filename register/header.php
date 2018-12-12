<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, inicial-scale=1">
  <title>Register form</title>
</head>

<!-- STYLESHEETS -->
<link rel="stylesheet" href="CSS/style.css">
<link rel="stylesheet" href="CSS/bootstrap.css">
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<!-- SCRIPTS -->
<script type="text/javascript" src="JS/bootstrap.js"></script>
<script src="dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="JS/jquery.js"></script>
<!-- BODY -->

<body class="background">

  <!-- HEADER -->
  <header>
    <!-- PHP SECTION TO DETERMINE WHICH PROCESS IS GOING TO SHOW -->
    <!-- LOGIN & LOGOUT SECTION -->
    <?php
     // <!-- LOGOUT -->
      if (isset($_SESSION['userMail'])) {
        echo '
        <div class = "wrap-logout">
        <!-- LOGO -->
          <a href="#" class="justify-content-center">
            <img src="img/logo.jpg" class="justify-content-center logo" alt="logo">
          </a>
        <!-- WELCOME SECTION -->
        <div class="welcome">
        <p><h1>Welcome !</h1></p><br>
        <p><h2>Now you have access to the festival!</h2></p><br>
        <p><h2> ENJOY!! </h2></p>
        </div>
        <!-- LOGOUT SECTION -->
        <form class="wrap-form" action="includes/logout.inc.php" method="post">
            <button class="logout-button"type="submit" name="logout-submit">Logout</button>
          </form>
          </div>';
      }
      // <!-- LOGIN -->
      else {
      echo  ' <!-- LOGO -->
      <div class="wrap-login ">
        <a href="#" class="justify-content-center">
          <img src="img/logo.jpg" class="justify-content-center logo" alt="logo">
        </a>
        <!-- LOGIN SECTION -->
        <form class="wrap-form" action="includes/login.inc.php" method="post">
          <div class="form-row">
            <!-- EMAIL -->
            <div class="wrap-form col-md-10">
              <label for="Email">E-mail</label>
              <input class="form-control mr-sm-4" type="text" name="userMail" placeholder="e-mail..." id="Email">
            </div>
            <!-- PASSWORD -->
            <div class="wrap-form col-md-10 ">
              <label for="pwd">Password</label>
              <input class="form-control mr-sm-2" type="password" name="userPwd" placeholder="Password..." id="Password">
            </div>
            <!-- SUBMIT -->
            <div class="form-group">
              <button class="login-button" type="submit" name="login-submit">Login</button>
              <button type="button" class="signup-button" name="button"><a href="signup.php">Sign Up</a></button>
            </div>
        </form>
      </div>';
      }
     ?>



  </header>
