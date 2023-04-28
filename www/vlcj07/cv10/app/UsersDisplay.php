<?php foreach ($users as $user) : ?>
    <a href="users.php" class="group">
        <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="<?php echo $product["name"] ?>" class="h-full w-full aspect-[4/3] object-cover object-center group-hover:opacity-75">
        </div>
        <div>
            <h3 class="mt-4 text-sm text-gray-700 dark:text-white"><?php echo $user['email'] ?></h5>
            </h3>
            <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white">Privilege: <?php echo $user['privilege'] ?></p>
            <div>
                <form action="users.php" method="POST">
                    <select id="privilege" name="privilege">
                        <option value="1" <?php echo (isset($user["privilege"]) &&  $user["privilege"] == 1) ?  "selected" : ""; ?>>1</option>
                        <option value="2" <?php echo (isset($user["privilege"]) &&  $user["privilege"] == 2) ?  "selected" : ""; ?>>2</option>
                        <option value="3" <?php echo (isset($user["privilege"]) &&  $user["privilege"] == 3) ?  "selected" : ""; ?>>3</option>
                    </select>
                    <button class="flex-shrink-0 bg-amber-100 hover:bg-amber-50 border-amber-100 hover:border-amber-50 text-sm dark:text-black border-4  py-1 px-2 rounded" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </a>
<?php endforeach; ?>