<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Soundchecker</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="h-screen flex flex-col justify-stretch">
    <header class="bg-dots-darker min-h-[25%] bg-gray-900 text-white flex flex-col p-6">
        <div class="pt-8 lg:m-auto lg:w-[800px] w-full">
            <h1 class="text-3xl bold">Soundchecker</h1>
            <span>Rehearsal &amp; studio room booking app</span>
        </div>
        <div class="flex flex-row mt-8 sm:mb-4 m-auto justify-between lg:w-[800px] w-full">
            <nav>
                <ul class="flex flex-col sm:flex-row gap-4 sm:gap-8">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Rehearsal rooms</a></li>
                    <li><a href="#">Studio rooms</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div>User panel</div>
        </div>
    </header>
    <main class="flex flex-col m-auto mt-4 p-6 lg:w-[1024px]">
        <p>Pilot version, work in progress</p>
        <?php echo e(var_dump($users)); ?>

        <p>connection to db works</p>
    </main>
    <footer class="min-h-[200px] bg-gray-900">
        <div class="lg:w-[1024px] p-6 m-auto text-white">
            <p>Footer</p>
        </div>
    </footer>
</body>

</html><?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/welcome.blade.php ENDPATH**/ ?>