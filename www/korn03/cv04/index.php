<?php 

/*
$file = fopen('./database.db', 'w');
fwrite($file, $email);
fclose($file);
*/
/*
file_put_contents('./database.db', $email, FILE_APPEND);
$dbContent = file_get_contents('./database.db');
var_dump($dbContent);
*/
?>
<?php include './head.php' ?>

<body>
<div class="container w-50">
    <a href="./registration.php">New here? Register</a>
    <a href="./login.php">Log in</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
<?php include './foot.php'; ?>