<?php

require_once 'dbconfig.php';
$pdo = new PDO(
    'mysql:host=' . DB_HOST .
        ';dbname=' . DB_NAME .
        ';charset=utf8mb4',
    DB_USERNAME,
    DB_PASSWORD
);

function getTotalRecords($pdo)
{
    $statement = $pdo->prepare("SELECT COUNT(*) AS count FROM cv09_goods");
    $statement->execute();
    $result = $statement->fetchAll()[0]['count'];
    return $result;
}

$itemsCountPerPage = 10;
$totalRecords = getTotalRecords($pdo);

$paginationCount = ceil($totalRecords / $itemsCountPerPage);

function fetchRecords($pdo, $itemsCountPerPage, $offset)
{
    $query = "SELECT * FROM cv09_goods ORDER BY good_id ASC LIMIT $itemsCountPerPage OFFSET ?";
    $statement = $pdo->prepare($query);
    $statement->bindParam(1, $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll();
};


if (!empty($_GET)) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$records = fetchRecords($pdo, $itemsCountPerPage, $offset);
?>

<div class="cards-wrapper">
    <?php foreach ($records as $item) : ?>
        <div class="col-md-4 pb-2">
            <div class="card h-100 item-card">
                <div class="card-body">
                    <h4 class="card-title"><a href="#"><?php echo $item['name']; ?></a></h4>
                    <h5><?php echo $item['price'] . ' €' ?></h5>
                    <p class="card-text"><?php echo $item['description']; ?></p>
                </div>
                <div class="card-footer">
                    <div>
                        <a class="btn card-link btn-outline-primary" href="./buy.php?good_id=<?php echo $item['good_id'] ?>">Buy</a>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
                            <a class="btn card-link btn-outline-primary" href="./edit-item.php?good_id=<?php echo $item['good_id'] ?>">Edit</a>
                            <a class="btn card-link btn-outline-primary" href="./delete-item.php?good_id=<?php echo $item['good_id'] ?>">Delete</a>
                        <?php endif; ?>
                    </div>
                    <div class="mt-2">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['privilege'] >= 2) : ?>
                            <a class="btn card-link btn-outline-primary" href="./edit-item-optimistic.php?good_id=<?php echo $item['good_id'] ?>">Edit-optimistic</a>
                            <a class="btn card-link btn-outline-primary" href="./edit-item-pessimistic.php?good_id=<?php echo $item['good_id'] ?>">Edit-pessimistic</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<ul class="pagination-container">
    <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
        <li>
            <a href="<?php echo './index.php?offset=' . $i * $itemsCountPerPage; ?>">
                <?php echo $i + 1 ?>
            </a>
        </li>
    <?php } ?>
</ul>