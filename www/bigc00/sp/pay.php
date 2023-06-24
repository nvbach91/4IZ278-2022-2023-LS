<?php
session_start();
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     header("Location: sendingOrder.php");
// }
$_SESSION['totalCart']=0;
foreach ($_SESSION['cart_list'] as $course) {
    $_SESSION['totalCart'] += $course['price'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #999;
            font-size: 16px;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label {
            top: 0;
            transform: translateY(0);
            font-size: 12px;
            color: #333;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
        }

        .register {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .register a {
            color: #333;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <form action="sendingOrder.php" method="post">
                <h2>Payment</h2>
                <div class="inputbox">
                    <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="16" minlength="16" name="ccn" placeholder="">
                    <label for="ccn">Card Number</label>
                </div>
                <button type="submit">Pay <?php echo $_SESSION['totalCart'] . ' CZK'; ?></button>
                <div class="register">
                    <a href="cart.php">Want to change your order? Go to cart</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
