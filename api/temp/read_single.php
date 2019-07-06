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

  //Get id
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  //Get the data
  $user->read_single();

  //create array and send the data
  $user_array = array('id' => $user->id, 'name' => $user->UserName, 'email' => $user->UserEmail, 'phone' => $user->UserPhone, 'dob' => $user->DOB, 'password' => $user->UserPassword );

  //encode the array ane echo
  echo json_encode($user_array);

?>
