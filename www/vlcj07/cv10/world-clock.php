<?php
require_once './db/db.php';
require 'authorization.php';

$timezones = [
    'Europe/Amsterdam',
    'Africa/Abidjan',
    'America/Adak',
    'Antarctica/Casey',
    'Indian/Antananarivo',
    'Europe/Prague'
]

?>
<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">World Clock</h2>
            <div class="flex flex-row justify-between">
                <a class="bg-amber-50 mt-4 rounded-xl text-gray-700 dark:text-white text-xl p-5 m-5 dark:bg-gray-900" href="index.php">Get Back</a>
            </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './app/ClockDisplay.php' ?>
            </div>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>