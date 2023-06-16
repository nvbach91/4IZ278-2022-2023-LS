<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Knihovna</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body>
<header class="bg-dark p-5" style="position: relative">
    <div class="d-flex flex-row justify-content-between align-items-center mx-auto" style="max-width: 80vw; gap: 16px">
        <a href="index.php" style="text-decoration: none">
            <div class="container px-4 px-lg-5 my-1 text-center text-white">
                <h1 class="display-4 fw-bolder">Knihovna</h1>
                <p class="lead fw-normal text-white-50 mb-0">Semestrální práce na 4IZ278</p>
            </div>
        </a>
        <div class="d-inline-flex flex-row flex-wrap btn-group">
            <?php if (intval($_SESSION["userType"] ?? 0) >= 3): ?>
                <a href="edit-book.php" class="btn btn-outline-info">Přidat knihu</a>
            <?php endif;
            if (intval($_SESSION["userType"] ?? 0) >= 2): ?>
                <a href="branch.php" class="btn btn-outline-info">Pobočka</a>
            <?php endif;
            if (empty($_SESSION["userEmail"])): ?>
                <a href="login.php" class="btn btn-outline-info">Přihlásit</a>
                <a href="register.php" class="btn btn-outline-info">Registrovat</a>
            <?php else: ?>
                <a href="profile.php" class="btn btn-outline-info">Profil</a>
                <a href="logout.php" class="btn btn-outline-info">Odhlásit</a>
            <?php endif ?>
        </div>
    </div>
</header>
