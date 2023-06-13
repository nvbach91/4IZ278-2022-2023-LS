<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAuthenticated = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles/search_style.css">
    
</head>
<body>
    <header>
        <h1>Nay E-shop</h1>
        <div class="auth-buttons">
        <?php if ($isAdmin) { ?>
                    <a href="admin.php"><button>Dashboard</button></a> <!-- button len pre admina-->
                <?php } ?>   
        <?php if ($isAuthenticated) { ?>
                <a href="order_history.php"><button>Order History</button></a>
                
                <a href="logout.php"><button>Logout</button></a>
            <?php } else { ?>
                <?php if ($successMessage) { ?>
                    <div class="success-message"><?php echo $successMessage; ?></div>
                <?php } ?>
                <a href="register.html"><button>Register</button></a>
                <a href="login.html"><button>Login</button></a>
            <?php } ?>
            <a href="shopping_cart.php"><button class="shopping-cart-button">Shopping Cart</button></a>
            <div class="search-box">
            <form action="search_redirect.php" method="GET">
    <input type="text" name="query" placeholder="Search for products">
    <input type="submit" value="Search">
</form>
            </div>
            
        </div>
    </header>
</body>
</html>

<?php
unset($_SESSION['success_message']);

?>


