

Author: Chandan Tudu, Corey McPherson
Date: 5/8/2023
Facebook Style Friend Request System
Version 1.0.0
Source Code
Url: https://www.w3jar.com/friend-request-system-in-php-pdo/#comments

<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("Location: index.php");
exit;
