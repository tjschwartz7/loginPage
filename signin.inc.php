<main>
  <meta charset="UTF-8">
</main>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//if the signin-submit button was actively pressed continue
if(isset($_POST['signin-submit'])){
  require 'dbh.inc.php';
  if($_SERVER['REQUEST_METHOD'] = 'POST')
  {
      //collects input info
      $user=($_POST["user"]);
      $password=($_POST["pw1"]);
      $email=($_POST["email"]);
    //verifies user information
    if(Empty($user) || Empty($password))
    {
      header("Location: ../signup.php?error=emptyfields&user=".$user."&email=".$email."first=".$first."&last=".$last);
      exit();
    }
    else{
      //sees if the user input matches account information within the database
      $sql="SELECT * FROM userinfo WHERE username=? OR email=?;";
      $stmt = mysqli_stmt_init($connection);
      //if stmt is not initialized with sql then return that an error has occurred
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../signin.php?error=sqlerror");
        exit();
      }
      else{
        //bind the user input to sql placeholders ? ?
        mysqli_stmt_bind_param($stmt, "ss", $user, $user);
        //execute code in mysql database
        mysqli_stmt_execute($stmt);
        //store result
        $getResult =  mysqli_stmt_get_result($stmt);
          
          if($row = mysqli_fetch_assoc($getResult)){
            //store boolean in the checkpass variable to determine if the password is valid
          $checkPass = password_verify($password, $row['pass']);
            //password not valid
            if($checkPass == false)
            {
              header("Location: ../signin.php?error=incorrectpassword&user=".$user);
              exit();
            }
            else if($checkPass == true){
              //password is valid
              //return login successful
              header("Location: ../index.php?loginsuccessful");
              //create a logged in session containing 'iduser' and 'username'
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
    //close connection and stmt
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
