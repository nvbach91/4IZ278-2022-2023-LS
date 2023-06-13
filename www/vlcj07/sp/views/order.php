<?php $pageTitle = 'Fruitopia - Objednávka přijata' ?>
<?php $metaKW = 'Fruitopia, cart, eshop, objednávka, order, fruits' ?>
<?php $metaDescription = 'V pořádku jsme přijali vaši objednávku a o procesu vás budeme informovat. Jsme Fruitopia.' ?>
<?php
require '../controllers/authorization.php';
?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="order" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="flex flex-col mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Objednávka byla v pořádku přijata.</h2>
            <h5>O procesu Vás budeme průběžně informovat. 🙂</h5>
        </div>

    </section>
    <div class="flex flex-row justify-center">
        <div class="m-2 text-center">
            <a href="main.php" class=" text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">Zpět na hlavní stránku</a>
        </div>
        <div class="m-2 text-center">
            <a href="orders.php" class=" text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">Moje objednávky</a>
        </div>
    </div>
</main>

<?php include './incl/footer.php';
?>