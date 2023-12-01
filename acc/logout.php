<?php

setcookie('user', '', -1, '/');
setcookie('role', '', -1, '/');
header('Location: main.php');
die();