<?php 
require 'includes/init.php';
include 'includes/ChromePhp.php';
include('client.php');

// IF USER MAKING LOGIN REQUEST
if(isset($_POST['email']) && isset($_POST['password'])){
  $result = $user_obj->loginUser($_POST['email'],$_POST['password']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: profile.php');
  exit;
}

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/Logs/genLog.txt'); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
      <h2>Login</h2>
  </div>
     
  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
      
    <div class="input-group">
          <label>Email</label>
          <input type="email" id="email" name="email" spellcheck="false" placeholder="Enter your email address" required>
      </div> 
    <div class="input-group">
          <label>Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
      </div>
      
    <div class="input-group">
          <button type="submit" class="btn" name="login_user" value="Login">Login</button>
      </div>
      <p>
          Register new user <a href="register.php">Register</a>
      </p>
  </form>
</body>
</html>