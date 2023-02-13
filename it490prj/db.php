
<?php
// Database connection settings
$host = '192.0.0.1';
$user = 'root';
$pass = '1234';
$db = 'users';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

function getDB(){
    global $mysqli;
    return $mysqli;
}