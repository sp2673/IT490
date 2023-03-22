<?php
include "post.css";
// Connect to the database
$dbhost = 'localhost';
$dbname = 'users';
$dbuser = 'testuser';
$dbpass = '12345';
$db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

// Retrieve the messages from the database
$stmt = $db->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the messages
foreach ($messages as $message) {
  echo '<div class="message">';
  echo '<p><strong>' . htmlspecialchars($message['username']) . '</strong> ' . htmlspecialchars($message['message']) . '</p>';
  echo '<p class="date">' . htmlspecialchars($message['created_at']) . '</p>';
  echo '</div>';
}
?>
