Author: Chandan Tudu, Corey McPherson
Date: 5/8/2023
Facebook Style Friend Request System
Version 1.0.0
Source Code
Url: https://www.w3jar.com/friend-request-system-in-php-pdo/

<?php
require 'includes/init.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    
    if(isset($GET['code'])){
        $code = $_GET['code'];
        $res = matchCode($code);
        if(!$res){
            header('Location: logout.php');
            exit;
        }
        else{
            header('Location: profile.php');
            exit;
        }
    }

}
else{
    header('Location: logout.php');
    exit;
}
?>
