<?php
require_once('scripts/database.php');
//session_start();

$db1 = new Database();
$db1->connectToDB();
if($db1->checkIfConnected())
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
      else if($db1->addemployee($username, $password))
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

?>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username'])) {
  $username = test_input($_POST["username"]);
  $password = test_input($_POST["password"]);
  echo "Your username:";
  echo $username;
  echo "<br>";
  echo "Dont forget your:";
  echo "<br>";
  echo $password;
}
else{
  echo "Please complete the form below";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE HTML>
<html>
<head>
</head>
<body>

  <form method="POST" action"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset>
      <legend>Employee sign up:</legend>

      <input type="text" name="username" value="" placeholder="Username"><br>
      <input type="password" name="password" value="" placeholder="Password"><br>
      <input type="submit" name="esubmit" value="Register">

    </fieldset>
  </form>

</body>
</html>
