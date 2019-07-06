<?php

  //headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Methods, Content-Type, Authorization, X-Requested-With');

  //import file
  include_once '/var/www/html/Template/config/database.php';
  include_once '/var/www/html/Template/models/user.php';

  //Instantiate DB and connect
  $database = new database();
  $db = $database->connect();

  //Instantiate user with Constructor
  $user = new user($db);

  //Get Raw Data
  $data = json_decode(file_get_contents("php://input"));

  $user->id = $data->id;
  $user->UserName = $data->name;
  $user->UserEmail = $data->email;
  $user->UserPhone = $data->phone;
  $user->DOB = $data->dob;
  $user->UserPassword = $data->password;

  //send response
  if($user->update()){
    echo json_encode(array('message'=>'update success'));
  }
  else {
    echo json_encode(array('message'=>'update fail'));
  }
?>
