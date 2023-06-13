<?php $pageTitle = 'Fruitopia - Úprava profilu' ?>
<?php $metaKW = 'Fruitopia, edit, profile, user' ?>
<?php $metaDescription = 'Úprava vašeho profilu v obchodě Fruitopia.' ?>

<?php require '../controllers/edit-profile.php' ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="edit-item" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <?php include './displays/ErrorDisplay.php' ?>
            <div class="mx-auto rounded-xl bg-white max-w-2xl  sm:p-6 lg:max-w-7xl lg:px-8 shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-700">
                <h2 class="text-4xl font-bold text-center sm:text-5xl m-7 text-slate-900 dark:text-white">Správa účtu</h2>
                <div class="p-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8 border rounded-xl">
                    <?php include './displays/EditCurrentUserDisplay.php' ?>
                </div>
                <form class="w-full space-y-4 md:space-y-6 max-w-sm m-auto" method="POST">
                    <div class="flex flex-col py-1">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['name'] ?></label>
                        <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nové jméno" aria-label="name">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['email'] ?></label>
                        <input id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="email" placeholder="Nový email" aria-label="email">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['phone'] ?></label>
                        <input id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="phone" placeholder="Nové telefonní číslo" aria-label="phone">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="adress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['adress'] ?></label>
                        <input id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nová adresa (ulice a č.p.)" aria-label="adress">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['city'] ?></label>
                        <input id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nové město" aria-label="city">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['zip_code'] ?></label>
                        <input id="zip_code" name="zip_code" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nové poštovní směrovací číslo" aria-label="zip_code">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo $current_user['country'] ?></label>
                        <input id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Nový stát" aria-label="country">
                    </div>
                    <div class="flex flex-col py-1">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše heslo</label>
                        <input id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="password" placeholder="••••••••" aria-label="password">
                    </div>
                    <div class="m-2 flex justify-center items-center py-2">
                        <button class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800" type="submit">
                            Aktualizovat údaje
                        </button>
                    </div>
                </form>
            </div>
    </section>
</main>

<?php include './incl/footer.php'; ?>