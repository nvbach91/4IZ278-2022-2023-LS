<?php 
require_once './db/db.php';
require 'authorization.php';
?>

<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-10 text-slate-900 dark:text-white">You don' have permission to do this.</h2>
            <a class="bg-amber-50 mt-4 rounded-xl text-gray-700 dark:text-white text-xl p-5 m-5 dark:bg-gray-900" href="index.php">Get back to Main Page</a>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>