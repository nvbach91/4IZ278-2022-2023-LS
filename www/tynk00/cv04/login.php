<?php


require 'utils.php';

require 'loginFunction.php';

include('header.php');


if (isset($_GET['email'])) {
    $email = $_GET['email'];
}


?>

<body style="background-color: #eeeeee">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <?php include 'navbar.php' ?>

    <div class="container pt-5">

        
        <?php if (isset($_GET['registration'])) : ?>
        <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="text-success"><i class="fa fa-check" aria-hidden="true"> </i> Registrace byla úspěšná</div>
            
        </div>
    <?php endif; ?>


        <?php foreach ($errors as $line) : ?>
            <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
                <div class="text-danger"><i class="fa fa-times" aria-hidden="true"> </i> <?php echo $line ?>
                </div>
            </div>
        <?php endforeach; ?>


        <div class="card shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <form action="login.php" method="post">

                <div class="mb-3">
                    <label for="" class="form-label">E-mail</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $email ?>"></input>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Heslo</label>
                    <input type="password" class="form-control" name="password" value=""></input>
                </div>

                <button type="submit" class="btn btn-primary">Odeslat</button>
            </form>
        </div>
    </div>

</body>

</html>