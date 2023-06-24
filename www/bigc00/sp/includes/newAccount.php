<?php
require('../includes/header.php');
require_once('../Utils.php');
$utils = new Utils();
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $accountDB = new AccountsDB();
    $accountDB->create(
        substr(htmlspecialchars(trim($_POST['number'])), 0, 8),
        htmlspecialchars(trim($_POST['name'])),
        $_SESSION['user'],
        htmlspecialchars(trim($_POST['type']))
    );
    header('Location: ../includes/accounts.php');
    exit();
}
?>

<body>
    <main class='container'>
        <a class='login-btn' id='back' href='../includes/accounts.php'>
            <p>Back</p>
        </a>
        <form class='blue-box' method='POST' action='../includes/newAccount.php'>
            <h2>New account</h2>
            <div class='input-field'>
                <p>Name</p>
                <input type='text' class='input' name='name'>
            </div>
            <div class='input-field' name='type'>
                <p>Account type</p>
                <select class='input' style='color: white; height: 30px;' name='type'>
                    <option>Current account</option>
                    <option>Savings account</option>
                    <option>Salary account</option>
                </select>
            </div>
            <div class='input-field'>
                <p>Account Number</p>
                <input type='text' class='input' name='number' value='<?php echo $utils->generateNumber(); ?>/1100' style='background-color: grey;' readonly>
            </div>
            <input type='submit' value='Create an account' id='submit'>
        </form>
    </main>
</body>