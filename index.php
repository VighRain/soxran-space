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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>

<?php
$mysql = new mysqli('localhost', 'root', 'YES', 'services');
$result_busin = $mysql->query("SELECT * FROM busin");
$result_tech = $mysql->query("SELECT * FROM tech");
$mysql->close();
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
    <?php include "header.php" ?>
    <div>
        <p> Здравствуйте, пользователь! <br> Ознакомтесь с предоставляемыми компанией услугами. </p>
    </div>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button onclick='window.history.pushState({},"","?tab=business")' href="#Yes-info"
                class="nav-link <?php echo @$_GET['tab'] != 'technical' ? "active" : ""; ?>" id="nav-busin-tab"
                data-bs-toggle="tab" data-bs-target="#nav-busin" type="button" role="tab" aria-controls="nav-busin"
                aria-selectedу="true">Business</button>
            <button onclick='window.history.pushState({},"","?tab=technical")' href="#No-info"
                class="nav-link <?php echo @$_GET['tab'] == 'technical' ? "active" : ""; ?>" id="nav-tech-tab"
                data-bs-toggle="tab" data-bs-target="#nav-tech" type="button" role="tab" aria-controls="nav-tech"
                aria-selected="false">Technical</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?php echo @$_GET['tab'] != 'technical' ? "show active" : ""; ?>" id="nav-busin"
            role="tabpanel" aria-labelledby="nav-busin-tab" tabindex="0">
            <div class="bg-body-tertiary border rounded-3">
                <table class="table caption-top one">
                    <caption>
                        <button onclick="clearBusinForm()" id="openModalBusin" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdropBusin">Добавить</button>
                        <div class="modal fade" id="staticBackdropBusin" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropBusinLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropBusinLabel">Добавление бизнес
                                            услуги
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <input id="id_busin" name="id_busin" type="text" class="form-control" hidden>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Модель</span>
                                            <input id="model_busin" name="model_busin" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-default">Наименование</span>
                                            <input id="name_busin" name="name_busin" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Цена</span>
                                            <input id="price_busin" name="price_busin" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Описание</label>
                                            <textarea id="description_busin" name="description_busin"
                                                class="form-control" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="Accept_busin()">Accept</button>
                                        <script type="text/javascript">
                                            function Accept_busin() {
                                                var id_busin = $('#id_busin')[0].value;
                                                var model_busin = $('#model_busin')[0].value;
                                                var name_busin = $('#name_busin')[0].value;
                                                var price_busin = $('#price_busin')[0].value;
                                                var description_busin = $('#description_busin')[0].value;
                                                saveBusinIncident(model_busin, name_busin, price_busin, description_busin, id_busin)
                                            }
                                        </script>
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
                        while ($row = mysqli_fetch_array($result_busin)) {
                            echo "<tr><th scope='row'>" . $row['id_busin']
                                . "</th><td>" . $row['model_busin'] . "</td><td>"
                                . $row['name_busin'] . "</td><td>" . $row['price_busin']
                                . "</td><td>" . $row['description_busin'] . "</td>"
                                . '<td class="icons"> <svg onclick="editBusinIncident(\'' . $row['id_busin'] . '\',\'' . $row['model_busin'] . '\',\'' . $row['name_busin'] . '\',\'' . $row['price_busin'] . '\',\'' . $row['description_busin'] . '\')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
                                fill="currentColor" class="bi bi-pencil-square" 
                                viewBox="0 0 16 16"> <path 
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 
                                1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 
                                .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /> 
                                <path fill-rule="evenodd" 
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 
                                1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg> <svg onclick="deleteBusinIncident(\'' . $row['id_busin'] . '\')" xmlns="http://www.w3.org/2000/svg" valign="middle" width="20" height="20" 
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
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade <?php echo @$_GET['tab'] == 'technical' ? "show active" : ""; ?>" id="nav-tech"
            role="tabpanel" aria-labelledby="nav-tech-tab" tabindex="0">
            <div class="bg-body-tertiary border rounded-3">
                <table class="table caption-top two">
                    <caption>
                        <button onclick="clearTechForm()" id="openModalTech" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdropTech">Добавить</button>
                        <div class="modal fade" id="staticBackdropTech" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropTechLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropTechLabel">Добавление технической
                                            услуги
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <input id="id_tech" name="id_tech" type="text" class="form-control" hidden>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Модель</span>
                                            <input id="model_tech" name="model_tech" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-default">Наименование</span>
                                            <input id="name_tech" name="name_tech" type="text" class="form-control"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label">ИТ-активы</label>
                                            <textarea id="it_assets_tech" name="it_assets_tech" class="form-control"
                                                id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="Accept_tech()">Accept</button>
                                        <script type="text/javascript">
                                            function Accept_tech() {
                                                var id_tech = $('#id_tech')[0].value;
                                                var model_tech = $('#model_tech')[0].value;
                                                var name_tech = $('#name_tech')[0].value;
                                                var it_assets_tech = $('#it_assets_tech')[0].value;
                                                saveTechIncident(model_tech, name_tech, it_assets_tech, id_tech)
                                            }
                                        </script>
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
                            <th scope="col">ИТ активы</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result_tech)) {
                            echo "<tr><th scope='row'>" . $row['id_tech']
                                . "</th><td>" . $row['model_tech'] . "</td><td>"
                                . $row['name_tech'] . "</td><td>" . $row['it_assets_tech'] . "</td>"
                                . '<td class="icons"> <svg onclick="editTechIncident(\'' . $row['id_tech'] . '\',\'' . $row['model_tech'] . '\',\'' . $row['name_tech'] . '\',\'' . $row['it_assets_tech'] . '\')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" 
                                fill="currentColor" class="bi bi-pencil-square" 
                                viewBox="0 0 16 16"> <path 
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 
                                1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 
                                .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" /> 
                                <path fill-rule="evenodd" 
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 
                                1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg> <svg onclick="deleteTechIncident(\'' . $row['id_tech'] . '\')" xmlns="http://www.w3.org/2000/svg" valign="middle" width="20" height="20" 
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function deleteBusinIncident(id_busin) {
            $.ajax({
                url: "api/script_delete_busin.php",
                type: "POST",
                data: "&id_busin=" + id_busin,
                success: function () {
                    location.reload();
                }
            });
        }
        function deleteTechIncident(id_tech) {
            $.ajax({
                url: "api/script_delete_tech.php",
                type: "POST",
                data: "&id_tech=" + id_tech,
                success: function () {
                    location.reload();
                }
            });
        }
    </script>
    <script>
        let CLEAR_MODEL = true
        function editBusinIncident(id_busin, model_busin, name_busin, price_busin, description_busin) {
            $('#id_busin')[0].value = id_busin;
            $('#model_busin')[0].value = model_busin;
            $('#name_busin')[0].value = name_busin;
            $('#price_busin')[0].value = price_busin;
            $('#description_busin')[0].value = description_busin;
            CLEAR_MODEL = false
            $("#openModalBusin").click()
            CLEAR_MODEL = true
        }
        function clearBusinForm() {
            if (CLEAR_MODEL) {
                $('#id_busin')[0].value = "";
                $('#model_busin')[0].value = "";
                $('#name_busin')[0].value = "";
                $('#price_busin')[0].value = "";
                $('#description_busin')[0].value = "";
            }
        }
        function saveBusinIncident(model_busin, name_busin, price_busin, description_busin, id_busin = "") {
            $.ajax({
                url: "api/script_accept_busin.php",
                type: "POST",
                data: "&model_busin=" + model_busin + "&name_busin=" + name_busin + "&price_busin=" + price_busin + "&description_busin=" + description_busin + "&id_busin=" + id_busin,
                success: function () {
                    location.reload();
                }
            });
        }
        function editTechIncident(id_tech, model_tech, name_tech, it_assets_tech) {
            $('#id_tech')[0].value = id_tech;
            $('#model_tech')[0].value = model_tech;
            $('#name_tech')[0].value = name_tech;
            $('#it_assets_tech')[0].value = it_assets_tech;
            CLEAR_MODEL = false
            $("#openModalTech").click()
            CLEAR_MODEL = true
        }
        function clearTechForm() {
            if (CLEAR_MODEL) {
                $('#id_tech')[0].value = "";
                $('#model_tech')[0].value = "";
                $('#name_tech')[0].value = "";
                $('#it_assets_tech')[0].value = "";
            }
        }
        function saveTechIncident(model_tech, name_tech, it_assets_tech, id_tech = "") {
            $.ajax({
                url: "api/script_accept_tech.php",
                type: "POST",
                data: "&model_tech=" + model_tech + "&name_tech=" + name_tech + "&it_assets_tech=" + it_assets_tech + "&id_tech=" + id_tech,
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const content = document.querySelector('.table.caption-top.two');
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
                paginationContainer.classList.add('pagination_tech');
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
                const pageButtons = document.querySelectorAll('.pagination_tech button');
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

        afk
    </style>

</body>

</html>