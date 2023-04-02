<?php
require 'includes/init.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    
    if(isset($_GET['code'])){
        if (strcmp($_GET['code'], $match) != 0){
            //header('Location: logout.php');

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
    <div>
        <form method="GET">
            <label for="code">Enter the code sent to your email</label>
            <input type="text" id="code" name="code" spellcheck="false" placeholder="Enter code" required>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>