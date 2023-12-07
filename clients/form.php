<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>



<body>
    <?php


    $mysql = new mysqli('localhost', 'root', 'YES', 'service');

    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    }

    $result_busin = $mysql->query("SELECT * FROM busin");
    $services = array();
    while ($row = mysqli_fetch_array($result_busin)) {
        $services[] = [
            'type' => 'busin',
            'name' => $row['name_busin'],
            'id' => $row['id_busin'],
        ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $query = "INSERT INTO req (
        data_req,
        type_req,
        theme_req,
        contractor_req,
        status_req,
        description_req) 
        VALUES (NOW(), 'busin', ?, ?, 'open',?)";

        $stmt = $mysql->prepare($query);

        $c = $_POST['name'] . ' ' . $_POST['email'];
        $stmt->bind_param("sss", $_POST['service'], $c, $_POST['descr']);

        $stmt->execute();

        $stmt->close();

        echo "sent";
        die();
    }


    ?>
    <h1>Форма тех. поддержки</h1>
    <p>Уважаемый Клиент! <br> Заполните размещённые ниже формы для отправки заявки в тех. поддержку.</p>
    <form action="" method="post" class="row g-3">
        <div class="col-md-6">
            <label for="inputName4" class="form-label">Name</label>
            <input name="name" type="name" class="form-control" id="inputName4">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-4">
            <label for="inputServices" class="form-label">Services</label>
            <select name="service" id="inputServices" class="form-select">
                <?php
                foreach ($services as $service) {
                    echo <<<HTML
                    <option value="{$service['name']}">{$service['name']}</option>
                    HTML;
                }
                ?>
            </select>
        </div>
        <div class="col-12">
            <label for="inputDesc" class="form-label">Description</label>
            <textarea name="descr" type="text" class="form-control" id="inputDesc" placeholder="Описание"></textarea>
        </div>
        <div class="col-12">
            <button id="Send" type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</body>

</html>