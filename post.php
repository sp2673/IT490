<?php
// Connect to the database
$dbhost = 'localhost';
$dbname = 'users';
$dbuser = 'testuser';
$dbpass = '12345';
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Insert the message into the database
$username = $_POST['username'];
$message = $_POST['message'];
$stmt = $db->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':message', $message);
$stmt->execute();

// Redirect back to the messaging board
header('Location: index.php');
?>
