<?php

require('validation.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background-color: #eeeeee">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <div class="container pt-5">
        <form action="." method="post">
            <div class="mb-3">
                <label for="" class="form-label">Celé jméno</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name ?>"></input>
                <div class="text-danger"><?php echo $errors['name'] ?></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Pohlaví</label>
                <select class="form-select" name="sex">
                    <option value="m" <?php echo ($sex == "m") ? "selected" : "a" ?>>Muž</option>
                    <option value="f" <?php echo ($sex == "f") ? "selected" : "b" ?>>Žena</option>
                    <option value="o" <?php echo ($sex == "o") ? "selected" : "c" ?>>Jiné</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>"></input>
                <div class="text-danger"><?php echo $errors['email'] ?></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Telefon</label>
                <input type="tel" class="form-control" name="tel" value="<?php echo $tel ?>"></input>
                <div class="text-danger"><?php echo $errors['tel'] ?></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Profilový obrázek (URL)</label>
                <input type="text" class="form-control" name="avatar" value="<?php echo $avatar ?>"></input>
                <div class="text-danger"><?php echo $errors['avatar'] ?></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Název balíku</label>
                <input type="text" class="form-control" name="deckName" value="<?php echo $deckName ?>"></input>
                <div class="text-danger"><?php echo $errors['deckName'] ?></div>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Počet karet</label>
                <input class="form-control" name="cards" value="<?php echo $cards ?>"></input>
                <div class="text-danger"><?php echo $errors['cards'] ?></div>

            </div>
            <button type="submit" class="btn btn-primary">Odeslat</button>
        </form>
    </div>

    <?php if(!empty($_POST)): ?>


    <div class="container p-5" style="margin: auto">
        <div class="card" style="width: 18rem;">
            <img src="<?php echo $avatar ?>" class="card-img-top" alt="no avatar">
            <div class="card-body">
                <h5 class="card-title"><?php echo $name ?></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">E-mail: <?php echo $email ?></li>
                    <li class="list-group-item">Telefonní číslo: <?php echo $tel ?></li>
                    <li class="list-group-item">Pohlaví: 
                        <?php 
                        if($sex == "m") echo "muž";
                        if($sex == "f") echo "žena";
                        if($sex == "o") echo "jiné";
                        ?></li>
                    <li class="list-group-item">Název balíčku: <?php echo $deckName ?></li>
                    <li class="list-group-item">Počet karet: <?php echo $cards?> </li>
                </ul>

            </div>
        </div>
    </div>
    <?php endif ?>
</body>

</html>