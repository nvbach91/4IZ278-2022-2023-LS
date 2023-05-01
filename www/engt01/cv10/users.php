<?php
session_start();
if (!isset($_SESSION["userType"])) header("Location: login.php");
if (empty($_SESSION["userType"]) || $_SESSION["userType"] < 3) {
    http_response_code(403);
    die();
}

require "db/UserDatabase.php";
$db = new UserDatabase();
$users = $db->getUsers();

if (!empty($_POST)) {
    $db->updateUserType(key($_POST), current($_POST));
    header("Refresh: 0");
}

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <table class="table w-50">
                <thead>
                <tr>
                    <th scope="col">User email</th>
                    <th scope="col">User type</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user["email"] ?></td>
                    <td>
                        <form action="users.php" method="POST">
                            <div style="display: flex">
                                <select class="form-select form-select-sm w-25" name="<?php echo $user["user_id"] ?>">
                                    <option value="1" <?php echo $user["type"] == 1 ? "selected" : "" ?>>1</option>
                                    <option value="2" <?php echo $user["type"] == 2 ? "selected" : "" ?>>2</option>
                                    <option value="3" <?php echo $user["type"] == 3 ? "selected" : "" ?>>3</option>
                                </select>
                                <button type="submit" class="btn btn-outline-dark" style="margin-left: 16px">Confirm
                                    change
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
