<?php
$id = trim(@$_POST['id_tech']);

$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$result = $mysql->query("DELETE FROM tech WHERE id_tech='$id'");

$mysql->close();
?>