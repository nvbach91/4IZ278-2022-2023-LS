<!-- tady bude detail objednávky + možnost vybrání platby -->

<?php $pageTitle = 'Fruitopia - Nákupní seznam' ?>
<?php $metaKW = 'Fruitopia, cart, eshop, košík, buy, fruits' ?>
<?php $metaDescription = 'Našim zákazníkům přinášíme to nejčerstvější a nejlahodnější exotické ovoce dostupné na trhu za ty nejpříznivější ceny. Jsme Fruitopia, váš svět exotického ovoce.' ?>

<?php require '../controllers/cartController.php'; ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="cart" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Souhrn objednávky a výběr platby</h2>
            <?php if (@$products) : ?>
                <div class="flex flex-col ">
                    <div>
                        <div class="p-2 border rounded-xl grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 my-2">
                            <?php include './displays/UserOrderDetailDisplay.php' ?>
                        </div>

                    </div>
                    <div class="p-2 border rounded-xl grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 my-2">
                        <div class="flex flex-1 flex-col px-5 py-2">
                            <div>
                                <h1 class="whitespace-nowrap mt-4 text-2xl font-bold text-gray-700 dark:text-white">Cena platby a doručení:</h1>
                            </div>
                            <div>
                                <?php echo number_format(floatval($_SESSION['delivery_method']), 2); ?> Kč
                            </div>
                        </div>
                    </div>
                    <div>Celkem: <strong><?php echo number_format($sum + $_SESSION['delivery_method'], 2); ?>Kč</strong></div>

                    <div class="p-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 border rounded-xl my-2">
                        <?php include './displays/UserOrderDisplay.php' ?>
                    </div>
                </div>

                <div class="m-2 text-center">
                    <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../controllers/orderController.php">Dokončit objednávku</a>
                </div>
            <?php else : ?>
                <h5>Nic tady není. 😔</h5>
                <div class="m-5 text-center">
                    <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="products.php">Zpět k produktům</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include './incl/footer.php'; ?>