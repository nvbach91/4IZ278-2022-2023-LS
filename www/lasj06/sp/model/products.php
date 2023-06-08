<?php
require_once 'db.php';

function fetchAllProducts()
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM products');
    $stmt->execute([]);
    $products = @$stmt->fetchAll();
    return $products;
}

function fetchAllCategories()
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT DISTINCT category FROM categories');
    $stmt->execute([]);
    $categories = @$stmt->fetchAll();
    return $categories;
}

function fetchAllProductsByCategory($categories)
{
    $productIdArray = []; // for keeping track of how many of the selected categories does an id appear for

    foreach ($categories as $category) {
        $db = newDB();
        @$stmt = $db->prepare('SELECT product_id FROM categories WHERE category = :category');
        $stmt->execute([
            'category' => $category,
        ]);
        $productIds = @$stmt->fetchAll();
        foreach ($productIds as $productId) {
            array_push($productIdArray, $productId);
        }
    }

    $categoryCount = count($categories);
    $productIds = []; // for cleaning the $productIdArray array

    foreach ($productIdArray as $productId) {
        array_push($productIds, $productId['product_id']);
    }

    $idCount = array_count_values($productIds);

    $allCategoryIds = []; // for placing only Ids valid to the search into an array 

    foreach (array_keys($idCount) as $idKey) {
        //echo $idKey;
        if ($idCount[$idKey] == $categoryCount) {
            array_push($allCategoryIds, $idKey);
        }
    }

    $productsByCategory = []; //  for keeping track of relevant productss

    foreach ($allCategoryIds as $productId) {
        $db = newDB();
        @$stmt2 = $db->prepare('SELECT * FROM products WHERE product_id = :product_id');
        $stmt2->execute([
            'product_id' => $productId,
        ]);
        $product = @$stmt2->fetchAll();
        array_push($productsByCategory, $product);
    }
    $productsByCategory = call_user_func_array('array_merge', $productsByCategory);
    return $productsByCategory;
}

function fetchProductById($product_id)
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM products WHERE product_id = :product_id');
    $stmt->execute([
        "product_id" => $product_id,
    ]);
    $product = @$stmt->fetchAll()[0];
    return $product;
}

function fetchProductsByName($search)
{
    $db = newDB();
    @$stmt = $db->prepare('SELECT * FROM products WHERE name LIKE :search');
    $stmt->execute([
        "search" => $search,
    ]);
    $products = @$stmt->fetchAll();
    return $products;
}

function updateProduct($product_id)
{
    $db = newDB();
    @$stmt = $db->prepare('UPDATE products SET name = :name, price = :price, description = :description, image = :image WHERE product_id = :product_id');
    $stmt->execute([
        "product_id" => $product_id,
        "name" => $_POST['name'],
        "price" => $_POST['price'],
        "description" => $_POST['description'],
        "image" => $_POST['image_link']
    ]);
}
