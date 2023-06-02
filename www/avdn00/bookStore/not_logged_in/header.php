   <?php

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
               <p><a href="../login.php">login</a> | <a href="../register.php">register</a></p>
           </div>
       </div>

       <div class="header-2">
           <div class="flex">

               <a href="../index.php" class="logo-main">
                   <p>Book<span>Worms</span><img alt="logo" src="../img/open-book.png"></p>
               </a>
               <nav class="navbar">
                   <a href="../index.php">Home</a>
                   <a href="./about.php">About</a>
                   <a href="./shop.php">Shop</a>
                   <a href="./contact.php">Contact</a>
                   <a href="./orders.php">Orders</a>
               </nav>

               <div class="icons">
                   <a href="./search.php" class="fas fa-search"></a>
                   <div id="user-button" class="fas fa-user"></div>
                   <a href="./cart.php"><i class="fas fa-shopping-cart"></i></a>
               </div>

               <div class="user-box">
                   <p>You are not logged in</span></p>
                   <a href="../login.php" class="button">Log in</a>
               </div>
           </div>
       </div>

   </header>