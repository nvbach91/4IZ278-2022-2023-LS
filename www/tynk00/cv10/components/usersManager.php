<h3 class="text-center">Uživatelé</h3>
<?php if ($productsDatabase->getCount() > 0) : ?>




    <table class="table">
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Uživatelské jméno</th>
                <th>Role</th>
                <th>Možnosti</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersDatabase->getAllUsers() as $user) : ?>
                <?php $currentUser = ($user['user_id'] == $loggedUser) ? true : false; ?>
                <tr class="mx-1">

                    <td> <img src="<?php echo $user["avatar"] ?>" alt="Logo" class="align-text-top rounded-circle" onerror="this.src='<?php img('avatar-placeholder.jpeg'); ?>';" width="30" height="30">
                    </td>
                    <td><?php echo $user["username"] ?></td>
                    <td><?php echo $usersDatabase->getPrivilegeName($user) ?></td>
                    <td>
                        <form class="w-auto d-inline" method="post" action="privilegeForm.php">
                            <input type="hidden" name="user" value="<?php echo $user['user_id']; ?>">
                            <button class="btn btn-warning py-1 <?php echo ($currentUser == true) ? 'disabled' : '' ?>" type="submit"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </form>

                        <form class="w-auto d-inline" method="post" action="privilegeForm.php">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="user" value="<?php echo $user['user_id']; ?>">
                            <button class="btn btn-danger py-1 <?php echo ($currentUser == true) ? 'disabled' : '' ?>" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>

                        <form class="w-auto d-inline" method="get" action="">
                            <a href="profile.php?user=<?php echo $user['user_id'] ?>" class="btn btn-primary py-1" type="submit"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        </form>


                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="row">

    </div>





<?php else : ?>
    <div class="text-center my-5">
        <img class="w-25 mb-3" src="<?php img('error.png') ?>" alt="" srcset="">
        <h3>Nebyly vloženy žádné kategorie :/</h3>
    </div>

<?php endif; ?>
<hr class="mt-4 mb-3" style="background: linear-gradient(to right, #000000, #4d4d4d, #8c8c8c); border: none; height: 2px;">
<form method="post" action="productEditor.php" class="w-auto mt-1">
    <button class="btn btn-dark" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Přidat novou kategorii</button>
</form>