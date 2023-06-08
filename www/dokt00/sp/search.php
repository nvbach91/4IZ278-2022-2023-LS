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

$searchQuery = "%" . $_POST['query'] . "%";
$sql = "SELECT * FROM product WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $searchQuery);
$stmt->execute();

$result = $stmt->get_result();

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
        echo '<form method="POST">';
        echo '<input type="hidden" name="product_id" value="' . $row["product_id"] . '">';
        echo '<button class="add-to-cart" type="submit">Add to Cart</button>';
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
?>
