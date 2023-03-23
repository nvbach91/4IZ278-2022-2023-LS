<?php $pageTitle = "Home page"; ?>

<?php include './php/header.php' ?>

<body>
    <div class="flex flex-col items-center h-screen box-border font-serif py-20 px20 space-y-6">
        <h1 class=" text-5xl font-bold">Welcome to our page</h1>
        <p>If you want to continue, you need to have an account</p>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='./php/login-form.php'">Login</button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="location.href='./php/registration-form.php'">Register</button>    
    </div>
</body>
<?php include './php/footer.php' ?>