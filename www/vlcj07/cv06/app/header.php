<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banana Shop</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="./js/main.js"></script>
    <link rel="icon" href="https://img.icons8.com/emoji/48/null/banana-emoji.png"/>
</head>
<body class="min-h-screen bg-slate-50 dark:bg-black dark:text-white">
    <header class="bg-amber-50 dark:bg-gray-900 dark:text-white sticky top-0 z-10">
        <section class="max-w-4xl mx-auto p-4 flex justify-between items-center ">
            <h1 class="text-3xl font-medium">
                <a href="#products"> 🍌Banana Shop</a>
            </h1>
            <div>
                <button id="hamburger-menu" class="text-3xl md:hidden cursor-pointer relative w-8 h-8">
                    <div class="bg-white w-8 h-1 rounded absolute top-4 -mt-0.5 transition-all duration-500 before:content-[''] before:bg-white before:w-8 before:h-1 before:rounded before:absolute before:-translate-x-4 before:-translate-y-3 before:transition-all before:duration-500 after:content-[''] after:bg-white after:w-8 after:h-1 after:rounded after:absolute after:-translate-x-4 after:translate-y-3 after:transition-all after:duration-500"></div>
                </button>
                <nav class="hidden md:block space-x-8 text-xl" aria-label="main">
                    <a href="#products" class="hover:opacity-90">Home</a>
                    <a href="#carousel" class="hover:opacity-90">Best Products</a>
                    <a href="#about" class="hover:opacity-90">About Us</a>
                    <a href="#contact" class="hover:opacity-90">Contact</a>
                </nav>
            </div>
        </section>
        <section id="mobile-menu" class="absolute top-68 bg-black w-full text-5xl flex-col justify-content-center origin-top animate-open-menu hidden">
            <nav class="flex flex-col min-h-screen items-center py-8" aria-label="mobile">
                <a href="#products" class="w-full text-center py-6 hover:opacity-90">Home</a>
                <a href="#carousel" class="w-full text-center py-6 hover:opacity-90">Best Products</a>
                <a href="#about" class="w-full text-center py-6 hover:opacity-90">About</a>
                <a href="#contact" class="w-full text-center py-6 hover:opacity-90">Contact</a>
            </nav>
        </section>
    </header>