<?php
require_once('../database/Database.php');
class AccountsDB extends Database {
    protected $tableName = 'accounts';

    public function isAccountExists(int $number) {
        return $this -> fetchOne($this -> tableName, 'account_id', $number);
    }

    public function getOne(string $field, string $value) {
        return $this -> fetchOne($this -> tableName, $field, $value);
    }

    public function getAll(int $userID) {
        return $this -> fetchAll($this -> tableName, 'owner_id', $userID);
    }

    public function create(int $accountID, string $name, int $ownerID, string $accountType) {
        $sql = "INSERT INTO `accounts`(`account_id`, `name`, `owner_id`, `balance`, `account_type`) 
            VALUES (:accountID, :name, :ownerID, :balance, :accountType)";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'accountID' => $accountID,
            'ownerID' => $ownerID,
            'name' => $name,
            'balance' => 0,
            'accountType' => $accountType
        ]);        
    }

    public function setMoney(int $accountID, int $amount) {
        $this -> update(
            $this -> tableName,
            'balance',
            $amount,
            'account_id',
            $accountID,
        );
    }

    public function getMoney(int $accountID) {
        $account = $this -> fetchOne(
            $this -> tableName,
            'account_id',
            $accountID
        );
        return $account['balance'];
    }

    public function updateAccount(array $accountInfos, int $accountID) {
        foreach($accountInfos as $field => $value) {
            $this -> update(
                $this -> tableName,
                $field,
                $value,
                'account_id',
                $accountID
            );
        }
    }
}
?>