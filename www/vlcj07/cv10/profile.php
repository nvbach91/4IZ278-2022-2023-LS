<!-- opr 1 -->

<?php
require './db/db.php';
require 'authorization.php';

?>
<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white"><?php echo $_SESSION['user_email'] ?>'s Profile</h2>
            <p>Welcome to your profile. In the future you could change your profile info and password right here. :)</p>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>