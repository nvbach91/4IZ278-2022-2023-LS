<?php require '../controllers/create-itemController.php' ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="edit-item" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <!-- přidat výpis kateogiríí (čísel a názvů) -->
            <?php if (!empty($_POST)) : ?>
                <p>Produkt vytvořen!</p>
            <?php endif; ?>
            <div class="mx-auto rounded-xl bg-white max-w-2xl  sm:p-6 lg:max-w-7xl lg:px-8 shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-700">
                <h2 class="text-4xl font-bold text-center sm:text-5xl m-7 text-slate-900 dark:text-white">Nový produkt</h2>
                <form class="w-full space-y-4 md:space-y-6 max-w-sm m-auto" method="POST">
                    <div class="flex flex-col py-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Název produktu</label>
                        <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nový název" aria-label="name">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cena produktu (v Kč)</label>
                        <input id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nová cena (v Kč)" aria-label="price">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Popis produktu</label>
                        <input id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nový popis" aria-label="description">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Obrázek produktu</label>
                        <input id="img" name="img" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="URL obrázku" aria-label="img">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="available" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dostupnost produktu</label>
                        <input id="available" name="available" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Dostupnost produktu -> 1 = dostupný, 0 = nedostupný" aria-label="available">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategorie produktu</label>
                        <input id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Kategorie produktu (číslo)" aria-label="available">
                    </div>
                    <div class="m-2 flex justify-center items-center py-2">
                        <button class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800" type="submit">
                            Aktualizovat produkt
                        </button>
                    </div>
                </form>
            </div>
    </section>
</main>

<?php include './incl/footer.php'; ?>