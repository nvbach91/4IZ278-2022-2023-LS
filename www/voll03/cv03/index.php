<?php
//session_start();

$heading = "Card Tournament - Registration";
?>

<?php include './head.php' ?>

<body>
    <section class="p-6 box-border font-sans h-screen bg-gradient-to-br from-black via-[#00031b] to-[#090018]">
        <h1 class="text-3xl text-center font-heading text-white"><?php echo $heading ?></h1>
        <main class="flex flex-col content-center flex-wrap">
            <?php include './form/form.php' ?>
        </main>
    </section>
</body>

<?php include './footer.php' ?>