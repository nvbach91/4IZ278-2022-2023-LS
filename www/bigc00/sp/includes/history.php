<?php
require('../includes/header.php');
require_once('../database/TransactionsDB.php');
$transactionsDB = new TransactionsDB();
$transactions = $transactionsDB->getAll($_SESSION['user']);
?>

<body>
    <main class='container' id='column'>
        <a class='login-btn' id='back' href='../includes/accounts.php'>
            <p>Back</p>
        </a>
        <div class='blue-box' id='transactions'>
            <table>
                <tr>
                    <th>From account</th>
                    <th>To account</th>
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?php echo $transaction['sender_id']; ?></td>
                        <td><?php echo $transaction['recipient_id']; ?></td>
                        <td><?php echo $transaction['amount']; ?> Kč</td>
                        <td><?php echo $transaction['category']; ?></td>
                        <td><?php echo $transaction['date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
</body>