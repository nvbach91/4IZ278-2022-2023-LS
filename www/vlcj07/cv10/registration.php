<?php
session_start();
require './db/db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $privilege = 1;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $query = 'INSERT INTO cv10_users(privilege, email, password) VALUES (:privilege, :email, :password)';
    $statement = $pdo->prepare($query);
    $statement->execute(['privilege' => $privilege, 'email' => $email, 'password' => $hashedPassword]);

    header("Location: login.php");
}
?>
<?php include './app/header.php';?>

<main class="max-w-4xl mx-auto">
        <section id="login" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-5xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">Registration</h2>
                <form class="w-full max-w-sm" method="POST">
                    <div class="flex items-center border-b border-amber-100 py-2">
                        <input id="email" name="email" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="email" placeholder="Your Email" aria-label="email">
                    </div>
                    <div class="flex items-center border-b border-amber-100 py-2">
                        <input id="password" name="password" class="appearance-none bg-transparent border-none w-full  mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="Your Password" aria-label="password">
                    </div>
                    <div class="flex justify-center items-center border-b border-amber-100 py-2">
                        <button class="flex-shrink-0 bg-amber-100 hover:bg-amber-50 border-amber-100 hover:border-amber-50 text-sm dark:text-black border-4  py-1 px-2 rounded" type="submit">
                        Register
                        </button>
                    </div>
                </form>
                <div class="text flex justify-center items-center py-8">
                    <a class="text-2xl text-center sm:text-4xl mb-7 text-slate-900 dark:text-white hover:text-slate-700 hover:dark:text-slate-50" href="login.php">Already have an account? Login</a>
                </div>
                
            </div>
        </section>
    </main>

<?php include './app/footer.php';
    ?>