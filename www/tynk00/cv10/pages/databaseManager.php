<?php
session_start();


require_once('../database/loadData.php');
include('../components/header.php');


$user = $usersDatabase->getLoggedUser($loggedUser);




$url = getCurrentUrlWithoutParams();

if (isset($_GET['database'])) {
    $database = $_GET['database'];
} else {
    $database = 'products';
}


?>




<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header pt-3 text-bg-dark">

    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link me-2 bg-dark text-light <?php echo ($database == 'products') ? 'active' : ' bg-opacity-50' ?>" aria-current="page" href="<?php $url ?>?database=products">Produkty</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2 bg-dark text-light <?php echo ($database == 'categories') ? 'active ' : ' bg-opacity-50' ?>" href="<?php $url ?>?database=categories">Kategorie</a>
                    </li>
                    <?php if ($usersDatabase->isAdmin($user)) : ?>
                        <li class="nav-item">
                            <a class="nav-link me-2 bg-dark text-light <?php echo ($database == 'users') ? 'active' : ' bg-opacity-50' ?>" href="<?php $url ?>?database=users">Uživatelé</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <?php
                if ($database == 'products') {
                    include('../components/productsManager.php');
                }
                if ($database == 'categories') {
                    include('../components/categoriesManager.php');
                }
                if ($database == 'users') {
                    include('../components/usersManager.php');
                }

                ?>

            </div>

        </div>
    </div>
</div>


<?php

include('../components/footer.php');

?>