<?php

include './utils.php';

$pageTitle = "Card Tournament - Home page";
$heading = "Welcome to our Casino!";
$cssFile = "./css/output.css";
?>

<?php include './head.php' ?>

<body>
    <main class="flex flex-col items-center px-6 py-4 box-border font-sans h-screen bg-gradient-to-br from-black via-[#00031b] to-[#090018]">
        <h1 class="text-3xl text-center font-heading text-white"><?php echo $heading ?></h1>
        <div class="flex flex-col content-center flex-wrap mt-12 w-[400px] p-2 text-white  bg-[#333333]/20">

            <div class="flex flex-col content-center mb-2 mt-2 p-2 w-80">
                <p class="text-center">Start playing NOW!</p>
                <a class="block m-auto mt-4 py-2 px-4 w-24 text-center rounded-md border-2 border-[#0c1435] bg-[#060918]
                 hover:bg-[#130935] hover:border-[#3a0849]" href="./login.php">Login</a>
            </div>

            <div class="flex flex-col content-center mb-2 mt-2 p-2 w-80">
                <p class="text-center">Don't have an account already?</p>
                <a class="block m-auto mt-4 py-2 px-4 w-24 text-center rounded-md border-2 border-[#0c1435] bg-[#060918]
                 hover:bg-[#130935] hover:border-[#3a0849]" href="./register.php">Register</a>
            </div>

        </div>
    </main>
</body>

<?php include './footer.php' ?>