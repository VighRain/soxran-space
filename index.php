<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Основная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<?php
$mysql = new mysqli('localhost', 'root', 'YES', 'services');
$result = $mysql->query("SELECT * FROM busin");
?>

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
    <header class="header-site">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Service</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!-- active and current = page -->
                            <a class="nav-link active" aria-current="page" href="requests.php">Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="messages.php">Messages</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Exit</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div>
        <p> Здравствуйте, пользователь! <br> Ознакомтесь с предоставляемыми компанией услугами. </p>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-busin-tab" data-bs-toggle="tab" data-bs-target="#nav-busin"
                type="button" role="tab" aria-controls="nav-busin" aria-selected="true">Business</button>
            <button class="nav-link" id="nav-tech-tab" data-bs-toggle="tab" data-bs-target="#nav-tech" type="button"
                role="tab" aria-controls="nav-tech" aria-selected="false">Technical</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-busin" role="tabpanel" aria-labelledby="nav-busin-tab"
            tabindex="0">
            <div class="bg-body-tertiary border rounded-3">
                <table class="table caption-top">
                    <caption>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Добавить</button>
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Добавление бизнес услуги
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Модель</span>
                                            <input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-default">Наименование</span>
                                            <input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Цена</span>
                                            <input type="text" class="form-control" aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Accept</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Модель</th>
                            <th scope="col">Наименования</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Описание</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr><th scope='row'>" . $row['id_busin']
                                . "</th><td>" . $row['model_busin'] . "</td><td>"
                                . $row['name_busin'] . "</td><td>" . $row['price_busin']
                                . "</td><td>" . $row['description_busin'] . "</td>"
                                . '<td class="icons"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
                                fill="currentColor" class="bi bi-pencil-square" 
                                viewBox="0 0 16 16"> <path 
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 
                                1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 
                                .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /> 
                                <path fill-rule="evenodd" 
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 
                                1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg> <svg xmlns="http://www.w3.org/2000/svg" valign="middle" width="20" height="20" 
                                fill="currentColor" 
                                class="bi bi-trash3" viewBox="0 0 16 16"> <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 
                                1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 
                                4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 
                                0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 
                                0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 
                                .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 
                                0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                </svg></td></tr>';
                        }
                        ?>
                        <!-- 11 -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-tech" role="tabpanel" aria-labelledby="nav-tech-tab" tabindex="0">...
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>