<?php
session_start();
require_once('../database/loadData.php');

$error = null;



if (isset($_POST['submit'])) {
    $login = $usersDatabase->login($_POST['email'], $_POST['password'], isset($_POST['stayLogged']));
    if ($login) {
        header("Location: home.php");
    } else {
        $error = "Byly zadány špatné údaje!";
    }
}






include('../components/header.php');


?>


<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">

    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Přihlásit se</h3>
                <?php if ($error != null) : ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php">
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Heslo:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="stayLogged">
                            <label class="form-check-label" for="disabledFieldsetCheck">
                                Zůstat přihlášen
                            </label>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-dark btn-block" name="submit" value="Přihlásit se">
                    <a class="ms-2" href="register.php">
                        Ještě nemáte učet? Založte si nový!
                    </a>

                </form>
            </div>


        </div>
    </div>
</div>



<?php

include('../components/footer.php');

?>