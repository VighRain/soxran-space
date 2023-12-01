<?php
$mysql = new mysqli('localhost', 'root', 'YES', 'services');

if ($mysql->connect_error) {
    die("Ошибка соединения: " . $mysql->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = $mysql->real_escape_string($email);
    $password = $mysql->real_escape_string($password);

    $query = "SELECT * FROM user WHERE email_user='$email' AND pass_user='$password'";

    $result = $mysql->query($query);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result);
        setcookie("user", $email, time() + 60 * 60 * 24 * 30, '/');
        setcookie("role", $row['role_user'], time() + 60 * 60 * 24 * 30, '/');
        header('Location: ../index.php');
        die();
    } else {
        header('Location: main.php?error=user_not_found');
        die();
    }

    $result->free_result();
} else {
    echo "Ошибка: Неверный метод запроса!";
}

$mysql->close();
?>