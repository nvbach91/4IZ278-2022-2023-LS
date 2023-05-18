<?php
session_start();
require_once 'db.php';

if (isset($_POST["register"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];

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
    $stmt = $pdo->prepare('INSERT INTO user (username, password, name, email, phone, address, isAdmin) VALUES (:username, :password, :name, :email, :phone, :address, "false")');
    $stmt->execute([
        "username" => $username,
        'password' => $hashedPassword,
        'name' => $name, 
        'email' => $email, 
        'phone' => $phone, 
        'address' => $address
    ]);

    //ted je uzivatel ulozen, bud muzeme vzit id posledniho zaznamu pres last insert id (co kdyz se to potka s vice requesty = nebezpecne),
    // nebo nacist uzivatele podle mailove adresy (ok, bezpecne)

    // $stmt = $pdo->prepare('SELECT user_id FROM user WHERE email = :email LIMIT 1'); //limit 1 jen jako vykonnostni optimalizace, 2 stejne maily se v db nepotkaji
    // $stmt->execute([
    //     'email' => $email
    // ]);
    // $user_id = (int) $stmt->fetchColumn();

    // $_SESSION['user_id'] = $user_id;
    // $_SESSION['user_email'] = $email;
    // $_SESSION['isAdmin'] = $isAdmin;

    // setcookie('user', $email, time() + 3600);
    header('Location: index.php');
    exit;
}
?>