<?php
/*
*All data sent via XHR will be manipulated by this script
*/
//Define security hash to prevent fake petitions
define("_SECURE_HASH_", "XHR");
//Get target model
if(isset($_GET['r'])){
  $request = $_GET['r'];
}
else{
  $request = "";
}

//Load required classes
require_once("lib/user.model.php");

switch ($request) {
  case "login":
    //Get object and decode it
    //Contains: username, password
    $post = json_decode(file_get_contents("php://input"));
    $obj = new User();
    echo $obj->loginUser($post->username, $post->password);
    break;
  case "validate-session":
    //Get object and decode it
    //Contains: token
    $post = json_decode(file_get_contents("php://input"));
    $obj = new User();
    echo $obj->validateSession($post->token);
    break;
  case "get-username":
    //Get object and decode it
    //Contains: token
    $post = json_decode(file_get_contents("php://input"));
    $obj = new User();
    echo $obj->getUsername($post->token);
    break;
  default:
    echo "";
    break;
}

 ?>
