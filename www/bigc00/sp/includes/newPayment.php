<?php
require('../includes/header.php');
require_once('../database/AccountsDB.php');
require_once('../database/TransactionsDB.php');
require_once('../Utils.php');
$userID = $_SESSION['user'];
$accountDB = new AccountsDB();
$accounts = $accountDB->getAll($userID);
$utils = new Utils();
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $errors = $utils->validatePayment();
    if (!$errors) {
        $transactions = new TransactionsDB();
        $senderID = $_POST['sender'];
        $recipientID = htmlspecialchars(trim($_POST['recipient']));
        $amount = htmlspecialchars(trim($_POST['number']));
        $transactions->create(
            $senderID,
            $recipientID,
            $amount,
            $_POST['reason']
        );
        $accountDB->setMoney(
            $senderID,
            $accountDB->getMoney($senderID) - $amount
        );
        $accountDB->setMoney(
            $recipientID,
            $accountDB->getMoney($recipientID) + $amount,
        );
        header('Location: ../includes/accounts.php');
    }
}
$categories = [
    'None',
    'Normal payment',
    'Food / Restaurants',
    'Activities',
    'Internet payment',
    'Home',
    'For friends / family',
    'Debt / Debt repayment'
];
?>

<body>
    <main class='container'>
        <a class='login-btn' id='back' href='../includes/accounts.php'>
            <p>Back</p>
        </a>
        <form class='blue-box' id='payment' method='POST' action='../includes/newPayment.php'>
            <h2>New payment</h2>
            <div class='input-field'>
                <p>Recipient</p>
                <input type='text' class='input' name='recipient' placeholder="Input recipient" value="<?php echo isset($_POST['recipient']) ? $_POST['recipient'] : ''; ?>">
                <?php if (isset($errors['recipient'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['recipient']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field' name='type'>
                <p>From account</p>
                <select class='input' style='color: white;' name='sender'>
                    <?php
                    foreach ($accounts as $account) :
                        $accountID = $account['account_id'];
                    ?>
                        <option <?php echo isset($_POST['sender']) && $_POST['sender'] == $accountID ? 'selected' : ''; ?>><?php echo $account['account_id']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class='input-field'>
                <p>Amount</p>
                <input type='number' class='input' name='number' placeholder="Input money amount" value="<?php echo isset($_POST['number']) ? $_POST['number'] : ''; ?>">
                <?php if (isset($errors['amount'])) : ?>
                    <div class='error'>
                        <p><?php echo $errors['amount']; ?></p>
                    </div>
                <?php endif; ?>
            </div>
            <div class='input-field' name='type'>
                <p>Payment category</p>
                <select class='input' style='color: white;' name='reason'>
                    <?php foreach ($categories as $category) : ?>
                        <option <?php echo isset($_POST['reason']) && $_POST['reason'] == $category ? 'selected' : ''; ?>><?php echo $category; ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <input type='submit' value='Send money' id='submit'>
        </form>
    </main>
</body>