<?php

include './utils.php';

$pageTitle = "Card Tournament - Login";
$heading = "Login";
$cssFile = "./css/output.css";

?>

<?php include './head.php' ?>

<body>
    <main class="px-6 py-4 box-border font-sans h-screen bg-gradient-to-br from-black via-[#00031b] to-[#090018]">
        <h1 class="text-3xl text-center font-heading text-white"><?php echo $heading ?></h1>
        <div class="flex flex-col content-center flex-wrap">

            <?php $type = LOGIN;
            include __DIR__ . '/validation.php'; ?>

            <form class="m-8 p-8 w-[400px] bg-[#333333]/10 rounded-xl text-white" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <?php include __DIR__ . '/error-panel.php' ?>

                <div class="flex items-center mt-2 mb-2">
                    <label for="email" class="w-[128px]">E-mail</label>
                    <input id="email" class="grow m-1 p-1 rounded-md text-black" name="email" 
                           value="<?php echo isset($email) ? $email : (isset($_GET['email']) ? $_GET['email'] : '') ?>">
                </div>
                <small class="text-white/60 text-[12px]">Example: jack@oneill.com</small>

                <div class="flex items-center mt-2 mb-2">
                    <label for="password" class="w-[128px]">Password</label>
                    <input id="password" class="grow m-1 p-1 rounded-md text-black" name="password" type="password" value="<?php echo isset($password) ? $password : ''; ?>">
                </div>

                <button class="block m-auto mt-4 py-2 px-4 rounded-md border-2 border-[#0c1435] bg-[#060918] hover:bg-[#130935] hover:border-[#3a0849]" type="submit">Submit</button>
            </form>

            <?php include __DIR__ . '/getback.php' ?>

        </div>
    </main>
</body>

<?php include './footer.php' ?>