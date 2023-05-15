<?php
Session::regenerate();

if( !isset( $_SESSION["user"] ) ){
    return redirect()->route("login");
}

$items = $_SESSION["items"];
?>
