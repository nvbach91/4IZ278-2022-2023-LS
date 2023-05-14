<?php $pageTitle = 'Fruitopia - Registrace' ?>
<?php $metaKW = 'Fruitopia, registrace, přihlášení, registration, login' ?>
<?php $metaDescription = 'Registrace do internetového obchodu Fruitopia.' ?>

<?php require '../controllers/registrationController.php' ?>
<?php include './incl/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <?php if (!empty($errors)) : ?>
        <div class="flex flex-col text-center m-5 gap-2">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <section id="register" class="w-full flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto rounded-xl bg-white max-w-2xl  sm:p-6 lg:max-w-7xl lg:px-8 shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-900 dark:border-gray-700">
            <h2 class="text-4xl font-bold text-center sm:text-5xl m-7 text-slate-900 dark:text-white">Registrace</h2>
            <form class="w-full space-y-4 md:space-y-6 max-w-sm m-auto" method="POST">
                <div class="flex flex-col py-1">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Váš email</label>
                    <input id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="email" placeholder="vas@email.cz" aria-label="email">
                </div>
                <div class="flex flex-col py-1">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše jméno</label>
                    <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Jan Novák" aria-label="name">
                </div>
                <div class="flex flex-col py-1">
                    <label for="adress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše adresa</label>
                    <input id="adress" name="adress" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Slánská 123" aria-label="adress">
                </div>
                <div class="flex flex-col py-1">
                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše obec</label>
                    <input id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Praha" aria-label="city">
                </div>
                <div class="flex flex-col py-1">
                    <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše PSČ</label>
                    <input id="zip_code" name="zip_code" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="120 00" aria-label="zip_code">
                </div>
                <div class="flex flex-col py-1">
                    <label for="country" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Váš stát</label>
                    <input id="country" name="country" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="text" placeholder="Česká republika" aria-label="country">
                </div>
                <div class="flex flex-col py-1">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Váš telefon</label>
                    <input id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="tel" placeholder="+420 123 456 789" aria-label="phone">
                </div>
                <div class="flex flex-col py-1">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vaše heslo (alespoň 8 znaků)</label>
                    <input id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" type="password" placeholder="••••••••" aria-label="password">
                </div>
                <div class="m-2 flex justify-center items-center py-2">
                    <button class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-primary-800" type="submit">
                        Registrovat se
                    </button>
                </div>
            </form>
            <div class="text flex justify-center items-center py-8 flex-col">
                <a class="text-2xl text-center sm:text-4xl mb-7 text-slate-900 dark:text-white hover:text-slate-700 hover:dark:text-slate-300" href="login.php">Máte účet? Přihlašte se!</a>
                <a class="text-2xl text-center sm:text-4xl text-slate-900 dark:text-white hover:text-slate-700 hover:dark:text-slate-50" href="login-fb.php">Přihlášení přes Facebook</a>
            </div>
        </div>
    </section>
</main>

<?php include './incl/footer.php'; ?>