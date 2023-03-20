<?php 
require 'includes/init.php';
include('Client.php'); 

// IF USER MAKING SIGNUP REQUEST
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
  $result = $user_obj->signUpUser($_POST['username'],$_POST['email'],$_POST['password']);
}
// IF USER ALREADY LOGGED IN
if(isset($_SESSION['email'])){
  header('Location: profile.php');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Pound per Day Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
      <h2>Register</h2>
  </div>
    
  <form method="post" action="register.php">
      <?php include('errors.php'); ?>
      
    <div class="input-group">
        <label>Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required autofocus   autocomplete=off>
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" id="email" name="email" placeholder="Enter email" required autofocus   autocomplete=off>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" id="password" name="password_1" placeholder="Password" required autofocus   autocomplete=off>
      </div>
      <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2" placeholder="Re-type password" required autofocus   autocomplete=off>
      </div>
      
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user" value="Sign Up">Register</button>
      </div>
      <p>
          Already a member? <a href="login.php">Login</a>
      </p>
  </form>
  <div>  
      <?php
        if(isset($result['errorMessage'])){
          echo '<p class="errorMsg">'.$result['errorMessage'].'</p>';
        }
        if(isset($result['successMessage'])){
          echo '<p class="successMsg">'.$result['successMessage'].'</p>';
        }
      ?>    
    </div>
</body>
</html>