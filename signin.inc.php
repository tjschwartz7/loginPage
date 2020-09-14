<main>
  <meta charset="UTF-8">
</main>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST['signin-submit'])){
  require 'dbh.inc.php';
  if($_SERVER['REQUEST_METHOD'] = 'POST')
  {

      $user=($_POST["user"]);
      $password=($_POST["pw1"]);
      $email=($_POST["email"]);

    if(Empty($user) || Empty($password))
    {
      header("Location: ../signup.php?error=emptyfields&user=".$user."&email=".$email."first=".$first."&last=".$last);
      exit();
    }
    else{
      $sql="SELECT * FROM userinfo WHERE username=? OR email=?;";
      $stmt = mysqli_stmt_init($connection);
    //  $stmt = mysqli_prepare($connection, "SELECT username FROM userinfo WHERE username=?;");
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../signin.php?error=sqlerror");
        exit();
      }
      else{

        mysqli_stmt_bind_param($stmt, "ss", $user, $user);
        mysqli_stmt_execute($stmt);
      $getResult =  mysqli_stmt_get_result($stmt);

          if($row = mysqli_fetch_assoc($getResult)){
          $checkPass = password_verify($password, $row['pass']);
            if($checkPass == false)
            {
              header("Location: ../signin.php?error=incorrectpassword&user=".$user);
              exit();
            }
            else if($checkPass == true){
              header("Location: ../index.php?loginsuccessful");
              session_start();
              $_SESSION['iduser'] = $row['userid'];
                $_SESSION['username'] = $row['username'];
              exit();
            }
            else{
              header("Location: ../signin.php?error=incorrectpassword&user=".$user);
              exit();
            }
          }
          else{
            header("Location: ../signin.php?error=incorrectuser&user=".$user);
            exit();



              }

      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

  }
  else
  {
    header("Location: ../signin.php");
    exit();
  }

}

?>
