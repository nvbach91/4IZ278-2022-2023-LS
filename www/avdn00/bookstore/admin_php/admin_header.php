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
       <div class="flex">
           <a href="admin_home.php" class="logo_admin">Admin<span>Board</span></a>

           <nav class="navbar">
               <a href="admin_home.php">home</span></a>
               <a href="admin_products.php">products</span></a>
               <a href="admin_orders.php">orders</span></a>
               <a href="admin_users.php">users</span></a>
               <a href="admin_messages.php">messages</span></a>
           </nav>

           <div class="icons">
               <div id="user-button" class="fas fa-user"></div>
           </div>

           <div class="account-box">
               <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
               <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
               <a href="../customer_php/logout.php" class="delete-button">Logout</a>
           </div>
       </div>


   </header>