<?php
session_start();
require_once('scripts/database.php');

$db = new Database();
$db->connectToDB();

if($_POST)
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  $useremail = $_POST['useremail'];
  $db->createAccount($username, $password, $useremail);
}
 ?>
