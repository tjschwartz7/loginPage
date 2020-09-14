<?php
require 'requires/nav2.php';
?>

<main>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Trade Winds">

      <title>Login</title>
    </head>

    <body>

      <form id="loginbox" action="include/signin.inc.php" method="post">
  <!--  <div class="loginimg-container">
      <div class="loginimg-item loginimg-item-1">
      <h1 id="siteName">Nerdy Owl</h1>
    </div>
    </div>
  -->

    <div class="login-container">
      <ul>
        <li>
      <label for="user"><b>Username/Email</b></label>
      <input type="text" placeholder="Enter Username" name="user" required>
  </li>

  <li>
  <!--  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded',
    function(){
      document.getElementById('submit').onclick = function(){
    var pw1 = document.getElementsByClassName("pw1").value;
    var pw2 = document.getElementsByClassName("pw2").value;
    if(pw1 !== pw2) document.getElementsByClassName("passwordlabel")[0].textContent = "Passwords do not match";
    else document.getElementsByClassName("passwordlabel")[0].textContent= "Passwords match!";
  };
  });
  </script>-->
      <label for="pw1"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pw1" class="pw1" required>
    </li>
  </ul>

    </div>

    <ul class="buttonbox">
      <li>
        <button id="submit" type="submit" name="signin-submit">Login</button>
      </li>
      <li>
    <a href="index.php">  <button type="button" id="cancel">Cancel</button></a>
    </li>
    <li id="signup">
  <a href="signup.php">  <button type="button">Create New Account</button></a>
  </li>
    <li>
      <span class="pw">Forgot <a href="#">password?</a></span>
    </li>
  </ul>
  <label>
    <input type="checkbox" checked="checked" name="remember"> Remember me
  </label>

    <div class="color-bar"></div>
  </form>
    <div class="background-image"></div>

    </body>
  </html>
</main>
