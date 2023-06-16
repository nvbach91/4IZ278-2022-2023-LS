<?php
require 'authorization.php';
require 'admin-required.php';
require '../models/OrdersDB.php';

$ordersDatabase = new OrdersDatabase();

$orders = $ordersDatabase->fetchAll();
