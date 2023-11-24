<?php
$from_id = trim(@$_POST['from_id']);
$to_id = trim(@$_POST['to_id']);
$text = trim(@$_POST['text']);

// Create connection
$mysql = new mysqli('localhost', 'root', 'YES', 'services');

// Check connection
if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

// Prepare your SQL statement
$query = "INSERT INTO messages (from_id, to_id, text) VALUES (?, ?, ?)";

// Prepare statement
$stmt = $mysql->prepare($query);

// Check if the statement was prepared correctly
if (false === $stmt) {
    die('prepare() failed: ' . htmlspecialchars($mysql->error));
}

// Bind parameters
$bind = $stmt->bind_param("sss", $from_id, $to_id, $text);

// Check if parameters were bound correctly
if (false === $bind) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

// Execute query
$execute = $stmt->execute();

// Check if execute was successful
if (false === $execute) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

// Close statement and connection
$stmt->close();
$mysql->close();
?>