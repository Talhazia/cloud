<?php
require_once('scripts/database.php');
//session_start();

$db = new Database();
$db->connectToDB();
if($db->checkIfConnected())
{
  $username = $_POST['username'];
  $password = $_POST['password'];

  if(isset($username) && isset($password)) {
      if($username == "")
      {
          echo "Enter username";
      }
      else if($password == "")
      {
          echo "Enter password";
      }
      else if($db->checkLogin($username, $password))
      {
          echo "Logged in";
         //$_SESSION['user'] = $username;
      } else {
          echo "invalid login";
      }
  }
} else {
  echo "not connected";
}

//print_r($_SESSION);

?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Registeration form for Cel-tel Wireless</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->


        <form action="/project/index1.php" method="POST">
            <input type="text" name="username" value="" placeholder="Username">
            <input type="password" name="password" value="" placeholder="Password">
            <input type="submit" name="LoginSubmit" value="Login">
        </form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>