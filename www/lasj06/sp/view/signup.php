<?php include '../controller/signup_controller.php' ?>

<?php require __DIR__ . "/incl/header.php"; ?>
<h1>DiscShop</h1>
<h2>Registration</h2>
<form class="form" method="POST">
    <div>
        <label for="email">Email address</label>
        <input type="email" name="email" placeholder="Email address" required>
    </div>
    <div>
        <label for="full_name">Full name</label>
        <input type="name" name="full_name" placeholder="Full name" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <br>
    <button type="submit">Create account</button>
    <?php if (!empty($errors)) : ?>
        <div>
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</form>


<?php require __DIR__ . "/incl/footer.php"; ?>