<?php $pageTitle = 'Fruitopia - Editace produktů' ?>
<?php $metaKW = 'Fruitopia, products, produkty, fruits, ovoce, lahodné, čerstvé' ?>
<?php $metaDescription = 'Fruitopia nabízí všechna dostupná exotická ovoce ze všech koutů světa.' ?>

<?php
require '../controllers/authorization.php';

require '../controllers/admin-required.php';
?>
<?php
require '../controllers/productsController.php';
?>
<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">

    <section id="products" class="flex justify-center  mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Správa produktů</h2>
            <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="create-item.php">Nový produkt</a>
            <div class="flex flex-col justify-between items-center my-10 space-y-2 text-2xl text-slate-900 dark:text-white ">
                <?php include './displays/CategoryDisplay.php' ?>
            </div>
            

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './displays/ModifyProductDisplay.php' ?>
            </div>
            <div class="text-center mt-4 text-gray-700 dark:text-white text-xl p-5 m-5 gap-1">
                <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                    <a class="p-0.5" href="<?php echo './modify-products.php?limit=' . $limit . '&offset=' . $i * 4; ?>"><?php echo $i + 1 ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<?php include './incl/footer.php'; ?>