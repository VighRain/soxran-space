<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="signupFrm">
        <form action="login.php" method="post" class="form">
            <h1 class="title">Log in</h1>
            <?php
            if (@$_GET['error']) {
                echo '<h3 style="color: red;">' . $_GET['error'] . '</h3>';
            }
            ?>

            <div class="inputContainer">
                <input id="email" type="text" class="input" placeholder="a" name="email">
                <label for="email" class="label">Email</label>
            </div>

            <div class="inputContainer">
                <input id="password" type="text" class="input" placeholder="a" name="password">
                <label for="password" class="label">Password</label>
            </div>

            <input type="submit" class="submitBtn" value="Log in">
        </form>
    </div>
</body>

</html>