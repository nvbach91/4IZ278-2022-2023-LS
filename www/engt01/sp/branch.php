<?php
require_once "db/BooksDatabase.php";
require_once "db/UserDatabase.php";
require_once "db/LoansDatabase.php";
session_start();

if (($_SESSION["userType"] ?? 0) < 2) header("Location: index.php");

$bookDb = BooksDatabase::getInstance();
$userDb = UserDatabase::getInstance();
$loansDb = LoansDatabase::getInstance();

$errors = [];

$email = "";
$userDebt = $_SESSION["manageDebt"] ?? 0;
$userLoans = $_SESSION["manageLoans"] ?? false;
$registered = false;

if (!empty($_GET)) {
    $email = htmlspecialchars(trim($_GET["email"] ?? ""));
    $registered = $userDb->isEmailRegistered($email);
    $_SESSION["manageEmail"] = $email;

    if ($registered) {
        $userDebt = $userDb->getDebt($userDb->getUserId($email));
        $userLoans = $loansDb->getUnreturnedLoansForUser($userDb->getUserId($email));
        $_SESSION["manageDebt"] = $userDebt;
        $_SESSION["manageLoans"] = $userLoans;
    } else $errors[] = "Uživatel neexistuje";

    if (!empty($_GET["overpay"])) $errors[] = "Dluh by byl přeplacen";
}

include "components/header.php" ?>
<main class="mx-4 my-3 mx-auto w-75 d-flex flex-column">
    <?php if (!empty($errors)): ?>
        <div class="text-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <form method="get" action="branch.php">
        <div class="d-flex flex-column" style="gap: 16px">
            <div class="d-flex flex-row" style="gap: 8px">
                <label for="email">E-mail uživatele:</label>
                <input id="email" name="email" type="email" value="<?php echo $email ?>" class="flex-grow-1">
                <button class="btn btn-primary btn-sm">Načíst uživatele</button>
            </div>
            <?php if ($email && $registered): ?>
                <div class="d-flex flex-row flex-wrap justify-content-evenly border-bottom ">
                    <p>Aktuálně vypůjčeno: <b><?php echo count($userLoans) ?></b></p>
                    <p>Nedoplacený dluh: <b class="<?php echo $userDebt === 0 ? "text-success" : "text-warning" ?>">
                            <?php echo $userDb->getDebt($userDb->getUserId($email)) ?>
                        </b></p>
                </div>
            <?php endif ?>
        </div>
    </form>

    <?php if ($email && $registered): ?>
        <form method="post" action="actions/userChangeAction.php" class="branch-control-grid my-3">
            <label for="isbn">ISBN</label>
            <input id="isbn" name="isbn" type="text">
            <button class="btn btn-primary btn-sm">Půjčit/vrátit</button>

            <label for="pay">Částka (Kč)</label>
            <input id="pay" name="pay" type="number">
            <button class="btn btn-primary btn-sm">Zaplatit</button>
        </form>
    <?php endif ?>

    <?php if ($email && $registered): ?>
        <section class="my-3">
            <h3 class="text-center">Nevrácené knihy</h3>
            <table class="table table-sm table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col" class="col-md-3">Kniha</th>
                    <th scope="col" class="col-md-3">ISBN</th>
                    <th scope="col" class="col-md-3">Datum vypůjčení</th>
                    <th scope="col" class="col-md-3">Datum plánovaného vrácení</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($userLoans as $loan): if ($loan["returned"]) continue; ?>
                    <tr>
                        <th scope="row"><a href="detail.php?isbn=<?php echo $loan["book_isbn"] ?>">
                                <?php echo $bookDb->getBook($loan["book_isbn"])["name"] ?>
                            </a></th>
                        <td><?php echo $loan["book_isbn"] ?></td>
                        <td><?php echo date_format(date_create($loan["start"]), "j. n. Y") ?></td>
                        <td><?php echo date_format(date_create($loan["end"]), "j. n. Y") ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </section>
    <?php endif ?>
</main>
<?php include "components/footer.php" ?>
