<?php $pageTitle = 'Fruitopia - Vaše objednávka' ?>
<?php $metaKW = 'Fruitopia, orders, objednávky, ovoce' ?>
<?php $metaDescription = 'Přehled vašich objednávek ve Fruitopii.' ?>

<?php require '../controllers/order-detailsController.php'; ?>
<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Detail objednávky</h1>
    <section id="orders" class="flex justify-center mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <?php if ($current_user['user_id'] === $orders['user_id']) : ?>
                <?php if (@$order) : ?>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                        <?php include './displays/OrderDetailDisplay.php' ?>
                    </div>

                <?php else : ?>
                    <h5>Nic tady není. 😔</h5>
                <?php endif; ?>
            <?php else : ?>
                <?php header('Location: access-forbidden.php'); ?>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php include './incl/footer.php' ?>