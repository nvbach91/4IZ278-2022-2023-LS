<?php
require_once __DIR__ . '/incl/header.php';
require_once __DIR__ . '/database.php'; ?>
<?php
if(empty($_COOKIE)||!isset($_COOKIE['user_email'])){
    header('Location: login.php');
    exit;
}
$database=new Database();
$goods = isset($_SESSION['goods']) ? $_SESSION['goods'] : [];
?>
<main class="container" style="max-width: 60% !important;">
    <h1 style="text-align:center;">Shopping cart</h1>
    <table>
        <tbody>
            <tr>
                <td width=200></td>
                <td style="width:10%;margin-left:20px;">ID</td>
                <td style="width:60%;margin-left:5%;">Name</td>
                <td style="margin-left:5%;text-align:center;">Price</td>
                <td style="width:10%;"></td>
            </tr>
    <?php
    $item;
    foreach ($goods as $good) {
        $item=$database->getItem($good);
        echo
        '<tr style="border-color:gray!important;border-style:solid!important;border-radius:7px;border:1px;height:70px;margin-bottom:10px;" class="container-fluid">
            <td width=200><img src="https://www.designingbuildings.co.uk/w/images/6/6f/Field-175959_640.jpg" style="max-width:100px; max-height:100%;" alt="item_picture"></td>
            <td style="width:10%;margin-left:20px;">ID: '.$good.'</td>
            <td style="width:60%;margin-left:5%;">'.$item['name'].'</td>
            <td style="margin-left:5%;">'.$item['price'].'</td>
            <td style="width:10%;"><a href="remove-item.php?good_id='.$good.'" style="width:100%;display:block;text-align:center;"><i class="btn btn-danger fa-solid fa-trash-can"></i></a></td>
        </tr>';
    }
    ?>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>