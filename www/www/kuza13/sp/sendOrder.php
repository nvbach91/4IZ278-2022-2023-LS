<?php
require('index.php');
if (empty($_SESSION['cart_list'])) {
    $_SESSION['message'] = 'Your cart is empty!';
    header("Location: login.php");
}

$ordersDB = new OrdersDatabse();
$rulesPayment = [
    'required' => ['ccn',],
    'length' => [
        ['ccn', 16]
    ]
];
if (!empty($_SESSION['cart_list'])) {
    if (!empty($_POST)) {
        $v = new \Valitron\Validator($_POST);
        $v->rules($rulesPayment);
        if ($v->validate()) {
            if (!empty($_SESSION['user'])) {
                $userPostalCode = $_SESSION['user']['postalCode'];
                $userAdress = $_SESSION['user']['adress'];
                $userName = $_SESSION['user']['name'];
                $userSurname = $_SESSION['user']['surname'];
                $userPhone = $_SESSION['user']['phone'];
                $userEmail = $_SESSION['user']['email'];
            } else {
                $userEmail = $_SESSION['adress']['email'];
                $userName = $_SESSION['adress']['name'];
                $userSurname = $_SESSION['adress']['surname'];
                $userPhone = $_SESSION['adress']['phone'];
                $userAdress = $_SESSION['adress']['adress'];
                $userPostalCode = $_SESSION['adress']['postalCode'];
            }

            foreach (array_unique($_SESSION['cart_list'], SORT_REGULAR) as $productArray) {
                $productAmount = 0;
                foreach ($productArray as $product) {
                    foreach ($_SESSION['cart_list'] as $value) {
                        foreach ($value as $value2) {
                            if ($value2 == $product) {
                                $productAmount++;
                            }
                        }
                    }

                    $ordersDB->create([
                        'product_id' => $product['product_id'],
                        'product_name' => $product['product_name'],
                        'price' => $product['price'],
                        'category_id' => $product['category_id'],
                        'productAmount' => $productAmount,
                        'name' => $userName,
                        'surname' => $userSurname,
                        'email' => $userEmail,
                        'adress' => $userAdress,
                        'postalCode' => $userPostalCode,
                        'phone' => $userPhone,
                        'total' => $product['price'] * $productAmount
                    ]);
                }
            }
            $_SESSION['message'] = 'Payment complete! We are working on your order!';
            unset($_SESSION['cart_list']);
            header("Location: cart.php");
        } else {
            $errors = '<ul>';
            foreach ($v->errors() as $error) {
                foreach ($error as $item) {
                    $errors .= "<li>{$item}</li>";
                    header("Location: paymentPage.php");
                }
            }
            $errors .= "</ul>";
            $_SESSION['message'] = $errors;
        }
        die;
    }
}
