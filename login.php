<?php
session_start();
require_once('scripts/database.php');

$db = new Database();
$db->connectToDB();


if($db->checkLoginStatus() == true){
    header('Location: repairs.php');
}

if($_POST)
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $db->createSession($username, $password);
}
 ?>


<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login for Celtel Employee</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
    <script type="text/javascript" src="js/script.js"></script>
</head>

<body>

    <form class="form-login" method="post" id="login-form">

        <h2 class="form-signin-heading">Enter Login Information</h2>
        <hr />

        <div id="error">
                <?php echo isset($message) ? $message : null; ?>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" id="user_name" />
        </div>

        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" id="pass_word" />
        </div>

        <hr />

        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
            </button>
        </div>

    </form>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
