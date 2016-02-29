<?php

require_once 'scripts/database.php';

$db = new Database();
$db->connectToDB();

$db->uploadImage();



 ?>



<?php echo'
<div class="form-group">
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file_img" class="btn btn-default" id="btn-submit1"/> </br>
    <input type="submit" name="btn_upload" value="Upload" class="btn btn-default" id="btn-submit1">
  </form>'
  ?>
