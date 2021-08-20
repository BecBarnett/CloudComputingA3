<?php
/**
 * Cloud Computing Assignment 3 by Rebecca Barnett S3856827
*/
session_start();
putenv('HOME=/var/www/html');

date_default_timezone_set('UTC');

use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;

  if (isset($_GET['username'])){
    $_SESSION["username"]["userID"] = $_GET['username'];
  }

  if (isset($_GET['favDriver'])){
    $_SESSION["fanInfo"]["favDriver"] = $_GET['favDriver'];  
  }

function top_module($pageTitle)
{
  $username = "";  

  if (isset($_SESSION["username"]["userID"])) {
    $username = $_SESSION["username"]["userID"];
  }
  $header = <<<"OUTPUT"
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name='author' content='Rebecca Barnett'>
  <meta name="description" content="Cloud Computing Assignment 3">
  <title>$pageTitle</title>
  <link id='stylecss' type="text/css" rel="stylesheet" href='style.css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script>

  $(function() {
      $("#registerForm").submit(function(e){
        e.preventDefault();

        \$form=$(this);

        $.ajax({
          type: "POST",
          url: "https://i8aas6fsha.execute-api.us-east-1.amazonaws.com/Test/account",
          data: \$form.serialize(),
          success: function(data) {
            //alert(data);
            var container= $("#registerDiv");
            container.empty();
            container.append("</br><h2>" + data + "</h2></br></br><p id = 'homepageLink'><a href='/'>Back to Homepage</a></p></br></br>");
          },
          dataType: 'json'
        });
      });
    });

    $(function() {
      $("#loginForm").submit(function(e){
        e.preventDefault();

        \$form=$(this);

        $.ajax({
          type: "POST",
          url: "https://i8aas6fsha.execute-api.us-east-1.amazonaws.com/Test/login",
          data: \$form.serialize(),
          dataType: 'json',
          success: function(data) {
            //alert(data);
            fanpageAttribute = 'fanpage.php'  + data;
            window.location.href = fanpageAttribute;
          },
          error: function(data) {
            document.getElementById("logError").innerHTML = "Invalid Login";
          }
        });
      });
    });

  </script>
</head>

<body>
  <header>
    <h1><a href="/"><img src='https://s3856827-a3-bucket.s3.us-east-1.amazonaws.com/f1racefans.PNG'></a></h1>
  </header>

OUTPUT;

$header2 = <<<"OUTPUT"
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset="utf-8">
  <meta name='author' content='Rebecca Barnett'>
  <meta name="description" content="Cloud Computing Assignment 3">
  <title>$pageTitle</title>
  <link id='stylecss' type="text/css" rel="stylesheet" href='style.css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>

  $(function() {
      $("#registerForm").submit(function(e){
        e.preventDefault();

        \$form=$(this);

        $.ajax({
          type: "POST",
          url: "https://i8aas6fsha.execute-api.us-east-1.amazonaws.com/Test/account",
          data: \$form.serialize(),
          success: function(data) {
            //alert(data);
            var container= $("#registerDiv");
            container.empty();
            container.append("</br><h2>" + data + "</h2></br></br><p id = 'homepageLink'><a href='/'>Back to Homepage</a></p></br></br>");
          },
          dataType: 'json'
        });
      });
    });

    $(function() {
      $("#loginForm").submit(function(e){
        e.preventDefault();

        \$form=$(this);

        $.ajax({
          type: "POST",
          url: "https://i8aas6fsha.execute-api.us-east-1.amazonaws.com/Test/login",
          data: \$form.serialize(),
          dataType: 'json',
          success: function(data) {
            //alert(data);
            fanpageAttribute = 'fanpage.php'  + data;
            window.location.href = fanpageAttribute;
          },
          error: function(data) {
            alert("Task failed successfully");
            var container= $("#logError");
            container.empty();
            container.append(data);
          }
        });
      });
    });

  </script>
</head>

<body>
  <header>
    
  </header>

OUTPUT;

$menuLoggedIn = <<<"OUTPUT"
<nav>
<img src='https://s3856827-a3-bucket.s3.us-east-1.amazonaws.com/f1raceFansSkinny.png' id='skinnyf1'>
  </nav>
OUTPUT;

$logIn = <<<"OUTPUT"
<main>
<p id="logError"></p>
<div id ="loginA">

<form name='loginForm' id='loginForm'>

<div id="loginFormA">
  
  <input id="usernameInput" type="text" placeholder="Enter Email" name="usernameInput" required>
  <input  id="passwordInput"  type="password" placeholder="Enter Password" name="passwordInput" required>
  <button type="submit" name="logIO" id="loginButton">Login</button>
  
  
</form>


</div>

<a href="register.php" id='registerLink'><button id = "registerButtonLink">Register</button></a>
</br>
</br>
</br>
</div>
</br></br>
</br>
<div class="parallax"></div>
</br>
OUTPUT;

$logOut = <<<"OUTPUT"
<main>
<div id ="login">

<form action="post-validation.php" method="post">

<div id="loginForm">
<p>Logged in as: $username</p>
<button type="submit" name="logOut">Logout</button>

</div>

</form>

</div>

OUTPUT;

  
  if (isset($_SESSION["username"])){
    echo $header2;
    echo $menuLoggedIn;
    echo $logOut;
  } else if (isset($_SESSION["registrationInProgress"])) {
    echo $header;
  } else {
    echo $header;
    if (isset($_SESSION["loginError"])){
      echo '<p id="logError">' . $_SESSION["loginError"] . '</p>';
      unset($_SESSION['loginError']);
    }
    echo $logIn;
    
  }    
}


function bottom_module()
{
  $footer = <<<"OUTPUT"
  </main>
  </br>
</br></br>
</br>
  <footer>
  </br></br>
      <p> Cloud Computing A3 Rebecca Barnett S3856827.</p>
 
  </footer>
  
  </body>
  
  </html>
OUTPUT;

  echo $footer;
}


?>
