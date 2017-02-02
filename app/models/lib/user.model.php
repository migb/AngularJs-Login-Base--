<?php
/**
 * User class, manipulate all user processes
 *Call to conexion Class
 */
require_once('connectionString.php');
class User
{
  public function loginUser($_user, $_password){
    //This function validate form data. if exist, it will create a login token for the targeted user and return it
    $username = htmlspecialchars(addslashes($_user));
    $password = sha1($_password);
    //Create a new connection object
    $db = new ConnectionString();

    //Execute databse query, asking if the user exists
    $verify_query = $db->query("SELECT U.userID FROM user AS U WHERE U.userName = '{$username}' AND U.userPassword = '{$password}';");

    //Evaluate query result
    if($verify_query){
      if($db->rows($verify_query) == 1){
        //Generate Token
        $token = time(). "-" . uniqid();
        //Save token into the database (this means the user is logged)
        $set_token = $db->query("UPDATE user AS U SET U.userToken = '{$token}' WHERE U.userName = '{$username}' AND U.userPassword = '{$password}';");

        //validate if the token was saved
        if($set_token){
          $response = array(
            "status" => 200,
            "message"=> "OK",
            "token" => $token
          );
          //Start session in the server-side
          session_start();
          $_SESSION['userToken'] = $token;
          $_SESSION['userName'] = $username;

          return json_encode($response);
        }else{

          $response = array(
            "status" => 500,
            "message"=> "INTERNAL SERVER ERROR"
          );
          return json_encode($response);
        }
      }else{

        $response = array(
          "status" => 200,
          "message"=> "WRONG DATA"
        );
          return json_encode($response);
      }
    }

    $db->close();
  }

  public function validateSession($_token){
    session_start();
    $db = new ConnectionString();
    $token = htmlspecialchars(addslashes($_token));

    $tokenExist = $db->rows($db->query("SELECT U.userToken FROM user AS U WHERE U.userToken = '{$token}';"));

    if($tokenExist == 1 && isset($_SESSION["userToken"]) && $_SESSION["userToken"] == $token){
        return json_encode(array('state'=>true));
    }else{
      return json_encode(array('state'=>false));
    }
  }

  public function getUsername($_token){
    $db = new ConnectionString();
    $token = htmlspecialchars(addslashes($_token));

    $username_query = $db->toArray($db->query("SELECT U.userName FROM user AS U WHERE U.userToken = '{$token}';"));
    $username = $username_query['userName'];
    $user_info = array("username"=>$username,
                       "status"=> 200);
    return json_encode($user_info);
  }


}

?>
