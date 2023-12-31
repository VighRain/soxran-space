<?php
if (!@$_COOKIE['user']) {
    header('Location: acc/main.php');
    die();
}
?>

<style>
    .header-site {
        background-color: #E9E9E9;
    }
</style>
<header class="header-site">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Service</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="requests.php">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">Messages</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $_COOKIE['user']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="acc/logout.php">Exit</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>