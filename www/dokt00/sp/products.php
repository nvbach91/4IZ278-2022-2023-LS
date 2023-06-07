<?php
$db_host = 'localhost';
$db_name = 'tea_shop';
$db_user = 'root';
$db_password = '';

//connection to db
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM product";
$result = $conn->query($sql);

$productCounter = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($productCounter % 3 == 0) {
            echo '<section class="products">';
        }

        echo '<div class="product">';
        echo '<img src="' . $row["image_url"] . '" alt="' . $row["name"] . '">';
        echo '<h3>' . $row["name"] . '</h3>';
        echo '<p>$' . $row["price"] . '</p>';
        echo '<form method="POST" action="add_to_cart.php">';
        echo '<input type="hidden" name="product_id" value="' . $row["product_id"] . '">';
        echo '<button type="submit">Add to Cart</button>';
        echo '</form>';
        echo '</div>';

        $productCounter++;

        if ($productCounter % 3 == 0) {
            echo '</section>';
        }
    }

    if ($productCounter % 3 != 0) {
        echo '</section>';
    }

} else {
    echo "No products found";
}

$conn->close();
