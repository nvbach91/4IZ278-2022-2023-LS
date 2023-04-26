<?php
session_start();
require_once('../database/loadData.php');



if (isset($loggedUser)){
    header("Location: home.php");
}


if (isset($_POST['submit'])) {
    $user = $usersDatabase->registerUser($_POST['username'], $_POST['email'], $_POST['password'], isset($_POST['avatar']) ? $_POST['avatar'] : '');
    setcookie('user', $user, time() + 60*30, '/');

    header("Location: home.php");
}

include('../components/header.php');


?>

<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">

    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Registrace</h3>
                <form method="POST" action="register.php">
                    <div class="form-group mb-3">
                        <label for="username">Přezdívka</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="emaoů">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Heslo</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Avatar</label>
                        <input type="text" class="form-control" id="avatar" name="avatar" onchange="previewAvatar()">

                        <div id="avatar-preview-container" class="mt-2">
                            <img id="avatar-preview" src="../img/avatar-placeholder.jpeg">
                        </div>
                    </div>


                    <input type="submit" class="btn btn-dark btn-block" name="submit" value="Registrovat">
                    <a class="ms-2" href="login.php">
                        Jste již zaregistrován? Přihlašte se!
                    </a>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    #avatar-preview-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
    }

    #avatar-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<script>
    function previewAvatar() {
        var input = document.getElementById('avatar');
        var url = input.value;
        var preview = document.getElementById('avatar-preview');
        if (url) {
            preview.onerror = function() {
                preview.src = '../img/avatar-placeholder.jpeg';
            };
            preview.src = url;
        } else {
            preview.src = '../img/avatar-placeholder.jpeg';
        }
    }
</script>



<?php

include('../components/footer.php');

?>