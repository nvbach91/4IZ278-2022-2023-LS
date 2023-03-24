<?php
session_start();
require 'db.php';

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO PRO STUDENTY osetrit vstupy, email a heslo jsou povinne, atd.
    // TODO PRO STUDENTY jde se prihlasit prazdnym heslem, jen prototyp, pouzit filtry
    // $password = md5($_POST['password']); #chybi salt

    // $password = hash("sha256" , $password); #chybi salt

    // viz http://php.net/manual/en/function.password-hash.php
    // salt lze generovat rucne (nedoporuceno), nebo to nechat na php, ktere salt rovnou pridat do hashovaneho hesla

    /**
     * We just want to hash our password using the current DEFAULT algorithm.
     * This is presently BCRYPT, and will produce a 60 character result.
     *
     * Beware that DEFAULT may change over time, so you would want to prepare
     * By allowing your storage to expand past 60 characters (255 would be product)
     */
    // dalsi moznosti je vynutit bcrypt: PASSWORD_BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //vlozime usera do databaze
    $stmt = $db->prepare('INSERT INTO cv11_users(name, email, password) VALUES (:name, :email, :password)');
    $stmt->execute([
        'name' => $name, 
        'email' => $email, 
        'password' => $hashedPassword
    ]);

    //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
    // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)

    $stmt = $db->prepare('SELECT user_id FROM cv11_users WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    $stmt->execute([
        'email' => $email
    ]);
    $user_id = (int) $stmt->fetchColumn();

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;

    header('Location: index.php');
}
?>


<?php require __DIR__ . '/incl/header.php' ?>
<main class="container">
    <h1>PHP Shopping App</h1>
    <h2>New Signup</h2>
    <form class="form-signin" method="POST">
        <div class="form-label-group">
            <label for="name">Full name</label>
            <input type="name" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-label-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" placeholder="Email address" required>
        </div>
        <div class="form-label-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Creat account</button>
    </form>
</main>
<div style="margin-bottom: 600px"></div>
<?php require __DIR__ . '/incl/footer.php' ?>
