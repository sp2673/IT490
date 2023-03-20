<?php
session_start(); 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

/*

$username = "";
$errors = array();

$fp = fsockopen(192.168.2.135,80,$errno,$errstr,30);
if (!$fp){
	$ini = "testRabbitMQ.ini"
   }
   else{
	$ini = "HSBRabbitMQ.ini"
    }
*/
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
echo "authenticate BEGIN".PHP_EOL;

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

//LOGIN
if (isset($_POST['login_user'])) {
	$request = array();
	$request['type']     = "Login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message']  = $msg;

	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==0){
		array_push($errors, "Wrong username/password combination");	
	}
	if ($response != null){  
				
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		$_SESSION['json'] = json_decode($response);
		header('location: index.php');
	}
}
//Show Profile Info
if (isset($_POST['view'])){
	$request = array();
	$request['type']       = "ViewInfo";
	$request['username']   = $_POST["username"];

	$response = $client->send_request($request);
	echo "client received response";
	print_r($response);
	if ($response != null){
		$_SESSION['json'] = $response;
		header('location: index.php');
	}
	//return $response;
}

//REGISTER
if (isset($_POST['reg_user'])) {
	$request = array();
	$request['type']       = "Register";
	$request['username']   = $_POST["username"];
        $request['email']      = $_POST["email"];
	$request['password_1'] = $_POST["password_1"];
	$request['password_2'] = $_POST["password_2"];
	if ($request['password_1'] != $request['password_2']) {  
		array_push($errors, "Passwords don't match");	
	}
	else { $response = $client->send_request($request); }
	//$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);
	
	if ($response==1){
		echo "<strong>New User Registered</strong>";
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		header('location: profile.php');	
	}
	else{ array_push($errors, "User already exists"); }
}
