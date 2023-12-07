<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>messages</title>
    <?php include "scripts.php" ?>
</head>

<body>
    <style>
        .nav-item.dropdown {
            position: absolute;
            right: 0px;
        }

        .dropdown-item {
            text-align: right;
        }

        .dropdown-menu {
            min-width: 90px;
        }

        .btn-primary {
            float: right;
        }

        .icons {
            text-align: center;
        }

        .bi-pencil-square {
            filter: invert(19%) sepia(94%) saturate(3053%) hue-rotate(239deg) brightness(81%) contrast(100%);
        }

        .bi-trash3 {
            filter: invert(24%) sepia(98%) saturate(3318%) hue-rotate(3deg) brightness(104%) contrast(105%);
        }
    </style>
    <style>
        .message-in {
            text-align: left;
        }

        .message-out {
            text-align: right;
        }

        .message {
            background-color: lightgrey;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 10px;
            display: inline-block;
            max-width: 80%;
        }
    </style>
    <?php include "header.php" ?>
    <?php
    $selected_conv = $_GET['id'] ?? "";
    $current_user_id = $_COOKIE['user'];



    $mysql = new mysqli('localhost', 'root', 'YES', 'service');


    $result_users = $mysql->query("SELECT * FROM user WHERE role_user = 'admin' OR role_user ='employee' OR role_user ='spec'");


    $users = array();
    while ($row = mysqli_fetch_array($result_users)) {
        $users[] = $row;
    }

    if ($selected_conv) {

        $messages = $mysql->query("SELECT * FROM messages WHERE (to_id='{$current_user_id}' AND from_id='{$selected_conv}') OR (from_id='{$current_user_id}' AND to_id='{$selected_conv}')");

    }


    $mysql->close();
    ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group">
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <a href="?id=<?php echo $user['email_user']; ?>"
                            class="list-group-item list-group-item-action <?php echo $selected_conv == $user['email_user'] ? "active" : ""; ?>">
                            <?php echo $user['email_user']; ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="border rounded p-3 mb-3" style="height: 400px; overflow-y: auto;">
                    <?php
                    if (!$selected_conv) {
                        echo "choose conversation";
                    } else {
                        while ($row = mysqli_fetch_array($messages)) {

                            ?>
                            <div class="<?php echo $row['from_id'] == $current_user_id ? "message-out" : "message-in" ?>"><span
                                    class="message">
                                    <?php echo $row['text']; ?>
                                </span></div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="input-group">
                    <input id="msg" type="text" class="form-control" placeholder="Enter message...">
                    <div class="input-group-append">
                        <button onclick="sendMessage()" class="btn btn-primary" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function sendMessage() {
            <?php if ($selected_conv) { ?>
                var from_id = '<?php echo $current_user_id; ?>';
                var to_id = '<?php echo $selected_conv; ?>';
                var text = $("#msg")[0].value;

                $.ajax({
                    url: "api/send_message.php",
                    type: "POST",
                    data: "&from_id=" + from_id + "&to_id=" + to_id + "&text=" + text,
                    success: function () {
                        fetch(location.href).then(data => data.text()).then(data => {
                            document.getElementsByTagName('html')[0].innerHTML = data;
                        });

                    }
                });
            <?php } ?>
        }
    </script>
</body>

</html>