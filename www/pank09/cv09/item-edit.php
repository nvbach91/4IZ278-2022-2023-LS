<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require_once __DIR__ . '/classes/ProductsDB.php';

        $productsDatabase = new ProductsDB;
        $productsDatabase->update(
            $_POST['good_id'],
            [
                'name' => $_POST['name'],
                'price' => (float) $_POST['price'],
                'description' => $_POST['description'],
                'img' => $_POST['image']
            ]
        );

        header(sprintf('Location: %s', $_SERVER['HTTP_REFERER'] ?? 'index.php'));
        exit();
    } else {
        if (!isset($_GET['id']))
            exit('No product selected.');

        require_once __DIR__ . '/classes/ProductsDB.php';

        $productsDB = new productsDB();
        $product = $productsDB->fetch($_GET['id']);

        if (!$product)
            exit('No product selected.');
    }
?>

<?php include "./components/base/head.php"; ?>

<main class="container">
    <h1>Editing good</h1>
    <form method="POST" style="min-height: calc(100vh - 230px);">
        <input type="hidden" name="good_id" value="<?php echo $product['good_id']; ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $product['name']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description"><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input class="form-control" id="image" name="image" placeholder="Image URL" value="<?php echo $product['img']; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price (Kč)</label>
            <input class="form-control" id="price" name="price" placeholder="Price (Kč)" value="<?php echo $product['price']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>  
    </form>
</main>

<?php include "./components/base/foot.php"; ?>