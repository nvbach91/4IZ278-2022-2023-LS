<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<style type="text/css">
<?php
if (isset($_SESSION["user"])){
    echo (":root{  --primary: ".$_SESSION["primary"]."; --secondary: ".$_SESSION["secondary"].";}");
}
else {
    echo (":root{  --primary: #adbf39; --secondary: #ff9d57;}");
}
if ($_SESSION["privilege"] >= 2) {
?>body{
  overflow-x: scroll;
}<?php
}
?>
</style>
  <link rel="icon" href="icon/favicon.ico" type="image/x-icon"/>
