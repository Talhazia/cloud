<?php

$hostdb = 'localhost';
$namedb = 'cloudcomp';
$userdb = 'root';
$passdb = 'Admin00?';


try {

  $conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
  $conn->exec();


  $sql = "SELECT * FROM repairform, customers";
  $result = $conn->query($sql);


  if($result !== false) {

    $html_table = '<table border="1" cellspacing="0" cellpadding="2">
    <hr>
    <tr>
    <th>Location</th>
    <th>Brand</th>
    <th>Model</th>
    <th>Repair Date</th>
    <th>Technician</th>
    <th>IMEI #</th>
    <th>Customer Name</th>
    <th>Customer Phone #</th>
    <th>Customer email</th>
    </tr>';


    foreach($result as $row) {
      $html_table .= '<tr>
      <td>' .$row['repairloc'].'</td>
      <td>' .$row['repairbrand']. '</td>
      <td>' .$row['repairmodel']. '</td>
      <td>' .$row['repairdate']. '</td>
      <td>' .$row['repairtech']. '</td>
      <td>' .$row['repairIMEI']. '</td>
        <td>' .$row['cusname']. '</td>
          <td>' .$row['cusphone']. '</td>
            <td>' .$row['cusemail']. '</td>

      </tr>';
    }
  }

  $conn = null;

  $html_table .= '</table>';

  echo $html_table;
}
catch(PDOException $e) {
  echo $e->getMessage();
}
?>


<html>
<body>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
  <script type="text/javascript" src="js/validation.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
  <br>
  <hr>
<input type="button" value="Submit new Repair" class="btn btn-default" id="btn-submit1" onClick="document.location.href='repairs.php'" />
<hr>
<input type="button" value="Logout" class="btn btn-default" id="btn-submit1" onClick="document.location.href='logout.php'" />
</body>
</html>
