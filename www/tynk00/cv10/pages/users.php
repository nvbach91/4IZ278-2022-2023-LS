<?php
session_start();
require_once('../database/loadData.php');


include('../components/header.php');




?>




<div class="card w-100 shadow my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark p-5">
        <h3 class="text-center mb-3">Uživatelé</h3>
        <div class="row">
            <?php foreach ($usersDatabase->getAllUsers() as $user) : ?>

                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card shadow rounded">
                        <div class="card-body text-center mx-auto">
                            <div class="d-flex mb-2 justify-content-center shadow-lg align-items-center rounded-circle bg-light" style="width: 150px; height: 150px; 
                            background-image: url(<?php echo $user['avatar'] ?>); background-size: cover; background-position: center;">
                            </div>

                            <h5 class="card-title mb-1"><?php echo $user['username'] ?></h5>
                            <p class="card-text text-muted"><?php echo $usersDatabase->getPrivilegeName($user) ?></p>
                            <a href="profile.php?user=<?php echo $user['user_id'] ?>" class="btn btn-dark w-100 mb-2">Zobrazit profil</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

    </div>

</div>

<?php

include('../components/footer.php');

?>