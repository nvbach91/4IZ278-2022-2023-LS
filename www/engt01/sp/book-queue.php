<?php
require_once "db/BooksDatabase.php";
require_once "db/UserDatabase.php";
require_once "db/ReservationsDatabase.php";
session_start();

$bookDb = BooksDatabase::getInstance();
$userDb = UserDatabase::getInstance();
$reservationsDb = ReservationsDatabase::getInstance();

$userReservations = $reservationsDb->getReservations();

$errors = [];
if (isset($_GET["success"]) && $_GET["success"]) {
    $errors[] = "Úspěšně smazáno";
}

include "components/header.php" ?>
<main class="mx-4 my-3 mx-auto w-75 d-flex flex-column">
    <h3 class="text-center">Stav rezervací</h3>
    <?php if (!empty($errors)): ?>
        <div class="text-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <!-- TODO filter? -->
    <form action="actions/removeReservationAction.php" method="post">
        <table class="table table-sm table-striped table-bordered align-middle">
            <thead>
            <tr>
                <th scope="col" class="col-md-4">Kniha (ISBN)</th>
                <th scope="col" class="col-md-4">Uživatel (ID)</th>
                <th scope="col" class="col-md-4">Smazat</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userReservations as $reservation): ?>
                <tr>
                    <th scope="row">
                        <a href="detail.php?isbn=<?php echo $reservation["book_isbn"] ?>"><?php echo $bookDb->
                            getBook($reservation["book_isbn"])["name"] ?></a>
                        (<?php echo $reservation["book_isbn"] ?>)
                    </th>
                    <td>
                        <?php echo $userDb->getUserEmail($reservation["user_id"]) ?>
                        (<?php echo $reservation["user_id"] ?>)
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary btn-sm" name="reservation"
                                value="<?php echo $reservation["book_isbn"] ?>=<?php echo $reservation["user_id"] ?>">
                            Smazat
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </form>
</main>
<?php include "components/footer.php" ?>
