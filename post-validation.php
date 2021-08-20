<?php
/**
 * Cloud Computing Assignment 3 by Rebecca Barnett S3856827
*/

//resume session
session_start();

date_default_timezone_set('UTC');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logOut"])){
  //Handle Logout
  unset($_SESSION["username"]);
  unset($_SESSION["fanInfo"]["favDriver"]);
  header('Location: index.php');
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["driverSelected"])) {
  //Handle changing selected driver
   $_SESSION["fanInfo"]["favDriver"] = $_POST["driver"];
  header("Location: fanpage.php");  
} 



?>