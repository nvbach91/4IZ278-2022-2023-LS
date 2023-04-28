<!-- bez oprávnění -->

<?php
session_start();
require './db/db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = 'SELECT * FROM cv10_users WHERE email = :email LIMIT 1';
    $statement = $pdo->prepare($query); 
    $statement->execute(['email' => $email]);
    $existing_user = @$statement->fetchAll()[0];

    if (password_verify($password, $existing_user['password'])) {
        $_SESSION['user_id'] = $existing_user['user_id'];
        $_SESSION['user_email'] = $existing_user['email'];

        header('Location: index.php');
        exit;
    }
}
?>
<?php include './app/header.php';?>

<main class="max-w-4xl mx-auto">
        <section id="login" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Login</h2>
                <form class="w-full max-w-sm" method="POST">
                    <div class="flex items-center border-b border-amber-100 py-2">
                        <input id="email" name="email" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="email" placeholder="Your Email" aria-label="email">
                    </div>
                    <div class="flex items-center border-b border-amber-100 py-2">
                        <input id="password" name="password" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="Your Password" aria-label="password">
                    </div>
                    <div class="flex justify-center items-center border-b border-amber-100 py-2">
                        <button class="flex-shrink-0 bg-amber-100 hover:bg-amber-50 border-amber-100 hover:border-amber-50 text-sm dark:text-black border-4 py-1 px-2 rounded" type="submit">
                        Login
                        </button>
                    </div>
                </form>
                <div class="text flex justify-center items-center py-8">
                    <a class="text-2xl text-center sm:text-4xl mb-7 text-slate-900 dark:text-white hover:text-slate-700 hover:dark:text-slate-300" href="registration.php">Don't have an account? Register</a>
                </div>
            </div>
        </section>
    </main>

<?php include './app/footer.php';
    ?>