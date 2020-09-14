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

      <title>Sign up</title>
    </head>

    <body>

      <form id="loginbox" action="include/signup.inc.php" method="post">
  <!--  <div class="loginimg-container">
      <div class="loginimg-item loginimg-item-1">
      <h1 id="siteName">Nerdy Owl</h1>
    </div>
    </div>
  -->

    <div class="login-container">
      <p class="passwordlabel" style="font-family:sans-serif, serif;">Passwords must contain more than 8 digits,
      3 numbers, and 1 uppercase letter.<br>Usernames must contain at least 8 characters.</p>

      <ul>
        <li>
      <label for="first"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="first" required>
  </li>
  <li>
  <label for="last"><b>Last Name</b></label>
  <input type="text" placeholder="Last Name" name="last" required>
  </li>
        <li>
      <label for="user"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="user" required>
  </li>
  <li>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter email" name="email" required>
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
    <li>
        <label for="pw2"><b>Confirm</b></label>
        <input type="password" placeholder="Confirm Password" name="pw2" class="pw2" required >
      </li>
  </ul>
    </div>

    <ul class="buttonbox">
      <li>
          <button id="submit" type="submit" name="signup-submit">Login</button>
      </li>
      <li>
    <a href="index.php">  <button type="button" id="cancel">Cancel</button><a>
    </li>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

  </ul>

    <div class="color-bar"></div>
  </form>
    <div class="background-image"></div>

    </body>
  </html>
</main>



<?php

?>
