<?php foreach ($users as $user) : ?>
    <a href="#" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
            <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" alt="user image" class="h-full w-full aspect-[1/1] object-cover object-center group-hover:opacity-75">
        </div>
        <div class="">
            <h2 class="mt-4 text-xl font-bold text-gray-700 dark:text-white"><?php echo $user["name"] ?></h2>
            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white"><?php echo $user['email'] ?></p>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white">ID: <?php echo $user["user_id"] ?></h3>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div class="flex flex-row">
                    <div class="my-4 mx-1 text-center">
                        <a class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../views/edit-user.php?user_id=<?php echo $user['user_id'] ?>">Upravit</a>
                    </div>
                    <div class="my-4 mx-1 text-center">
                        <a id="delete-button" onclick="confirmDelete(event)" class="w-full text-black dark:text-white bg-orange-100 hover:bg-orange-200 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700" href="../controllers/delete-user.php?user_id=<?php echo $user['user_id'] ?>">Smazat</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </a>
<?php endforeach; ?>