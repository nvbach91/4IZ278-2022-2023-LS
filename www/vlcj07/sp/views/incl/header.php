<!DOCTYPE html>
<html lang="cs">

<head>
    <!-- nastavit meta popisky, variabilní dle stránky -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $metaKW ?>">
    <meta name="description" content="<?php echo $metaDescription ?>">
    <!-- nastavit název variabilní dle stránky/view -->
    <title><?php echo $pageTitle ?></title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <script src="../public/js/main.js"></script>
    <link rel="icon" href="./public/img/icon/avocado.png" />
</head>

<body class="min-h-screen bg-slate-50 dark:bg-black dark:text-white">
    <header class="bg-orange-100 dark:bg-gray-900 dark:text-white sticky top-0 z-10">
        <section class="max-w-4xl mx-auto p-4 flex justify-between items-center ">
            <h1 class="text-3xl font-medium">
                <a href="main.php">🥑Fruitopia</a>
            </h1>
            <div>
                <button id="hamburger-menu" class="text-3xl md:hidden cursor-pointer relative w-8 h-8">
                    <div class="bg-black dark:bg-white w-8 h-1 rounded absolute top-4 -mt-0.5 transition-all duration-500 before:content-[''] before:bg-black before:dark:bg-white before:w-8 before:h-1 before:rounded before:absolute before:-translate-x-4 before:-translate-y-3 before:transition-all before:duration-500 after:content-[''] after:bg-black after:dark:bg-white after:w-8 after:h-1 after:rounded after:absolute after:-translate-x-4 after:translate-y-3 after:transition-all after:duration-500"></div>
                </button>
                <nav class="hidden md:block space-x-8 text-xl" aria-label="main">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a href="cart.php" class="hover:opacity-90">Košík</a>
                        <a href="products.php" class="hover:opacity-90">Produkty</a>
                        <a href="main.php#about" class="hover:opacity-90">O nás</a>
                        <a href="#contact" class="hover:opacity-90">Kontakt</a>
                        <a href="profile.php" class="hover:opacity-90">Profil</a>
                        <a href="../controllers/logout.php" class="hover:opacity-90">Odhlásit se</a>
                    <?php else : ?>
                        <a href="products.php" class="hover:opacity-90">Produkty</a>
                        <a href="main.php#about" class="hover:opacity-90">O nás</a>
                        <a href="#contact" class="hover:opacity-90">Kontakt</a>
                        <a href="login.php" class="hover:opacity-90">Přihlásit se</a>
                    <?php endif; ?>

                </nav>
            </div>
        </section>
        <section id="mobile-menu" class="absolute top-68 text-white bg-black w-full text-5xl flex-col justify-content-center origin-top animate-open-menu hidden">
            <nav class="flex flex-col min-h-screen items-center py-8" aria-label="mobile">
                <a href="main.php" class="w-full text-center py-6 hover:opacity-90">Domů</a>
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="cart.php" class="w-full text-center py-6 hover:opacity-90">Košík</a>
                    <a href="main.php#about" class="w-full text-center py-6 hover:opacity-90">O nás</a> 
                    <a href="#contact" class="w-full text-center py-6 hover:opacity-90">Kontakt</a>
                    <a href="profile.php" class="w-full text-center py-6 hover:opacity-90">Profil</a>
                    <a href="../controllers/logout.php" class="w-full text-center py-6 hover:opacity-90">Odhlásit se</a>
                <?php else : ?>
                    <a href="main.php#about" class="w-full text-center py-6 hover:opacity-90">O nás</a> 
                    <a href="#contact" class="w-full text-center py-6 hover:opacity-90">Kontakt</a>
                    <a href="login.php" class="w-full text-center py-6 hover:opacity-90">Přihlásit se</a>
                <?php endif; ?>

            </nav>
        </section>
    </header>