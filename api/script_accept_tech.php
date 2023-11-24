<?php
$id = trim(@$_POST['id_tech']);
$model = trim(@$_POST['model_tech']);
$name = trim(@$_POST['name_tech']);
$assets = trim(@$_POST['it_assets_tech']);

$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$query = "INSERT INTO tech (id_tech, model_tech, name_tech, it_assets_tech) 
          VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
          model_tech = VALUES(model_tech), 
          name_tech = VALUES(name_tech), 
          it_assets_tech = VALUES(it_assets_tech)";

$stmt = $mysql->prepare($query);

$stmt->bind_param("isss", $id, $model, $name, $assets);

$stmt->execute();

$stmt->close();
$mysql->close();
?>