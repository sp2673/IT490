#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

require_once('dbConnection.php');

function doLogin($username,$password)
{
    $connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `account` WHERE username='$username' AND password='$ENCpassword'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***Login successful***\n\n";
      return show($username);
    }  
    else { 
      echo "\n\t***Wrong username/password combination***\n\n";
      return false; 
   }
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>