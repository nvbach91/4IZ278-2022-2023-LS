<?php
include('header.php');
require('database.php');
?>




<div class="container mt-5 mb-5">


    <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
        <div class="card-body">
            <?php foreach ($messages as $message) : ?>

                <p class="card-text text-success"><?php echo $message ?></p>

            <?php endforeach; ?>
        </div>

    </div>

    <a href="setData.php" class="btn btn-dark mb-5" role="button" aria-disabled="true">Načti nové data</a>


    <h2>Uživatelé (Celkem výsledků: <?php echo count($users->fetch()) ?>)</h2>

    <div class="row pt-4">



        <?php foreach ($users->fetch() as $user) : ?>
            <div class="col-4">

                <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
                    <img src="<?php echo $user->avatar ?>" class="card-img-top" alt="no avatar">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->name ?></h5>
                        <p class="card-text">
                            Věk: <?php echo $user->age ?>
                        </p>
                        <form action="deleteMethod.php" method="post">
                            <input type="hidden" name="user" value="<?php echo $user->id ?>">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>

                    </div>

                </div>

            </div>


        <?php endforeach; ?>

    </div>

    <h2>Produkty (Celkem výsledků: <?php echo count($products->fetch()) ?>)</h2>

    <div class="row pt-4">



        <?php foreach ($products->fetch() as $product) : ?>

            <div class="col-4">

                <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->name ?></h5>
                        <p class="card-text">
                            Cena: <?php echo $product->price ?>
                        </p>
                        <form action="deleteMethod.php" method="post">
                            <input type="hidden" name="product" value="<?php echo $product->id ?>">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>

    <h2>Objednávky (Celkem výsledků: <?php echo count($orders->fetch()) ?>)</h2>

    <div class="row pt-4">



        <?php foreach ($orders->fetch() as $order) : ?>

            <div class="col-4">

                <div class="card w-100 shadow-sm p-3 mb-5 bg-body-tertiary rounded" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Číslo objednávky: <?php echo $order->id ?></h5>
                        <p class="card-text">
                            Datum: <?php echo $order->date ?>
                        </p>
                        <form action="deleteMethod.php" method="post">
                            <input type="hidden" name="order" value="<?php echo $order->id ?>">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>

            </div>

        <?php endforeach; ?>
    </div>




</div>


</body>

</html>