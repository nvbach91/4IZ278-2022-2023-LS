<div class="header">
  <a href='main_news.php'><span class="logo">DwGym</span></a>
  <span class="noForms">
    <a href="main_booking.php"><input type="Submit" name="t1" class="submit" value="Timetable"></a>
    <a href="main_about.php"><input type="Submit" name="t1" class="submit" value="About"></a>
    <a href="main_contacts.php"><input type="Submit" name="t1" class="submit" value="Contacts"></a></span>
    <div class="square"></div>
    <?php
      if(isset($_SESSION["forename"]) AND ($_SESSION["forename"] == "" OR $_SESSION["surname"] == "") AND !isset($news)){
      header("Location: main_news.php");
    }
    $forename = ucwords(substr($_SESSION["forename"],0,2));
    $surname = ucwords(substr($_SESSION["surname"],0,2));
    if (isset($_SESSION["email"])){
       $_SESSION["privilege"] = 0;
       $_SESSION["user"] = 'googleAuth';
            $_SESSION["primary"] = '#adbf39';
            $_SESSION["secondary"] = '#ffb37b';
            $_SESSION["forename"] = 'google';
            $_SESSION["surname"] = 'auth';
            
    }
    
    
    if (isset($_SESSION["user_id"]) OR isset($_SESSION["iduser"])){ ?>
      <div class="rightside">
        <span class="forms">
              <?php  if (!isset($_SESSION["email"])){ ?>
          <form action="main_user.php" method="post">
            <input type='Submit' class='account' value='Account'>
          </form>
          <?php }?>
          <form action="main_logout.php" method="post">
            <input type='Submit' class='logout' value='Log out'>
          </form>

          <span class ='user'><p><?php echo $forename; echo $surname; ?></p></span>
          <span class="userLogo"><i class='fas fa-user'></i></span>
        </span>
      </div>
      <?php
    }
    else {
      ?>
      <div class="rightside">
        <span class="forms_noReg">
          <form action="main_login.php" method="post">
            <input type="Submit" name="t1" class="log" value="Log in">
          </form>
          <div class="or">or</div>
          <form action="main_signin.php" method="post">
            <input type="Submit" name="t1" class="sign" value="Sign in">
          </form>
        </span>
      </div>
    <?php } ?>
  </div>
  <div class="line"></div>
