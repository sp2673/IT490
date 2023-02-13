<?php

/* Database connection settings */
$host = '127.0.0.1';
$user = 'testuser';
$pass = '12345';
$db = 'testdb';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
?>

// idea for authentication with the database. 
// searching the database for two truths: one being the username and
// the other as the password. Must be in the same row to be valid.

foreach($user as $credentials) {
    $sql = "SELECT COUNT(*) AS count
            FROM   USERS
            WHERE      userid = $uid
                   AND passw = $password
    $row = ...$sql

    if ($row['count'] == 0) {
        return false;
    }
}
return true;