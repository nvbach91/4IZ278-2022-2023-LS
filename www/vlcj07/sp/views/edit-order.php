<?php $pageTitle = 'Fruitopia - Úprava produktů' ?>
<?php $metaKW = 'Fruitopia, edit, fruits' ?>
<?php $metaDescription = 'Našim zákazníkům přinášíme to nejčerstvější a nejlahodnější exotické ovoce dostupné na trhu za ty nejpříznivější ceny. Jsme Fruitopia, váš svět exotického ovoce.' ?>

<?php require '../controllers/edit-orderController.php' ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="edit-item" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">

            <div class="mx-auto rounded-xl bg-white max-w-2xl  sm:p-6 lg:max-w-7xl lg:px-8 shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-700">
                <h2 class="text-4xl font-bold text-center sm:text-5xl m-7 text-slate-900 dark:text-white">Úprava produktu</h2>
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 border rounded-xl">
                <?php include './displays/EditOrderDisplay.php'; ?>
                </div>
                <form class="w-full space-y-4 md:space-y-6 max-w-sm m-auto" method="POST">
                    <div class="flex flex-col py-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dostupnost produktu</label>
                        <select id="status" name="status" class="block py-2.5 px-2 w-full text-sm text-gray-500 bg-transparent border-1 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200">
                            <option selected value="<?php echo $orders['status'] ?>"><?php echo $orders["status"] ? 'Nová' : 'Zpracována' ?></option>
                            <option value="new">Nová</option>
                            <option value="processed">Zpracována</option>
                        </select>
                    </div>
                    <div class="m-2 flex justify-center items-center py-2">
                        <button class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800" type="submit">
                            Aktualizovat stav objednávky
                        </button>
                    </div>
                </form>
            </div>
    </section>
</main>

<?php include './incl/footer.php'; ?>