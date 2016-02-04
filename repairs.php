<?php

require_once 'scripts/database.php';

$db = new Database();
$db->connectToDB();

if ($_POST) {
    $repairbrand = $_POST['repairbrand'];
    $repairmodel = $_POST['repairmodel'];
    $repairtech = $_POST['repairtech'];
    $repairIMEI = $_POST['repairIMEI'];
    $cusname = $_POST['cusname'];
    $cusphone = $_POST['cusphone'];
    $cusemail = $_POST['cusemail'];
    $db->createRepair($repairbrand, $repairmodel, $repairtech, $repairIMEI, $cusname, $cusphone, $cusemail);
}
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

 <body>

     <form class="form-repair" method="post" id="repair-form">

         <h2 class="form-signin-heading">Enter Repair Info</h2>
         <hr />

         <div id="error">
             <!-- error will be showen here ! -->
         </div>

         <div class="form-group">
             <input type="text" class="form-control" placeholder="Phone Brand" name="repairbrand" id="repairbrand" />
         </div>

         <div class="form-group">
             <input type="text" class="form-control" placeholder="Phome Model" name="repairmodel" id="repairmodel" />
         </div>

         <div class="form-group">
             <input type="text" class="form-control" placeholder="Technician Name" name="repairtech" id="repairtech" />
         </div>

         <div class="form-group">
             <input type="number" class="form-control" placeholder="IMEI number" name="repairtech" id="repairtech" />
         </div>

         <div class="form-group">
             <input type="text" class="form-control" placeholder="Cutomer Name" name="cusname" id="cusname" />
         </div>

         <div class="form-group">
             <input type="number" class="form-control" placeholder="Customer phone #" name="cusphone" id="cusphone" />
         </div>

         <div class="form-group">
             <select name="cars">
                 <option value="">Locations</option>
                 <option value="pickering">Pickering</option>
                 <option value="whitby">Whitby</option>

             </select>
         </div>

         <hr />

         <div class="form-group">
             <button type="submit" class="btn btn-default" name="btn-submit" id="btn-submit1">
                 <span class="glyphicon glyphicon-log-in"></span> &nbsp; Submit
             </button>
         </div>

     </form>
     </div>
     <script src="js/bootstrap.min.js"></script>
 </body>

 </html>
