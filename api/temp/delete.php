<?php

  //headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  //send response
  if($user->delete()){
    echo json_encode(array('message'=>'delete success'));
  }
  else {
    echo json_encode(array('message'=>'delete fail'));
  }
?>
