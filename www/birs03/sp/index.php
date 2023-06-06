<?php 
session_start();
?>
<?php require 'header.php'; ?>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5 text-center">
                <?php require_once 'CategoryDisplay.php'?>
            </div>
            <div class="container px-4 px-lg-5 mt-5">
                <?php require_once 'ProductDisplay.php'?>
            </div>
        </section>
<?php require 'footer.php'; ?>
