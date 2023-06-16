<?php $pageTitle = 'Fruitopia - Přehled uživatelů' ?>
<?php $metaKW = 'Fruitopia, users' ?>
<?php $metaDescription = 'Fruitopia nabízí všechna dostupná exotická ovoce ze všech koutů světa. Tady však nalezneš přehled všech uživatelů na stránce.' ?>

<?php require '../controllers/usersController.php'; ?>

<?php include './incl/header.php'; ?>
<main class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold text-center sm:text-5xl m-10 text-slate-900 dark:text-white">Přehled všech registrovaných uživatelů</h1>
    <section id="products" class="flex justify-center mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './displays/UsersDisplay.php' ?>
            </div>
            <div class="text-center mt-4 text-gray-700 dark:text-white text-xl p-5 m-5 gap-1">
                <?php for ($i = 0; $i < $paginationCount; $i++) { ?>
                    <a class="p-0.5" href="<?php echo './users.php?limit=' . $limit . '&offset=' . $i * 4; ?>"><?php echo $i + 1 ?></a>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<script src="../public/js/confirm-delete.js"></script>
<?php include './incl/footer.php' ?>