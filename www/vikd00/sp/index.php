<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReDrive</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="container">
    <div class="container-content">
        <?php require __DIR__ . '/includes/navbar.php'; ?>
        <?php require __DIR__ . '/includes/spotlight.php'; ?>
        <div class="text-center mt-4">
            <h2>Vyhľadajte svoje vozidlo snov... ReDrive!</h2>
        </div>
        <?php require __DIR__ . '/includes/search-container.php'; ?>
        <footer class="footer fixed-bottom bg-dark d-flex align-items-center">
            <div class="container text-center text-white">
                <p class="m-0">Dávid Vikor 2023 - vikd00@vse.cz</p>
            </div>
        </footer>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>