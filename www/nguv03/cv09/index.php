<?php
// http://php.net/manual/en/session.examples.basic.php
// Sessions can be started manually using the session_start() function. If the session.auto_start directive is set to 1, a session will automatically start on request startup.

// http://stackoverflow.com/questions/4649907/maximum-size-of-a-php-session
// You can store as much data as you like within in sessions. All sessions are stored on the server. The only limits you can reach is the maximum memory a script can consume at one time, which by default is 128MB.

//http://stackoverflow.com/questions/217420/ideal-php-session-size

require 'db.php';

$nItemsPerPagination = 4;

# offset pro strankovani
if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

# celkovy pocet zbozi pro strankovani
$count = $db->query("SELECT COUNT(id) FROM cv09_goods")->fetchColumn();

$stmt = $db->prepare("SELECT * FROM cv09_goods ORDER BY id DESC LIMIT $nItemsPerPagination OFFSET ?");
$stmt->bindValue(1, $offset, PDO::PARAM_INT);
$stmt->execute();
$goods = $stmt->fetchAll();

?>


<?php require './incl/header.php'; ?>
<?php require './incl/navbar.php'; ?>

<main class="container">
    <h1>Mango index</h1>
    Total mango count: <?php echo $count ?>
    <br><br>
    <a class="btn btn-primary" href="new.php">Add new mango</a>
    <br><br>
    
    <div class="pagination">
    <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
        <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
            <?php echo $i; ?>
        </a>
    <?php } ?>
    </div>
    <?php if ($count) { ?>
        <div class="products">
            <?php foreach($goods as $row): ?>
            <div class="card product" style="width: calc(100% / 3)">
                <div class="card-img-top" style="background-image: url(<?php echo $row['img']; ?>)"></div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name'] ?></h5>
                    <div class="card-subtitle"><?php echo $row['price'] ?></div>
                    <div class="card-text"><?php echo $row['description'] ?></div>
                    <div class="card-controls">
                        <a class="btn btn-secondary card-link" href='./buy.php?id=<?php echo $row['id'] ?>'>Buy</a>
                        <a class="btn btn-secondary card-link" href='./update.php?id=<?php echo $row['id'] ?>'>Edit</a>
                        <a class="btn btn-secondary card-link" href='./delete.php?id=<?php echo $row['id'] ?>'>Delete</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <br>
        <div class="pagination">
        <?php for ($i = 1; $i <= ceil($count / $nItemsPerPagination); $i++) { ?>
            <a class="<?php echo $offset / $nItemsPerPagination + 1 == $i ? "active" : ""; ?>" href="./index.php?offset=<?php echo ($i - 1) * $nItemsPerPagination; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>
        </div>
        <br>
    <?php } ?>
</main>
<?php require './incl/footer.php'; ?>

