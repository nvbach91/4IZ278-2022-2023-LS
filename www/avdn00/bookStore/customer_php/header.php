   <?php
    include '../config.php';
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
            <div class="message">
                <span>' . htmlspecialchars($message) . '</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
             </div>
            ';
        }
    }

    ?>

   <header class="header">
       <div class="header-1">
           <div class="flex">
               <div class="share">
                   <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
                   <a href="https://twitter.com/i/flow/login" class="fab fa-twitter"></a>
                   <a href="https://www.instagram.com/?hl=cs" class="fab fa-instagram"></a>
                   <a href="https://www.linkedin.com/login/cs" class="fab fa-linkedin"></a>
               </div>
               <p>new <a href="../login.php">login</a> | <a href="../register.php">register</a></p>
           </div>
       </div>

       <div class="header-2">
           <div class="flex">

               <a href="./home.php" class="logo-main">
                   <p>Book<span>Worms</span><img alt="logo" src="../img/open-book.png"></p>
               </a>
               <nav class="navbar">
                   <a href="./home.php">Home</a>
                   <a href="./about.php">About</a>
                   <a href="./shop.php">Shop</a>
                   <a href="./contact.php">Contact</a>
                   <a href="./orders.php">Orders</a>
               </nav>

               <div class="icons">
                   <a href="./search.php" class="fas fa-search"></a>
                   <div id="user-button" class="fas fa-user"></div>
                   <?php
                    $query = "SELECT * FROM `cart` WHERE user_id = '$user_id'";
                    $select_cart_number = mysqli_query($connection, $query) or die('query failed');
                    $cart_rows_number = mysqli_num_rows($select_cart_number);
                    ?>
                   <a href="./cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo htmlspecialchars($cart_rows_number); ?>)</span> </a>
               </div>

               <div class="user-box">
                   <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                   <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                   <a href="logout.php" class="delete-button">Log out</a>
               </div>
           </div>
       </div>

   </header>