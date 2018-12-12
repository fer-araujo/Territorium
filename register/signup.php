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

<main>
  <!-- LOGO -->
  <div class="wrap-signup justify-content-center">
    <a href="index.php" class="justify-content-center">
      <img src="img/logo.jpg" class="justify-content-center logo" alt="logo">
    </a>
    <?php
      if (isset($_GET['error'])) {
          if ($_GET['error']==="emptyfields") {
            echo '<p class="signuperror"> Fill in all fields please!</p>';
          }
          else if ($_GET['error']==="invaliduserName") {
            echo '<p class="signuperror"> Thats an invalid user name!</p>';
          }
          else if ($_GET['error']==="invaliduserMail") {
            echo '<p class="signuperror"> Thats an invalid email!</p>';
          }
          else if ($_GET['error']==="passwordcheck") {
            echo '<p class="signuperror"> The passwords do not match!</p>';
          }
      }
     ?>
      <!-- SIGNUP SECTION -->
      <form class=" wrap-form  justify-content-center" action="includes/signup.inc.php" method="post">
        <div class="form-row">
          <!-- NAME -->
          <div class="form-group col-md-6">
            <label for="Name">Name</label><br>
            <input class="form-control" type="text" name="userName" placeholder="Name..." id="Name">
          </div>
          <!-- LAST NAME -->
          <div class="form-group col-md-6">
            <label for="lastName">Last Name</label><br>
            <input class="form-control" type="text" name="userLast" placeholder="Last Name..." id="lastName">
          </div>
          <!-- GENDER -->
          <div class="form-group col-md-4">
            <label for="Gender">Gender</label>
            <select class="form-control" name="userGender" id="Gender">
              <option selected>Choose...</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <!-- AGE -->
          <div class="form-group col-md-4">
            <label for="age" class="">Your Age</label>
            <div class="form-control mr-sm-2">
              <input class="" type="number" name="userAge" value="" id="age">
            </div>
          </div>
          <!-- MUSIC GENRE -->
          <div class="form-group col-md-4">
            <label for="Genre">Favorite Music Genre</label>

            <select class="form-control mr-sm-2" name="userGenre" id="Genre">
              <option selected>Choose...</option>
              <option value="Genre 1">Genre 1</option>
              <option value="Genre 2">Genre 2</option>
              <option value="Genre 3">Genre 3</option>
            </select>
          </div>
          <!-- BANDS -->
          <div class="form-group col-md-6">
            <label class="" for="Bands">Favorite Bands</label><br>
            <select class="form-control mr-sm-2"name="userBand" id="Bands">
              <option selected>Choose...</option>
              <option value="Band 1">Band 1</option>
              <option value="Band 2">Band 2</option>
              <option value="Band 3">Band 3</option>
            </select>
          </div>
          <!-- EMAIL -->
          <div class="form-group col-md-6">
            <label for="email">Email</label><br>
            <input class="form-control " type="text" name="userMail" placeholder="e-mail..." id="email">
          </div>
          <!-- PASSWORD -->
          <div class="form-group password-form col-md-6 ">
            <label for="pwd">Password</label>
            <input class="form-control" type="password" name="userPwd" placeholder="Password..." id="Password">
            <label for="rpwd">Repeat Password</label>
            <input class="form-control" type="password" name="userPwd-repeat" placeholder="Repeat Password..." id="Password">
          </div>
        </div>
        <button class="login-button" type="submit" name="signup-submit">Submit</button>
      </form>
    </div>
  </div>

</main>
