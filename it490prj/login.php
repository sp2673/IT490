<?php 

require('autheticateClient.php');
require('db.php');

//$servername = "localhost";
//$user = $_POST['username'];
$user = "students1";
//$passwd = $_POST['password'];
$passwd = "12345";

// Create connection - cited from www.w3schools.com/php/php_mysql_connect.asp 2/13/22
//$conn = new mysqli($servername, $user, $passwd);
$db = getDB();

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

$response = authentication($user, $passwd);

if($response == false){
    echo "Failed to login";
    $_SESSION['message'] = "Check login credentials.";
    //header("location: index.php") // or some error page
}

else {
    echo "Successfully logged in.";
    changeCreds($response, $user);
}
?>