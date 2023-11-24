<?php
$id = trim(@$_POST['id']);
$model = trim(@$_POST['model']);
$name = trim(@$_POST['name']);
$price = trim(@$_POST['price']);
$description = trim(@$_POST['description']);

$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$query = "INSERT INTO busin (id_busin, model_busin, name_busin, price_busin, description_busin) 
          VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE 
          model_busin = VALUES(model_busin), 
          name_busin = VALUES(name_busin), 
          price_busin = VALUES(price_busin), 
          description_busin = VALUES(description_busin)";

$stmt = $mysql->prepare($query);

$stmt->bind_param("issss", $id, $model, $name, $price, $description);

$stmt->execute();

$stmt->close();
$mysql->close();
?>