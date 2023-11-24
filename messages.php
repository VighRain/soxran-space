<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
    $current_user_id = 1;
    $tmp_users = [
        [
            "id" => 1,
            "name" => "User 1"
        ],
        [
            "id" => 2,
            "name" => "User 2"
        ],
        [
            "id" => 3,
            "name" => "User 3"
        ],
        [
            "id" => 4,
            "name" => "User 4"
        ],

    ];

    if ($selected_conv) {
        $mysql = new mysqli('localhost', 'root', 'YES', 'services');
        $messages = $mysql->query("SELECT * FROM messages WHERE (to_id={$current_user_id} OR from_id={$current_user_id}) AND (to_id={$selected_conv} OR from_id={$selected_conv})");
        $mysql->close();
    }
    ?>
    <div class="container mt-3">
        <div class="row">
            <!-- People List -->
            <div class="col-md-4">
                <div class="list-group">
                    <?php
                    foreach ($tmp_users as $user) {
                        ?>
                        <a href="?id=<?php echo $user['id']; ?>"
                            class="list-group-item list-group-item-action <?php echo $selected_conv == $user['id'] ? "active" : ""; ?>">
                            <?php echo $user['name']; ?>
                        </a>
                        <?php
                    }
                    ?>
                    <!-- Add more people here -->
                </div>
            </div>

            <!-- Messages Section -->
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
                    <!-- Add more messages here -->
                </div>

                <!-- Message Input -->
                <div class="input-group">
                    <input id="msg" type="text" class="form-control" placeholder="Enter message...">
                    <div class="input-group-append">
                        <button onclick="sendMessage()" class="btn btn-primary" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function sendMessage() {
            <?php if ($selected_conv) { ?>
                var from_id = <?php echo $current_user_id; ?>;
                var to_id = <?php echo $selected_conv; ?>;
                var text = $("#msg")[0].value;

                $.ajax({
                    url: "api/send_message.php",
                    type: "POST",
                    data: "&from_id=" + from_id + "&to_id=" + to_id + "&text=" + text,
                    success: function () {
                        location.reload();
                    }
                });
            <?php } ?>
        }
    </script>
</body>

</html>