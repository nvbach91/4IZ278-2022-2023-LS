<?php $pageTitle = 'Fruitopia - Detail produktu' ?>
<?php $metaKW = 'Fruitopia, products, produkty, fruits, ovoce, lahodné, čerstvé' ?>
<?php $metaDescription = 'Fruitopia nabízí všechna dostupná exotická ovoce ze všech koutů světa.' ?>

<?php require '../controllers/authorization.php'; ?>
<?php require '../controllers/productController.php'; ?>
<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Detail produktu</h1>
    <section id="product" class="flex justify-center mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="m-5">
                <?php if ($current_user['role'] === 'admin') : ?>
                    <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../views/edit-item.php?product_id=<?php echo $product['product_id'] ?>">Upravit produkt</a>
                <?php endif; ?>
            </div>

            <div class="flex flex-row gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './displays/ProductDetailDisplay.php' ?>
            </div>
        </div>
    </section>
</main>
<?php include './incl/footer.php' ?>