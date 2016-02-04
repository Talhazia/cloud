<?php

class Database
{
    protected $host = "localhost";
    protected $user = "root";
    protected $pass = "Admin00?";
    protected $db = "cloudcomp";
    protected $isConnected = false;
    protected $dbh;

    public function connectToDB()
    {
      try {
        $this->dbh = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . '', $this->user, $this->pass);
        if($this->dbh)
        {
            $this->isConnected = true;
        }
      } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
      }
    }

    public function checkIfConnected()
    {
        return $this->isConnected;
    }

    public function getdb() {
      if ($this->$db instanceof PDO)
      return $this->$db;
    }

    public function checkLogin($username, $password) {
       if ($this->isConnected)
       {
          $statement = $this->dbh->prepare('SELECT * FROM users WHERE username=:username AND password=:password');
          $statement->execute(array(
              ':username' => $username,
              ':password' => $password
          ));

          if($statement->rowCount() > 0)
          {
              return true;
          } else {
            return false;
          }
       }
    }

    public function createAccount($username, $password, $useremail)
    {


        $joiningdate = date('Y-m-d H:i:s');

        try{

          $stmt = $this->dbh->prepare("SELECT * FROM users WHERE useremail=:email");
          $stmt->execute(array(":email"=>$useremail));
          $count = $stmt->rowCount();

          if($count==0){
            $stmt = $this->dbh->prepare("INSERT INTO users(username,password,useremail,joiningdate) VALUES(:username, :password, :email, :jdate)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":email", $useremail);
            $stmt->bindParam(":jdate", $joiningdate);

            if($stmt->execute())
            {
              echo "Registeration complete";
            }
            else
            {
              echo "Error: Could not register";
            }

              }

              else {
                echo "1";
              }
      }
          catch(PDOException $e) {
            echo $e->getMessage();
          }

      }




      public function createRepair($repairbrand, $repairmodel, $repairtech, $repairIMEI, $cusname, $cusphone, $cusemail, $repairloc)
      {


          $repairdate = date('Y-m-d H:i:s');

          try{

            $stmt = $this->dbh->prepare("SELECT * FROM repairform WHERE repairIMEI=:repairIMEI");
            $stmt->execute(array(":repairIMEI"=>$repairIMEI));
            $count = $stmt->rowCount();

            if($count==0){
              $stmt = $this->dbh->prepare("INSERT INTO repairform(repairbrand, repairdate, repairmodel, repairtech, repairIMEI, repairloc) VALUES(:repairbrand, :repairdate, :repairmodel, :repairtech, :repairIMEI, :repairloc)");
              $stmt1 = $this->dbh->prepare("INSERT INTO customers(cusname, cusphone, cusemail) VALUES(:cusname, :cusphone, :cusemail)");
              $stmt->bindParam(":repairbrand", $repairbrand);
              $stmt->bindParam(":repairmodel", $repairmodel);
              $stmt->bindParam(":repairtech", $repairtech);
              $stmt->bindParam(":repairIMEI", $repairIMEI);
              $stmt->bindParam(":repairdate", $repairdate);
              $stmt1->bindParam(":cusname", $cusname);
              $stmt1->bindParam(":cusphone", $cusphone);
              $stmt1->bindParam(":cusemail", $cusemail);
              $stmt->bindParam(":repairloc", $repairloc);

              if($stmt1->execute() && $stmt->execute())
              {
                return "Repair submitted";
              }
              else
              {
                return "Error: Could not submit";
              }

                }

                else {
                  return "Repair IMEI already exists";
                }
        }
            catch(PDOException $e) {
              echo $e->getMessage();
            }

        }





    }


?>
