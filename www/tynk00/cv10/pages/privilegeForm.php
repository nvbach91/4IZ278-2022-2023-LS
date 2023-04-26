<?php
session_start();
require_once('../database/loadData.php');





if(isset($_POST['user'])){
    $cUser = $usersDatabase->getUserById($_POST['user']);
    if(isset($_POST['action'])){
        if($_POST['action'] == 'delete'){
            $usersDatabase->deleteUser($_POST['user']);
            header("Location: databaseManager.php?database=users"); 
        }
    }

}
else {
    header("Location: databaseManager.php?database=users"); 
}






if(isset($_POST['privilege'])){
    $usersDatabase->setPrivilege($cUser['user_id'], $_POST['privilege']);
    header("Location: databaseManager.php?database=users");   
}

include('../components/header.php');


?>

<div class="card w-100 shadow my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">
    </div>
    <div class="card-body text-dark p-4">
        <div class="row justify-content-center text-center">
            <div class="col-md-8 col-lg-6">
                <div class="d-flex shadow-lg mb-2 mb-3 mx-auto justify-content-center align-items-center rounded-circle bg-light" style="width: 250px; height: 250px; 
                            background-image: url(<?php echo $cUser['avatar'] ?>); background-size: cover; background-position: center;">
                </div>
                <h2 class="card-title"><?php echo $cUser['username'] ?></h2>
                <div class="form-group mb-3">
                    <form action="privilegeForm.php" method="post">
                        <label for="">Nastavení role</label>
                        <input type="hidden" name="user" value="<?php echo $cUser['user_id']; ?>">
                        <select class="form-select" name="privilege">
                            <?php foreach ($usersDatabase->getPrivileges() as $privilege) : ?>
                                <option value="<?php echo $privilege['privilege_id'] ?>" <?php echo ($privilege['privilege_id'] == $cUser['privilege']) ? 'selected' : '' ?>><?php echo $privilege['name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button class="btn btn-dark mt-3" type="submit">Změnit roli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?php

include('../components/footer.php');

?>