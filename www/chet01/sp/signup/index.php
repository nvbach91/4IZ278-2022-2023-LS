<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../req/metadata.php') ?>
    <title>Sign Up | SuperCafé</title>
</head>

<body>
    <?php $activePage = "signup";
    include_once("../req/header.php") ?>
    <main id='signup'>
        <form @submit.prevent='sendForm'>
            <label>
                <p>Firstname</p><input type="text" v-model='user.firstname'>
            </label>
            <label>
                <p>Surname</p><input type="text" v-model='user.surname'>
            </label>
            <label>
                <p>Email</p><input type="email" v-model='user.email'>
            </label>
            <label>
                <p>Password</p><input type="password" v-model='user.password'>
            </label>
            <label>
                <p>Phone</p><input type="text" v-model='user.phone'>
            </label>
            <button type="submit">Signup</button>
        </form>
    </main>
    <script src='./script.js'></script>
</body>

</html>