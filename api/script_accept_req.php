<?php

$id_req = isset($_POST['id_req']) ? trim($_POST['id_req']) : null;

$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}

$rowCount = 0;
if ($id_req) {
    $stmt = $mysql->prepare("SELECT * FROM req WHERE id_req = ?");
    $stmt->bind_param("i", $id_req);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowCount = $result->num_rows;
}

if ($rowCount > 0) {
    $updateQuery = "UPDATE req SET ";
    $params = array();
    $types = "";

    foreach ($_POST as $key => $value) {
        if ($value !== "" && $key !== "id") {
            $updateQuery .= "$key = ?, ";
            $params[] = $value;
            $types .= "s";
        }
    }
    $updateQuery = rtrim($updateQuery, ", ");
    $updateQuery .= " WHERE id_req = ?";
    $types .= "i";
    $params[] = $id_req;

    $stmt = $mysql->prepare($updateQuery);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $stmt->close();
} else {
    $insertQuery = "INSERT INTO req (id_req";

    $placeholders = "";
    $values = array($id_req);

    foreach ($_POST as $key => $value) {
        if ($value !== "" && $key !== "id_req") {
            $insertQuery .= ", $key";
            $placeholders .= ", ?";
            $values[] = $value;
        }
    }

    $insertQuery .= ",data_req,status_req) VALUES (?$placeholders,NOW(),'open')";
    $stmt = $mysql->prepare($insertQuery);
    $stmt->bind_param(str_repeat("s", count($values)), ...$values);
    $stmt->execute();
    $stmt->close();
}

$mysql->close();
