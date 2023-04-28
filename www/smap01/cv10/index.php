<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/database.php'; ?>
<?php

$offset;
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
} else {
    $offset = 0;
}

$itemsCountPerPage = 5;
$database = new Database();
$goods = $database->getItemByOffset($offset, $itemsCountPerPage);
$paginationCount = ceil($database->getCountOfTotalRecord() / $itemsCountPerPage);


?>
<main class="container" style="max-width: 60% !important;">
    <?php if (isset($_GET['update']) && $_GET['update'] == 'success') {
        echo
        '<div style="margin-top:10px;background-color:green;padding:10px;text-align:center;">
                <a style="color:white;"><i style="margin-right:10px;" class="fa-sharp fa-solid fa-check"></i>Item was successfully edited</a>
            </div>';
    } ?>
    <div class="display:flex;">
        <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
            <a href="<?php echo './index.php?offset=' . $i * $itemsCountPerPage; ?>">
                <?php echo $i + 1; ?>
            </a>
        <?php } ?>
    </div>
    <div class="row">
        <?php
        foreach ($goods as $good) {
            echo "<div class='card' style='width: 18rem;padding-bottom:110px;'>
            <img class='card-img-top' src='https://www.designingbuildings.co.uk/w/images/6/6f/Field-175959_640.jpg' alt='Card image cap'>
            <div class='card-body'>
              <h5 class='card-title'>" . $good["name"] . "</h5>
              <p class='card-text'>" . $good["description"] . "</p>
              <p class='card-text' style='bottom:70px !important;position:absolute;'>$" . $good["price"] . "</p>
              <div style='bottom: 20px !important; position: absolute;'>
                <a href='buy.php?good_id=" . $good["good_id"] . "' style='margin-right:4px;' class='btn btn-primary'>Buy</a>";
            echo (!empty($_COOKIE['user_email'])&&$database->getUserPrivilege($_COOKIE['user_email'])>1) ? ("<a href='edit-item.php?good_id=" . $good["good_id"] . "' class='btn btn-warning'><i class='fa-solid fa-pen'></i></a>
                <a href='delete-item.php?good_id=" . $good["good_id"] . "' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></a>") : "";
            echo "</div>
            </div>
          </div>";
        }


        ?>
    </div>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>