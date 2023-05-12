<?php
require_once('index.php');
if (!empty($_SESSION['adress'])) {
    header("Location: index.php");
} ?>



<body>
    <section>
        <div class="errors">

            <?php
            if (!empty($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            ?>

        </div>
        <div class="form-box">
            <div class="form-value">
                <form action="noRegister.php" method="post">
                    <h2>Adress Form</h2>
                    <div class="inputbox">
                        <input type="text" name="email" placeholder="E-mail">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">E-mail</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="name" placeholder="Name">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">Name</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="surname" placeholder="Surname">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">Surname</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="adress" placeholder="Adress">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">Adress</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="postalCode" placeholder="Postal code">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">Postal code</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="phone" placeholder="Phone number">
                        <ion-icon name="mail-outline"></ion-icon>
                        <label for="">Phone number</label>
                    </div>
                    <div class="continueButton">
                        <button>Submit</button>
                    </div>
                    <div class="register">
                        <a href="registration.php">Don't have an account? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>