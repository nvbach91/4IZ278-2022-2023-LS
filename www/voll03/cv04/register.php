<?php

include './utils.php';

$pageTitle = "Card Tournament - Registration";
$heading = "Registration";
$cssFile = "./css/output.css";

?>

<?php include './head.php' ?>

<body>
    <main class="px-6 py-4 box-border font-sans bg-gradient-to-br from-black via-[#00031b] to-[#090018]">
        <h1 class="text-3xl text-center font-heading text-white"><?php echo $heading ?></h1>
        <div class="flex flex-col content-center flex-wrap">

            <?php $type = REGISTRATION;
            include __DIR__ . '/validation.php'; ?>

            <form class="m-8 p-8 w-[400px] bg-[#333333]/10 rounded-xl text-white" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php include __DIR__ . '/error-panel.php' ?>

                <div class="flex items-center mt-2 mb-2">
                    <label for="name" class="w-[128px]">Name</label>
                    <input id="name" class="grow m-1 p-1 rounded-md text-black" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                </div>

                <div class="flex items-center mt-2 mb-2">
                    <label for="gender" class="w-[128px]">Gender</label>
                    <select id="gender" name="gender" class="grow m-1 p-1 rounded-md text-black">
                        <option value="" disabled selected hidden>Choose your gender</option>
                        <option value="M" <?php echo (isset($gender) && $gender === 'M') ? 'selected' : ''; ?>>Male</option>
                        <option value="F" <?php echo (isset($gender) && $gender === 'F') ? 'selected' : ''; ?>>Female</option>
                        <option value="O" <?php echo (isset($gender) && $gender === 'O') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="flex items-center mt-2 mb-2">
                    <label for="email" class="w-[128px]">E-mail</label>
                    <input id="email" class="grow m-1 p-1 rounded-md text-black" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                <small class="text-white/60 text-[12px]">Example: jack@oneill.com</small>

                <div class="flex items-center mt-2 mb-2">
                    <label for="password" class="w-[128px]">Password</label>
                    <input id="password" class="grow m-1 p-1 rounded-md text-black" name="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
                </div>

                <div class="flex items-center mt-2 mb-2">
                    <label for="password_check" class="w-[128px]">Password (repeat)</label>
                    <input id="password_check" class="grow m-1 p-1 rounded-md text-black" name="password_check" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
                </div>
                <hr class="opacity-25 mt-4 pt-2">
                <small class="text-white/60 text-[12px]">Password must contain at least one capital letter, one special character (e.g. +, -, ! etc.), one digit and must be at least 8 letters long.</small>
                <hr class="opacity-25 mt-4 pt-2">
                <div class="flex items-center mt-2 mb-2">
                    <label for="phone" class="w-[128px]">Phone number</label>
                    <input id="phone" class="grow m-1 p-1 rounded-md text-black" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                </div>

                <div class="flex items-center mt-2 mb-2">
                    <label for="avatar" class="w-[128px]">Avatar URL</label>
                    <input id="avatar" class="grow m-1 p-1 rounded-md text-black" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>">
                </div>
                <small class="text-white/60 text-[12px]">Example: https://eso.vse.cz/~voll03/cv04/img/avatar.jpg</small>

                <div class="flex items-center mt-4 mb-2">
                    <label for="deck" class="w-1/2">Card deck name</label>
                    <input id="deck" class="w-1/2 m-1 p-1 rounded-md text-black" name="deck" value="<?php echo isset($deck) ? $deck : ''; ?>">
                </div>

                <div class="flex">
                    <label for="cards_count" class="w-3/4">Number of cards in deck</label>
                    <input id="cards_count" class="w-1/4 m-1 p-1 rounded-md text-black" name="cards_count" value="<?php echo isset($cardsCount) ? $cardsCount : ''; ?>">
                </div>

                <button class="block m-auto mt-4 py-2 px-4 rounded-md border-2 border-[#0c1435] bg-[#060918] hover:bg-[#130935] hover:border-[#3a0849]" type="submit">Submit</button>
            </form>

            <?php include __DIR__ . '/getback.php' ?>

        </div>
    </main>
</body>

<?php include './footer.php' ?>