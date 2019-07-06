<?php

  //headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  //import file
  include_once '/var/www/html/Template/config/database.php';
  include_once '/var/www/html/Template/models/user.php';

  //Instantiate DB and connect
  $database = new database();
  $db = $database->connect();

  //Instantiate user with Constructor
  $user = new user($db);


  //use query: bu using fuction read()
  $result = $user->read();

  //get row Count
  $count = $result->rowCount();

if($count > 0){
    $user_array = array();
    $user_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $user_item = array('id' => $id, 'name'=>$UserName,'email'=>$UserEmail,'phone'=>$UserPhone, 'dob'=>$DOB, 'password'=>$UserPassword);

      //push to data
      array_push($user_array['data'],$user_item);
    }

    //convert to json
    echo json_encode($user_array);

  }
  else {
    $nouser = array('message' => 'no users yet');
    echo json_encode($nouser);
  }
?>
