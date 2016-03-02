<?php

require_once 'scripts/database.php';

$db = new Database();
$db->connectToDB();

 ?>

 <!DOCTYPE html>

 <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>Repair Form for CelTel Wireless</title>
     <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
     <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
     <script type="text/javascript" src="js/validation.min.js"></script>
     <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
     <script type="text/javascript" src="js/script.js"></script>
 </head>


<div class="form-group">



  <form action="<?php $db->uploadImage() ?>" method="post" enctype="multipart/form-data" class="form-repair" >
    <h1>Upload a Picture</h1><br>
    <p1 > Would you like to Upload a picture?</p1>
    <br><br>
    <input type="file" name="file_img" class="btn btn-default" id="btn-submit1"/> </br>
    <input type="submit" name="btn_upload" value="Upload" class="btn btn-default" id="btn-submit1">
  </form>'

  <script src="js/bootstrap.min.js"></script>
 </body>

 </html>
