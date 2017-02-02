<?php
/**
 * Replace the parent constructor of the class with your database info
 */
class ConnectionString extends mysqli
{

  function __construct()
  {
    //Order: Pointer server - Database user - Database user password - Database name
    parent::__construct('127.0.0.1','root','','angularLogin');
  		$this->connect_errno ? die('Error while trying to instance a database connection') : null;
  		$this->set_charset("utf8");
  }

  public function rows($query){
    return mysqli_num_rows($query);
  }

  public function toArray($query){
    return mysqli_fetch_array($query);
  }
}

?>
