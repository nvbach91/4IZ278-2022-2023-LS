<?php
require_once('../database/Database.php');
require_once('../database/AccountsDB.php');
class TransactionsDB extends Database {
    protected $tableName = 'transactions';

    public function create(int $senderID, int $recipientID, int $amount, string $category) {
        $sql = "INSERT INTO `transactions`(`sender_id`, `recipient_id`, `amount`, `category`) 
            VALUES (:senderID, :recipientID, :amount, :category)";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'senderID' => $senderID,
            'recipientID' => $recipientID,
            'amount' => $amount,
            'category' => $category
        ]);        
    }

    public function getAll(int $ownerID) {
        $sql = "SELECT * FROM `transactions` JOIN `accounts` ON transactions.sender_id = accounts.account_id WHERE `owner_id` = :ownerID";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'ownerID' => $ownerID,
        ]);
        $transactions = $statement -> fetchAll();
        $newTransactions = [];
        foreach($transactions as $transaction) {
            $date = new DateTime($transaction['date']);
            $newTransaction = $transaction;
            $newTransaction['date'] = $date -> format('d.m.Y');
            array_push($newTransactions, $newTransaction);
        }
        return $newTransactions;
    }
} 
?>