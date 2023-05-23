<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../../req/metadata.php') ?>
    <title>Profile | SuperCafé</title>
</head>

<body>
    <?php $activePage = "profile";
    include_once('../../req/header_v.php') ?>
    <main id='profile' class="visit">
        <div class="visit__box">
            <h2>My profile</h2>
            <form v-if='profile' @submit.prevent='saveProfile'>
                <label>
                    <p>Firstname</p>
                    <input type="text" v-model='profile.firstname'>
                </label>
                <label>
                    <p>Surname</p>
                    <input type="text" v-model='profile.surname'>
                </label>
                <label>
                    <p>Phone</p>
                    <input type="text" v-model='profile.phone'>
                </label>
                <button :disabled='!profile.firstname||!profile.surname||!profile.phone' type="submit">Save profile</button>
            </form>
            <form @submit.prevent='changePass'>
                <label>
                    <p>Old password</p>
                    <input type="password" v-model='oldPass'>
                </label>
                <label>
                    <p>New password</p>
                    <input type="password" v-model='newPass'>
                </label>
                <label>
                    <p>Confirm password</p>
                    <input type="password" v-model='newPassC'>
                </label>
                <p v-if='newPass!==newPassC' class="err">Passwords do not match</p>
                <button :disabled='!oldPass||!newPass||newPass!==newPassC' type="submit">Change password</button>
            </form>
        </div>
    </main>
    <script src='./script.js'></script>
</body>

</html>