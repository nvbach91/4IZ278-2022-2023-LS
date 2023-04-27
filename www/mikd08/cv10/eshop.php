<?php
    if (empty($_COOKIE["user"])) {
        header("Location: index.php");
    }
    session_start();
    
    require_once("db.php");

    $limitFrom = $_GET["limitFrom"] ?? 0;
    $limit = 6;

    $query = "SELECT COUNT(*) AS count FROM cv09_goods";
    $numRecords = $pdo->query($query)->fetchAll()[0]["count"];


    $numPages = ceil($numRecords/$limit);
   
    $query = "SELECT * FROM cv09_goods LIMIT ?,?;";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(1, $limitFrom, PDO::PARAM_INT);
    $stmt->bindValue(2, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    //sql injection hazard
    // if(!empty($_POST)){
    //     $minPrice = $_POST["minPrice"];
    //     $query = "SELECT COUNT(*) AS count FROM cv09_goods";
    //     $data = $pdo->query($query)->fetchAll();
    // }


?>
<?php require "header.php"?>
    <main style="width: 80%; margin:0px auto;">
        <div style="display: flex; flex-wrap: wrap;">
        <?php foreach ($data as $key => $value):?>
            <div class="card" style="min-width: 200px; width: calc(33% - 40px); margin: 20px;">
                <img class="card-img-top" src="<?php echo $value["img"]; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value["name"]; ?></h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="card-body">
                    <a href="buy.php?good_id=<?php echo $value["good_id"]?>" class="card-link">Add</a>
                    <?php if($_SESSION["privilege"] == 2 || $_SESSION["privilege"] == 3):?>
                        <a href="edit.php?good_id=<?php echo $value["good_id"]?>" class="card-link">Edit</a>
                        <a href="delete.php?good_id=<?php echo $value["good_id"]?>" class="card-link">Delete</a>
                    <?php endif?>
                </div>
            </div>
        <?php endforeach?>
        </div>
    </main>

    <nav aria-label="...">
        <ul class="pagination">
            <?php for($i = 0; $i < $numPages; $i++){?>
                <li class="page-item"><a class="page-link" href="<?php echo "eshop.php?limitFrom=".$i*$limit?>"><?php echo $i + 1 ?></a></li>
            <?php }?>
        </ul>
    </nav>

    <div style="width: 400px; white-space: nowrap; overflow-y: auto; padding: 5px;">

    </div>
<?php require "footer.php"?>


