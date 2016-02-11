 <?php

 require_once('scripts/database.php');

$db = new Database();
if(!$db->checkLoginStatus()){
  header('Location: login.php');

}
else {
session_destroy();
header('Location: login.php');


}

 ?>
