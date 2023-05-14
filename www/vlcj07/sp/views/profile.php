<!-- verze pro admina a verze pro uživatele -->

<?php
require '../models/UsersDB.php';
require '../controllers/authorization.php';

?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="profile" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Tvůj profil</h2>
            <?php if ($current_user['role'] === 'admin') : ?>
                <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="modify-products.php">Spravovat produkty</a>
                <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="users.php">Spravovat uživatele</a>
            <?php endif; ?>
            <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="orders.php">Moje objednávky</a>
            <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="user.php">Upravit účet</a>

        </div>
    </section>
</main>

<?php include './incl/footer.php';?>