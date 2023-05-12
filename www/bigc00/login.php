<?php
$name = @$_POST['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   setcookie("name", $_POST['name'], time() + 3600);
   header('Location: index.php');
   exit();
}
?>
<?php require 'header.php'; ?>
   <main class="container">
      <form method="POST">
         <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>