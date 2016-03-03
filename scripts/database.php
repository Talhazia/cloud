<?php

require 'vendor/autoload.php';
use Mailgun\Mailgun;

ini_set('display_errors', 1);  error_reporting(E_ALL);
if(!isset($_SESSION))
    {
        session_start();
    }

class Database
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $pass = 'Admin00?';
    protected $db = 'cloudcomp';
    protected $isConnected = false;
    protected $dbh;
    protected $isLoggedIn = false;

    public function checkLoginStatus()
    {
        if (isset($_SESSION['username']) ) {
            $this->isLoggedIn = true;
        } else {
            $this->isLoggedIn = false;
        }

        return $this->isLoggedIn;
    }

    public function connectToDB()
    {
        try {
            $this->dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->db.'', $this->user, $this->pass);
            if ($this->dbh) {
                $this->isConnected = true;
            }
        } catch (PDOException $e) {
            echo 'Error!: '.$e->getMessage().'<br/>';
            die();
        }
    }

    public function checkIfConnected()
    {
        return $this->isConnected;
    }

    public function checkLogin($username, $password)
    {
        if ($this->isConnected) {
            $statement = $this->dbh->prepare('SELECT * FROM users WHERE username=:username AND password=:password');
            $statement->execute(array(
              ':username' => $username,
              ':password' => $password,
          ));

            if ($statement->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function createAccount($username, $password, $useremail)
    {
        $joiningdate = date('Y-m-d H:i:s');

        try {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE useremail=:email');
            $stmt->execute(array(':email' => $useremail));
            $count = $stmt->rowCount();

            if ($count == 0) {
                $stmt = $this->dbh->prepare('INSERT INTO users(username,password,useremail,joiningdate) VALUES(:username, :password, :email, :jdate)');
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':email', $useremail);
                $stmt->bindParam(':jdate', $joiningdate);

                if ($stmt->execute()) {
                    echo 'registered';
                } else {
                    echo 'Error: Could not register';
                }
            } else {
                echo '1';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createRepair($repairbrand, $repairmodel, $repairtech, $repairIMEI, $cusname, $cusphone, $cusemail, $repairloc)
    {
        $repairdate = date('Y-m-d H:i:s');

        try {
            $stmt = $this->dbh->prepare('SELECT * FROM repairform WHERE repairIMEI=:repairIMEI');
            $stmt->execute(array(':repairIMEI' => $repairIMEI));
            $count = $stmt->rowCount();

            if ($count == 0) {
                $stmt = $this->dbh->prepare('INSERT INTO repairform(customerID, repairbrand, repairdate, repairmodel, repairtech, repairIMEI, repairloc) VALUES(:customerID, :repairbrand, :repairdate, :repairmodel, :repairtech, :repairIMEI, :repairloc)');
                $stmt1 = $this->dbh->prepare('INSERT INTO customers(cusname, cusphone, cusemail) VALUES(:cusname, :cusphone, :cusemail)');
                $stmt->bindParam(':repairbrand', $repairbrand);
                $stmt->bindParam(':repairmodel', $repairmodel);
                $stmt->bindParam(':repairtech', $repairtech);
                $stmt->bindParam(':repairIMEI', $repairIMEI);
                $stmt->bindParam(':repairdate', $repairdate);
                $stmt->bindParam(':repairloc', $repairloc);
                $stmt1->bindParam(':cusname', $cusname);
                $stmt1->bindParam(':cusphone', $cusphone);
                $stmt1->bindParam(':cusemail', $cusemail);

              /*if($stmt1->execute() && $stmt->execute())
              {
                return "Repair submitted";
              }
              else
              {
                return "Error: Could not submit";
              }*/
              if ($stmt1->execute()) {
                  $id = $this->dbh->lastInsertId();
                  $stmt->bindParam(':customerID', $id);
                  if ($stmt->execute()) {
                      $this->sendEmail();
                      $this->uploadImage();


                      return 'Repair submitted';
                  } else {
                      return 'Error: Could not submit';
                  }
              } else {
                  return 'Error: Could not submit';
              }
            } else {
                return 'Repair IMEI already exists';
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createSession($username, $password)
    {
        if (count($_POST) > 0) {
            $stmt = $this->dbh->prepare('SELECT * FROM users WHERE (`username` = :username) and (`password` = :password)');

            $result = $stmt->execute(array(':username' => $_POST['username'], ':password' => $_POST['password']));
            $rows = $stmt->rowCount();

            if ($rows > 0) {
                $_SESSION['username'] = $_POST['username'];

                header('Location: repairs.php');
            } else {
                echo 'Invalid username or password, please try again!';
                header('Location: login.php');
            }
        }
    }

    public function getCustomers()
    {
        $stmt = $this->dbh->prepare('SELECT * FROM customers');
        $result = $stmt->execute();
        $rows = $stmt->rowCount();

        if ($rows > 0) {
            return $stmt->fetchAll();
        }
    }

    public function sendEmail()
    {
        # First, instantiate the SDK with your API credentials and define your domain.
          $mg = new Mailgun('key-3f57a39ea3bef42f294c5e5590e6e5d4');
        $domain = 'https://api.mailgun.net/v3/sandbox06544ae5e2c74187bd56ca729517bc90.mailgun.org';
        $time = new DateTime(date('h:i:s'));

          # Now, compose and send your message.
          $result = $mg->sendMessage($domain, array('from' => 'talha.zia@uoit.net',
                                          'to' => ($_POST['cusemail']),
                                          'subject' => 'Your repair has been submitted',
                                          'text' => 'Thank you for choosing us '.$_POST['cusname'].'. Your '.$_POST['repairbrand'].' '.$_POST['repairmodel'].' has IMEI '.$_POST['repairIMEI'].', Your repair technician is: '.$_POST['repairtech'].' and your repair was submitted at: '.$time->format('h:i:s'), ));

        $httpResponseCode = $result->http_response_code;
        $httpResponseBody = $result->http_response_body;

                                          # Iterate through the results and echo the message IDs.
                                          /*$logItems = $result->http_response_body->items;
                                          foreach($logItems as $logItem){
                                              echo $logItem->message_id . "\n";
                                          }*/
                                          print_r($httpResponseBody->message);
    }

    public function uploadImage() {

      if(isset($_POST['btn_upload']))
{
	$filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$filetype = $_FILES["file_img"]["type"];
	$filepath = "images/".$filename;



    move_uploaded_file($filetmp,$filepath);
    $stmt = $this->dbh->prepare('INSERT INTO image(imageName,imagePath,imageType) VALUES(:imageName, :imagePath, :imageType)');
    $stmt->bindParam(':imageName', $filename);
    $stmt->bindParam(':imagePath', $filepath);
    $stmt->bindParam(':imageType', $filetype);
    $result = $stmt->execute();

    if ($stmt->execute()) {
        $stmt->bindParam(':imgID', $this->dbh->lastInsertId());





}

}
    }

}
