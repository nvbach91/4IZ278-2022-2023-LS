<a href="#edit-current-user" class="group">
    <div class="flex flex-col px-5 py-2">
        <div>
            <h1 class="mt-4 text-2xl font-bold text-gray-700 dark:text-white">Údaje spravovaného uživatele:</h1>
        </div>
        <div>
            <h2 class="mt-4 text-xl font-bold text-gray-700 dark:text-white">Jméno: <?php echo $user["name"] ?></h2>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Role: <?php echo $user["role"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Email: <?php echo $user["email"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Telefon: <?php echo $user["phone"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Ulice a č.p.: <?php echo $user["adress"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Město: <?php echo $user["city"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">PSČ: <?php echo $user["zip_code"] ?></h3>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">Stát: <?php echo $user["country"] ?></h3>
        </div>
        <hr class="mx-auto bg-black dark:bg-white w-1/2">
        <div>
            <h3 class="mt-4 text-sm font-bold text-gray-700 dark:text-white">Při úpravě profilu prosím vyplňte všechny údaje!</h3>
        </div>
    </div>
</a>