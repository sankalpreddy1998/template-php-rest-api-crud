<?php
class database{
  //db params
  private $host = 'localhost';
  private $dbname = 'template_db';
  private $username = 'admin';
  private $password = 'Welcome';
  private $conn;

  //db connect
  public function connect(){
    $this->conn = null;

    try {
      $this->conn = new PDO('mysql:host='.$this->host.'; dbname='.$this->dbname, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection Error: ".$e->getMessage();
    }

    return $this->conn;

  }
}
