<?php $pageTitle = 'Fruitopia - Produkty' ?>
<?php $metaKW = 'Fruitopia, products, produkty, fruits, ovoce, lahodné, čerstvé' ?>
<?php $metaDescription = 'Fruitopia nabízí všechna dostupná exotická ovoce ze všech koutů světa. Prohlédněte si všechny produkty.' ?>

<?php require '../controllers/fb/authorization.php'; ?>
<?php require '../controllers/productsController.php'; ?>
<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Naše exotické produkty</h1>
    <p class="text-xl text-center sm:text-sm m-10 text-slate-900 dark:text-white">Prohlédněte si naši nabídku produktů.</p>
    <section id="products" class="flex justify-center mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <div class="flex flex-col justify-between items-center my-10 space-y-2 text-2xl text-slate-900 dark:text-white ">
                <?php include './displays/fb/CategoryDisplay.php' ?>
            </div>


            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './displays/fb/ProductDisplay.php' ?>
            </div>
            <div class="text-center mt-4 text-gray-700 dark:text-white text-xl p-5 m-5 gap-1">
                <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                    <a class="p-0.5" href="<?php echo './products-fb.php?limit=' . $limit . '&offset=' . $i * 4; ?>"><?php echo $i + 1 ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php include './incl/footer.php' ?>