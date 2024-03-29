<?php
session_start();
session_regenerate_id(true);
ini_set('max_input_vars', 3000);

require 'classes/database.php';
require 'classes/user.php';
require 'classes/friend.php';


// DATABASE CONNECTIONS
$db = new Database();
$db_connection = $db->dbConnection();

// USER OBJECT
$user_obj = new User($db_connection);
// FRIEND OBJECT
$frnd_obj = new Friend($db_connection);