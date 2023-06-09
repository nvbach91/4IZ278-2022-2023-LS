<?php require_once 'ProductsDatabase.php';?>
<?php require_once 'OrdersDatabase.php';?>
<?php require_once 'OrderItemsDatabase.php';?>
<?php require_once 'UsersDatabase.php';?>
<?php
session_start();

$productsDatabase = new ProductsDatabase();
$ordersDatabase = new OrdersDatabase();
$orderItemsDatabase = new OrderItemsDatabase();
$usersDatabase = new UsersDatabase();

$records=[];

if(!empty($_SESSION['selected_product'])){
    $records = $productsDatabase->getRecortdsById($_SESSION['selected_product']);
}

if(isset($_GET['makeorder'])&&!empty($records)){
    if(isset($_COOKIE['user_id'])){
        $amount = 0;
        
        foreach($_SESSION['selected_product'] as $id){
            $product = $productsDatabase->getRecordById($id);
            $amount += $product['price']*$_SESSION['product_quantity'][array_search($product['product_id'], $_SESSION['selected_product'])];
        }
        $lastId = $ordersDatabase->addOrder($_COOKIE['user_id'],date("Y-m-d"),$amount);
        foreach($_SESSION['selected_product'] as $id){
            $product = $productsDatabase->getRecordById($id);
            $orderItemsDatabase->addOrderItem($lastId,$product['product_id'],$product['name'],$_SESSION['product_quantity'][array_search($product['product_id'], $_SESSION['selected_product'])],$product['price']);
        }
        $records=[];
        $_SESSION['selected_product']=array();
        $_SESSION['product_quantity'] = array();

        $user = $usersDatabase->getUserById($_COOKIE['user_id']);
        $message = "Dear ".$user['username'].",
        Thank you for your recent order from our online shop. We are pleased to inform you that your order has been successfully placed.
        The details of your order are as follows:
        Order number:".$lastId."
        Date:".date("Y-m-d")."
        Total Amount:".$amount."
        Best regards, Decathlon.";

        $message = wordwrap($message, 70, "\r\n");

        // Send
        mail($user['email'], 'Decathlon order confirmation', $message);
    }else{
        header('Location: login.php');
    }
}

if(isset($_GET['product'])&&isset($_GET['quantity'])){
    $_SESSION['product_quantity'][array_search($_GET['product'], $_SESSION['selected_product'])]=$_GET['quantity'];
}

    
?>
<?php require 'header.php'; ?>
<script>
    function updateQuantity(input) {
    var productId = input.id;
    var quantity = input.value;
    
    location.replace('cart.php' + '?product=' + encodeURIComponent(productId) + '&quantity=' + encodeURIComponent(quantity));
    
}
</script>
        <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Cart</h1>
            <div style="text-align: center;"><a href="cart.php?makeorder=1"><button>Create order</button></a></div>
            <div style="text-align: center;"><a href="index.php">Back</a></div>
            <?php if(isset($_GET['makeorder'])&&isset($_COOKIE['user_id'])):?>
                    <div style="width:40%;margin:auto;text-align: center;" class="success"><p>Order was successfully created!</p></div>
            <?php endif; ?>
            <div class="row">
                <?php foreach($records as $record):?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 product">
                        <a href="#">
                            <img class="card-img-top product-image" src="<?php echo $record['img'];?>" alt="product-image">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">
                            <a style="text-decoration:none" href="#"><?php echo $record['name']; ?></a>
                            </h4>
                            <h5><?php echo number_format($record['price'], 2), ' €'; ?></h5>
                            <p class="card-text"><?php echo $record['description'];?></p>
                        </div>
                        <div class="card-footer">
                            <label for="">Amount: </label>
                            <input style='width:100px;margin-right:125px;' id="<?php echo $record['product_id']?>" name="quantity" type="number" value="<?php echo $_SESSION['product_quantity'][array_search($record['product_id'], $_SESSION['selected_product'])]; ?>" min="1" onchange="updateQuantity(this)">
                            <a href="remove.php?product_id=<?php echo $record['product_id'];?>">Remove</a>
                        </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            </div>
        </section>

<?php require 'footer.php'; ?>