<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>requests</title>
    <?php include "scripts.php" ?>
</head>

<?php
$mysql = new mysqli('localhost', 'root', 'YES', 'service');

if ($_COOKIE['role'] == 'admin') {
    $result_req = $mysql->query("SELECT * FROM req");
} elseif ($_COOKIE['role'] == 'spec') {
    $result_req = $mysql->query("SELECT * FROM req WHERE responsible_req='" . $_COOKIE['user'] . "' OR responsible_req='" . "" . "'");
} else {
    $result_req = $mysql->query("SELECT * FROM req WHERE contractor_req='" . $_COOKIE['user'] . "'");
}
$result_tech = $mysql->query("SELECT * FROM tech");
$result_busin = $mysql->query("SELECT * FROM busin");

if ($_COOKIE['role'] == 'spec') {
    $result_users = $mysql->query("SELECT * FROM user WHERE email_user = '{$_COOKIE['user']}'");
} else {
    $result_users = $mysql->query("SELECT * FROM user WHERE role_user = 'admin' OR role_user ='spec'");
}

$mysql->close();

$users_to_assign_array = array();
while ($row = mysqli_fetch_array($result_users)) {
    $users_to_assign_array[] = $row;
}


$services = array();
while ($row = mysqli_fetch_array($result_tech)) {
    $services[] = [
        'type' => 'tech',
        'name' => $row['name_tech'],
        'id' => $row['id_tech'],
        'price' => null,
        'descr' => null,
        'it' => $row['it_assets_tech']
    ];
}
while ($row = mysqli_fetch_array($result_busin)) {
    $services[] = [
        'type' => 'busin',
        'name' => $row['name_busin'],
        'id' => $row['id_busin'],
        'price' => $row['price_busin'],
        'descr' => $row['description_busin'],
        'it' => null,
    ];
}

?>

