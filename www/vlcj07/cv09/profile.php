<?php
require './db/db.php';
$username = @$_POST['username'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie('username', $username, time() + 3600);
    header('Location: profile.php');
    exit();
}
?>
<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white"><?php echo $_COOKIE['username'] ?>'s Profile</h2>
            <form class="w-full max-w-sm" method="POST">
                <div class="flex items-center border-b border-amber-100 py-2">
                    <input id="username" name="username" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="New Username" aria-label="username">
                    <button class="flex-shrink-0 bg-amber-100 hover:bg-amber-50 border-amber-100 hover:border-amber-50 text-sm dark:text-black border-4  py-1 px-2 rounded" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>