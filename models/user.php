<?php
  class user{
    //DB Stuff
    private $conn;
    private $table = 'users';

    //posts properties
    public $id;
    public $UserName;
    public $UserEmail;
    public $UserPhone;
    public $DOB;
    public $UserPassword;

    //Constructor with
    public function __construct($db){
      $this->conn = $db;
    }


    //Get users

    public function read(){

      //Create Query
      $query = 'SELECT u.id as id, u.name as UserName, u.email as UserEmail, u.phone as UserPhone, u.dob as DOB, u.password as UserPassword
                FROM '.$this->table.' u';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //execute Query
      $stmt->execute();

      //return PDOStatement
      return $stmt;
    }


    public function read_single(){

      //Create Query
      $query = 'SELECT u.id as id, u.name as UserName, u.email as UserEmail, u.phone as UserPhone, u.dob as DOB, u.password as UserPassword
                FROM '.$this->table.' u WHERE u.id = ? LIMIT 0,1';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //EXTRA::Bind ID
      $stmt->bindParam(1,$this->id);

      //execute Query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->id = $row['id'];
      $this->UserName = $row['UserName'];
      $this->UserEmail = $row['UserEmail'];
      $this->UserPhone = $row['UserPhone'];
      $this->DOB = $row['DOB'];
      $this->UserPassword = $row['UserPassword'];


    }



    //create function
    public function create(){
      //query
      $query = 'INSERT INTO '.$this->table.' SET id = :id, name = :UserName, email = :UserEmail, phone = :UserPhone, dob = :DOB, password = :UserPassword';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //Clean Data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->UserName = htmlspecialchars(strip_tags($this->UserName));
      $this->UserEmail = htmlspecialchars(strip_tags($this->UserEmail));
      $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
      $this->DOB = htmlspecialchars(strip_tags($this->DOB));
      $this->UserPassword = htmlspecialchars(strip_tags($this->UserPassword));

      //Bind params
      $stmt->bindParam(':id',$this->id);
      $stmt->bindParam(':UserName',$this->UserName);
      $stmt->bindParam(':UserEmail',$this->UserEmail);
      $stmt->bindParam(':UserPhone',$this->UserPhone);
      $stmt->bindParam(':DOB',$this->DOB);
      $stmt->bindParam(':UserPassword',$this->UserPassword);

      if($stmt->execute()){
        return true;
      }

      //print error
      printf("Error: %s.\n",$stmt->error);

      return false;
    }





    //update function
    public function update(){
      //query
      $query = 'UPDATE '.$this->table.' SET name = :UserName, email = :UserEmail, phone = :UserPhone, dob = :DOB, password = :UserPassword WHERE id = :id';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //Clean Data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->UserName = htmlspecialchars(strip_tags($this->UserName));
      $this->UserEmail = htmlspecialchars(strip_tags($this->UserEmail));
      $this->UserPhone = htmlspecialchars(strip_tags($this->UserPhone));
      $this->DOB = htmlspecialchars(strip_tags($this->DOB));
      $this->UserPassword = htmlspecialchars(strip_tags($this->UserPassword));

      //Bind params
      $stmt->bindParam(':id',$this->id);
      $stmt->bindParam(':UserName',$this->UserName);
      $stmt->bindParam(':UserEmail',$this->UserEmail);
      $stmt->bindParam(':UserPhone',$this->UserPhone);
      $stmt->bindParam(':DOB',$this->DOB);
      $stmt->bindParam(':UserPassword',$this->UserPassword);

      if($stmt->execute()){
        return true;
      }

      //print error
      printf("Error: %s.\n",$stmt->error);

      return false;
    }



    //delete function
    public function delete(){
      //query
      $query = 'DELETE FROM '.$this->table.' WHERE id = :id';

      //prepare statement
      $stmt = $this->conn->prepare($query);

      //Clean Data
      $this->id = htmlspecialchars(strip_tags($this->id));

      //Bind params
      $stmt->bindParam(':id',$this->id);

      if($stmt->execute()){
        return true;
      }

      //print error
      printf("Error: %s.\n",$stmt->error);

      return false;
    }
}
