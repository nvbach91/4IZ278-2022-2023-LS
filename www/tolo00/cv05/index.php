<?php

interface DatabaseOperations {
    public function load();
    public function save();

    public function fetch($id);
    public function fetchAll();
    public function insert($args);
    public function delete($id);
}

abstract class Database implements DatabaseOperations {
    protected $dbPath = '/db/';
    protected $dbExtension = '.db';
    protected $delimiter = ';';
    protected $db = [];

    public function __construct()
    {
        $this->load();
    }

    public function load()
    {
        if (($handle = fopen(__DIR__ . $this->dbPath . get_class($this) . $this->dbExtension, "r")) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                $this->db[$row[0]] = $row;
            }

            fclose($handle);
        }
    }

    public function save()
    {
        if (($handle = fopen(__DIR__ . $this->dbPath . get_class($this) . $this->dbExtension, "w")) !== FALSE) {
            foreach ($this->db as $row) {
                fputcsv($handle, $row, $this->delimiter);
            }

            fclose($handle);
        }
    }

    public function getNextAiId()
    {
        $keys = array_keys($this->db);

        $currentGreatestValue = 0;

        if ($keys) {
            $currentGreatestValue = max(array_keys($this->db));
        }

        return $currentGreatestValue + 1;
    }
}

class UsersDB extends Database {
    public function insert($args) {
        $newId = $this->getNextAiId();
        $newRow = [
            'id' => $newId,
            'name' => $args['name'] ?? null
        ];

        $this->db[$newId] = $newRow;

        $this->save();
    }

    public function fetchAll()
    {
        return $this->db;
    }

    public function fetch($id)
    {
        return $this->db[$id] ?? null;
    }

    public function delete($id)
    {
        if (isset($this->db[$id])) {
            unset($this->db[$id]);
        }

        $this->save();
    }
}

class ProductsDB extends Database {
    public function insert($args) {
        $newId = $this->getNextAiId();
        $newRow = [
            'id' => $newId,
            'name' => $args['name'] ?? null,
            'price' => $args['price'] ?? null,
        ];

        $this->db[$newId] = $newRow;

        $this->save();
    }

    public function fetchAll()
    {
        return $this->db;
    }

    public function fetch($id)
    {
        return $this->db[$id] ?? null;
    }

    public function delete($id)
    {
        if (isset($this->db[$id])) {
            unset($this->db[$id]);
        }

        $this->save();
    }
}

$errors = [];

$usersDb = new UsersDB;
$productsDb = new ProductsDB;

if (!$database = ($_GET['db'] ?? null)) {
    $errors[] = 'No database specified.';
} elseif (!isset(${$database . 'Db'})) {
    $errors[] = 'Invalid database: ' . $database;
}

if (!$action = ($_GET['action'] ?? null)) {
    $errors[] = 'No database action specified.';
} elseif (!in_array($action, ['fetch', 'fetchAll', 'insert', 'delete'])) {
    $errors[] = 'Invalid database action: ' . $action;
}

if (in_array($action, ['fetch', 'delete']) && !$id = ($_GET['id'] ?? null)) {
    $errors[] = 'Please provide param "id" for action:' . $action;
}

if ($action === 'insert' && !$args = ($_GET['args'] ?? null)) {
    $errors[] = 'Please provide param "args" for action:' . $action;
}

if (!$errors) {
    $params = null;

    // nested ternary operator is deprecated :(
    if (isset($id)) {
        $params = $id;
    } elseif (isset($args)) {
        $params = $args;
    }

    $result = ${$database . 'Db'}->{$action}($params);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB tool</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          crossorigin="anonymous">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">DB tool</h1>

            <div>
                Usage examples:
                <ul>
                    <li>insert new user row: "?db=users&action=insert&args[name]=ondra"</li>
                    <li>delete user row: "?db=users&action=delete&id=10"</li>
                    <li>fetch user row: "?db=users&action=fetch&id=10"</li>
                    <li>fetch all user rows: "?db=users&action=fetchAll"</li>
                    <li>add new product row: "?db=products&action=insert&args[name]=Kafe&args[price]=155"</li>
                </ul>
            </div>

            <?php
                if ($errors) {
                    ?>
                        <div class="callout alert">
                            <h5>Errors:</h5>
                            <ul>
                                <?php foreach ($errors as $error) { echo '<li>' . $error . '</li>'; } ?>
                            </ul>
                        </div>
                    <?php
                }
            ?>

            <div>
                Current query:
                <ul>
                    <li>db: <?= $database ?? '---' ?></li>
                    <li>action: <?= $action ?? '---' ?></li>
                    <li>id: <?= $id ?? '---' ?></li>
                    <li>args: <?= isset($args) ? json_encode($args) : '---' ?></li>
                </ul>
            </div>

            <div>
                Current query result:
                <pre><?= isset($result) ? json_encode($result) : '---' ?></pre>
            </div>
        </div>
    </div>

    <div class="grid-x">
        <div class="cell medium-6" style="border: 1px solid red; padding: 10px;">
            <h3>UsersDB (id;name)</h3>
            <pre><?= file_get_contents(__DIR__ . '/db/UsersDB.db') ?></pre>
        </div>

        <div class="cell medium-6" style="border: 1px solid red; padding: 10px;">
            <h3>ProductsDB (id;name;price)</h3>
            <pre><?= file_get_contents(__DIR__ . '/db/ProductsDB.db') ?></pre>
        </div>
    </div>
</div>
