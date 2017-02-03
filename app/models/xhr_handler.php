<?php
/*
*All data sent via XHR will be manipulated by this script
*/
//Get target model
if(isset($_GET['r'])){
  $request = $_GET['r'];
}
else{
  $request = "";
}

//Load required classes
require_once("lib/user.model.php");

$post = json_decode(file_get_contents("php://input"));
 if(!empty($post)){
   switch ($request) {
     case "login":
       $obj = new User();
       echo $obj->loginUser($post->username, $post->password);
       break;
     case "validate-session":
       $obj = new User();
       echo $obj->validateSession($post->token);
       break;
     case "get-username":
       $obj = new User();
       echo $obj->getUsername($post->token);
       break;
     case "logout":
       $obj = new User();
       echo $obj->endSession($post->token);
       break;
     default:
       echo "";
       break;
   }
 }else{
   echo "<h1>Forbidden - 403</h1>";
 }

 ?>
