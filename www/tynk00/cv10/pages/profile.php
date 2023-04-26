<?php
session_start();
require_once('../database/loadData.php');


include('../components/header.php');

if (isset($_GET['user']))
    $user = $usersDatabase->getUserById($_GET['user']);


?>




<div class="card w-100 shadow my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark p-4">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">
                <div class="d-flex shadow-lg mb-2 mb-3 mx-auto justify-content-center align-items-center rounded-circle bg-light" style="width: 250px; height: 250px; 
                            background-image: url(<?php echo $user['avatar'] ?>); background-size: cover; background-position: center;">
                            </div>
                <h2 class="card-title"><?php echo $user['username'] ?></h2>
                <h5 class="card-subtitle text-muted mb-3"><?php echo $usersDatabase->getPrivilegeName($user) ?></h5>
                <hr class="my-4" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">

                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla molestie elit vitae sem laoreet, eu pulvinar eros aliquet. Sed non sapien nulla.</p>
            </div>
        </div>
    </div>

</div>


<?php

include('../components/footer.php');

?>