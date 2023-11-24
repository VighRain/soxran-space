<?php
$id = trim(@$_POST['id_busin']);

$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$result = $mysql->query("DELETE FROM busin WHERE id_busin='$id'");

$mysql->close();
?>