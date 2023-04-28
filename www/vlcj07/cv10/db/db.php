<?php require_once 'config.php'; ?>

<?php
$pdo = new PDO(
   'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . ';charset=utf8mb4',
   DB_USERNAME,
   DB_PASSWORD
);
$pdo->setAttribute(
   PDO::ATTR_ERRMODE,
   PDO::ERRMODE_EXCEPTION
);
$pdo->setAttribute(
   PDO::ATTR_DEFAULT_FETCH_MODE,
   PDO::FETCH_ASSOC
);
?>