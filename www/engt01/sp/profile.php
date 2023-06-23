<?php
require_once "db/BooksDatabase.php";
require_once "db/UserDatabase.php";
require_once "db/LoansDatabase.php";
require_once "db/ReservationsDatabase.php";
session_start();

$bookDb = BooksDatabase::getInstance();
$userDb = UserDatabase::getInstance();
$loansDb = LoansDatabase::getInstance();
$reservationsDb = ReservationsDatabase::getInstance();

$userEmail = $_SESSION["userEmail"];
$userId = intval($userDb->getUserId($userEmail));
$userDebt = $userDb->getDebt($userId);

$userReservations = $reservationsDb->getReservationsForUser($userId);
$userLoans = $loansDb->getLoansForUser($userId);

include "components/header.php" ?>
<main class="mx-4 my-3 mx-auto w-75 d-flex flex-column">
    <div class="d-flex flex-row flex-wrap justify-content-evenly">
        <p><b><?php echo $userEmail ?></b></p>
        <p>Nedoplacený dluh: <b class="<?php echo $userDebt === 0 ? "text-success" : "text-warning" ?>">
                <?php echo $userDb->getDebt($userDb->getUserId($userEmail)) ?>
            </b></p>
    </div>

    <h3 class="text-center">Stav rezervací</h3>
    <table class="table table-sm table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col" class="col-md-4">Kniha</th>
            <th scope="col" class="col-md-4">Rezervováno dne</th>
            <th scope="col" class="col-md-4">Pořadí ve frontě</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userReservations as $reservation):
            $bookReservations = $reservationsDb->getReservationsForBook($reservation["book_isbn"]);
            $queuePosition = 0;
            foreach ($bookReservations as $bookReservation) {
                $queuePosition++;
                if (intval($bookReservation["user_id"]) === $userId) break;
            }
            ?>
            <tr>
                <th scope="row"><a href="detail.php?isbn=<?php echo $reservation["book_isbn"] ?>">
                        <?php echo $bookDb->getBook($reservation["book_isbn"])["name"] ?>
                    </a></th>
                <td><?php echo date_format(date_create($reservation["start"]), "j. n. Y") ?></td>
                <td><?php echo $queuePosition ?>.</td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>

    <h3 class="text-center">Historie výpůjček</h3>
    <table class="table table-sm table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col" class="col-md-3">Kniha</th>
            <th scope="col" class="col-md-3">Datum vypůjčení</th>
            <th scope="col" class="col-md-3">Datum (plánovaného) vrácení</th>
            <th scope="col" class="col-md-3">Vráceno</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($userLoans as $loan): ?>
            <tr>
                <th scope="row"><a href="detail.php?isbn=<?php echo $loan["book_isbn"] ?>">
                        <?php echo $bookDb->getBook($loan["book_isbn"])["name"] ?>
                    </a></th>
                <td><?php echo date_format(date_create($loan["start"]), "j. n. Y") ?></td>
                <td><?php echo date_format(date_create($loan["end"]), "j. n. Y") ?></td>
                <td><?php echo $loan["returned"] ? "Ano" : "Ne" ?></td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</main>
<?php include "components/footer.php" ?>
