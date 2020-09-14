<?php
//ends the session
session_start();
session_unset();
session_destroy();
//return loggedout status
header("Location: ../index.php?Loggedout");
?>
