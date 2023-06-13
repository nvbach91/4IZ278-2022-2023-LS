<?php $pageTitle = 'Fruitopia - Detail produktu' ?>
<?php $metaKW = 'Fruitopia, products, produkty, fruits, ovoce, lahodné, čerstvé' ?>
<?php $metaDescription = 'Fruitopia nabízí všechna dostupná exotická ovoce ze všech koutů světa.' ?>

<?php require '../controllers/fb/authorization.php'; ?>
<?php require '../controllers/productController.php'; ?>
<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Detail produktu</h1>
    <section id="product" class="flex justify-center mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <div class="m-5">
                <div class="flex flex-row gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    <?php include './displays/fb/ProductDetailDisplay.php' ?>
                </div>
            </div>
    </section>
</main>
<?php include './incl/footer.php' ?>