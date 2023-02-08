<?php

//pripojeni do db na serveru eso.vse.cz
$db = new PDO('mysql:host=localhost;dbname=test07;charset=utf8mb4', 'root', 'root');
//vyhazuje vyjimky v pripade neplatneho SQL vyrazu
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
