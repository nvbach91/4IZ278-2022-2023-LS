<?php
include 'database.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($query)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ?");
    $stmt->execute(["%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        foreach ($results as $product) {
            echo $product['product_name'] . "<br>";
            
        }
    } else {
        echo "No products found.";
    }
} else {
    echo "Please enter a search term.";
}
?>
