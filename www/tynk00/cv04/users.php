<?php
include('header.php');
?>

<body style="background-color: #eeeeee">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>



    <?php

    include 'navbar.php';
    require 'utils.php';


    $users = getAllUsers();
    ?>



    <div class="container row p-5" style="margin: auto">
    <?php if (isset($_GET['success'])) : ?>
        <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="text-success"><i class="fa fa-check" aria-hidden="true"> </i> Přihlášení bylo úspěšné</div>
            
        </div>
    <?php endif; ?>

        <?php foreach ($users as $user) : ?>
            <div class="col-4">

                <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
                    <img src="<?php echo $user->avatar ?>" class="card-img-top" alt="no avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->name ?></h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">E-mail: <?php echo $user->email ?></li>
                            <li class="list-group-item">Telefonní číslo: <?php echo $user->tel ?></li>
                            <li class="list-group-item">Pohlaví:
                                <?php
                                if ($user->sex == "m") echo "muž";
                                if ($user->sex == "f") echo "žena";
                                if ($user->sex == "o") echo "jiné";
                                ?></li>
                            <li class="list-group-item">Název balíčku: <?php echo $user->deckName ?></li>
                            <li class="list-group-item">Počet karet: <?php echo $user->cards ?> </li>
                        </ul>

                    </div>
                </div>

            </div>


        <?php endforeach; ?>

    </div>

</body>

</html>