<?php
session_start();
header("Location: databaseManager.php?database=products");


require_once('../database/loadData.php');

include('../components/header.php');




if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        $productsDatabase->deleteProduct($_GET['product_id']);
    }

}
else {
}



?>


<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Produkt odstraněn!</h3>

            </div>

        </div>
    </div>
</div>


<?php

include('../components/footer.php');

?>