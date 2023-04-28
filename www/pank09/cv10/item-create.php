<?php include "./components/base/head.php"; ?>

<main class="container">
    <?php
        if (!$authUser || !($authUser->privilege > 1)) {
            header('HTTP/1.0 403 Forbidden');
            exit('You are forbidden');
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            require_once __DIR__ . '/classes/ProductsDB.php';

            $productsDatabase = new ProductsDB;
            $productsDatabase->create([
                'name' => $_POST['name'],
                'price' => (float) $_POST['price'],
                'description' => $_POST['description'],
                'img' => $_POST['image']
            ]);

            header('Location: index.php');
            exit();
        }
    ?>

    <h1>Creating new good</h1>
    <form method="POST" style="min-height: calc(100vh - 230px);">
    <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input class="form-control" id="image" name="image" placeholder="Image URL">
        </div>
        <div class="form-group">
            <label for="price">Price (Kč)</label>
            <input class="form-control" id="price" name="price" placeholder="Price (Kč)">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>  
    </form>
</main>

<?php include "./components/base/foot.php"; ?>