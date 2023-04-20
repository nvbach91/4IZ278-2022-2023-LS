<?php

if (!isset($_COOKIE['user'])){
    header("Location: home.php");
}
else{
    setcookie("user", "", time()-3600, "/");

    header("refresh:5;url=home.php");
}
require_once('../database/loadData.php');

include('../components/header.php');


?>

<div class="card w-100 shadow my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark p-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">
                Byli jste odhlášeni!<br>
                Během chvíle budete přesměrováni na hlavní stránku!
            </div>
        </div>
    </div>

</div>


<?php

include('../components/footer.php');

?>


?>