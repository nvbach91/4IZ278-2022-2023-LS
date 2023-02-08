<?php
require 'db.php';
$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   # pokud nenastavime platnost, tak je cookie platna jen pro tuto session
   #setcookie("name", $_POST['name']);
   
   # platnost cookie bude 1 hodina od ulozeni
   # pozor, neni to bezpecne, cookie se da v klidu precist a zmenit!
   # cookie je soucasti HTTP hlavicky, takze ji musime nastavit jeste PREDTIM, nez neco posleme na vystup (at uz redirect nebo nejaky text, html, apod.)
   setcookie("name", $_POST['name'], time() + 3600); # ted + 3600 sekund = 1 hodina
   header('Location: index.php');
   exit();
}
?>
<?php require './incl/header.php'; ?>
   <?php include './incl/navbar.php'; ?>
   <main class="container">
      <h1>Login</h1>
      <form method="POST">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>
<?php require './incl/footer.php'; ?>