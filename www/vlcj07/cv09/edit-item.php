<?php
require './db/db.php';

$query = "SELECT * FROM `cv09_goods` WHERE `good_id` = :goodId";
$statement = $pdo->prepare($query);
$statement->execute(['goodId' => $_GET['good_id']]);

if (!empty($_POST)) {
    $goodId = $_GET['good_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img = $_POST['img'];


    $query = "UPDATE `cv09_goods`  SET name = :name, price = :price, description = :description, img = :img WHERE good_id = :goodId";
    $statement = $pdo->prepare($query);
    $statement->execute(['goodId' => $goodId, 'name' => $name, 'price' => $price, 'description' => $description, 'img' => $img]);
}
?>

<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Update Item</h2>
            <?php if (!empty($_POST)) : ?>
                <p>Product updated!</p>
            <?php endif; ?>
            <form class="w-full max-w-sm" method="POST">
                <div class="flex items-center border-2 rounded-xl border-amber-100 py-2 flex-col gap-2">
                    <input class="border-2" id="name" name="name" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Product Name" aria-label="name">
                    <input class="border-2" id="price" name="price" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Product Price" aria-label="price">
                    <input class="border-2" id="description" name="description" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Product Description" aria-label="description">
                    <input class="border-2" id="img" name="img" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Product Image" aria-label="img">
                    <button class="flex-shrink-0 bg-amber-100 hover:bg-amber-50 border-amber-100 hover:border-amber-50 text-sm dark:text-black border-4  py-1 px-2 rounded" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>