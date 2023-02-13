<?php 
require('cred.php');
require('db.php');

function authentication($user, $pass){

    $request = array();

    $request = getCred();

    $request['type'] = "Login";
    $request['username'] = $user;
    $request['password'] = $pass;
    
    $params = 
    [":username" => $user, ":pass" => $pass];

    $db = getDB();
    $query = 
        "SELECT EXISTS
        (SELECT * FROM users WHERE username = :user AND password = :pass)";
    
    $stmt = $$db->prepare($query);
    try {
        $stmt->execute($params);
    } catch (Exception $e) {
        echo "Failed.";
    }
    
    
}

function changeCreds($response, $username) { // change session credentials
    $info = json_decode($response, true);
    $_SESSION['username'] = $info['username'];
    $_SESSION['state'] = true;
}
?>