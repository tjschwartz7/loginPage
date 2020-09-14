<main>
  <meta charset="UTF-8">
</main>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['signup-submit'])){
  require 'dbh.inc.php';
  if($_SERVER['REQUEST_METHOD'] = 'POST')
  {
    $first=($_POST["first"]);
    $last=($_POST["last"]);
     $email=($_POST["email"]);
      $user=($_POST["user"]);
      $password=($_POST["pw1"]);
      $passwordConfirm=($_POST["pw2"]);
      $pwNumbers = 0;
      $pwUpper = 0;
      $pwArr = str_split($password);
      for($x = 0; $x < strlen($password); $x++)
      {
        if(is_numeric($pwArr[$x])){
          $pwNumbers++;
        }
        else if(ctype_upper($pwArr[$x])) $pwUpper++;
      }


    if(Empty($user) || Empty($first) || Empty($first) ||
    Empty($last) || Empty($password) || Empty($passwordConfirm))
    {
      header("Location: ../signup.php?error=emptyfields&user=".$user."&email=".$email."first=".$first."&last=".$last);
      exit();
    }
     else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $user))
    {
      header("Location: ../signup.php?error=invalidmailuser&first=".$first."&last=".$last);
      exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../signup.php?error=invalidmail&user=".$user."&first=".$first."&last=".$last);
      exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $user) || strlen($user) > 20 || strlen($user) < 8)
    {
      header("Location: ../signup.php?error=incorrectusername&user=".$user."&email=".$email."&first=".$first."&last=".$last);
      exit();
    }
    else if($password !== $passwordConfirm || $pwUpper < 1 || $pwNumbers < 3 || strlen($password) > 45 || strlen($password) < 8)
    {
      header("Location: ../signup.php?error=confirmationfailed&user=".$user."&email=".$email."&first=".$first."&last=".$last);
      exit();
    }
    else if(strlen($first) > 15 || strlen($lastName) > 15)
    {
      header("Location: ../signup.php?error=nameoutofbounds&user=".$user."&email=".$email);
      exit();
    }
    else{
      $sql="SELECT * FROM userinfo WHERE username=? OR email=?;";
      $stmt = mysqli_stmt_init($connection);
    //  $stmt = mysqli_prepare($connection, "SELECT username FROM userinfo WHERE username=?;");
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      else{
        mysqli_stmt_bind_param($stmt, "ss", $user, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $checkVarSQL = mysqli_stmt_num_rows($stmt);
        if($checkVarSQL > 0){
          header("Location: ../signup.php?error=usernameTaken/emailalreadyinuse&email=".$email."&first=".$first."&last=".$last);
          exit();
        }
        else{
            $sql= "INSERT INTO userinfo (username, pass, email, firstName, lastName) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($connection);
          //$stmt = mysqli_prepare($connection, "INSERT INTO userinfo (username, password, email, firstName, lastName) VALUES (?, ?, ?, ?, ?);");


           if(!mysqli_stmt_prepare($stmt, $sql))
           {
              header("Location: ../signup.php?error=sqlerror");
              exit();
            }
            else{
              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, "sssss", $user, $hashedPassword, $email, $first, $last);
              //  mysqli_stmt_send_long_data($stmt, "sssss",  $user, $hashedPassword, $email, $first, $last );
              mysqli_stmt_execute($stmt);
              header("Location: ../setupProfile.php?signupsuccessful");
              exit();

           }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

  }
  else
  {
    header("Location: ../signup.php");
    exit();
  }

}

?>
