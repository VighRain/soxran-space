<?php
$from_id = trim(@$_POST['from_id']);
$to_id = trim(@$_POST['to_id']);
$text = trim(@$_POST['text']);

$mysql = new mysqli('localhost', 'root', 'YES', 'service');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$query = "INSERT INTO messages (from_id, to_id, text) VALUES (?, ?, ?)";

$stmt = $mysql->prepare($query);

if (false === $stmt) {
    die('prepare() failed: ' . htmlspecialchars($mysql->error));
}

$bind = $stmt->bind_param("sss", $from_id, $to_id, $text);

if (false === $bind) {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}

$execute = $stmt->execute();

if (false === $execute) {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
}

$stmt->close();
$mysql->close();
?>