<?php


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}



function add_to_cart($product_id, $quantity) {
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

function remove_from_cart($product_id) {
    unset($_SESSION['cart'][$product_id]);
}

function update_cart_quantity($product_id, $quantity) {
    $_SESSION['cart'][$product_id] = $quantity;
}

function clearCart() {
    $_SESSION['cart'] = array();
    header('Location: pages/cart.php');
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'update') {
        update_cart_quantity($_POST['product_id'], $_POST['quantity']);
        header('Location: pages/cart.php');
    } elseif ($_POST['action'] == 'remove') {
        remove_from_cart($_POST['product_id']);
        header('Location: pages/cart.php');
    } elseif ($_POST['action'] == 'add') {
        add_to_cart($_POST['product_id'], $_POST['quantity']);
        header('Location: pages/cart.php');
    } elseif ($_POST['action'] == 'clear') {
        clearCart();
        
    }
    
    exit;
}
