<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class=" navbar-brand" href="./."><img class="logo-xsmall d-inline-block align-text-top me-2" src="./redrive_logo_text.png" /></a>
        <div class="d-flex justify-content-center flex-grow-1">
            <form class="d-flex w-100" method="GET" action="./ads.php">
                <input name="searchQuery" class="form-control me-2" type="search" placeholder="Vyhľadať vozidlo..." aria-label="Search" oninput="toggleButton(this)">
                <button id="searchButton" class="btn btn-outline-light" type="submit" disabled>Vyhľadať</button>
            </form>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-light text-center" aria-current="page" href="./.">Domov</a>
                    </li>
                    <?php if (isAdmin()) : ?>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-light text-center" href="./admin-edit-ads.php">Správa inzerátov</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-light text-center" href="./admin-edit-users.php">Správa používateľov</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isLoggedIn()) : ?>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-light text-center" href="./chat.php">Chat</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link text-light text-center" href="./ad-create.php">Nový inzerát</a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <i><a class="nav-link text-light text-center" href="./profile.php"><?php echo $_SESSION['user']['xname']; ?></a></i>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item d-flex align-items-center">
                        <a class="nav-link text-light text-center" href="<?php echo (isLoggedIn()) ? './logout.php' : './login.php'; ?>">
                            <?php echo (isLoggedIn()) ? "Odhlásiť sa" : "Prihlásiť sa"; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleButton(input) {
        var button = document.getElementById("searchButton");
        button.disabled = input.value.trim() === '';
    }
</script>