<body>
    <script>
        const services = <?php echo json_encode($services, true) ?>;
    </script>
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

        .bi-eye {
            filter: invert(19%) sepia(94%) saturate(3053%) hue-rotate(239deg) brightness(81%) contrast(100%);
            transform: scale(1.25);
        }
    </style>
    <?php include "header.php" ?>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?php echo @$_GET['tab'] != 'your' ? "show active" : ""; ?>" id="nav-req"
            role="tabpanel" aria-labelledby="nav-req-tab" tabindex="0">
            <div class="bg-body-tertiary border rounded-3">
                <table class="table caption-top one">
                    <caption>
                        <button onclick="clearReqForm()" id="openModalReq" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdropReq">Добавить</button>
                        <div class="modal fade" id="staticBackdropReq" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropReqLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropReqLabel">Добавление заявки об
                                            инциденте
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <input id="id_req" name="id_req" type="text" class="form-control" hidden />
                                        <input id="type_req" name="type_req" type="text" class="form-control" hidden />

                                        <input id="theme_req" name="theme_req" type="text" class="form-control"
                                            hidden />
                                        <input id="responsible_req" name="responsible_req" type="text"
                                            class="form-control" hidden />

                                        <div class="input-group mb-3">
                                            <div class='dropdown req'>
                                                <button class='btn btn-secondary dropdown-toggle req' type='button'
                                                    data-bs-toggle='dropdown' aria-expanded='false' id="service_title">
                                                    service
                                                </button>
                                                <ul class='dropdown-menu req'>
                                                    <?php
                                                    foreach ($services as $service) {

                                                        echo <<<HTML
                                                                 <li><button onclick="document.getElementById('type_req').value='{$service['type']}';
                                                                 document.getElementById('theme_req').value='{$service['name']}';
                                                                 document.getElementById('service_title').innerText='{$service['name']}'" class='dropdown-item req'>{$service['name']}</button></li>
                                                        HTML;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="input-group mb-3">
                                            <div class='dropdown req'>
                                                <button class='btn btn-secondary dropdown-toggle req user' type='button'
                                                    data-bs-toggle='dropdown' aria-expanded='false'
                                                    id="responsible_req_title">
                                                    choose user
                                                </button>
                                                <ul class='dropdown-menu req'>
                                                    <?php
                                                    foreach ($users_to_assign_array as $user) {
                                                        echo <<<HTML
                                             <li><button onclick="document.getElementById('responsible_req').value='{$user['email_user']}';
                                             document.getElementById('responsible_req_title').innerText='{$user['email_user']}'" class='dropdown-item req'>{$user['email_user']}</button></li>
                                    HTML;
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                                            <textarea id="description_req" name="description_req" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="Accept_req()">Accept</button>
                                        <script type="text/javascript">
                                            function Accept_req() {
                                                var id_req = $('#id_req')[0].value;
                                                var type_req = $('#type_req')[0].value;
                                                var theme_req = $('#theme_req')[0].value;
                                                var responsible_req = $('#responsible_req')[0].value;


                                                var description_req = $('#description_req')[0].value;
                                                saveReq(
                                                    type_req,
                                                    theme_req,
                                                    responsible_req,


                                                    description_req,
                                                    id_req
                                                )
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">Дата регистрации</th>
                            <th scope="col">#</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Тема</th>
                            <th scope="col">Ответственный</th>
                            <th scope="col">Контрагент</th>
                            <th scope="col">Статус</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $users_to_assign = "";
                        foreach ($users_to_assign_array as $user) {
                            $users_to_assign = $users_to_assign . <<<HTML
                            <li><button onclick="setResponsibleUser('id_req','{$user['email_user']}')" class='dropdown-item req'>{$user['email_user']}</button></li>
                            HTML;
                        }
                        $btn_dis = "";
                        if ($_COOKIE["role"] == 'employee') {
                            $btn_dis = "disabled";
                        }
                        if ($_COOKIE["role"] == 'spec') {
                            ?>
                            <style>
                                .btn.btn-primary {
                                    background: transparent;
                                    border: none !important;
                                    font-size: 0;
                                }
                            </style>
                            <?php
                        }
                        if ($_COOKIE["role"] == 'employee') {
                            ?>
                            <style>
                                .btn.btn-secondary.dropdown-toggle.req.user {
                                    background: transparent;
                                    border: none !important;
                                    font-size: 0;
                                }
                            </style>
                            <?php
                        }
                        ?>

                        <?php
                        while ($row = mysqli_fetch_array($result_req)) {
                            $btn_dis_spec = false;
                            if ($_COOKIE['role'] == 'spec' && $row['responsible_req']) {
                                $btn_dis_spec = "disabled";
                            }
                            $aaaaa = str_replace("id_req", $row['id_req'], $users_to_assign);
                            echo <<<HTML
                            <tr>
                                <th scope='row'>{$row['data_req']}</th>
                                <td>{$row['id_req']}</td>
                                <td>{$row['type_req']}</td>
                                <td>{$row['theme_req']}</td>
                                <td>
                                    <div class='dropdown req'>
                                        <button {$btn_dis} {$btn_dis_spec} class='btn btn-secondary dropdown-toggle req' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            {$row['responsible_req']}
                                        </button>
                                        <ul class='dropdown-menu req'>
                                            {$aaaaa}
                                        </ul>
                                    </div>
                                </td>
                                <td>{$row['contractor_req']}</td>
                                <td>
                                    <div class='dropdown req'>
                                        <button {$btn_dis} class='btn btn-secondary dropdown-toggle req' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            {$row['status_req']}
                                        </button>
                                        <ul class='dropdown-menu req'>
                                        <li><button onclick="setStatus('{$row['id_req']}','open')" class='dropdown-item req'>open</button></li>
                                        <li><button onclick="setStatus('{$row['id_req']}','closed')" class='dropdown-item req'>closed</button></li>
                                        <li><button onclick="setStatus('{$row['id_req']}','declined')" class='dropdown-item req'>declined</button></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <td class="icons">
                                        <svg onclick="openReqInfoModal(
                                            '{$row['id_req']}',
                                            '{$row['data_req']}',
                                            '{$row['type_req']}',
                                            '{$row['theme_req']}',
                                            '{$row['responsible_req']}',
                                            '{$row['contractor_req']}',
                                            '{$row['status_req']}',
                                            '{$row['description_req']}',
                                            )" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </td>
                                </td>
                            </tr>
                            HTML;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function openReqInfoModal(id_req,
            data_req,
            type_req,
            theme_req,
            responsible_req,
            contractor_req,
            status_req,
            description_req) {
            document.getElementById('openModalReqInfo').click();

            services.map(service => {
                if (service.name == theme_req) {
                    if (service.type == 'busin') {
                        $('#info_price')[0].innerText = service.price;
                        $('#info_descr')[0].innerText = service.descr;
                        $('#info_it_assets')[0].innerText = "----";
                    } else {
                        $('#info_price')[0].innerText = "----";
                        $('#info_descr')[0].innerText = "----";
                        $('#info_it_assets')[0].innerText = service.it;
                    }
                }
            })

            $('#info_id_req')[0].innerText = id_req;
            $('#info_data_req')[0].innerText = data_req;
            $('#info_type_req')[0].innerText = type_req;
            $('#info_theme_req')[0].innerText = theme_req;
            $('#info_responsible_req')[0].innerText = responsible_req;
            $('#info_contractor_req')[0].innerText = contractor_req;
            $('#info_status_req')[0].innerText = status_req;
            $('#info_description_req')[0].innerText = description_req;
        }
    </script>

    <button id="openModalReqInfo" type="button" class="d-none btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#staticBackdropReqInfo">ReqInfo</button>
    <div class="modal fade" id="staticBackdropReqInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropReqLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropReqLabel">Информация о заявке
                    </h1>
                </div>
                <style>
                    .div-one {
                        background-color: #DDDDDD;
                        width: 300px;
                        border-radius: 5px;
                        border: 2px solid black;
                        overflow-wrap: break-word;
                    }

                    .div-two {
                        position: relative;
                        background-color: #DDDDDD;
                        width: 300px;
                        top: -430px;
                        left: 310px;
                        border-radius: 5px;
                        border: 2px solid black;
                        overflow-wrap: break-word;
                    }

                    .div-three {
                        position: relative;
                        background-color: #DDDDDD;
                        width: 300px;
                        top: -420px;
                        left: 310px;
                        border-radius: 5px;
                        border: 2px solid black;
                        overflow-wrap: break-word;
                    }

                    .div-four {
                        position: relative;
                        background-color: #DDDDDD;
                        width: 300px;
                        top: -410px;
                        left: 310px;
                        border-radius: 5px;
                        border: 2px solid black;
                        overflow-wrap: break-word;
                    }

                    .div-five {
                        position: absolute;
                        background-color: #DDDDDD;
                        width: 870px;
                        top: 16px;
                        left: 636px;
                        border-radius: 5px;
                        border: 2px solid black;
                        overflow-wrap: break-word;
                    }
                </style>
                <div class="modal-body">
                    <div class="div-one">
                        <h6>Информация:</h6>
                        <p>Номер:
                        <div id="info_id_req"></div>
                        </p>
                        <p>Тема:
                        <div id="info_theme_req"></div>
                        </p>
                        <p>Статус:
                        <div id="info_status_req"></div>
                        </p>
                        <p>Дата создания:
                        <div id="info_data_req"></div>
                        </p>
                        <p>Тип:
                        <div id="info_type_req"></div>
                        </p>
                    </div>
                    <div class="div-two">
                        <h6>Подробности(биз.):</h6>
                        <p>Цена:
                        <div id="info_price"></div>
                        </p>
                        <p>Описание:
                        <div id="info_descr"></div>
                        </p>
                    </div>
                    <div class="div-three">
                        <h6>Подробности(тех.):</h6>
                        <p>ИТ активы:
                        <div id="info_it_assets"></div>
                        </p>
                    </div>
                    <div class="div-four">
                        <h6>Участники:</h6>
                        <p>Ответственный:
                        <div id="info_responsible_req"></div>
                        </p>
                        <p>Контрагент:
                        <div id="info_contractor_req"></div>
                        </p>
                    </div>
                    <div class="div-five">
                        <h6>Описание:</h6>
                        <div id="info_description_req"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let CLEAR_MODEL = true
        function clearReqForm() {
            if (CLEAR_MODEL) {
                $('#id_req')[0].value = "";
                $('#type_req')[0].value = "";
                $('#theme_req')[0].value = "";
                $('#responsible_req')[0].value = "";
                $('#responsible_req_title')[0].value = "";

                $('#status_req')[0].value = "";
                $('#description_req')[0].value = "";
            }
        }
        function saveReq(type, theme, responsible, description, id = "") {
            $.ajax({
                url: "api/script_accept_req.php",
                type: "POST",
                data: "&id_req=" + id + "&type_req=" + type + "&theme_req=" + theme + "&responsible_req=" + responsible + "&contractor_req=<?php echo $_COOKIE['user']; ?>" + "&description_req=" + description,
                success: function () {
                    location.reload();
                }
            });
        }
        function setResponsibleUser(id, email) {
            $.ajax({
                url: "api/script_accept_req.php",
                type: "POST",
                data: "&id_req=" + id + "&responsible_req=" + email,
                success: function () {
                    location.reload();
                }
            });
        }
        function setStatus(id, status) {
            $.ajax({
                url: "api/script_accept_req.php",
                type: "POST",
                data: "&id_req=" + id + "&status_req=" + status,
                success: function () {
                    location.reload();
                }
            });
        }

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const content = document.querySelector('.table.caption-top.one');
            const itemsPerPage = 10;
            let currentPage = 0;
            const items = Array.from(content.getElementsByTagName('tr')).slice(1);
            function showPage(page) {
                const startIndex = page * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                items.forEach((item, index) => {
                    item.classList.toggle('hiddin', index < startIndex || index >= endIndex);
                });
                updateActiveButtonStates();
            }
            function createPageButtons() {
                const totalPages = Math.ceil(items.length / itemsPerPage);
                const paginationContainer = document.createElement('div');
                const paginationDiv = document.body.appendChild(paginationContainer);
                paginationContainer.classList.add('pagination');
                for (let i = 0; i < totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i + 1; pageButton.addEventListener('click', () => {
                        currentPage = i;
                        showPage(currentPage);
                        updateActiveButtonStates();
                    });

                    content.appendChild(paginationContainer);
                    paginationDiv.appendChild(pageButton);
                }
            }
            function updateActiveButtonStates() {
                const pageButtons = document.querySelectorAll('.pagination button');
                pageButtons.forEach((button, index) => {
                    if (index === currentPage) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });
            }
            createPageButtons();
            showPage(currentPage);
        });
    </script>

    <style>
        .pagination,
        .pagination_tech {

            margin-top: 20px;
        }

        .pagination button,
        .pagination_tech button {
            padding: 5px 10px;
            margin: 0 5px;
            cursor: pointer;
            outline: 1px solid #494a4f;
            border-radius: 1px;
            border: none;
        }

        .hiddin {
            clip: rect(0 0 0 0);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .pagination button.active,
        .pagination_tech button.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</body>

</html>