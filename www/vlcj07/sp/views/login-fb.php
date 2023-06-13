<?php $pageTitle = 'Fruitopia - Přihlášení přes Facebook' ?>
<?php $metaKW = 'Fruitopia, přihlášení, login, eshop, fruits' ?>
<?php $metaDescription = 'Přihlášení do internetového obchodu Fruitopia. Pro nakupování se musíte přihlásit.' ?>

<?php include './incl/header.php'; ?>
<?php require '../controllers/loginFBbutton.php' ?>

<main class="max-w-4xl mx-auto">
    <div class="text flex justify-center items-center py-8 flex-col">
        <a class="w-1/2 text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="<?php echo htmlspecialchars($loginUrl); ?>">Přihlášení přes Facebook</a>
    </div>
    <div class="text flex justify-center items-center py-8 flex-col">

        Upozornění: Přihlášení přes facebook nabízí pouze omezené využití naší stránky.
    </div>
</main>

<?php include './incl/footer.php';
?>