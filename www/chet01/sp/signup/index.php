<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('../req/metadata.php') ?>
    <title>Sign Up | SuperCafe</title>
</head>

<body>
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
                <p>Password</p><input type="text" v-model='user.password'>
            </label>
            <label>
                <p>Phone</p><input type="text" v-model='user.phone'>
            </label>
            <button type="submit">Signup</button>
        </form>
    </main>
    <!-- <script>
        let userData = {
            firstname: 'Tanya',
            surname: "Tanya",
            email: 'chess@email.cz',
            phone: '123123123',
            password: 'heslo'
        }
        fetch("http://localhost:8080/semestralka/api/index.php/registerUser", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(userData),
            })
            .then((response) => {
                console.log(response)
            })
    </script> -->

    <script src='./script.js'></script>
</body>

</html>