<main>
  <meta charset="UTF-8">
</main>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//This if checks to see if the signup-submit button is pressed at the time of access
if(isset($_POST['signup-submit'])){
  //this is the include file for the database (not included)
  require 'dbh.inc.php';
  //Checks to see if the 'POST' was the submit method used
  if($_SERVER['REQUEST_METHOD'] = 'POST')
  {
    //receive the submitted information
    $first=($_POST["first"]);
    $last=($_POST["last"]);
     $email=($_POST["email"]);
      $user=($_POST["user"]);
      $password=($_POST["pw1"]);
      $passwordConfirm=($_POST["pw2"]);
    //variables to check password for validity
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

//series of ifs to determine if the user input is valid
    //otherwise, return to signup page
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
      //user inputs are mostly valid(not yet checked for duplicate user/email
      //secure method of checking database for username duplicate
      $sql="SELECT * FROM userinfo WHERE username=? OR email=?;";
      $stmt = mysqli_stmt_init($connection);
      //if stmt is not initialized with sql
      if(!mysqli_stmt_prepare($stmt, $sql))
      {
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }
      else{
        //bind variables user and email to stmt for later use (fill in the ? ?'s)
        mysqli_stmt_bind_param($stmt, "ss", $user, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        //number of rows containing the specified username or email (greater than one is already taken)
        $checkVarSQL = mysqli_stmt_num_rows($stmt);
        if($checkVarSQL > 0){
          //return username is already taken
          header("Location: ../signup.php?error=usernameTaken/emailalreadyinuse&email=".$email."&first=".$first."&last=".$last);
          exit();
        }
        else{
          //user input has been determined valid so attempt to insert data into the database using this secure method
            $sql= "INSERT INTO userinfo (username, pass, email, firstName, lastName) VALUES (?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($connection);
            //if stmt is not initialized with sql return to signup page (error has occurred)
           if(!mysqli_stmt_prepare($stmt, $sql))
           {
              header("Location: ../signup.php?error=sqlerror");
              exit();
            }
            else{
              //this method hashes the password for security reasons (if someone somehow gets into the database passwords are illegible)
              $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
              //bind the input with stmt placeholders (? ? ? ? ?)'s
              mysqli_stmt_bind_param($stmt, "sssss", $user, $hashedPassword, $email, $first, $last);
              //execute code in database
              mysqli_stmt_execute($stmt);
              //progress along account creation with signupsuccessful message
              header("Location: ../setupProfile.php?signupsuccessful");
              exit();

           }
        }
      }
    }
    //close connection and stmt
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
