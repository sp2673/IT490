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